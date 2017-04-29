<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the page header to be included on all pages.
-->
<?php

/* Process data submitted by report issues form */
if (isset($_POST['reportIssues'])) {
    $preferred_name = test_form_input($_POST['preferredname']);
    $email = test_form_input($_POST['email']);
    $issueID = test_form_input($_POST['issues']);
    $issue_reported = "";
    $message = test_form_input($_POST['message']);

    $dateTimeObject = new DateTime("now", new DateTimeZone("America/Halifax"));
    $dateTimeObject->setTimestamp(time()); //adjust the object to correct timestamp
    $message_date = $dateTimeObject->format('d.m.Y,');
    $message_time = $dateTimeObject->format('H:i:sa');

    switch ($issueID) {
        case '1':
            $issue_reported = "Link Not Working";
            break;

        case '2':
            $issue_reported = "Page Not Found";
            break;

        case '3':
            $issue_reported = "Incorrect Script";
            break;

        default:
            $issue_reported = "Issue Not Selected";
            break;
    }

    $issue_report = "";
    $issue_report .= "Issue Alert!";
    $issue_report .= "\r\n";
    $issue_report .= "Type of Issue: " . $issue_reported;
    $issue_report .= "\r\n";
    $issue_report .= "\r\n";
    $issue_report .= "Submitted by: " . $preferred_name;
    $issue_report .= "\r\n";
    $issue_report .= "Email ID: " . $email;
    $issue_report .= "\r\n";
    $issue_report .= "Submitted At: " . $message_time . " - on - " . $message_date;
    $issue_report .= "\r\n";
    $issue_report .= "\r\n";
    $issue_report .= "Details: " . $message;

    $issue_file_name = "misc/message_" . time() . ".txt";
    $issue_file_handle = fopen($issue_file_name, "w") or die("Sorry! Unable to open file!");

    fwrite($issue_file_handle, $issue_report);

    fclose($issue_file_handle);

    $current_page = basename($_SERVER['PHP_SELF']);

    header("Location: " . $current_page . "?issue_reported=1");
}
const TWO_MEGA_BYTES = 2097152;
$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/mystyles.css">
        
        <title>Home page</title>
    </head>
    <body>
        <!-- Container -->
        <div class="container myContainer">
            <div class="row">

                <!--************************************************
Standard Bootstrap Navigation - customized
for this CMS website assignment
Available: http://getbootstrap.com/components/#nav
*************************************************-->
                <header>
                    <?php require_once "navigation.php"; ?>
                </header>
