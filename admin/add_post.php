<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the add post page:
- Includes several other PHP scripts to implement the overall functionality.
- Allows users to create a new post.
-->
<?php
require "../includes/functions.php";
include "includes/header.php";
require "../includes/submit_post.php";
?>

<div class="col-md-8 col-sm-12 col-no-left-padding">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <form action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" name="post_title" required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_category_id">Post Category</label>
                    <select class="form-control" name="post_category_id" required>
                        <?php
                        //Creates category "options" dynamically, in a dropdown list
                        categories_into_dropdown_options();
                        ?>
                    </select>
                </div>

            </div>

            <div class="row col-lg-12">

                <div class="form-group">
                    <label for="status">Post Status</label>
                    <select class="form-control" name="post_status" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <input type="file" name="post_image">
                </div>

                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" required>
                </div>

                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="post_author" value="<?php echo $_SESSION['username'];?>"  required>
                    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
                </div>
            </div>
        </div>
    </form>

</div>

<?php
include "../includes/sidebar.php";
include "../includes/footer.php";
?>