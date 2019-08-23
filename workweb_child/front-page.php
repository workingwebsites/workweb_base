<?php

/**
 * The static front page template
 *
 * @package workweb_base
 */

if ('posts' == get_option('show_on_front')) :

	get_template_part('index');

else :

	get_header(); ?>

<div id="primary" class="content-area <?php workweb_base_primary_class() ?>">
	<!-- SLIDER -->
	<?php
		if ($wwbFeatures['slider'] == true) {
			get_template_part('inc/slider/template/slider', 'frontpage');
		}
		?>
	<!-- HEADER IMAGE AND ABOUT US -->
	<div id="fp_toprow" class="row">
		<?php if ($wwbFeatures['portfolio'] == true) { ?>
		<div id="fp_toprow_image" class="col-md-12" style="background-image: url('<?php echo  get_header_image(); ?>')">
		</div>
		<?php } ?>
		<div class="col-md-12">
			<h1>Home Page</h1>
			<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('components/page/content', 'page'); ?>
			<?php endwhile; ?>
			<article class="fp_contact col-md-12">
				<hr />
				<h2>Contact Info</h2>
				<?php
					$postid = wws_get_contactpage();
					$contact_post = get_post($postid);
					?>
				<?php echo wpautop($contact_post->post_content) ?>
				<?php edit_post_link('Edit', '<p>', '</p>', $postid); ?>
			</article>
		</div>
	</div>

	<main id="main" class="site-main <?php workweb_base_main_class() ?>" role="main">

		<!-- HOME BOXES -->
		<?php if ($wwbFeatures['home_box'] == true) { ?>
		<h1>Home Boxes</h1>
		<div id="fp_main_one" class="row">
			<?php get_template_part('inc/home-boxes/template/homebox', 'frontpage'); ?>
		</div>
		<hr />
		<?php } ?>

		<!-- PORTFOLIO -->
		<?php if ($wwbFeatures['portfolio'] == true) { ?>
		<h1>Portfolio</h1>
		<div id="fp_portfolio" class="row">
			<?php get_template_part('inc/portfolio/template/portfolio', 'grid'); ?>
		</div>
		<hr />
		<?php } ?>

		<!-- FEATURED VIDEO -->
		<?php if ($wwbFeatures['video'] == true) { ?>
		<h1>Featured Video</h1>
		<div id="fp_featured_video" class="row">
			<?php get_template_part('inc/post-video/template/video', 'frontpage'); ?>
		</div>
		<hr />
		<?php } ?>

		<!-- FEATURED PRODUCTS -->
		<?php if ($wwbFeatures['featured_products'] == true) { ?>
		<h1>Featured Product</h1>
		<div id="fp_main_two" class="row">
			<?php get_template_part('components/features/woocommerce', 'featuredproducts'); ?>
		</div>
		<hr />
		<?php } ?>

		<!-- TESTIMONY -->
		<?php if ($wwbFeatures['testimony'] == true) { ?>
		<h1>Testimony</h1>
		<div id="fp_testimony" class="row">
			<?php get_template_part('inc/testimony/template/testimony', 'grid'); ?>
		</div>
		<hr />
		<?php } ?>

		<!-- FEATURED PAGE -->
		<?php if ($wwbFeatures['featured_page'] == true) { ?>
		<h1>Featured Page</h1>
		<div id="fp_featuredpage" class="row">
			<div id="div_featuredpage" class="col-md-12">
				<?php get_template_part('inc/featuredpage/template/featuredpage'); ?>
			</div>
		</div>
		<hr />
		<?php } ?>
		
		<div id="fp_main_three" class="row">
			<!-- FEATURED POSTS -->
			<div id="latest_post_container" class="col-lg-8 col-xl-9">
				<h1>Latest Post</h1>
				<?php get_template_part('components/features/posts', 'latest'); ?>
				<hr />
			</div>

			<!-- HOME MIDDLE RIGHT BAR -->
			<div id="home-middle-right" class="widget-area col-lg-4 col-xl-3" role="complementary">
				<h1>Home Middle Right Bar</h1>
				<?php if (is_active_sidebar('home-middle-right')) { ?>
				<?php dynamic_sidebar('home-middle-right'); ?>
				<?php }	?>
				<hr />
			</div>
		</div>

	</main>
</div> <!-- END SITE CONTENT ROW -->
<?php get_footer(); ?>
<?php endif; ?>