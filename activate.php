<?php
//this file's job is to activate a user or post

if(isset($_GET['userid'])){

    require("includes/functions.php");
    $link = test_form_input($_GET['userid']);

    require_once("includes/connect_db.php");
    $stmt = $conn->prepare("UPDATE login SET activated='true' WHERE activation_link=?");
    $stmt->bind_param("s",$link);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $message = "successMessage=".urlencode("Your account has been activated.");
    }
    else{
        $message = "failureMessage=".urlencode("Invalid validation URL.");
    }
    echo $message;
    require_once("includes/close_db.php");
    header("Location: ./index.php?$message");
}
else if(isset($_GET['postid'])){
    require("includes/functions.php");
    $link = test_form_input($_GET['postid']);
    require_once("includes/connect_db.php");
    $stmt = $conn->prepare("UPDATE ads SET ad_status='activated' WHERE activation_link=?");
    $stmt->bind_param("s",$link);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        $message = "successMessage=".urlencode("Your post has been activated.");
    }
    else{
        $message = "failureMessage=".urlencode("Invalid validation URL.");
    }
    require_once("includes/close_db.php");
    header("Location: ./index.php?$message");
}
else{
    header("Location: ./index.php");
}
?>