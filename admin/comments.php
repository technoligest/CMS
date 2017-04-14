<?php
include_once('includes/header.php');

if($_SESSION['role']!=0 && $_SESSION['role']!=1){
    header("Location: ../index.php");
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
if(isset($_GET['deleteComment'])){
    $sql="DELETE FROM comments WHERE comment_id='{$_GET['deleteComment']}'";
    $conn->query($sql);
}
elseif(isset($_GET['approveComment']) && $_SESSION['role']==0){
    $sql="UPDATE comments SET comment_status='approved' WHERE comment_id='{$_GET['approveComment']}'";
    $conn->query($sql);
}
?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Comment ID</th>
                <th>Post Title</th>
                <th>Comment Author</th>
                <th>Comment Email</th>
                <th>Comment Content</th>
                <th>Status</th>
                <th>Approve/Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM posts";
            if($_SESSION['role']==0){
                $sql="SELECT * FROM comments, posts WHERE comment_post_id=posts.post_id";
            }
            elseif($_SESSION['role']==1){
                $sql="SELECT * FROM comments, posts  WHERE comment_post_id=posts.post_id AND comments.comment_author='{$_SESSION['username']}'";
            }
            else{
                header("Location: ../../index.php");
            }
            
            $result = $conn->query($sql);
            if($result!=false){
                while($row = $result->fetch_assoc()){
                    
                echo "
                <tr>
                    <td>{$row['comment_id']}</td>
                    <td>{$row['post_title']}</td>
                    <td>{$row['comment_author']}</td>
                    <td>{$row['comment_email']}</td>
                    <td>{$row['comment_content']}</td>
                    <td>{$row['comment_status']}</td>
                    <td>
                    <a class='btn btn-danger' href='comments.php?deleteComment={$row['comment_id']}'>Delete Delete</a>";
                    if($row['comment_status'] != 'approved' && $_SESSION['role']==0){
                        echo "<a class='btn btn-info' href='comments.php?approveComment={$row['comment_id']}'>Approve Comment</a>";
                    }
                    echo"                    </td>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
    include_once('includes/footer.php');
?>
