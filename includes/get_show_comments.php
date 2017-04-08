<?php 
	/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.

	This is the script that allows users to submit comments, retrieves them from the DB table,
	and displays them on the post page.
	****************************************************************************************************/
?>
				<!-- Comments Form -->
				<div class="well">
					<h4>Leave a Comment:</h4>
					<?php
						/*
						 * When we submit a form using the POST method, it loads the page that is specified in "action" attribute
						 * of the HTML form. However, when this happens, we lose the variables that we had passed in the URL
						 * to indicate which category ID needs to be updated. Since an UPDATE query would need an identifier to 
						 * update a table, we need the category ID information even after the form was submitted.
						 * To avoid such issues, we use $_SERVER['QUERY_STRING']. This retrieves the variables in the URL, i.e.
						 * whatever we pass as key=value pairs in the URL after a question mark (?).
						 * E.g. Suppose the URL was http://localhost/cms/categories.php?update_category=9  
						 *      $_SERVER['PHP_SELF'] returns "/cms/categories.php"
						 *      $_SERVER['QUERY_STRING'] returns "update_category=9"
						 *
						 * There are several other things the $_SERVER superglobal can do. Check it out on php.net
						 */
						$variables_in_URL = $_SERVER['QUERY_STRING'];
						$current_page = $_SERVER['PHP_SELF'];
					?>

					<form action="<?php echo $current_page . '?' . $variables_in_URL; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="comment_author">Author</label>
							<input type="text" name="comment_author" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="comment_email">Email</label>
							<input type="email" name="comment_email" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="comment_content">Comment</label>
							<textarea class="form-control" rows="3" name="comment_content" required></textarea>
						</div>
						<input type="submit" class="btn btn-primary" name="submit_comment">
					</form>
				</div>

				<hr>

				<?php
					/* Insert posted comments into the DB table */

					if (isset($_POST['submit_comment'])) {
						$comment_author = test_form_input($_POST['comment_author']);
						$comment_email = test_form_input($_POST['comment_email']);
						$comment_content = test_form_input($_POST['comment_content']);
						$comment_status = 'submitted';
						$comment_post_id = $_GET['p_id'];

						$sql = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
						$sql .= "VALUES('$comment_post_id','$comment_author','$comment_email','$comment_content','$comment_status',now())";

						$submit_comment_query_result = $conn->query($sql);

						if (!$submit_comment_query_result) {
							die ("<p>Sorry. Your request could not be completed.</p>" . $conn->error);
						}
					}

				?>


				<!-- Posted Comments -->

				<!-- Comment -->
				<?php 
					//Retrieve comments for this post				
					$post_id_for_comment = $_GET['p_id'];

					$sql = "SELECT * FROM comments WHERE comment_post_id = $post_id_for_comment";
					$retrieve_comment_query_result = $conn->query($sql);

					if ($retrieve_comment_query_result->num_rows > 0) {
						while ($row = $retrieve_comment_query_result->fetch_assoc()) {
							$this_comment_author = $row['comment_author'];
							$this_comment_date = $row['comment_date'];
							$this_comment_content = $row['comment_content'];
				
				?>
				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><?php echo $this_comment_author; ?>
							<small>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<?php echo $this_comment_date; ?></small>
						</h4>
						<?php
							echo "<p>$this_comment_content</p>";
						?>
					</div>
				</div>

				<?php
						} // While loop ends
					}
					else {
						echo "<p>No comments yet.</p><p>Be the first to post a comment about this article!</p>";
					}
				?>
