<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the add post page:
- Includes several other PHP scripts to implement the overall functionality.
- Allows users to create a new post.
-->
<?php
require "includes/functions.php";
include "includes/header.php";
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="col-md-8 col-sm-12 col-no-left-padding">

<!--enctype is SUPER important for form input-->
<form id="contact_form" class="form-horizontal" action="includes/register.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="user_firstname" placeholder="First Name" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Last Name</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="user_lastname" placeholder="Last Name" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="user_email" placeholder="E-Mail Address" class="form-control" type="text">
                    </div>
                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Phone #</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="user_phone" placeholder="(845)555-1212" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Address</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="user_address" placeholder="Address" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">City</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="user_city" placeholder="city" class="form-control" type="text">
                    </div>
                </div>
            </div>
            
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label">Province</label>
                <div class="col-md-6 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="user_province" class="form-control selectpicker">
                            <option value=" ">Please select your province</option>
                            <option value="AB">AB</option>
                            <option value="BC">BC</option>
                            <option value="MB">MB</option>
                            <option value="NB">NB</option>
                            <option value="NL">NL</option>
                            <option value="NS">NS</option>
                            <option value="ON">ON</option>
                            <option value="PEI">PEI</option>
                            <option value="QC">QC</option>
                            <option value="SK">SK</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Postal Code</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="postalCode" placeholder="Postal Code" class="form-control" type="text">
                    </div>
                </div>
            </div>
            
            
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label">User role</label>
                <div class="col-md-6 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="user_role" class="form-control selectpicker">
                            <option value=" " >Please select a role</option>
                            <option value="2">Subscriber</option>
                            <option value="1">Author</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Username</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="user_username" placeholder="Username" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="user_password" placeholder="Enter password" class="form-control" type="password">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="user_confirm_password" placeholder="Confirm password" class="form-control" type="password">
                    </div>
                </div>
            </div>

            <!--Uploading the profile picture-->
            <div class="form-group">
                <label class="col-md-4 control-label">Add a profile image:</label>
                <div class="col-md-6 inputGroupContainer">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span>
                             <input type="file" name="user_image" class="form-control">
                    </div>
                </div>
            </div>
            <!-- Success message -->
            <div class="alert alert-success" style="display: none" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" name="register" class="btn btn-warning">Register <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<?php
include "includes/sidebar.php";
include "includes/footer.php";
?>