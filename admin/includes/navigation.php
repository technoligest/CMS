<?php 
/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.

	This is the page navigation to be included on all pages.
	****************************************************************************************************/
//0 is admin
//1 is author
//2 subscriber
?>


<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">CMS2670</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php 
                //Determine the name of the file - e.g. filename.php
                $active = basename($_SERVER['PHP_SELF']);

                //Use $active in in-line scripts below to set a nav item as active
                ?>
                <?php
                    if($_SESSION['role']==0 || $_SESSION['role']==1){
                ?>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Posts
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href='view_posts.php'>View Posts</a></li>
                            <li><a href='add_post.php'>Add Post</a></li>
                            
                        </ul>
                    </li>
                </ul>
                <li <?php if ($active == "categories.php") { echo "class='active'"; } ?>>
                    <a href="categories.php">Categories<span class="sr-only">(current)</span></a>
                </li>
                <li <?php if ($active == "comments.php") { echo "class='active'"; } ?>>
                    <a href="#">Comments<span class="sr-only">(current)</span></a>
                </li>
                <?php
                    }
                if($_SESSION['role']==0){
                ?>
                
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Users
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href='view_users.php'>View All Users</a></li>
                            <li><a href='add_user.php'>Add New User</a></li>
                            
                        </ul>
                    </li>
                </ul>
                <?php
                }
                ?>
                <li <?php if ($active == "profile.php") { echo "class='active'"; } ?>>
                    <a href="profile.php">Profile<span class="sr-only">(current)</span></a>
                </li>
                <!-- List of categories -->
                

                
                







            </ul>
            <?php
            if(isset($_SESSION) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']== TRUE){
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($active == "comments.php") { echo "class='active'"; } ?>>
                    <a href="../index.php">View Your Site<span class="sr-only">(current)</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php">Profile</a></li>
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

