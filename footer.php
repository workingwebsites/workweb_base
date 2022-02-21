<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package workweb_base
 */


?>
</div> <!-- END site-content row  FROM HEADER -->
<footer id="footer-widgets" class="site-footer row mt-auto" role="contentinfo">
	<?php get_template_part('components/footer/site'); ?>
</footer>
<footer id="colophon" class="site-colophon row" role="contentinfo">
	<?php get_template_part('components/footer/site', 'colophon'); ?>
</footer>
</div> <!-- END #PAGE -->
<?php wp_footer(); ?>
</body>

</html>