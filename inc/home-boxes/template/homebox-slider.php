<?php
/* REQUIRES HOME BOX */

	$ar_homebox = wws_get_homebox(true);

?>
<div id="wwsCarousel" class="carousel slide row" data-ride="carousel">
	<ol class="carousel-indicators">
    <li data-target="#wwsCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#wwsCarousel" data-slide-to="1"></li>
    <li data-target="#wwsCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
<?php
	$i = -1;
	foreach ( $ar_homebox As $homebox) {
			++$i;
			//Make the first one active
			$item_active = $i == 0 ? 'active':null;

			//Set vars
			$image = isset( $homebox['image'] )? $homebox['image'][0]: NULL;
			$title = isset( $homebox['title'] )? $homebox['title'] : NULL;
			$content = isset( $homebox['content'] )? wpautop( $homebox['content'] ) : NULL;
			$link = isset( $homebox['link'] )?'<a href="'.$homebox['link'].'" class="homebox_link_a btn btn-sm portfolio_but"">More</a>': NULL;
?>

  <div class="carousel-item <?php echo $item_active ?> homeboxrow align-items-end" style="background-image:url('<?php echo $image ?>');">
	 <!-- <div id="homeboxrow_<?php echo $i ?>" class="row carousel-item homeboxrow align-items-end" style="background-image:url('<?php echo $image ?>');"> -->
			<div  class="homebox_container col-sm-12 offset-md-6 col-md-6 ">
				<div class="homebox">
					<h2 class="homebox_title"><?php echo  $title ?></h2>
					<div class="homebox_content">
						<?php echo  $content ?>
						<div class="homebox_cta">
							<?php //echo do_shortcode("[contactmodal title='Get Your Free Estimate']"); ?>
						</div>
						<div class="homebox_link"><?php echo  $link ?></div>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#wwsCarousel" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#wwsCarousel" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
    </div>
	<?php } ?>
  </div>
</div>
