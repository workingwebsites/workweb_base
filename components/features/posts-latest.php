<?php
	$num_posts = $GLOBALS['wwbVars']['latestposts_num'];
	$args = array(
		'numberposts' => $num_posts,
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
		$content = apply_filters('the_content', $recent['post_content']);

?>
<div class="latest_post">
	<h2 class="recentpost_title"><?php echo $recent['post_title'] ?></h2>
	<div class="recentpost_meta">Posted: <?php echo $recent['post_date'] ?></div>
	<div class="recentpost_content"><?php echo $content ?></div>

	<?php edit_post_link( 'Edit', '<p>', '</p>', $recent['ID'] ); ?>
</div>

<?php
	}
	wp_reset_query();
?>
