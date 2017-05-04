<?php
/**
 * Created by PhpStorm.
 * User: Technoligest
 * Date: 2017-05-02
 * Time: 4:35 PM
 */
if(!isset($_GET['id'])){
    header("Location: index.php");
}

require_once ("includes/functions.php");
require_once ("includes/header.php");

$id =test_form_input($_GET['id']);
$result = $conn->query("SELECT * FROM ads WHERE ads.ad_id=$id");

if(!$result || $result->num_rows<1){
    header("Location: index.php");
}



require_once ("includes/footer.php");