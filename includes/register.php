<?php
require ("functions.php");
if(isset($_POST['register'])) {
    $TWO_MEGA_BYTES = 2097152;
    $db_host = "localhost";
	$db_username = "ehab";
	$db_password = "ehab";
	$db_name = "cms";

	$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

	if ($conn->connect_error) {
		die ("Error connecting to the DB.<br>" . $db->connect_error);
	}
    
    
    /*
		 * Retrieve all the form values using the $_POST superglobal.
		 */
    $user_firstname = ucwords(test_form_input($_POST['user_firstname']));
    $user_lastname = ucwords(test_form_input($_POST['user_lastname']));
    $user_role = test_form_input($_POST['user_role']);
    $user_address = test_form_input($_POST['user_address']);
    $user_email = test_form_input($_POST['user_email']);
    $user_phone = test_form_input($_POST['user_phone']);
    $user_username = test_form_input($_POST['user_username']);
    $user_password = password_hash(test_form_input($_POST['user_password']),PASSWORD_BCRYPT);

    
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_image_filesize = $_FILES['user_image']['size'];

    if($user_image != "") { 
        /*
			 * This section of the code manages image uploads. As discussed in class,
			 * we check if the file is of a specified type, and within the allowed file-size.
			 */
        $target_file = "../images/" . $user_image;
        echo $target_file;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $user_image_temp);

        /*
			 * A list of MIME types are available here:
			 * http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
			 */

        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                if ($user_image_filesize < $TWO_MEGA_BYTES) {
                    //Upload the image.
                    move_uploaded_file($user_image_temp, "$target_file");
                }
                break;

            default:
                die("<br>Unknown file type. Your image cannot be uploaded.<br>");
        }
    } 
    else { 
        //Otherwise, the user has not set any post image.
        $user_image = "default_profile.png";
    } 
    
    
    $sql = "INSERT INTO users (user_firstname,user_lastname, user_email, user_address, user_phone, user_role, user_image,registeration_date)";
    $sql .= "VALUES('$user_firstname','$user_lastname','$user_email','$user_address','$user_phone','$user_role', '$user_image',now())";
    $add_user_result = $conn->query($sql);
    
    
    if (!$add_user_result) {
        die ("Error adding user.<br>" . $conn->error . "<br>");
    }
    
    $sql = "INSERT INTO login ( username, password,user_id) ";
    $sql .= "VALUES('$user_username','$user_password','$conn->insert_id')";
    

    $add_user_result2 = $conn->query($sql);

    if (!$add_user_result2) {
        die ("Error adding user.<br>" . $conn->error . "<br>");
    }
    header("Location: ../index.php");
}
?>