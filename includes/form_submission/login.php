<?php
session_start();
header('content-type: text/plain');
require("../connect_db.php");
require("../functions.php");

/* Process data submitted by login form */
if (isset($_POST['login_btn'])) {
    echo "button has been pressed\n";
    $username = test_form_input($_POST['username']);
    $password = test_form_input($_POST['password']);

    if ($username != null && $password != null) {
        $query = "SELECT * FROM login WHERE username = '$username'";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0 && ($row = $result->fetch_assoc()) && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
        }
    }
}
date_default_timezone_set('America/Halifax');
setcookie("cms_access", Date("M d, Y g:i a"), time() + 365 * 400, "/");
if (isset($_SESSION) && isset($_SESSION['username'])) {
    $message = urldecode("Welcome! You are signed in now.");
    header("location: ../../index.php?successMessage=$message");
} else {
    header("location: ../../login.php?loginError=true");
}
require("../close_db.php");