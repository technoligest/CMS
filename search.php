<?php
require_once("includes/functions.php");
$sql = "";
if (isset($_GET['cat_id'])) {
    $cat_id = test_form_input($_GET['cat_id']);
    $sql = "SELECT * FROM ads WHERE ads.ad_cat_id='$cat_id'";
} elseif (isset($_GET['general_search'])) {
    $sql = "SELECT * FROM ads";
} else {
    header("Location: index.php");
}


require_once("includes/header.php");
$result = $conn->query($sql);

?>
    <div class="container">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo(print_post($row));
            }
            ?>
        </div>
    </div>

<?php

function print_post($row)
{
    $ad_description = getDescriptionSummary($row['ad_description']);
    $result = <<<START
    <div class="row" style="margin-top:30px">
        <a href="view_ad.php?id={$row['ad_id']}">
            <div class="col-md-3 col-sm-2 col-xs-12">
                <img src="https://placehold.it/200x150" alt="Ad image" class="img-responsive center-block">
            </div>

            <div class="col-md-9 col-sm-10 col-xs-12">
                <div class="row">
                    <h3 class="col-md-9 col-sm-9 col-xs-10">
                        {$row['ad_title']}
                    </h3>
                    <h3 class="col-md-3 col-sm-3 col-xs-2">
                    <span class="pull-right">
                        \${$row['ad_price']}
                        </span>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm 12 col-xs-12">
                    <p> $ad_description </p>
                    </div>
                </div>
            </div>


        </a>
    </div>
START;
    return $result;
}

//this returns the summary of the description of  given post so it does not overdlow.
function getDescriptionSummary($text)
{
    return substr($text, 0, 150) . "...";
}

require_once("includes/footer.php");
