<?php
$cat_id="-1";
$cat_section_id="-1";

if(isset($_GET['cat_section_id']) && isset($_GET['cat_id'])){
    $cat_id
}
elseif(isset($_GET['cat_id'])){
    $cat_id
}
else{
   header("Location:choose_category.php");
}
require "includes/functions.php";
include "includes/header.php";
include "includes/full_pages/post_ad.php";
include "includes/footer.php";
?>