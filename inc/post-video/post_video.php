<?php
/**
 * Create custom post for videos with featured option
 * Post type = wws_post_video
 */
 function wws_create_postvideo_type() {
//Set the labels for vid
   $labels = array(
		'name'               => __( 'Videos' ),
		'singular_name'      => __( 'Video' ),
		'menu_name'          => __( 'Video' ),
		'name_admin_bar'     => __( 'Video' ),
		'add_new'            => __( 'Add New Video' ),
		'add_new_item'       => __( 'Add New Video' ),
		'new_item'           => __( 'New Video' ),
		'edit_item'          => __( 'Edit Video' ),
		'view_item'          => __( 'View Video' ),
		'all_items'          => __( 'All Videos' ),
		'search_items'       => __( 'Search Videos' ),
		'parent_item_colon'  => __( 'Parent Videos:' ),
		'not_found'          => __( 'No videos found.' ),
		'not_found_in_trash' => __( 'No videos found in Trash.' )
	);

  register_post_type( 'wws_post_video',
      array(
          'labels' => $labels,
          'description'        => __( 'Link to YouTube videos.'),
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
          'supports'           => array( 'title', 'editor', 'page-attributes', 'post-formats'),
          'taxonomies'        => array('category', 'post_tag' )
    )
  );
}
add_action( 'init', 'wws_create_postvideo_type' );


/*
* Set default post format to 'video'
*/
function wws_default_videopost_format( $format ) {
    global $post_type;

    return ( 'wws_post_video' === $post_type ? 'video' : $format );
}

add_filter( 'option_default_post_format', 'wws_default_videopost_format' );


/*
*  Return custom posts
*/

function wws_get_videos(){
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
  return get_posts( $args );
}
