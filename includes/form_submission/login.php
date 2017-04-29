<?php
session_start();
require("../connect_db.php");

/* Process data submitted by login form */
if (isset($_POST['login_form'])) {
    $username = test_form_input($_POST['username']);
    $password = test_form_input($_POST['password']);
    echo $username . "<br>". $password;
    if ($username != null && $password != null) {

        $query = "SELECT * FROM login,users WHERE users.user_id=login.user_id && username = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows >0 && ($row = $result->fetch_assoc()) && password_verify($password,$row['password']) ) {
            $_SESSION['username'] = $_POST['username'];
        }
    }
}
date_default_timezone_set('America/Halifax');
setcookie("cms_access", Date("M d, Y g:i a"), time() + 365*400, "/");
if(isset($_SESSION) && isset($_SESSION['userId'])){
    header("location: ../../index.php");
}else{
    header("location: ../../login.php?loginError=true");
}


require("close_db.php");
?>