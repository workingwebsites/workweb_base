<?php
$postid = wws_get_featuredpage();
$featured_page = get_post($postid);

$thumbnail = get_the_post_thumbnail( $featured_page->ID );
$content = apply_filters( 'the_content', $featured_page->post_excerpt );

?>

<article id="post-<?php echo $featured_page->ID ?>">
	<header class="entry-header">
    <h1><?php echo $featured_page->post_title ?></h1>
	</header>
	<div class="entry-content">
    <div class="thumbnail">
      <?php echo $thumbnail; ?>
    </div>
    <div>
      <?php echo $content; ?>
    </div>
	</div>

  <footer class="entry-footer">
		<span class="edit-link"><a class="post-edit-link" href="<?php echo get_edit_post_link( $featured_page->ID ); ?>">Edit</a></span>
  </footer>

</article><!-- #post-## -->
