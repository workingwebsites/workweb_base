<?php
	$args = array(
		'numberposts' => 1,
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => true
	);
	
	$recent_posts = wp_get_recent_posts( $args );
	
	

	foreach( $recent_posts as $recent ){
?>
           <div class="latest_post">
               <h2 class="recentpost_title"><?php echo $recent['post_title'] ?></h2>
               <div class="recentpost_meta">Posted: <?php echo $recent['post_date'] ?></div>
               <div class="recentpost_content"><?php echo $recent['post_content'] ?></div>
			</div>
	<?php
		}
		wp_reset_query();
	?>
