<?php
/* REQUIRES VIDEO PAGE */
	//Get the videos
	$ar_videos = wws_get_videos();

	//Get the first video, it's special.  Remove from the list
	$featured_video = array_shift($ar_videos);

	//Pull it from the ArrayAccess
	if(!empty($featured_video)){
		$featured_content = apply_filters( 'the_content', $featured_video->post_content );
?>
		<div class="video_main col-md-8">
			<h3 class="videomain_title"><?php echo $featured_video->post_title ?></h3>
	 		<div class="videomain_content">
				<?php echo $featured_content  ?>
			</div>
	 	</div>
<?php } ?>
	<div class="video_list col-md-4">
		<?php
			foreach ( $ar_videos As $video ) {
				$content = apply_filters( 'the_content', $video->post_content );
		 ?>
		 	<ul class="video_list">
				<li>
					<span class="videolist_content"><?php echo $content  ?></span>
					<span class="videolist_title"><?php echo $video->post_title ?></span>
				</li>
		 	</ul>
		<?php } ?>

	</div>
