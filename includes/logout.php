<?php
session_start();
session_unset();
session_destroy();
$message = urlencode("You have been successfully logged out.");
header("location: ../index.php?successMessage=$message");