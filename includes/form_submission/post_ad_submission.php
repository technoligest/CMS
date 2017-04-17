<?php

if(isset($_POST['post_ad_btn'])){
    $
    $type = test_form_input( $_POST['ad_type']);
    $price = test_form_input( $_POST['ad_price']);
    $forSaleBy = test_form_input($_POST['for_sale_by']);
    $title = test_form_input($_POST['ad_title']);
    $description= test_form_input($_POST['ad_description']);
    $city = test_form_input($_POST['ad_location']);
    $phone = test_form_input($_POST['ad_phone']);
    $email = test_form_input($_POST['ad_email']);

    $statement = $conn->prepare("INSERT INTO posts () VALUES(?,?,?,?,?,?,?,?,?)");
}

?>