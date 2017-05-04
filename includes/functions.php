<?php
/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.

	This is the functions script, some functions might be necessary on all pages.
	****************************************************************************************************/

define("WEBSITE", "localhost/CMS");


//this function takes a template and list of items and replaces every key in the template with its value
function replaceParameters($items, $template){
    foreach($items as $key=>$value){
        $template = str_replace(
            $key,
            $value,
            $template);
    }
    return $template;
}

//this function takes parameters and sends an email accordingly
function sendEmail($recipients, $sender, $template, $subject){
    try{
        require '../../phpmailer/PHPMailerAutoload.php';

        preg_match_all("/([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)/", $recipients, $recipient_addresses, PREG_OFFSET_CAPTURE);

        if (!count($recipient_addresses[0])) {
            die('MF001');
        }


        $mail = new PHPMailer();
        $mail->From = "technoligest@gmail.com";

        foreach ($recipient_addresses[0] as $key => $value) {
            $mail->addAddress($value[0]);
        }
        $mail->CharSet = 'utf-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($template);
        $mail->send();
    } catch (phpmailerException $e) {
        die('MF254');
    } catch (Exception $e) {
        die('MF255');
    }
}



/*
 * test_form_input()
 * - A function that takes form-submitted data ($data),
 *   and sanitizes it.
 * - Returns sanitized data ($data).
 */
function test_form_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


/*
 * create_paragraphs_from_DBtext()
 * - A function that takes text data from the database table
 *   and returns a string with several paragraphs, instead of
 *   new line characters or line-breaks.
 * - Returns sanitized data ($content).
 */
function create_paragraphs_from_DBtext($content) {

    $content = nl2br($content, false);

    $content = str_replace( '<br><br>', '</p><p>', $content );
    $content = str_replace( '<br>', '</p><p>', $content );

    return $content;
}

/*
 * read_post()
 * - A function that takes the post file handle ($post_file),
 *   the current page that the user is on ($current_page),
 *   and shows the post as specified in the assignment document.
 * - Does not return anything, however, it displays the post
 *   appropriately on the home and posts template pages.
 *
 * ~~NOTE~~ AS OF ASSIGNMENT 3, THIS FUNCTION IS NO LONGER USED
 *          TO DISPLAY POSTS.
 */
function read_post($post_file, $current_page) {
    $line_number = 0;

    while(!feof($post_file)) {
        $line = fgets($post_file);
        $line = trim($line);

        if ($line_number == 0) {
            echo "<h2 class='display-2'><a href='posts.php'>$line</a></h2>";
        }
        elseif ($line_number == 2) {
            echo "<p><a href='#'>$line</a></p>";
        }
        elseif ($line_number == 3) {
            if ($current_page == "index.php") {
                $date_time = explode(",", $line);
                echo "<p class='bottom-margin'>$date_time[0]</p>";
            }
            elseif ($current_page == "posts.php") {
                echo "<p>$line</p>";
                echo "<hr>";
            }
        }
        elseif ($line_number > 4) {
            if ($line != "") {
                echo "<p>$line</p>";
            }
        }

        ++$line_number;
    }
}


/*
 * read_all_categories()
 * - A function that finds all categories saved in the
 *   table named "category".
 * - Displays all categories in the form of a table, 
 *   wherever the function is called.
 */
function read_all_categories() {
    global $conn;

    $sql = "SELECT * FROM category";
    $categories_query_result = $conn->query($sql);

    $category_display_table_header = <<<_END
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th colspan="2">Category Title</th>
					</tr>
				</thead>
				<tbody>
_END;

    $category_display_table_footer = <<<_END
				</tbody>
			</table>
_END;

    echo $category_display_table_header;

    if ($categories_query_result->num_rows > 0) {
        while ($row = $categories_query_result->fetch_assoc()) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            echo "<td class='text-right'><a class='btn btn-info' href='categories.php?update_category=$cat_id'>UPDATE</a>";
            echo "&nbsp;<a class='btn btn-danger' href='categories.php?delete_category=$cat_id'>DELETE</a></td>";
            echo "</tr>";
        }
    }
    else {
        echo "<tr>";
        echo "<td colspan='3'>No categories exist yet.</td>";
        echo "</tr>";
    }

    echo $category_display_table_footer;

}


/*
 * categories_into_dropdown_options()
 * - A function that finds all categories saved in the
 *   table named "category".
 * - Echos/prints each category in the form of an <option>,
 *   that can be included within the <select> HTML element
 *   to create drop-down selection options in a form.
 */
function categories_into_dropdown_options() {
    global $conn;

    $sql = "SELECT * FROM category";
    $categories_query_result = $conn->query($sql);

    if ($categories_query_result->num_rows > 0) {
        while ($row = $categories_query_result->fetch_assoc()) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value='$cat_id'>$cat_title</option>";
        }
    }
    else {
        echo "No categories exist yet.";
    }
}


/*
 * insert_category($category_title)
 * - A function that inserts a specified category title
 *   into the table named "category".
 * - @input: $category_title: title of newly created category
 * - Does not return anything.
 */
function insert_category($category_title) {
    global $conn;

    $category_title = test_form_input($category_title);

    if (empty($category_title)) {
        echo "<p></em>Category title cannot be empty!</em></p>";
    }
    else {
        $sql = "INSERT INTO category(cat_title) VALUES('$category_title')";

        $result_create_category = $conn->query($sql);

        if (!$result_create_category) {
            die("<p><em>Sorry, could not create category!</em></p>" . $conn->error);
        }
    }
}


/*
 * delete_category($category_id)
 * - A function that deletes a specified category
 *   from the table named "category".
 * - @input: $category_id: ID of category to be deleted
 * - @return: TRUE, if operation was successful; FALSE, otherwise.
 */
function delete_category($category_id) {
    global $conn;

    $sql = "DELETE FROM category WHERE cat_id = $category_id";

    $result_delete_category = $conn->query($sql);

    if (!$result_delete_category) {
        echo "<p><em>Sorry, the category could not be deleted!</em></p>" . $conn->error;
        return FALSE;
    }
    else {
        return TRUE;
    }
}


/*
 *Returns a unique picture id that allows us to store the images for a post
 *
 *
 */
function get_new_picture_id(){
    while(true){
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                          .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                          .'0123456789!@#$%^&*()'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 10) as $k) $rand .= $seed[$k];
        $result = $conn->query("SELECT ad_picture_id FROM ads WHERE ad_picture_id={$rand}");
        if(!$result || $result->num_rows<1){
            return $rand;
        }
    }
}

?>