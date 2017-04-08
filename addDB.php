
<?php


$db_host = "localhost";
$db_username = "ehab";
$db_password = "ehab";
$db_name = "cms";
$currentDate= "---";

$conn = new mysqli ($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die ("Error connecting to the DB.<br>" . $db->connect_error);
}
$sql="INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments`, `post_status`) VALUES ('20', '3', 'test1', 'tech', '2017-04-12 00:00:00', 'whatever.png', 'fdsa', 'dsadf', '2', 'dsaf')";
$conn->query($sql);


$sql="INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments`, `post_status`) VALUES ('21', '3', 'test1', 'tech', '2017-04-12 00:00:00', 'whatever.png', 'fdsa', 'dsadf', '2', 'dsaf')";
$conn->query($sql);



$sql="INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments`, `post_status`) VALUES ('22', '3', 'test1', 'tech', '2017-04-12 00:00:00', 'whatever.png', 'fdsa', 'dsadf', '2', 'dsaf')";
$conn->query($sql);



$sql="INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments`, `post_status`) VALUES ('21', '3', 'test1', 'aloha', '2017-04-12 00:00:00', 'whatever.png', 'fdsa', 'dsadf', '2', 'dsaf')";
$conn->query($sql);



?>