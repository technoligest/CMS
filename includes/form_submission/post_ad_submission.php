<?php
header('content-type: text/plain');
print_r($_POST);
if (isset($_POST['post_ad_btn'])) {

    require_once("../functions.php");
    require_once("../connect_db.php");
    $statement = $conn->prepare("INSERT INTO ads (ad_date,
    ad_type,
    ad_price,
    ad_for_sale_by,
    ad_title,
    ad_description,
    ad_location_id,
    ad_user_email,
    ad_user_phone, 
    ad_cat_id, 
    ad_cat_section_id, 
    ad_approve_status, 
    ad_status) VALUES(now(),?,?,?,?,?,?,?,?,?,?,?,?)");

    $statement->bind_param("sisssissiiss",
        $type,
        $price,
        $forSaleBy,
        $title,
        $description,
        $city_id,
        $email,
        $phone,
        $cat_id,
        $cat_section_id,
        $approve_status,
        $ad_status);

    $type = test_form_input($_POST['ad_type']);
    $price = test_form_input($_POST['ad_price']);
    $forSaleBy = test_form_input($_POST['for_sale_by']);
    $title = test_form_input($_POST['ad_title']);
    $description = test_form_input($_POST['ad_description']);
    $city_id = test_form_input($_POST['ad_location']);
    $phone = test_form_input($_POST['ad_phone']);
    $email = test_form_input($_POST['ad_email']);
    $cat_id = test_form_input($_POST['ad_cat_id']);
    $cat_section_id = test_form_input($_POST['ad_cat_section_id']);

    $approve_status = "approved"; //currently approved is the default, but it should be changed to pending.
    $ad_status = "draft";//user has to sign in

    $r = $statement->execute();
    echo $statement->error;
    $id = $conn->insert_id;

    $statement->reset();
    if (isset($_POST['fileuploader-list-files']) && $_POST['fileuploader-list-files']) {
        $arr = json_decode($_POST['fileuploader-list-files']);
        foreach ($arr as &$picture_name) {
            $statement = $conn->prepare("INSERT INTO pictures(pic_ad_id, picture_name)VALUES(?,?)");
            $pic_name =
                substr($picture_name, 3);
            echo $picture_name . "\n";
            echo $pic_name . "\n\n";
            $statement->bind_param("is", $id, $pic_name);
            $statement->execute();
            $statement->reset();
        }
    }

    $recipients = $email;
    $sender = "technoligest@gmail.com";
    $subject = "Activate your ad today!";
    $link = generateLink($conn);
    $message = htmlentities("Hello!\n\nPlease activate your post through this link \n\n <a href\"" . WEBSITE."/activate?postid=$link" . "\">" . WEBSITE."/activate?postid=$link" . "</a>\n\nThank you.\n");
    $template = replaceParameters(["<!--message-->" => "$message"], file_get_contents('../../phpmailer/templates/general_template.tpl'));

    sendEmail($recipients, $sender, $template, $subject);

    if (!isset($_SESSION['firstname'])) {
        $message = urlencode("Follow the link in your email to activate your ad.");
        header("Location:../../index.php?successMessage=$message");
    } else {
        header("Location:../../my_ads.php");
    }
}

require_once("../close_db.php");

//generate a random link that does not exist in the given database connection.
function generateLink($conn)
{
    $length = 20;
    do {
        $random_string = substr(str_shuffle("_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        $result = $conn->query("SELECT activation_link FROM ads WHERE ad_activation_link='$random_string'");
    } while ($result && $result->num_rows > 0);
    return $random_string;
}

?>