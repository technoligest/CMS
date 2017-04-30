<?php
require "includes/functions.php";
include "includes/header.php";

$cat_id="-1";
$cat_section_id="-1";

if(isset($_GET['cat_section_id']) && isset($_GET['cat_id'])){

    $cat_section_id = test_form_input($_GET['cat_section_id']);
    $cat_id = test_form_input($_GET['cat_id']);

    $result = $conn->query("SELECT * FROM category WHERE category.cat_id=$cat_id");
    if(!$result || !$result->num_rows>0){
        header("Location:choose_category.php");
    }
    $result = $conn->query("SELECT * FROM category_sections WHERE cat_section_id=$cat_section_id");
    if(!$result || !$result->num_rows>0){
        header("Location:choose_category.php");
    }
}
elseif(isset($_GET['cat_id'])){
    $cat_id = test_form_input($_GET['cat_id']);
    $result = $conn->query("SELECT * FROM category WHERE category.cat_id=$cat_id");
    if(!$result || !$result->num_rows>0){
        header("Location:choose_category.php");
    }
}
else{
    header("Location:choose_category.php");
}


include "includes/full_pages/post_ad.php";
include "includes/footer.php";
?>