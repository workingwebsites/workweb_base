<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package workweb_base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ('' != get_the_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('workweb_base-featured-image'); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if (is_single()) {
			the_title('<h1 class="entry-title">', '</h1>');
		} else {
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		}

		if ('post' === get_post_type()) : ?>
			<?php get_template_part('components/post/content', 'meta'); ?>
		<?php
		endif; ?>
	</header>
	<div class="entry-content">
		<?php
		the_content(sprintf(
			/* translators: %s: Name of current post. */
			wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'workweb_base'), array('span' => array('class' => array()))),
			the_title('<span class="screen-reader-text">"', '"</span>', false)
		));

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'workweb_base'),
			'after'  => '</div>',
		));
		?>
	</div>
	<?php get_template_part('components/post/content', 'footer'); ?>
</article><!-- #post-## -->