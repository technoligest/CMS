<?php
$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}
?>