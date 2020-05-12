<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if(isset($_POST['post'])){
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}
?>
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
					<?php	echo "<span style='font-weight: 600; color: #393a4f;'>LIKES</span><br><br>" . $user['num_likes'] ?>
				</div>
				
			</div>
		</div>
	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>

		</form>

		<?php 

		$user_obj = new User($con, $userLoggedIn);
		echo $user_obj->getFirstAndLastName();

		?>


	</div>




	</div>
</body>
</html>