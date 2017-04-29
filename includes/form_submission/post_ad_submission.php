<?php
header('content-type: text/plain');
require_once("../functions.php");
require_once("../connect_db.php");
print_r($_POST);
session_start();
if(isset($_POST['post_ad_btn'])){


    $statement = $conn->prepare("INSERT INTO ads (
    ad_type,
    ad_price,
    ad_for_sale_by,
    ad_title,
    ad_description,
    ad_location_id,
    ad_user_email, 
    ad_user_phone, 
    ad_cat_id, 
    ad_cat_section_id, 
    ad_approve_status, 
    ad_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $statement->bind_param("sisssissiiss",
                           $type,
                           $price,
                           $forSaleBy,
                           $title,
                           $description,
                           $city_id,
                           $email,
                           $phone,
                           $cat_id,
                           $cat_section_id,
                           $approve_status,
                           $ad_status);

    $type = test_form_input( $_POST['ad_type']);
    $price = test_form_input( $_POST['ad_price']);
    $forSaleBy = test_form_input($_POST['for_sale_by']);
    $title = test_form_input($_POST['ad_title']);
    $description= test_form_input($_POST['ad_description']);
    $city_id = test_form_input($_POST['ad_location']);
    $phone = test_form_input($_POST['ad_phone']);
    $email = test_form_input($_POST['ad_email']);
    $cat_id = test_form_input($_POST['ad_cat_id']);
    $cat_section_id = test_form_input($_POST['ad_cat_section_id']);

    $approve_status = "approved"; //currently approved is the default, but it should be changed to pending.
    $ad_status = "draft";//user has to sign in

    $r = $statement->execute();
    echo "----".$conn->insert_id."----\n";
    echo "----".$statement->error."----";

    if(!isset($_SESSION['firstname'])){
        header("Location:../../login.php");
    }
    else{
        header("Location:../../my_ads.php");
    }

}

require_once("../close_db.php");
?>