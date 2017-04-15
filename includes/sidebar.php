<?php
global $currentDate;
?>
<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This script displays the sidebar on all pages:
- It shows the login form on all pages.
- It shows the submit report form on all pages other than the report page itself.
-->
<div class="col-md-4 col-sm-12 ">
    <div class="panel panel-default">

        <div class="panel-heading">
            Search
        </div>
        <div class="panel-body">
            <form action="search_results.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="search_text">Search Tags</label>
                    <input type="text" class="form-control" name="search_text" required>
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="tags" required> Tags
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="categories"> Categories
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="author"> Authors
                    </label>
                </div>
            </form>
            
        </div>
    </div>	

    <div class="panel panel-default">

        <div class="panel-heading">
            <?php
            if(!isset($_SESSION) || !isset($_SESSION['username']) )
                echo "Login to your account";
            else
                echo "You're logged in.";
            ?>        
        </div>
        <div class="panel-body">
            <?php
            date_default_timezone_set('America/Halifax');

            if (isset($_GET['loginError']) && $_GET['loginError']==TRUE) {
                echo "<p class='text-danger'>Username or password is wrong.</p>";
                include 'login_form.php';
            }
            elseif(isset($_GET['unauthAccess']) && $_GET['unauthAccess'] == TRUE){
                echo "<p class='text-danger'>You need to log in to access the user profile</p>";
                include 'login_form.php';
            }
            elseif (isset($_SESSION) && isset($_SESSION['username'])) {
                $user = $_SESSION['username'];
                echo "<p class='text-primary'>Welcome, $user!<br> You last accessed this site: {$_SESSION['currentDate']} </p>";
            }
            elseif (!isset($_POST['login'])) {
                include 'login_form.php';
            }
            ?>


        </div>
    </div>	

    <?php
    $report_form_start = <<<ENDREPORT
			<div class="panel panel-default">
				<div class="panel-heading">Encounter any issues? Report them</div>
				<div class="panel-body">
ENDREPORT;
    $report_form_end = <<<ENDREPORT
				</div>
			</div>	
ENDREPORT;
    $current_page = basename($_SERVER['PHP_SELF']);

    if ($current_page != "report.php") {
        echo $report_form_start;
        include 'report_form.php';
        echo $report_form_end;
    }
    ?>
</div>
