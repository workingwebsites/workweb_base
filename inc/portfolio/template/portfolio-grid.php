<?php
$ar_portfolio = wws_get_portfolio();
?>
<?php
	foreach ( $ar_portfolio As $portfolio ) {
		$excerpt = apply_filters( 'the_content', $portfolio->post_excerpt );
		$thumbnail_uri = get_the_post_thumbnail_url( $portfolio->ID, 'portfolio-thumb' );
 ?>
 <div class="portfolio_container col-md-4">
	 <div class="portfolio_img_container" style="background-image: url('<?php echo $thumbnail_uri ?>')"></div>
	 <div class="portfolio_content_container">
		 <h3><?php echo $portfolio ->post_title?></h3>
		 <?php echo $excerpt ?>
			<div class="portfolio_detail_link">
				<a class="btn btn-primary" href="<?php the_permalink( $portfolio->ID ) ?>" role="button">More</a>
			</div>
	 </div>
 </div>

<?php } ?>
