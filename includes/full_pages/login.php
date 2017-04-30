
<div class="col-md-8 col-sm-12">
    <form id="login_form" class="form-horizontal" action="includes/form_submission/login.php" method="post" enctype="multipart/form-data" data-toggle="validator">
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading">Login Here</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class=" col-md-6 inputGroupContainer ">
                            <?php
                            if(isset($_GET['accountExists'])&& $_GET['accountExists']==true){

                            ?>
                            <small class="help-block" style="color:#a94442">Account already exists. Please sign in.</small>
                            <?php
                            }
                            ?>
                        </div><!--closing input group container-->
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Username </label>
                        <div class=" col-md-6 inputGroupContainer ">
                            <div class="input-group" >
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input name="username" placeholder="Your Email" type="email" class="form-control" >
                            </div>
                            <div class="help-block with-errors"></div>
                        </div><!--closing input group container-->
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password </label>
                        <div class=" col-md-6 inputGroupContainer ">
                            <div class="input-group" >
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input name="password" placeholder=" Your Password" type="password" class="form-control" >

                            </div>
                            <div class="input-group" >
                                <a href="forgot_password.php">forgot password</a>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div><!--closing input group container-->
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5">
                            <button type="submit" name="post_ad_btn" class="btn btn-success">Login <span class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </div>
                </div>

            </div><!--closing the panel 1-->
        </fieldset>
    </form>
</div>
<div class="col-md-4 col-sm-12">

    <div class="panel panel-default">
        <div class="panel-heading">Don't have an account yet?
        </div>
        <div class="panel-body">
            <!-- Button -->
            <div class="form-group">
                <div class="col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-4">
                    <a href="signup.php" class="btn btn-success">Signup <span class="glyphicon glyphicon-send"></span></a>
                </div>
            </div>
        </div>

    </div><!--closing the panel 1-->

</div>