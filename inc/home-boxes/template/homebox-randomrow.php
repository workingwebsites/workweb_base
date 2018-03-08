<?php
/* REQUIRES HOME BOX */

	$ar_homebox = wws_get_homebox(true);


	$i = -1;	// To set first one at 0

	$homebox =  $ar_homebox[ rand ( 0 , 2)];

	//foreach ( $ar_homebox As $homebox) {
		//++$i;

		//Set vars
		$image = isset( $homebox['image'] )? $homebox['image'][0]: NULL;
		$title = isset( $homebox['title'] )? $homebox['title'] : NULL;
		$content = isset( $homebox['content'] )? wpautop( $homebox['content'] ) : NULL;
		$link = isset( $homebox['link'] )?'<a href="'.$homebox['link'].'" class="homebox_link_a btn btn-sm portfolio_but"">More</a>': NULL;

?>
<div id="homeboxrow_<?php echo $i ?>" class="row homeboxrow align-items-end" style="background-image:url('<?php echo $image ?>');">
	<div  class="col-sm-12 offset-md-6 col-md-6 homebox_container">
		<div class="homebox">
			<h2 class="homebox_title"><?php echo  $title ?></h2>
			<div class="homebox_content">
				<?php echo  $content ?>
				<div class="homebox_cta">
					<?php echo do_shortcode("[contactmodal title='Get Your Free Estimate']"); ?>
				</div>
				<div class="homebox_link"><?php echo  $link ?></div>
			</div>

		</div>
	</div>
</div>
 <?php
//}
?>
