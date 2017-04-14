

<?php
include "includes/header.php";
require "../includes/functions.php";
$TWO_MEGA_BYTES = 2097152;
if(!isset($_SESSION) || !isset($_SESSION['username'])){
    header("Location: ../index.php?unauthAccess=TRUE"); 
}
$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";
$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}

if(isset($_POST['update_info'])){
    $firstname=ucwords(test_form_input($_POST['firstname']));
    $lastname=ucwords(test_form_input($_POST['lastname']));
    $email=test_form_input($_POST['email']);
    $address=test_form_input($_POST['address']);
    $phone=test_form_input($_POST['phone']);



    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_image_filesize = $_FILES['user_image']['size'];

    if($user_image != "") { 
        /*
			 * This section of the code manages image uploads. As discussed in class,
			 * we check if the file is of a specified type, and within the allowed file-size.
			 */
        
        $target_file = "../images/" . $user_image;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $user_image_temp);

        /*
			 * A list of MIME types are available here:
			 * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
			 */

        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                if ($user_image_filesize < $TWO_MEGA_BYTES) {
                    //Upload the image.
                    move_uploaded_file($user_image_temp, "$target_file");
                }
                else{
                    $user_image = $_SESSION['user_image'];
                }
                break;

            default:
                die("<br>Unknown file type. Your image cannot be uploaded.<br>");
        }
    } 
    else { 
        //Otherwise, the user has not set any post image.
        $user_image = $_SESSION['user_image'];
    } 



    $sql= "UPDATE users
           SET
            users.user_firstname = '$firstname', 
            users.user_lastname = '$lastname',
            users.user_email = '$email',
            users.user_address = '$address',
            users.user_phone =  '$phone',
            users.user_image = '$user_image'
           WHERE users.user_id='{$_SESSION['userId']}'";
    $result = $conn->query($sql);
    if(!$result){
        die("Error: ". $conn->error);
    }
    $_SESSION['firstname']=$firstname;
    $_SESSION['lastname']=$lastname;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['phone'] = $phone;
    $_SESSION['user_image'] = $user_image;
}
?>


<div class="col-md-4 col-sm-12 col-no-right-padding">
    <form action="profile.php" method="post" enctype="multipart/form-data" disable>

        <?php
        $sql="SELECT * FROM users,login WHERE users.user_id=login.user_id && login.user_id = '{$_SESSION['userId']}'";

        $result = $conn->query($sql);

        if($result->num_rows<1){
            die("Error... user can't be found.");
        }
        $row= $result->fetch_assoc();
        ?>
        <div class="form-group">
            <img class="img-responsive" src="../images/<?php echo $_SESSION['user_image']; ?>" alt="profile picture"  width="200px" height="200px">
        </div>
        <?php if(isset($_GET['updateInfo']) && $_GET['updateInfo']==true){?>
        <div class="form-group">
            <label for="post_image">Update Image</label>
            <input type="file" name="user_image">
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" required disabled>
        </div>
        <div class="form-group">
            <label for="user_role">User Role</label>
            <select class="form-control" name="user_role" required disabled>
                <option value='2' <?php if($_SESSION['role']==2){echo 'selected="selected"';}?>>Subscriber</option>
                <option value='1' <?php if($_SESSION['role']==1){echo 'selected="selected"';}?>>Author</option>
                <option value='0' <?php if($_SESSION['role']==0){echo 'selected="selected"';}?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?php echo $row['user_firstname'];?>" required <?php if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){echo "disabled";}?>>
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo $row['user_lastname'];?>" required <?php if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){echo "disabled";}?>>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $row['user_email'];?>" required <?php if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){echo "disabled";}?>>
        </div>
        <div class="form-group">
            <label for="name">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $row['user_address'];?>" required <?php if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){echo "disabled";}?>>
        </div>
        <div class="form-group">
            <label for="name">Phone Number</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $row['user_phone'];?>" required <?php if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){echo "disabled";}?>>
        </div>
        <div class="form-group">
            <?php
            if(isset($_GET['updateInfo']) && $_GET['updateInfo']==true){
            ?>
            <input type="submit" class="btn btn-primary" name="update_info" value="Update Info" >

            <?php
            }
            ?>

            <?php
            if(!isset($_GET['updateInfo']) || $_GET['updateInfo']!=true){
                echo "<a class='btn btn-info' href='profile.php?updateInfo=true' >Edit Profile</a>";
            }
            else{
                echo "<a class='btn btn-danger' href='profile.php' >Discard All Changes</a>";
            }

            ?>
        </div>
    </form>
</div>

<?php include "includes/footer.php"; ?>
