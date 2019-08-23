<?php
/* REQUIRES HOME BOX */

$ar_slider = wws_get_sliders(true);

?>
<div id="wwsCarouselSlider" class="carousel slide row" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#wwsCarouselSlider" data-slide-to="0" class="active"></li>
		<li data-target="#wwsCarouselSlider" data-slide-to="1"></li>
		<li data-target="#wwsCarouselSlider" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<?php
		$i = -1;
		foreach ($ar_slider as $slider) {
			++$i;
			//Make the first one active
			$item_active = $i == 0 ? 'active' : null;

			//Set vars
			$image = isset($slider['image'][0]) ? $slider['image'][0] : NULL;
			$title = isset($slider['title']) ? $slider['title'] : NULL;
			$content = isset($slider['content']) ? wpautop($slider['content']) : NULL;
			$link = isset($slider['link']) ? '<a href="' . $slider['link'] . '" class="slider_link_a btn btn-sm portfolio_but"">More</a>' : NULL;
			?>

		<div class="carousel-item <?php echo $item_active ?> sliderrow align-items-end" style="background-image:url('<?php echo $image ?>');">
			<div class="slider_container col-sm-12 offset-md-6 col-md-6 ">
				<div class="slider">
					<h2 class="slider_title"><?php echo  $title ?></h2>
					<div class="slider_content">
						<?php echo  $content ?>
						<div class="slider_cta">
							<?php //echo do_shortcode("[contactmodal title='Get Your Free Estimate']"); 
								?>
						</div>
						<div class="slider_link"><?php echo  $link ?></div>
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