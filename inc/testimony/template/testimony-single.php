<?php
while ( have_posts() ) : the_post();
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <?php
        if ( is_single() ) {
          the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }

      if ( 'wws_testimony_scripts' === get_post_type() ) : ?>
      <?php get_template_part( 'components/post/content', 'meta' ); ?>
      <?php
      endif; ?>
    </header>
    <div class="entry-content">
      <?php
        the_content( sprintf(
          /* translators: %s: Name of current post. */
          wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'workweb_base' ), array( 'span' => array( 'class' => array() ) ) ),
          the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) );

        ?>

        <?php
          $meta_name = get_post_meta( get_the_ID(), 'meta-box-name', true );
          $meta_location = get_post_meta( get_the_ID(), 'meta-box-location', true );
        ?>
        <div class="testimony_info">
          <span class="name"><?php echo $meta_name ?></span>, <span class="location"><?php echo $meta_location ?></span>
        </div>
        <?php
        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'workweb_base' ),
          'after'  => '</div>',
        ) );
      ?>
      <!--- ===== NAVIGATION ===== --->
      <?php the_post_navigation(); ?>
    </div>
    <?php get_template_part( 'components/post/content', 'footer' ); ?>
  </article><!-- #post-## -->


  <!--- ===== COMMENTS =====-->
  <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;

  endwhile; // End of the loop.
  ?>
