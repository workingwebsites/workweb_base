<?php

/**
 *  Slider / carousel
 * Displays slides from 'slider' control.
 */

$ar_slider = wws_get_sliders(true);

?>

<div id="wwsCarouselSlider" class="carousel slide" data-bs-ride="carousel">

	<div class="carousel-indicators">
		<?php
		for ($i = 0; $i < count($ar_slider); $i++) {
			if ($i == 0) {	// The first one is active
				$strParam = 'class="active" aria-current="true" ';
			} else {
				$strParam = null;
			}
		?>
			<button type="button" data-bs-target="#wwsCarouselSlider" data-bs-slide-to="<?php echo $i ?>" <?php echo $strParam ?> aria-label="Slide <?php echo $i + 1 ?>"></button>
		<?php } ?>
	</div>

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
			<div class="carousel-item <?php echo $item_active ?>">
				<img src="<?php echo $image ?>" class="d-block w-100" alt="<?php echo $title ?>">
				<div class="carousel-caption d-none d-md-block">
					<h5><?php echo $title ?></h5>
					<div class="slider_content">
						<?php echo  $content ?>
						<div class="slider_link"><?php echo  $link ?></div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#wwsCarouselSlider" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#wwsCarouselSlider" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>