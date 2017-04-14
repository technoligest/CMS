<?php



if($_SESSION['role']==2){
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
//0 is admin
//1 is autho
//2 subscriber


if(isset($_GET['deletePostId'])){
    $sql="DELETE FROM posts WHERE post_id='{$_GET['deletePostId']}'";
    $conn->query($sql);
}


?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Post Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Modify/Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM posts";
            if($_SESSION['role']==0){
                $sql="SELECT * FROM posts";
            }
            else if($_SESSION['role']==1){
                $sql="SELECT * FROM posts WHERE post_author= '{$_SESSION['username']}'";
            }
            else{
                header("Location: ../../index.php");
            }
            
            $result = $conn->query($sql);
            if($result!=false){
                while($row = $result->fetch_assoc()){
                    
                echo "
                <tr>
                    <td>{$row['post_id']}</td>
                    <td>{$row['post_author']}</td>
                    <td>{$row['post_title']}</td>
                    <td>{$row['post_cat_id']}</td>
                    <td><img src=\"../images/{$row['post_image']}\" height='50' width='50'></td>
                    <td>{$row['post_tags']}</td>
                    <td>{$row['post_comments']}</td>
                    <td>{$row['post_date']}</td>
                    <td>
                    <a class='btn btn-info' href='edit_post.php?postId={$row['post_id']}'>Edit post</a>
                    <a class='btn btn-danger' href='view_posts.php?deletePostId={$row['post_id']}'>Delete Post</a>
                    </td>
                </tr>";
                    
                }
            }
            ?>
        </tbody>


    </table>
</div>


