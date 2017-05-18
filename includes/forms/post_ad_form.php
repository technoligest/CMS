<!--enctype is SUPER important for form input-->
<form id="post_ad_form" class="form-horizontal" action="includes/form_submission/post_ad_submission.php" method="post"
      enctype="multipart/form-data" data-toggle="validator">
    <fieldset>
        <div class="panel panel-default">
            <div class="panel-heading"><b>1</b> Ad Details</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Ad Type </label>
                    <div class=" col-md-6 inputGroupContainer ">
                        <div class="btn-group" data-toggle="validator">
                            <label class="btn btn-default ">
                                <input type="radio" name="ad_type" id="inlineRadio1" value="offering" required> Selling
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="ad_type" id="inlineRadio2" value="wanting" required> Looking
                                for
                            </label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div><!--closing input group container-->
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Price</label>
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input name="ad_price" placeholder="Price" class="form-control" type="text">
                        </div><!--closing input group-->
                    </div><!--closing input group container-->
                </div><!--closing form group-->
                <div class="form-group">
                    <label class="col-md-4 control-label">For Sale by: </label>
                    <div class=" col-md-6 inputGroupContainer ">
                        <div class="btn-group" data-toggle="validator">
                            <label class="btn btn-default ">
                                <input type="radio" name="for_sale_by" id="inlineRadio3" value="tags" required>
                                Individual
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="for_sale_by" id="inlineRadio4" value="tags" required> Business
                            </label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div><!--closing input group container-->
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                            <input name="ad_title" placeholder="Title" class="form-control" type="text">
                        </div><!--closing input group-->
                    </div><!--closing input group container-->
                </div><!--closing form group-->
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                            <textarea name="ad_description" placeholder="Your ad" class="form-control" type="text"
                                      spellcheck="true" req="req" data-writefull-timeout="null"></textarea>
                        </div><!--closing input group-->
                    </div><!--closing input group container-->
                </div><!--closing form group-->


                <div class="form-group">
                    <label class="col-md-4 control-label">City</label>
                    <div class="col-md-6 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="ad_location" class="form-control selectpicker">
                                <option value=" ">Please select your city</option>
                                <?php
                                $sql = "SELECT * FROM locs";
                                $retrieve_locations_result = $conn->query($sql);
                                if ($retrieve_locations_result && $retrieve_locations_result->num_rows > 0) {
                                    while ($row = $retrieve_locations_result->fetch_assoc()) {
                                        echo "<option value=\"{$row['loc_id']}\">{$row['loc_name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!--Closing panel body-->
        </div><!--closing the panel 1-->

        <div class="panel panel-default">
            <div class="panel-heading"><b>2</b> Upload Images</div>
            <div class="panel-body">
                <input type="file" name="files">
            </div><!--Closing panel body-->
        </div><!--closing the panel 2-->
        <div class="panel panel-default">
            <div class="panel-heading"><b>3</b> Contact Information</div>
            <div class="panel-body">
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Phone #</label>
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="ad_phone" placeholder="(902) 555-1212" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <?php
                if (!isset($_SESSION['username'])) {
                ?>
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                            <input name="ad_email" placeholder="E-Mail Address" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <?php
                } else {
                    echo "<input name=\"ad_email\" placeholder=\"E-Mail Address\" class=\"form-control\" type=\"hidden\" value=\"{$_SESSION['username']}\">";
                }
                ?>
            </div><!--Closing panel body-->
        </div><!--closing the panel 3-->
        <div class="panel panel-default">
            <div class="panel-heading"><b>4</b> Finish Posting!</div>
            <div class="panel-body">
                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5">
                        <button type="submit" name="post_ad_btn" class="btn btn-success">Preview Ad <span
                                                                                                          class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>
            </div><!--Closing panel body-->
        </div><!--closing the panel 4-->
        <input type="hidden" name="ad_cat_id" value="<?php echo test_form_input($_GET['cat_id']); ?>" type="text">
    </fieldset>
</form>