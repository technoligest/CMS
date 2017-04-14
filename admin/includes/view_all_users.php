<?php



if($_SESSION['role']==2){
    header("Location: ../../index.php");
}

$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";
$currentDate= "---";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}

//0 is admin
//1 is autho
//2 subscriber


if(isset($_GET['deleteUserId'])){
    $sql="DELETE FROM login WHERE user_id='{$_GET['deleteUserId']}'";
    $conn->query($sql);
    $sql="DELETE FROM users WHERE user_id='{$_GET['deleteUserId']}'";
    $conn->query($sql);
}


?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="";
            if($_SESSION['role']==0){
                $sql="SELECT * FROM users INNER JOIN login ON users.user_id=login.user_id";
            }
            else{
                header("Location: ../../index.php");
            }
            
            $result = $conn->query($sql);
            if($result!=false){
                while($row = $result->fetch_assoc()){
                    $curr_role="unknown role";
                    switch($row['user_role']){
                        case 0:
                            $curr_role='admin';
                            break;
                        case 1:
                            $curr_role='author';
                            break;
                        case 2:
                            $curr_role='subscriber';
                            break;
                        default:
                    }
                echo "
                <tr>
                    <td><img src=\"../images/{$row['user_image']}\" height='50' width='50'></td>
                    <td>{$row['username']}</td>
                    <td>{$row['user_firstname']}</td>
                    <td>{$row['user_lastname']}</td>
                    <td>{$row['user_email']}</td>
                    <td>$curr_role</td>
                    <td>
                    <a class='btn btn-info' href='edit_user.php?userId={$row['user_id']}'>Edit User</a>
                    <a class='btn btn-danger' href='view_users.php?deleteUserId={$row['user_id']}'>Delete User</a>
                    </td>
                </tr>";
                    
                }
            }
            ?>
        </tbody>
    </table>
</div>


