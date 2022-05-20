<?php

/**
 * Create custom post for videos with featured option
 * Post type = wws_post_video
 */
function wws_create_postvideo_type()
{
	//Set the labels for vid
	$labels = array(
		'name'               => __('Videos', 'workweb_base'),
		'singular_name'      => __('Video', 'workweb_base'),
		'menu_name'          => __('Video', 'workweb_base'),
		'name_admin_bar'     => __('Video', 'workweb_base'),
		'add_new'            => __('Add New Video', 'workweb_base'),
		'add_new_item'       => __('Add New Video', 'workweb_base'),
		'new_item'           => __('New Video', 'workweb_base'),
		'edit_item'          => __('Edit Video', 'workweb_base'),
		'view_item'          => __('View Video', 'workweb_base'),
		'all_items'          => __('All Videos', 'workweb_base'),
		'search_items'       => __('Search Videos', 'workweb_base'),
		'parent_item_colon'  => __('Parent Videos:', 'workweb_base'),
		'not_found'          => __('No videos found.', 'workweb_base'),
		'not_found_in_trash' => __('No videos found in Trash.', 'workweb_base')
	);

	register_post_type(
		'wws_post_video',
		array(
			'labels' => $labels,
			'description'        => __('Link to YouTube videos.', 'workweb_base'),
			'menu_icon'         => 'dashicons-video-alt3',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'           => array('slug' => 'videos'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => 5,
			'supports'           => array('title', 'editor', 'page-attributes', 'post-formats'),
			'taxonomies'        => array('category', 'post_tag')
		)
	);
}
add_action('init', 'wws_create_postvideo_type');


/*
* Set default post format to 'video'
*/
function wws_default_videopost_format($format)
{
	global $post_type;

	return ('wws_post_video' === $post_type ? 'video' : $format);
}

add_filter('option_default_post_format', 'wws_default_videopost_format');


/*
*  Return custom posts
*/

function wws_get_videos()
{
	$args = array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'wws_post_video',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   => '',
		'author_name'	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);
	return get_posts($args);
}
