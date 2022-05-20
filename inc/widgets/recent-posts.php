<?php

/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

class wws_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{

	function widget($args, $instance)
	{

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'workweb_base') : $instance['title'], $instance, $this->id_base);

		if (empty($instance['number']) || !$number = absint($instance['number']))
			$number = 10;

		$arPosts = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));

		//So component template can work
		set_query_var('arPosts', $arPosts);

		if ($arPosts->have_posts()) :

			echo $before_widget;
			if ($title) echo $before_title . $title . $after_title;
?>

            <?php get_template_part('components/post/widget', 'recent'); ?>
			 
			<?php
			echo $after_widget;

			wp_reset_postdata();

		endif;
	}
}
function wws_recent_widget_registration()
{
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('wws_Recent_Posts_Widget');
}
add_action('widgets_init', 'wws_recent_widget_registration');

			?>