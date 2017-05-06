<?php
require_once("includes/header.php");
?>

    <div class="col-md-8 col-sm-12">
        <?php
        require_once("includes/forms/login_form.php");
        ?>
    </div>
    <div class="col-md-4 col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">Don't have an account yet?
            </div>
            <div class="panel-body">
                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-4">
                        <a href="signup.php" class="btn btn-success">Signup <span
                                    class="glyphicon glyphicon-send"></span></a>
                    </div>
                </div>
            </div>

        </div><!--closing the panel 1-->
    </div>
<?php
require_once("includes/footer.php");
?>