<?php
/**
 * Created by PhpStorm.
 * User: Technoligest
 * Date: 2017-05-02
 * Time: 4:35 PM
 */
if (!isset($_GET['id'])) {
    header("Location: index.php");
}

require_once("includes/functions.php");
require_once("includes/header.php");

$id = test_form_input($_GET['id']);
$result = $conn->query("SELECT * FROM ads WHERE ads.ad_id=$id");

if (!$result || $result->num_rows < 1) {
    header("Location: index.php");
}

?>

    <link rel="stylesheet" href="easyZoom/easyZoom.css" />
    <div class="col-md-4">
        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails  " style="margin: auto;
    width: 100%;
    padding: 0px;>
            <a href="example-images/3_zoom_1.jpg   ">
                <img class="img-responsive " src="example-images/3_standard_1.jpg" alt="" />
            </a>
        </div>

        <ul class="thumbnails" style="margin: auto;

    padding: 10px;">
            <li>
                <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                    <img  src="example-images/3_thumbnail_1.jpg" alt="" />
                </a>
            </li>
            <li>
                <a href="example-images/3_zoom_2.jpg" data-standard="example-images/3_standard_2.jpg">
                    <img src="example-images/3_thumbnail_2.jpg" alt="" />
                </a>
            </li>
            <li>
                <a href="example-images/3_zoom_3.jpg" data-standard="example-images/3_standard_3.jpg">
                    <img src="example-images/3_thumbnail_3.jpg" alt="" />
                </a>
            </li>
            <li>
                <a href="example-images/3_zoom_4.jpg" data-standard="example-images/3_standard_4.jpg">
                    <img src="example-images/3_thumbnail_4.jpg" alt="" />
                </a>
            </li>
        </ul>

    </div>
    <div class="col-md-6">
        <h2>Title</h2>
    </div>
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">This is great</div>
            <div class="panel-body">
                Please

            </div>
        </div>
    </div>
    <script src="easyZoom/easyZoom.js"></script>
    <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>
<?php


require_once("includes/footer.php");