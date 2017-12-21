<div id="fp_featured_products" class="col-md-12">
	<h2>Featured Products</h2>
	<?php if ( shortcode_exists( 'featured_products' ) ) { ?>
    <?php echo do_shortcode( '[featured_products]' );?>
	<?php }else{ ?>
		<p style="font-style: italic;">
			Woocommerce must be installed.
		</p>
		<?php }?>
</div>
