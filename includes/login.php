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
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username . "<br>". $password;
    if ($username != null || $password != null) {

        $query = "SELECT * FROM login,users WHERE users.user_id=login.user_id && username = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows >0 && ($row = $result->fetch_assoc()) && password_verify($password,$row['password']) ) {
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['firstname'] = $row['user_firstname'];
            $_SESSION['lastname'] = $row['user_lastname'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = $row['user_role'];
            $_SESSION['user_image']= $row['user_image'];
            echo $_SESSION['firstname'] . "<br>".$_SESSION['lastname'];
            if (isset($_COOKIE['cms_access'])) {
                $_SESSION['currentDate'] = $_COOKIE['cms_access'];
            }
            else{
                 $_SESSION['currentDate'] = 'never.';
            }
        }
    }
}
date_default_timezone_set('America/Halifax');
setcookie("cms_access", Date("M d, Y g:i a"), time() + 365*400, "/");
if(isset($_SESSION) && isset($_SESSION['userId'])){
    header("location: ../index.php");
}else{
    header("location: ../index.php?loginError=true");
}
exit();
?>