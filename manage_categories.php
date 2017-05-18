<?php
require_once("includes/header.php");

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
    $cat_title = test_form_input($_POST['cat_title']);
    $cat_parent = test_form_input($_POST['cat_parent']);
    insert_category($cat_title, $cat_parent);
}


/* Statements that Update the category in the database */
if (isset($_POST['update_this_cat'])) {

    $cat_title_to_be_updated = test_form_input($_POST['updated_cat_title']);
    $cat_id_to_be_updated = $_GET['update_category'];
    $cat_parent = test_form_input($_POST['cat_parent']);

    $sql = "UPDATE categories SET cat_parent = '$cat_parent', cat_title = '$cat_title_to_be_updated' WHERE cat_id = $cat_id_to_be_updated";

    $result_update_category = $conn->query($sql);
    if (!$result_update_category) {
        $message=urlencode("Category could not be updated properly.");

        header("Location: manage_categories.php?failureMessage=$message");
    }
    else {
        $message=urlencode("Category updated successfully.");
        header("Location: manage_categories.php?successMessage=$message");
    }
}

/* Script to update a category that is visible in the HTML table on the right */
if (isset($_GET['update_category'])) {
    $update_this_cat_id = $_GET['update_category'];
    $sql = "SELECT * FROM category WHERE cat_id = $update_this_cat_id";
    $result_select_category = $conn->query($sql);
    if ($result_select_category && $result_select_category->num_rows > 0) {
        while ($row = $result_select_category->fetch_assoc()) {
            $update_this_cat_title = $row['cat_title'];
        }
    }
}

?>



<div class="col-md-12 col-sm-12">
    <div class="row">
        <div class="col-sm-6 col-xs-6">

            <form action="manage_categories.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cat_title">Add new category</label>
                    <input class="form-control" type="text" name="cat_title">
                </div>
                <div class="form-group">
                    <select name="cat_parent" >
                        <option value="false">Please select the parent of the category</option>
                        <?php
                        $sql="SELECT * FROM categories";
                        $stmt=$conn->query($sql);
                        if($stmt){
                            while($row=$stmt->fetch_assoc()){
                                echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
                </div>
            </form>


            <?php 

            if (isset($_GET['update_category'])) {

                $update_id = test_form_input($_GET['update_category']);
                $sql = "SELECT * FROM categories WHERE cat_id=$update_id";
                $stmt = $conn->query($sql);

                if($stmt && $stmt->num_rows>0){
                    $row=$stmt->fetch_assoc();
                    $cat_title = $row['cat_title'];
            ?>
            <form action="<?php echo "manage_categories.php?update_category={$_GET['update_category']}"?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cat_title">Update category</label>
                    <input class="form-control" type="text" name="updated_cat_title" value="<?php echo $cat_title;?>">
                </div>
                <div class="form-group">

                    <select name="cat_parent" >
                        <?php

                    $cat_parent_id ="";
                    $cat_id=$_GET['update_category'];
                    $sql="SELECT cat_parent FROM categories WHERE cat_id=$cat_id ";
                    echo $sql;
                    $stmt=$conn->query($sql);
                    if($stmt && $row=$stmt->fetch_assoc()){
                        $cat_parent_id =$row['cat_parent'];
                        $sql="SELECT * FROM categories WHERE cat_id=$cat_parent_id ";
                        echo $sql;
                        $stmt3=$conn->query($sql);
                        if($stmt3 && $row=$stmt3->fetch_assoc()){
                            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }
                        else{
                            echo "<option value='NULL'>Please select a parent</option>";
                        }
                    }
                    $sql= "SELECT * FROM categories WHERE cat_id!=$cat_id";
                    if($cat_parent_id!=NULL){
                        $sql="SELECT * FROM categories WHERE cat_id != $cat_parent_id AND cat_id!=$cat_id";
                    }
                    $stmt2=$conn->query($sql);
                    if($stmt2){
                        while($row=$stmt2->fetch_assoc()){
                            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }
                    }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update_this_cat" value="Update Category">
                </div>
            </form>
            <?php
                }
            }
            ?>
        </div>
        <div class="col-sm-6 col-xs-6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="SELECT * FROM categories";
                    $stmt = $conn->query($sql);
                    while($row=$stmt->fetch_assoc()){
                        echo "
                <tr>  
            <td>{$row['cat_title']}</td>
            <td ><a class=\"btn btn-info\" href=\"manage_categories.php?update_category={$row['cat_id']}\">Modify</a>
            </td>
                <td ><a class=\"btn btn-danger\" href=\"manage_categories.php?delete_category={$row['cat_id']}\">Delete</a></td>
        </tr>
                ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once("includes/footer.php");

