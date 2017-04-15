<?php 
/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.

	This is the page navigation to be included on all pages.
	****************************************************************************************************/
$active=basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS2670</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li <?php if ($active == "index.php") { echo "class='active'"; } ?>>
                    <a href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                
                <li <?php if ($active == "report.php") { echo "class='active'"; } ?>>
                    <a href="report.php">Report Issues</a>
                </li>
                
                <!-- List of categories -->
                <?php
                $category_menu1 = <<<_END
								<ul class="nav navbar-nav">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Categories
										<b class="caret"></b></a>
										<ul class="dropdown-menu">
_END;

                $category_menu2 = <<<_END
										</ul>
									</li>
								</ul>
_END;

                $sql = "SELECT * FROM category";

                $select_categories_result = $conn->query($sql);

                if ($select_categories_result->num_rows > 0) {

                    echo $category_menu1;

                    while ($row = $select_categories_result->fetch_assoc()) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        if(basename(getcwd()) == "admin"){  
                            echo "<li><a href='../category_posts.php?cat_id=$cat_id'>$cat_title</a></li>";
                        }
                        else{
                            echo "<li><a href='category_posts.php?cat_id=$cat_id'>$cat_title</a></li>";
                        }
                    }

                    echo $category_menu2;
                }
                ?>


            </ul>
            <?php
            if(isset($_SESSION) && isset($_SESSION['username'])){
            ?>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            if($_SESSION['role']==0 ||$_SESSION['role']==1){
                                echo "<li><a href=\"admin/dashboard.php\">Dashboard</a></li>";
                            }
                        ?>
                        <li><a href="admin/profile.php">Profile</a></li>
                        <li><a href="includes/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <?php
            }
                ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>