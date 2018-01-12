<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package workweb_base
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site container-fluid">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'workweb_base' ); ?></a>
    <?php get_template_part( 'inc/modal/template/modal', 'contact' ); ?>

	<header class="site-header" role="banner">
		<div id="masthead"  class="row">
	    <div class="col-md-7">
	    		<?php //get_template_part( 'components/header/header' ); ?>
					<?php get_template_part( 'components/header/header', 'image' ); ?>
			</div>

			<aside id="topbar-right" class="col-md-5" role="complementary">
				<?php if ( is_active_sidebar( 'topbar-right' ) ) { ?>
					<?php dynamic_sidebar( 'topbar-right' ); ?>
				<?php }	?>
			</aside>
		</div>

		<div id="navigation" class="row">
    		<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
		</div>
	</header>

	<div id="content" class="site-content row">
