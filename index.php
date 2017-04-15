<!-- 
/****************************************************************************************************
R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
****************************************************************************************************/

This is the home page:
- Includes several other PHP scripts to implement the overall functionality.
- Displays all posts that are read from files in a loop.
-->
<?php
require "includes/functions.php";
include "includes/header.php";

include "includes/view_categories.php";

// include "includes/sidebar.php";
include "includes/footer.php";
?>