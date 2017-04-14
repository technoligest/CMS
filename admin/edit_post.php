<?php

require "../includes/functions.php";
include "includes/header.php";
$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";
$currentDate= "---";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}

if(!isset($_GET['postId'])){
    die("Unknown post cannot be editted.");
}

$current_page = basename($_SERVER['PHP_SELF']);

$updated=false;

if(isset($_POST['update_post'])){
    $post_author = test_form_input($_POST['post_author']);
    $post_title = test_form_input($_POST['post_title']);
    $post_category_id = test_form_input($_POST['post_category_id']);
    $post_status = test_form_input($_POST['post_status']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_image_filesize = $_FILES['post_image']['size'];

    $post_content = test_form_input($_POST['post_content']);
    $post_tags = test_form_input($_POST['post_tags']);
    $post_comments = 0;

    if($post_image != "") { 
        /*
			 * This section of the code manages image uploads. As discussed in class,
			 * we check if the file is of a specified type, and within the allowed file-size.
			 */
        $target_file = "../images/" . $post_image;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $post_image_temp);

        /*
			 * A list of MIME types are available here:
			 * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
			 */

        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                if ($post_image_filesize < TWO_MEGA_BYTES) {
                    //Upload the image.
                    move_uploaded_file($post_image_temp, "$target_file");
                    $post_image = "post_image='$post_image',";
                }
                else{
                    $post_image = "";
                }
                break;

            default:
                die("<br>Unknown file type. Your image cannot be uploaded.<br>");
        }
    } 
    else { 
        //Otherwise, the user has not set any post image.
        $post_image = "";
    } 

    $sql = "UPDATE posts SET post_cat_id='$post_category_id', post_title='$post_title', post_author='$post_author', $post_image post_content='$post_content', post_tags='$post_tags', post_comments= '$post_comments', post_status= '$post_status' WHERE post_id='{$_GET['postId']}'";

    $submit_post_result = $conn->query($sql);

    if (!$submit_post_result) {
        die ("Error creating post.<br>" . $conn->error . "<br>");
    }
    $updated=true;


}

$postId = $_GET['postId'];
$sql = "SELECT * FROM posts WHERE post_id='$postId'";
$result= $conn->query($sql);
if($result==false){
    die("Post with this id could not be found.");
}
$row= $result->fetch_assoc();
?>


<div class="col-md-12 col-sm-12 col-no-left-padding">

    <form  method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <?php
            if($updated){

            ?>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label class="danger">Post has been updated!</label>
                </div>
            </div>

            <?php
            }
            ?>
            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" name="post_title"
                           value=" <?php echo $row['post_title']; ?>"
                           required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input type="text" class="form-control" name="post_author"
                           value=" <?php echo $row['post_author']; ?>"
                           readonly>
                </div>
            </div>


            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_category_id">Post Category</label>
                    <select class="form-control" name="post_category_id" value="<?php echo $row['post_cat_id'];?>" required>
                        <?php
                        //Creates category "options" dynamically, in a dropdown list
                        categories_into_dropdown_options();
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Post Status</label>
                    <select class="form-control" name="post_status" required>
                        <option value="published" <?php if($row['post_status']=="published") echo "selected=\"selected\""?>>Published</option>
                        <option value="draft" <?php if($row['post_status']=="draft") echo "selected=\"selected\""?>>Draft</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <img class="img-responsive" src="../images/<?php echo $row['post_image']; ?>" alt="profile picture"  width="400px" height="200px">
                </div>
                <div class="form-group">
                    <label for="post_image">Change current image</label>
                    <input type="file" name="post_image">
                </div>


                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" value="<?php echo $row['post_tags'];?>" required>
                </div>

                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" ><?php echo $row['post_content']?></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update_post" value="Update Post" data-toggle="modal" data-target="#myModal">
                </div>
            </div>
        </div>
    </form>

<?php
    include "includes/footer.php";
?>