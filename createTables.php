<?php
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

//creating the users and login tables
$sql = "CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  registeration_date DATETIME NOT NULL,
  user_firstname VARCHAR(255) NOT NULL,
  user_lastname VARCHAR(255) NOT NULL,
  user_email VARCHAR(100) NOT NULL,
  user_address VARCHAR(255) NOT NULL,
  user_phone VARCHAR(20) NOT NULL,
  user_role INT NOT NULL,
  user_image TEXT NOT NULL,
  user_location_id INT(4),
  FOREIGN KEY(user_location_id) REFERENCES locations(location_id)
);";

if ($conn->query($sql) === TRUE) {
  echo "Users table successfully created\n";
} else {
  echo "ERROR creating Users table\n";
}

$sql = "CREATE TABLE IF NOT EXISTS login (
  login_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  user_id Int NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  random_salt VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);";

if ($conn->query($sql) === TRUE) {
  echo "login table successfully created\n";
} else {
  echo "ERROR creating login table\n";
}




$sql = "CREATE TABLE IF NOT EXISTS posts (
  post_id INT(4) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  post_cat_id INT(4) NOT NULL,
  post_title VARCHAR(255) NOT NULL,
  post_author VARCHAR(255) NOT NULL,
  post_date DATETIME NOT NULL, 
  post_image TEXT,
  post_content TEXT,
  post_tags VARCHAR(255),
  post_comments INT(4) NOT NULL DEFAULT 0,
  post_status VARCHAR(255) NOT NULL,
  FOREIGN KEY (post_cat_id) REFERENCES category(cat_id)
);";

if ($conn->query($sql) === TRUE) {
  echo "Posts table successfully created\n";
} else {
  echo "ERROR creating Posts table\n";
}







$sql = "CREATE TABLE IF NOT EXISTS ads (
  ad_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  ad_type INT NOT NULL,
  ad_title VARCHAR(255) NOT NULL,
  ad_description TEXT NOT NULL,
  ad_location_id VARCHAR(255) NOT NULL,
  ad_postal_code VARCHAR(255) NOT NULL,
  ad_address VARCHAR(255) NOT NULL,
  ad_price VARCHAR(20) NOT NULL,
  ad_for_sale_by VARCHAR(20) NOT NULL,
  ad_user_id VARCHAR(255) NOT NULL,
  ad_picture_id VARCHAR(255) NOT NULL,
  ad_cat_id INT(4) NOT NULL,
  FOREIGN KEY (ad_location_id) references locations(location_id),
  FOREIGN KEY (ad_user_id) references users(user_id),
  FOREIGN KEY (ad_cat_id) references category(user_id),
  FOREIGN KEY (ad_user_id) references users(user_id),
);";

if ($conn->query($sql) === TRUE) {
  echo "Ads table successfully created\n";
} else {
  echo "ERROR creating Ads table\n";
}









$sql = "CREATE TABLE IF NOT EXISTS comments (
  comment_id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  comment_post_id INT NOT NULL,
  comment_author VARCHAR(255) NOT NULL,
  comment_email VARCHAR(255) NOT NULL,
  comment_content TEXT NOT NULL,
  comment_date DATETIME NOT NULL,
  comment_status VARCHAR(255) NOT NULL,
  FOREIGN KEY (comment_post_id) REFERENCES posts(post_id)
);";

if ($conn->query($sql) === TRUE) {
  echo "Comments table successfully created\n";
} else {
  echo "ERROR creating Comments table\n";
}


?>
