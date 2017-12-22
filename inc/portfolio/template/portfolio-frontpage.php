<?php
/* REQUIRES VIDEO PAGE */
	//Get the videos
	$ar_portfolio = wws_get_portfolio();


?>


		<?php
			foreach ( $ar_portfolio As $portfolio ) {
				$content = apply_filters( 'the_content', $portfolio->post_content );
				$postid = $portfolio->ID;
		 ?>
		 <div class="col-md-4">
			 <?php echo get_the_post_thumbnail( $postid, 'medium_large' ); ?>
			 <br />
			 <?php echo $content ?>
		 </div>

			<?php } ?>
