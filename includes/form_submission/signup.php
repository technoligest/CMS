<?php
require("../connect_db.php");
require("../functions.php");
if(!isset($_POST['signup_btn'])){
    header("Location: ../../signup.php");
}

$username = test_form_input($_POST['username']);


$statement = $conn->prepare("SELECT username FROM login WHERE username = ?");
$statement->bind_param("s",$username);
$statement->execute();
$statement->bind_result($user);
$statement->fetch();

if($user){
    header("Location: ../../login.php?accountExists=true");
}
$statement->reset();
$password = password_hash(test_form_input($_POST['password']),PASSWORD_BCRYPT);
mysqli_report(MYSQLI_REPORT_ALL);
$statement = $conn->prepare("INSERT INTO login (username,password) VALUES(?, ?)");
$statement->bind_param("ss",$username,$password);
$statement->execute();
require("../close_db.php");
header("Location: ../../index.php");


?>