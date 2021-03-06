<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package workweb_base
 */

get_header(); ?>

	<div id="primary" class="content-area <?php workweb_base_primary_sidebar_class() ?>">
		<main id="main" class="site-main <?php workweb_base_main_class() ?>" role="main">
			<?php get_template_part( 'inc/testimony/template/testimony', 'single' ); ?>
		</main>
	</div>
<?php
get_sidebar();
get_footer();
