<?php


session_start();
$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";
$currentDate= "---";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}

/* Process data submitted by login form */
if (isset($_POST['login'])) {
    $_SESSION['loggedIn'] = FALSE;
    $_SESSION['loginError'] = FALSE;

    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username . $password;
    if ($username != null || $password != null) {

        $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        //echo $query;
        $result = $conn->query($query);
        //die($result->num_rows);
        if ($result->num_rows >0) {
            $loggedIn = TRUE;
            $loginError = FALSE;
            $row = $result->fetch_assoc();

            $result2 = $conn->query("SELECT * FROM users WHERE user_id = {$row['user_id']}");
            if($result2->num_rows > 0){
                $row = $result2->fetch_assoc();
                $_SESSION['userId'] = $row['user_id'];
                $_SESSION['firstname'] = $row['user_firstname'];
                $_SESSION['lastname'] = $row['user_lastname'];
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $row['user_role'];
                $_SESSION['loggedIn'] = TRUE;
                $_SESSION['loginError'] = FALSE;
            }
            if (isset($_COOKIE['cms_access'])) {
                $_SESSION['currentDate'] = $_COOKIE['cms_access'];
            }
            else{
                $currentDate = 'never.';
            }
        }
        else {
            $_SESSION['loggedIn'] = FALSE;
            $_SESSION['loginError'] = TRUE;
            //echo "username or password were wrong";
        }
    }
}
date_default_timezone_set('America/Halifax');
setcookie("cms_access", Date("M d, Y g:i a"), time() + 365*400, "/");


header("location: ../index.php");
exit();
?>