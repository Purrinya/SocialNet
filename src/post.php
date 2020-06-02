<?php  
include("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
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
						<?php	echo "<span style='font-weight: 600; color: #393a4f;'>CREDIT POINTS</span><br><br>" . $user['num_likes'] ?>
					</div>
					
				</div>
			</div>
		</div>

	<div class="main_column column" id="post-wrapper">

		<div class="posts_area">

			<?php 
				$post = new Post($con, $userLoggedIn);
				$post->getSinglePost($id);
			?>

		</div>

	</div>