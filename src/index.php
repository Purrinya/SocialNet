<?php 
	include("includes/header.php");


	if(isset($_POST['post'])){

		$uploadOk = 1;
		$imageName = $_FILES['fileToUpload']['name'];
		$errorMessage = "";

		if($imageName != "") {
			$targetDir = "assets/images/posts/";
			$imageName = $targetDir . uniqid() . basename($imageName);
			$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

			if($_FILES['fileToUpload']['size'] > 10000000) {
				$errorMessage = "Sorry your file is too large";
				$uploadOk = 0;
			}

			if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
				$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
				$uploadOk = 0;
			}

			if($uploadOk) {
				if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
					//image uploaded okay
				}
				else {
					//image did not upload
					$uploadOk = 0;
				}
			}

		}

		if($uploadOk) {
			$post = new Post($con, $userLoggedIn);
			$post->submitPost($_POST['post_text'], 'none', $imageName);
		}
		else {
			echo "<div style='text-align:center;' class='alert alert-danger'>
					$errorMessage
				</div>";
		}

	}
?>
	<div id="sidebar-col">
		<div id="user_details_col" class="user_details column">
			<div class="user_details_avatar">
				<a href="<?php echo $userLoggedIn; ?>">
					<img src="<?php echo $user['profile_pic']; ?>">
				</a>
			</div>

			<div class="user_details_info">
				<div class="user_details_info_username">
					<a href="<?php echo $userLoggedIn; ?>">
						<?php 
							echo $user['first_name'] . " " . $user['last_name'];
						?>
					</a>
				</div>
				
				
				<div class="user_details_info_counting">

					<div class="user_details_info_num_posts">
						<?php echo "<span style='font-weight: 600; color: #393a4f;'>POSTS</span><br><br>" . $user['num_posts'] ?>
					</div>
					
					<div class="user_details_info_num_likes">
						<?php	echo "<span style='font-weight: 600; color: #393a4f;'>CREDIT POINTS</span><br><br>" . $user['num_likes'] ?>
					</div>
					
				</div>
			</div>
		</div>

		<div id="popular_col" class="user_details column">
			<h4>TRENDING KEYWORDS</h4>

			<div class="trends">
				<?php 
					$query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

					foreach ($query as $row) {
						
						$word = $row['title'];
						$word_dot = strlen($word) >= 14 ? "..." : "";

						$trimmed_word = str_split($word, 14);
						$trimmed_word = $trimmed_word[0];

						echo "<div style'padding: 1px'>";
						echo $trimmed_word . $word_dot;
						echo "<br></div><br>";
				}
				?>
			</div>
		</div>
	</div>
	<div class="main_column">
		<div class="column">
			<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="fileToUpload" id="fileToUpload">
				<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
				<input type="submit" name="post" id="post_button" value="Post">
			</form>
		</div>

		<div class="posts_area column"></div>
		<div>
			<img id="loading" src="assets/images/icons/loading.gif">
		</div>
		

	</div>

	<script>
	// Prevent auto resubmit after reloading
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>

	</div>
</body>
</html>