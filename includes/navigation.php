<?php
/****************************************************************************************************
 * R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to
 * Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
 *
 * This is the page navigation to be included on all pages.
 ****************************************************************************************************/
$active = basename($_SERVER['PHP_SELF']);
?>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SOLD</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ($active == "report.php") {
                    echo "class='active'";
                } ?>>
                    <a href="report.php">Report Issues</a>
                </li>
            </ul>
            <form class="navbar-form navbar-left" action="search.php" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="general_search" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION) && isset($_SESSION['username'])) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?><span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin/profile.php">Profile</a></li>
                            <li><a href="includes/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>

                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="signup.php">Signup</a>
                    </li>

                    <?php
                }
                ?>
                <?php
                if ($active != "post_ad.php" && $active != "choose_category.php") {
                    ?>
                    <li>
                        <a class="  " href="choose_category.php"
                           style="background-color:#5cb85c;color:white;">Post Ad</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div>
</nav>