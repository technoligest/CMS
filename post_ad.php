<?php
require "includes/functions.php";
include "includes/header.php";

$cat_id = "-1";

if (!isset($_GET['cat_id'])) {
    header("Location:choose_category.php");
}
$cat_id = test_form_input($_GET['cat_id']);
$result = $conn->query("SELECT * FROM categories WHERE cat_id=$cat_id");
if (!$result || $result->num_rows == 0) {
    header("Location:choose_category.php");
}
?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
        include "includes/forms/post_ad_form.php";
        ?>
    </div>
<?php
include "includes/footer.php";
?>