<?php
/* REQUIRES HOME BOX */

	$ar_videos = wws_get_videos();

	$i = -1;	// To set first one at 0

	foreach ( $ar_videos As $videos) {
		++$i;

		//Set vars
		$image = isset( $homebox['image'] )? $homebox['image'] : NULL;
		$title = isset( $homebox['title'] )? $homebox['title'] : NULL;
		$content = isset( $homebox['content'] )? wpautop( $homebox['content'] ) : NULL;
		$link = isset( $homebox['link'] )?'<a href="'.$homebox['link'].'" class="homebox_link_a">More</a>': NULL;

?>
	<div id="homebox_<?php echo $i ?>" class="col-md-4 homebox_container">
		<div class="homebox">
			<div class="homebox_image"><?php echo  $image ?></div>
			<h2 class="homebox_title"><?php echo  $title ?></h2>
			<div class="homebox_content"><?php echo  $content ?></div>
			<div class="homebox_link"><?php echo  $link ?></div>
		</div>
	</div>
 <?php
}
?>
