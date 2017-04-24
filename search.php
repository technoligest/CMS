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
<div class="container">
    <div class="col-md-2 col-sm-12 col-xs-12"></div>
    <div class="col-md-8 col-sm-12 col-xs-12">
        <?php
    //    while($row=$result->fetch_assoc()){
    //
    //    }
        ?>
        <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-12"><img src="http://placehold.it/200x150" alt="Ad image"  class="img-responsive center-block">
            </div>
            <div class="row col-md-9 col-sm-10 col-xs-12">
                <div class="col-md-10 col-sm-9 col-xs-9">
                    <h3>
                        Title
                    </h3>
                    <p> YES this is the best ever!!! fljdsafkl;d dfasjkhlkdafshkf afdsjlkhjfalks fdasjklfdas fdsalhljkfasd mjlkhfads m,jklfadhsm, fadhlvkcnczvxjlkewq fasdjlkn,mvck;ew qwroadsvijoj</p>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3">
                    <h3>
                        Priceee
                    </h3>
                </div>
            </div>
            <div class="row col-md-9 col-sm-10 col-xs-12">
                <div class="col-md-10 col-sm-9 col-xs-9">
                    <p> Metadata</p>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3">
                    <p> Metadata</p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
}
require_once("includes/footer.php");
?>