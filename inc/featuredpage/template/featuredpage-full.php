<?php
$postid = wws_get_featuredpage();
$featured_page = get_post($postid);

$thumbnail_url = get_the_post_thumbnail_url( $featured_page->ID );
$content = apply_filters( 'the_content', $featured_page->post_excerpt );
$link = get_permalink( $featured_page->ID );


?>


<div id="fp_whybuy" class="row align-items-center" style="background-image:url('<?php echo $thumbnail_url ?>')";>
		<div id="div_featuredpage" class="col-md-10 offset-md-1">

			<article id="post-<?php echo $featured_page->ID ?>">
				<header class="entry-header">
			    <h1><?php echo $featured_page->post_title ?></h1>
				</header>
				<div class="entry-content">
			      <?php echo $content; ?>
						<p class="more_link">
							<a href="<?php echo $link?>" class="homebox_link_a btn btn-sm portfolio_but" >More</a>
						</p>
				</div>
				<?php if ( is_user_logged_in() ) { ?>
						<footer class="entry-footer">
							<span class="edit-link"><a class="post-edit-link" href="<?php echo get_edit_post_link( $featured_page->ID ); ?>">Edit</a></span>
						</footer>
				<?php } ?>

			</article><!-- #post-## -->
		</div>
</div>
