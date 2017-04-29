<?php
$current_page = basename($_SERVER['PHP_SELF']);
$sql="SELECT * FROM category";
$retrieve_category_result = $conn->query($sql); 
if ($retrieve_category_result && $retrieve_category_result->num_rows > 0) {
    $i=0;

?>

<div class="col-md-4 col-sm-12">
    <?php    
    for($i=0; $i<$retrieve_category_result->num_rows/3; ++$i){
        $row = $retrieve_category_result->fetch_assoc();
        // echo $row['cat_title'];
        echo "<div class =\"list-group\">";
        echo "<a class='list-group-item active' href=\"post_ad.php?cat_id={$row['cat_id']}\"><h4>{$row['cat_title']}</h3></a>";
        $sql="SELECT * FROM category_sections WHERE category_sections.cat_id='{$row['cat_id']}'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo "<a class=\"list-group-item\" href=\"post_ad.php?cat_section_id={$row['cat_section_id']}&cat_id={$row['cat_id']}\">";
            echo $row['cat_section_title'];
            echo "</a>";
        }
        echo "</div><br>";
    }

    ?>
</div>
<div class="col-md-4 col-sm-12">
    <?php
    for(; $i<($retrieve_category_result->num_rows)*2/3; ++$i){
        $row = $retrieve_category_result->fetch_assoc();
        // echo $row['cat_title'];
        echo "<div class =\"list-group\">";
        echo "<a class='list-group-item active' href=\"post_ad.php?cat_id={$row['cat_id']}\"><h4>{$row['cat_title']}</h3></a>";
        $sql="SELECT * FROM category_sections WHERE category_sections.cat_id=' {$row['cat_id']}'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo "<a class=\"list-group-item\" href=\"post_ad.php?cat_section_id={$row['cat_section_id']}&cat_id={$row['cat_id']}\">";
            echo $row['cat_section_title'];
            echo "</a>";
        }
        echo "</div><br>";
    }
    ?>
</div>
<div class="col-md-4 col-sm-12">
    <?php
    for(; $i<$retrieve_category_result->num_rows; ++$i){
        $row = $retrieve_category_result->fetch_assoc();
        // echo $row['cat_title'];
        echo "<div class =\"list-group\">";
        echo "<a class='list-group-item active' href=\"post_ad.php?cat_id={$row['cat_id']}\"><h4>{$row['cat_title']}</h3></a>";
        $sql="SELECT * FROM category_sections WHERE category_sections.cat_id=' {$row['cat_id']}'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo "<a class=\"list-group-item\" href=\"post_ad.php?cat_section_id={$row['cat_section_id']}&cat_id={$row['cat_id']}\">";
            echo $row['cat_section_title'];
            echo "</a>";
        }
        echo "</div><br>";
    }
    ?>
</div>

<?php
}
else{
    echo "Nothing to show";
}
?>