<?php
//this helps us with debugging with the filetype set to text
header('content-type: text/plain');

require("../connect_db.php");
require("../functions.php");


//exit the file if the button is not pressed
if (!isset($_POST['signup_btn'])) {
    header("Location: ../../signup.php");
}

$username = test_form_input($_POST['username']);

$statement = $conn->prepare("SELECT user_activation_link FROM users WHERE user_username = ?");
$statement->bind_param("s", $username);
$statement->execute();
$statement->bind_result($activation_link);

//if the user exists in the database
if ($statement->fetch()) {
    $recipients = $username;
    $sender = "info@yaser.ca";
    $message = "";
    $subject = "";
    $template = "";

    //if the user exists and has already been activated
    if ($activation_link == "true") {
        $subject = "Your account is already activated.";
        $message = htmlentities("Hello!\n\nYour account is already activated.\n\n Please sign in here.<a href\"" . WEBSITE . "\">" . WEBSITE . "</a>\n\nThank you.\n");
        $template = replaceParameters(["<!--message-->" => "$message"], file_get_contents('../../phpmailer/templates/general_template.tpl'));
    } //if the user exists but has not activated their account yet
    else {
        $link = WEBSITE . '/activate.php?userid=' . $activation_link;
        $subject = "Please activate your account.";
        $message = htmlentities("Hello!\n\nPlease activate your account through this link");
        $template = replaceParameters(["<!--activation-link-->" => "$link"], file_get_contents('../../phpmailer/templates/new_registration.tpl'));
    }

    sendEmail($recipients, $sender, $template, $subject);

    $message = urlencode("Please check your email for the next steps.");
    header("Location: ../../index.php?successMessage=$message");
    exit();
}


//adding the user into the database.
$statement->reset();
$password = password_hash(test_form_input($_POST['password']), PASSWORD_BCRYPT);
$link = generateLink($conn);
$statement = $conn->prepare("INSERT INTO users (user_username,user_password,user_activation_link) VALUES(?, ?, ?)");
$statement->bind_param("sss", $username, $password, $link);
$statement->execute();
$statement->reset();
require("../close_db.php");

$link = WEBSITE . '/activate.php?userid=' . $link;

$recipients = $username;
$sender = "info@yaser.ca";
$subject = "Please activate your account.";
$template = replaceParameters(["<!--activation-link-->" => "$link"], file_get_contents('../../phpmailer/templates/new_registration.tpl'));
sendEmail($recipients, $sender, $template, $subject);

$message = urlencode("Please follow instructions in your email to complete activation.");
header("Location: ../../index.php?successMessage=$message");
exit();

//generate a random link that does not exist in the given database connection.
function generateLink($conn)
{
    $length = 20;
    do {
        $random_string = substr(str_shuffle("_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        $result = $conn->query("SELECT activation_link FROM login WHERE activation_link='$random_string'");
    } while ($result && $result->num_rows > 0);
    return $random_string;
}

?>

