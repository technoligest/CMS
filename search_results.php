<?php require "includes/functions.php"; ?>
<?php include "includes/header.php"; ?>

<div class="col-md-8 col-sm-12 col-no-left-padding">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);

    if (isset($_GET['cat_id'])) {
        $category_id = $_GET['cat_id'];

        //Posts are displayed only if they are published
        $sql = "SELECT * FROM posts WHERE post_cat_id = $category_id AND post_status = 'published'";
    }
    else {
        //If category is not set, act like index.php
        $sql = "SELECT * FROM posts WHERE post_status = 'published'";
    }
    $tags_array=[];
    $searchOn="";
    $sql="";
    if(isset($_POST['search_text'])){
        $tags = test_form_input($_POST['search_text']);
        $tags_array = explode(" ", $tags);
        if(isset($_POST['inlineRadioOptions'])){
            if($_POST['inlineRadioOptions']=="tags" || $_POST['inlineRadioOptions']=="author"){
                if(count($tags_array)>0){
                    $sql = "SELECT * FROM posts WHERE posts.post_status = 'published' AND post_{$_POST['inlineRadioOptions']} LIKE '%$tags_array[0]%'";
                    for($i=1; $i< count($tags_array); ++$i){
                        $sql .= " OR post_{$_POST['inlineRadioOptions']} LIKE '%$tags_array[$i]%'";
                    }
                }
            }
            elseif($_POST['inlineRadioOptions']=="categories"){
                if(count($tags_array)>0){
                    $sql = "SELECT * FROM posts, category WHERE posts.post_status = 'published' AND posts.post_cat_id=category.cat_id AND category.cat_title LIKE '%$tags_array[0]%'";
                    for($i=1; $i< count($tags_array); ++$i){
                        $sql .= " OR category.cat_title LIKE '%$tags_array[$i]%'";
                    }
                }
            }
        }
    }

    $retrieve_post_result = $conn->query($sql);

    if ($retrieve_post_result && $retrieve_post_result->num_rows > 0) {
        while ($row = $retrieve_post_result->fetch_assoc()) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = explode(" ",$row['post_date']);
            $post_image = $row['post_image'];
            $post_content = create_paragraphs_from_DBtext($row['post_content']);
            $post_status = $row['post_status'];

    ?>


    <h2>
        <a href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
    </h2>
    <p class="lead">
        by <a href="#"><?php echo $post_author; ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date[0]; ?></p>
    <hr>
    <?php 
            //Show the post image only if one has been set.
            if ($post_image != "") {
    ?>
    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
    <?php
            }
    ?>

    <hr>
    <p><?php echo $post_content; ?></p>

    <hr>



    <?php
        }	//Closing the posts while loop here.
    }
    else {
        echo "<p>No posts to show in this category yet!</p>";
    }

    ?>
</div>

<?php 
include "includes/sidebar.php";
include "includes/footer.php";
?>

