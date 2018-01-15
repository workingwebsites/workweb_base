<?php
$ar_testimony = wws_get_testimony();
?>
<?php
	foreach ( $ar_testimony As $testimony ) {
		$content = apply_filters( 'the_content', $testimony->post_content );
		$meta_name = get_post_meta( $testimony->ID, 'meta-box-name', true );
		$meta_location = get_post_meta( $testimony->ID, 'meta-box-location', true );
 ?>
 <div class="testimony_container col-md-4">
	 <div class="testimony_content_container">
		 <h3><?php echo $testimony ->post_title?></h3>
		 <div class="testimony_content">
			 <?php echo $content ?>
		 </div>
		 <div class="testimony_info">
		 	<span class="name"><?php echo $meta_name ?></span>, <span class="location"><?php echo $meta_location ?></span>
		 </div>
	 </div>
 </div>

<?php } ?>
