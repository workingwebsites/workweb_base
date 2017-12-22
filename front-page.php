<?php
/**
 * The static front page template
 *
 * @package workweb_base
 */

if ( 'posts' == get_option( 'show_on_front' ) ) :

	get_template_part( 'index' );

else :

get_header(); ?>

	<div id="primary" class="content-area <?php  workweb_base_primary_class() ?>">
    	 <!-- HEADER IMAGE AND ABOUT US -->
        <div id="fp_toprow" class="row">
            <div id="fp_toprow_image" class="col-md-5" style="background-image: url('<?php echo  get_header_image(); ?>')">
                <?php wws_get_custom_logo()?>
            </div>
            <div class="col-md-7">
							<h1>Home Page</h1>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'components/page/content', 'page' ); ?>
                <?php endwhile; ?>

                <article class="fp_contact col-md-12">
									<?php
										$postid = wws_get_contactpage();
										$contact_post = get_post($postid);
									?>

                	<?php echo wpautop( $contact_post->post_content ) ?>

									<?php edit_post_link( 'Edit', '<p>', '</p>', $postid ); ?>

                </article>

            </div>
        </div>

		<main id="main" class="site-main <?php workweb_base_main_class() ?>" role="main">

         	<!-- HOME BOXES -->
					<h1>Home Boxes</h1>
            <div id="fp_main_one" class="row">
							<?php get_template_part( 'inc/home-boxes/template/homebox', 'frontpage' );?>
						</div>
						<hr />

						<!-- PORTFOLIO -->
						<h1>Portfolio</h1>
						<div id="fp_portfolio" class="row">
                <?php get_template_part( 'inc/portfolio/template/portfolio', 'frontpage' );?>
            </div>
						<hr />

						<!-- FEATURED VIDEO -->
						<h1>Featured Video</h1>
						<div id="fp_featured_video" class="row">
                <?php get_template_part( 'inc/post-video/template/video', 'frontpage' );?>
            </div>
						<hr />

            <!-- FEATURED PRODUCTS -->
						<h1>Featured Product</h1>
            <div id="fp_main_two" class="row">
                <?php get_template_part( 'components/features/woocommerce', 'featuredproducts' );?>
            </div>
						<hr />


            <div id="fp_main_three" class="row">
							<!-- FEATURED PRODUCTS -->
							<div id="latest_post_container" class="col-lg-8 col-xl-9">
								<h1>Latest Post</h1>
                <?php get_template_part( 'components/features/posts', 'latest' );?>
								<hr />
              </div>

							<!-- HOME MIDDLE RIGHT BAR -->
              <div id="home-middle-right" class="widget-area col-lg-4 col-xl-3" role="complementary">
								<h1>Home Middle Right Bar</h1>
                  <?php if ( is_active_sidebar( 'home-middle-right' ) ) { ?>
                          <?php dynamic_sidebar( 'home-middle-right' ); ?>
                  <?php }	?>
									<hr />
              </div>
						</div>

		</main>


	</div>


<?php get_footer(); ?>


<?php endif; ?>
