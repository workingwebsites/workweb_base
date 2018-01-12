<?php
while ( have_posts() ) : the_post();
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( '' != get_the_post_thumbnail() ) : ?>
      <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'workweb_base-featured-image' ); ?>
        </a>
      </div>
    <?php endif; ?>

    <header class="entry-header">
      <?php
        if ( is_single() ) {
          the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }

      if ( 'wws_portfolio' === get_post_type() ) : ?>
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

        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'workweb_base' ),
          'after'  => '</div>',
        ) );
      ?>
    </div>
    <?php get_template_part( 'components/post/content', 'footer' ); ?>
  </article><!-- #post-## -->

  <!--- ===== NAVIGATION =====-->
  <?php
    //Prev post
    $previous_post = get_previous_post();

    if( $previous_post ){
      $previous_post_link = get_permalink( $previous_post );

      $previous_post_thumbnail = get_the_post_thumbnail( $previous_post, 'portfolio-thumblink' );
      $previous_post_title = $previous_post->post_title;

      //Build links
      $previous_post_link_str	= "<a href='".$previous_post_link."' class='previouspost_img'>".$previous_post_thumbnail."</a>"
                            ."<a href='".$previous_post_link."' class='previoustpost_title'>".$previous_post_title."</a>";
    }else{
      $previous_post_link_str = NULL;
    }

    //Next post
    $next_post = get_next_post();

    if( $next_post ){
      $next_post_link = get_permalink( $next_post );

      $next_post_thumbnail = get_the_post_thumbnail( $next_post, 'portfolio-thumblink' );
      $next_post_title = $next_post->post_title;

      //Build links
      $next_post_link_str	= "<a href='".$next_post_link."' class='nextpost_img'>".$next_post_thumbnail."</a>"
                            ."<a href='".$next_post_link."' class='nextpost_title'>".$next_post_title."</a>";
    }else{
      $next_post_link_str = NULL;
    }

  ?>
  <nav class="navigation post-navigation" role="navigation">
    <h2 class="screen-reader-text">Post navigation</h2>
    <div class="nav-links">
      <div class="nav-previous"><?php echo $previous_post_link_str ?></div>
      <div class="nav-next"><?php echo $next_post_link_str ?></div>
    </div>
  </nav>

  <!--- ===== COMMENTS =====-->
  <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;

  endwhile; // End of the loop.
  ?>
