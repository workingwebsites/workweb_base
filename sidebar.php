<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package workweb_base
 */

if ( ! is_active_sidebar( 'sidebar-inside' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area <?php workweb_base_sidebar_class() ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-inside' ); ?>
</aside>
