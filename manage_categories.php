<?php
require_once("includes/header.php");
//require_once("includes/full_pages/manage_categories.php");



/* Delete a category when the "delete" button is pressed */
if (isset($_GET['delete_category'])) {
    $delete_this_category = test_form_input($_GET['delete_category']);
    $delete_cat_status = delete_category($delete_this_category);
    if ($delete_cat_status) {
        $message=urlencode("Category has been deleted successfully.");
        header("Location: manage_categories.php?successMessage=$message");
    }
    else{
        $message=urlencode("Category could not be deleted properly.");
        header("Location: manage_categories.php?failureMessage=$message");
    }
}


/* Function that submits the category to the database */
if (isset($_POST['add_category'])) {
    $cat_title = $_POST['cat_title'];
    insert_category($cat_title);
}


/* Statements that Update the category in the database */
if (isset($_POST['update_this_cat'])) {
    $cat_title_to_be_updated = test_form_input($_POST['updated_cat_title']);
    $cat_id_to_be_updated = $_GET['update_category'];
    $sql = "UPDATE category SET cat_title = '$cat_title_to_be_updated' WHERE cat_id = $cat_id_to_be_updated";
    $result_update_category = $conn->query($sql);
    if (!$result_update_category) {
        die("<p><em>Sorry, could not update category!</em></p>" . $conn->error);
    }
    else {
        header("Location: categories.php");
    }
}

/* Script to update a category that is visible in the HTML table on the right */
if (isset($_GET['update_category'])) {
    $update_this_cat_id = $_GET['update_category'];
    $sql = "SELECT * FROM category WHERE cat_id = $update_this_cat_id";
    $result_select_category = $conn->query($sql);
    if ($result_select_category->num_rows > 0) {
        while ($row = $result_select_category->fetch_assoc()) {
            $update_this_cat_title = $row['cat_title'];
        }
    }
}

?>



<div class="col-md-12 col-sm-12">
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <?php 
            require("includes/forms/add_category.php");
            if (isset($_GET['update_category'])) {
                require("includes/forms/update_category.php");
            }
            ?>
        </div>
        <div class="col-sm-6 col-xs-6">
            <?php
            require("includes/full_pages/manage_categories.php");
            ?>
        </div>
    </div>
</div>

<?php
require_once("includes/footer.php");

