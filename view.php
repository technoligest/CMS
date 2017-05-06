<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
}

require_once("includes/functions.php");
require_once("includes/header.php");

$id = test_form_input($_GET['id']);
$result = $conn->query("SELECT * FROM ads WHERE ads.ad_id=$id");


if (!$result || $result->num_rows < 1) {
    header("Location: index.php");
    echo "WHATTT";
} else {
    echo "WHATTT";
}
$row = $result->fetch_assoc();

$description = $row['ad_description'];
$title = $row['ad_title'];
$price = $row['ad_price'];
$email = $row['ad_email'];

?>
    <div class="col-md-4">
        <div class="cont">
            <!-- Example -->
            <section id="example">
                <h3>
                    With thumbnail images
                </h3>

                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a href="example-images/3_zoom_1.jpg">
                        <img src="example-images/3_standard_1.jpg" class="img-responsive" alt="" width="400"
                             height="200"/>
                    </a>
                </div>

                <ul class="thumbnails">
                    <li>
                        <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                            <img src="example-images/3_thumbnail_1.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                            <img src="example-images/3_thumbnail_1.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                            <img src="example-images/3_thumbnail_1.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                            <img src="example-images/3_thumbnail_1.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_1.jpg" data-standard="example-images/3_standard_1.jpg">
                            <img src="example-images/3_thumbnail_1.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_2.jpg" data-standard="example-images/3_standard_2.jpg">
                            <img src="example-images/3_thumbnail_2.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_3.jpg" data-standard="example-images/3_standard_3.jpg">
                            <img src="example-images/3_thumbnail_3.jpg" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="example-images/3_zoom_4.jpg" data-standard="example-images/3_standard_4.jpg">
                            <img src="example-images/3_thumbnail_4.jpg" alt=""/>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </div>
    <div class="col-md-6">
        <h2></h2>
        <p></p>
    </div>
    <div class="col-md-2"></div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="easyZoom/easyZoom.js"></script>
    <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function (e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function () {
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

<?php require "includes/footer.php";
