<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the add post page:
- Includes several other PHP scripts to implement the overall functionality.
- Allows users to create a new post.
-->
<?php require "../includes/functions.php"; ?>
<?php include "includes/header.php"; ?>
<?php

$sql="SELECT * FROM users INNER JOIN login ON users.user_id=login.user_id WHERE users.user_id='{$_GET['userId']}'";
echo $sql;
$get_user = $conn->query($sql);


if($get_user->num_rows<1){
    die("Could not find the given user.");
}
$row = $get_user->fetch_assoc();
?>


<div class="col-md-8 col-sm-12 col-no-left-padding">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <form data-toggle="validator" role="form" action="includes/edit_user.php" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="user_firstname">First Name</label>
                    <input type="text" class="form-control" name="user_firstname" value="<?php echo $row['user_firstname'];?>" required>
                </div>
                <div class="form-group">
                    <label for="user_lastname">Last Name</label>
                    <input type="text" class="form-control" name="user_lastname" value="<?php echo $row['user_lastname'];?>"required>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="user_role">User Role</label>
                    <select class="form-control" name="user_role" required>
                        <option value='2' <?php if($row['user_role']==2){echo 'selected="selected"';}?>>Subscriber</option>
                        <option value='1' <?php if($row['user_role']==1){echo 'selected="selected"';}?>>Author</option>
                        <option value='0' <?php if($row['user_role']==0){echo 'selected="selected"';}?>>Admin</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="user_email">User Email</label>
                    <input type="text" class="form-control" name="user_email" value="<?php echo $row['user_email'];?>"required>
                </div>
                <div class="form-group">
                    <label for="user_address">User Address</label>
                    <input type="text" class="form-control" name="user_address" value="<?php echo $row['user_address'];?>" required>
                </div>
                <div class="form-group">
                    <label for="user_phone">User Phone number</label>
                    <input type="text" class="form-control" name="user_phone" value="<?php echo $row['user_phone'];?>" required>
                </div>

                <div class="form-group">
                    <label for="user_username">Username</label>
                    <input type="text" class="form-control" name="user_username" value="<?php echo $row['username'];?>" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" name="user_password" value="*****" required>
                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $_GET['userId']?>">
                </div>

                
            </div>

            <div class="row col-lg-12">
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <input type="file" name="user_image">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
                </div>
            </div>
        </div>
    </form>

</div>

<?php include "includes/footer.php"; ?>