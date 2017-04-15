
<?php

require_once "../includes/functions.php";
include_once "includes/header.php";

if(!isset($_SESSION['role']) || !($_SESSION['role']==0 || $_SESSION['role']==1 )){
    header("Location: ../index.php");
}
?>

<div class="col-md-<?php if(isset($_SESSION['role']) && $_SESSION['role']!=0 ){echo "6";}else{echo "4";}?> col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            Recent Posts
        </div>
        <div class="panel-body">
            <?php
            $thisPost = ""; //the post for this author
            if($_SESSION['role']==1){
                $thisPost = "posts.post_author = '{$_SESSION['username']}' AND";
            }
            $sql="SELECT * FROM posts WHERE $thisPost posts.post_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
            $result = $conn->query($sql);
            $numPosts=0;

            if($result){
                $numPosts = $result->num_rows;
            }
            else{
                $numPosts = 0;
            }
            echo"<p>The number of posts is <a href=\"view_posts.php\">{$numPosts}</a></p>";
            ?>
        </div>
    </div>
</div>
<div class="col-md-<?php if(isset($_SESSION['role']) && $_SESSION['role']!=0 ){echo "6";}else{echo "4";}?> col-sm-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            Recent Comments
        </div>
        <div class="panel-body">
            <?php
            $thisPost = ""; //the post for this author
            if($_SESSION['role']==1){
                $thisPost = "comments.comment_author = '{$_SESSION['username']}' AND";
            }
            $sql="SELECT * FROM comments WHERE $thisPost comments.comment_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
            $result = $conn->query($sql);
            $numComments=0;

            if($result){
                $numComments = $result->num_rows;
            }
            else{
                $numComments = 0;
            }
            echo"<p>The number of comments is <a href=\"comments.php\">{$numComments}</a></p>";
            ?>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12  <?php if(isset($_SESSION['role']) && $_SESSION['role']!=0){echo "hidden";}?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            Recent Users
        </div>
        <div class="panel-body">
            <?php
            $sql="SELECT * FROM users WHERE users.registeration_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
            $result = $conn->query($sql);
            $numUsers=0;
            if($result){
                $numUsers = $result->num_rows;
            }
            else{
                $numUsers = 0;
            }
            echo"<p>The number of userss is <a href=\"view_users.php\">{$numUsers}</a></p>";
            ?>
        </div>
    </div>
</div>


<?php
include "includes/footer.php";
?>