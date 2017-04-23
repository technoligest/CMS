<?php
$sql="";
if(isset($_GET['cat_section_id'])){
    $sql = "SELECT * FROM ads, category_sections WHERE ads.ad_cat_section_id=category_sections.cat_section_id AND ads.ad_cat_section_id={$_GET['cat_section_id']}"; 
}
elseif(isset($_GET['cat_id'])){
    $sql = "SELECT * FROM ads, category WHERE ads.ad_cat_id=category.cat_id AND ads.ad_cat_id=={$_GET['cat_id']}";
}
elseif(isset($_GET['general_search'])){
    $sql = "SELECT * FROM ";
}
else{
    header("Location: index.php");
}



require_once("includes/header.php");
$result = $conn->query($sql);
if(0){
?>
<div class="col-md-12">
    Nothing to show.
</div>

<?php    
}
else{
?>

<div class="col-md-12">
    <?php
    while($row=$result->fetch_assoc()){

    }
    ?>
    <div class="row">
        <div class="col-md-3 col-sm-2"><img src="http://placehold.it/200x150" alt="Ad image"  class="img-responsive"></div>
        <div class="col-md-9 col-sm-10">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="float: left">
                        Title
                    </h3>
                    <h3 style="float: righ">
                        Price
                    </h3>
                </div>
                <p class="text-right">Right aligned text.</p>
                <p> YES this is the best ever!!!</p>
            </div>
        </div>
    </div>
</div>

<?php
}
require_once("includes/footer.php");
?>