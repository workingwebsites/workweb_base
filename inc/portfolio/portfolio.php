<?php
/**
 * Create custom post for videos with featured option
 * Post type = wws_post_video
 */
 function wws_create_portfolio_type() {
//Set the labels for vid
   $labels = array(
		'name'               => __( 'Portfolio' ),
		'singular_name'      => __( 'Portfolio' ),
		'menu_name'          => __( 'Portfolio' ),
		'name_admin_bar'     => __( 'Portfolio' ),
		'add_new'            => __( 'Add New Portfolio Item' ),
		'add_new_item'       => __( 'Add New Portfolio Item' ),
		'new_item'           => __( 'New Portfolio Item' ),
		'edit_item'          => __( 'Edit Portfolio Item' ),
		'view_item'          => __( 'View Portfolio Item' ),
		'all_items'          => __( 'Portfolio' ),
		'search_items'       => __( 'Search Portfolio' ),
		'parent_item_colon'  => __( 'Parent Portfolio:' ),
		'not_found'          => __( 'No portfolio found.' ),
		'not_found_in_trash' => __( 'No portfolio found in Trash.' )
	);

  register_post_type( 'wws_portfolio',
      array(
          'labels'          => $labels,
          'description'        => __( 'Portfolio of work.'),
          'menu_icon'         => 'dashicons-portfolio',
          'public'             => true,
          'publicly_queryable' => true,
          'show_ui'            => true,
          'show_in_menu'       => true,
          'query_var'          => true,
          'rewrite'           => array('slug' => 'portfolio'),
          'capability_type'    => 'post',
          'has_archive'        => true,
          'hierarchical'       => true,
          'menu_position'      => 5,
          'supports'           => array( 'title', 'editor', 'page-attributes', 'post-formats', 'thumbnail'),
          'taxonomies'        => array('category', 'post_tag' )
    )
  );
}
add_action( 'init', 'wws_create_portfolio_type' );


/*
* Set default post format to 'video'
*/
function wws_default_portfolio_format( $format ) {
    global $post_type;

    return ( 'wws_portfolio' === $post_type ? 'image' : $format );
}

add_filter( 'option_default_post_format', 'wws_default_portfolio_format' );


/*
*  Return custom posts
*/

function wws_get_portfolio(){
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
  	'post_type'        => 'wws_portfolio',
  	'post_mime_type'   => '',
  	'post_parent'      => '',
  	'author'	   => '',
  	'author_name'	   => '',
  	'post_status'      => 'publish',
  	'suppress_filters' => true
  );
  return get_posts( $args );
}