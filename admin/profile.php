

<?php include "includes/header.php"; ?>
<?php require "../includes/functions.php"; ?>
<?php

if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == FALSE){
    header("Location: ../index.php?unauthAccess=TRUE"); 
    //    echo "WHATT";
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
    $sql= "UPDATE users
           SET
            users.user_firstname = '$firstname', 
            users.user_lastname = '$lastname',
            users.user_email = '$email',
            users.user_address = '$address',
            users.user_phone =  '$phone'
           WHERE users.user_id='{$_SESSION['userId']}'";
    $result = $conn->query($sql);
    if(!$result){
        die("Error: ". $conn->error);
    }
    $_SESSION['firstname']=$firstname;
    $_SESSION['lastname']=$lastname;
}
?>



<div class="col-md-4 col-sm-12 col-no-right-padding">
    <form action="profile.php" method="post" enctype="multipart/form-data" disable>
        
        <?php
        $result = $conn->query("SELECT * FROM users,login WHERE login.username = '{$_SESSION['username']}'");
        if($result->num_rows<1){
            die("Error... user can't be found.");
        }
        $row= $result->fetch_assoc();
        ?>
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" required disabled>
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
