<?php

//create all the tables necessary for the project

header('content-type: text/plain');
$serverName = 'localhost';
$userName = 'ehab';
$password = 'ehab';
$dbName = 'cms';

$conn = new mysqli($serverName, $userName, $password, $dbName);

if ($conn->connect_error) {
    die('connection error '. $conn->connect_error);
}
// Creating the locations table
$sql = "CREATE TABLE IF NOT EXISTS locations (
  location_id INT(4) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  location_name VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Locations table succesfully created\n";
} else {
    echo "ERROR creating locations table\n";
}

//creating the category table
$sql = "CREATE TABLE IF NOT EXISTS category (
  cat_id INT(4) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  cat_title VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Category table succesfully created\n";
} else {
    echo "ERROR creating category table\n";
}

//creating the category sections table
$sql = "CREATE TABLE IF NOT EXISTS category_sections (
  cat_section_id INT(4) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  cat_section_title VARCHAR(255) NOT NULL,
  cat_id INT (4) NOT NULL,
  FOREIGN KEY (cat_id) REFERENCES category(cat_id)
);";

if ($conn->query($sql) === TRUE) {
    echo "Category sections table succesfully created\n";
} else {
    echo "ERROR creating category sections table\n";
}



$sql = "CREATE TABLE IF NOT EXISTS login (
  login_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  activation_link VARCHAR(255) NOT NULL,
  activated VARCHAR(20) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "login table successfully created\n";
} else {
    echo "ERROR creating login table\n";
}

echo "HIIIIIifb,dsakhafsjdI";

$sql = "CREATE TABLE IF NOT EXISTS ads (
  ad_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ad_type VARCHAR(255) NOT NULL,
  ad_price INT(20) NOT NULL,
  ad_for_sale_by VARCHAR(20) NOT NULL,
  ad_date DATETIME NOT NULL,

  ad_title VARCHAR(255) NOT NULL,
  ad_description TEXT NOT NULL,
  ad_location_id INT(4) NOT NULL,

  ad_user_email VARCHAR(255) NOT NULL,
  ad_user_phone VARCHAR(15) NOT NULL,
  ad_cat_id INT(4) NOT NULL,
  ad_cat_section_id INT(4) NOT NULL,

  ad_approve_status VARCHAR(10) NOT NULL,
  ad_activation_link VARCHAR(256) NOT NULL,

  FOREIGN KEY (ad_location_id) references locations(location_id),
  FOREIGN KEY (ad_cat_id) references category(cat_id),
  FOREIGN KEY (ad_cat_section_id) references category_sections(cat_section_id)
);";
//ad status is to know if the ad has been activated or not.
//ad approve status tells us if it has been approved or not

if ($conn->query($sql) === TRUE) {
    echo "Ads table successfully created\n";
} else {
    echo "ERROR creating Ads table\n";
}


$sql = "CREATE TABLE IF NOT EXISTS pictures (
  pic_ad_id INT NOT NULL,
  picture_name VARCHAR(255) NOT NULL,
  FOREIGN KEY (pic_ad_id) REFERENCES ads(ad_id)
);";

if ($conn->query($sql) === TRUE) {
    echo "Pictures table successfully created\n";
} else {
    echo "ERROR creating Pictures table\n";
}


//$conn->close();



////creating the users and login tables
//$sql = "CREATE TABLE IF NOT EXISTS users (
//  user_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
//  registeration_date DATETIME NOT NULL,
//  user_firstname VARCHAR(255) NOT NULL,
//  user_lastname VARCHAR(255) NOT NULL,
//  user_email VARCHAR(100) NOT NULL,
//  user_address VARCHAR(255) NOT NULL,
//  user_phone VARCHAR(20) NOT NULL,
//  user_role INT NOT NULL,
//  user_image TEXT NOT NULL,
//  user_location_id INT(4),
//  FOREIGN KEY(user_location_id) REFERENCES locations(location_id)
//);";
//
//if ($conn->query($sql) === TRUE) {
//    echo "Users table successfully created\n";
//} else {
//    echo "ERROR creating Users table\n";
//}



//$sql = "CREATE TABLE IF NOT EXISTS comments (
//  comment_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
//  comment_post_id INT NOT NULL,
//  comment_author VARCHAR(255) NOT NULL,
//  comment_email VARCHAR(255) NOT NULL,
//  comment_content TEXT NOT NULL,
//  comment_date DATETIME NOT NULL,
//  comment_status VARCHAR(255) NOT NULL,
//  FOREIGN KEY (comment_post_id) REFERENCES posts(post_id)
//);";
//
//if ($conn->query($sql) === TRUE) {
//    echo "Comments table successfully created\n";
//} else {
//    echo "ERROR creating Comments table\n";
//}
?>
