<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the categories page:
- Includes several other PHP scripts to implement the overall functionality.
- Allows users to view/edit/add categories.
-->
<?php require "../includes/functions.php"; ?>
<?php include "includes/header.php"; ?>

<div class="col-md-8 col-sm-12 col-no-left-padding">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);

    /* Delete a category when the "delete" button is pressed */
    if (isset($_GET['delete_category'])) {
        $delete_this_category = $_GET['delete_category'];

        $delete_cat_status = delete_category($delete_this_category);

        if ($delete_cat_status) {
            //Because this is a GET query and the page has already loaded, the removed category
            //might still be showing in the table.
            //To update the HTML table being displayed, you need to "refresh" or "reload" the page. 
            //We do so using the header() function.
            /************************************************************************************
					 * This is important because it reloads the page, and does not show 
					 * the ID of the deleted category in the address bar, after it has been deleted.
					 ************************************************************************************/
            header("Location: categories.php");
        }
    }

    /* Function that submits the category to the database */
    if (isset($_POST['add_category'])) {
        $cat_title = $_POST['cat_title'];
        insert_category($cat_title);
    }


    ?>
    <div class="row">
        <div class="col-xs-6">
            <!-- Create new category -->
            <form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cat_title">Add new category</label>
                    <input class="form-control" type="text" name="cat_title">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
                </div>
            </form>

            <!-- Edit/Update category -->
            <?php 
            if (isset($_GET['update_category'])) {
                //		$updated_cat_id = $_GET['update_category'];
                include '../includes/update_category.php';
            }
            ?>
        </div>

        <div class="col-xs-6">
            <!-- Displays table containing available Categories -->

            <?php 
            //Retrieves and prints all categories using these statements
            read_all_categories();
            ?>

        </div>
    </div>
</div>

<?php include "../includes/sidebar.php"; ?>

<?php include "../includes/footer.php"; ?>