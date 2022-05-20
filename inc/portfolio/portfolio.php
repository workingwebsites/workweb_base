<?php

/**
 * Create custom post for videos with featured option
 * Post type = wws_post_video
 */
function wws_create_portfolio_type()
{
  //Set the labels for vid
  $labels = array(
    'name'               => __('Portfolio', 'workweb_base'),
    'singular_name'      => __('Portfolio', 'workweb_base'),
    'menu_name'          => __('Portfolio', 'workweb_base'),
    'name_admin_bar'     => __('Portfolio', 'workweb_base'),
    'add_new'            => __('Add New Portfolio Item', 'workweb_base'),
    'add_new_item'       => __('Add New Portfolio Item', 'workweb_base'),
    'new_item'           => __('New Portfolio Item', 'workweb_base'),
    'edit_item'          => __('Edit Portfolio Item', 'workweb_base'),
    'view_item'          => __('View Portfolio Item', 'workweb_base'),
    'all_items'          => __('Portfolio', 'workweb_base'),
    'search_items'       => __('Search Portfolio', 'workweb_base'),
    'parent_item_colon'  => __('Parent Portfolio:', 'workweb_base'),
    'not_found'          => __('No portfolio found.', 'workweb_base'),
    'not_found_in_trash' => __('No portfolio found in Trash.', 'workweb_base')
  );

  register_post_type(
    'wws_portfolio',
    array(
      'labels'          => $labels,
      'description'        => __('Portfolio of work.', 'workweb_base'),
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
      'supports'           => array('title', 'editor', 'page-attributes', 'post-formats', 'thumbnail', 'excerpt'),
      'taxonomies'        => array('category', 'post_tag')
    )
  );
}
add_action('init', 'wws_create_portfolio_type');


/*
* Set default post format to 'video'
*/
function wws_default_portfolio_format($format)
{
  global $post_type;

  return ('wws_portfolio' === $post_type ? 'image' : $format);
}

add_filter('option_default_post_format', 'wws_default_portfolio_format');


/*
*  Return custom posts
*/
function wws_get_portfolio($num_posts = 12)
{

  $args = array(
    'posts_per_page'   => $num_posts,
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
    'author'     => '',
    'author_name'     => '',
    'post_status'      => 'publish',
    'suppress_filters' => true
  );
  return get_posts($args);
}

/*
*  Set image sizes for portfolio
*/
add_image_size('portfolio-thumb', 500, 500, 'center', 'center');
add_image_size('portfolio-thumblink', 100, 100, 'center', 'center');

/*
*  Add style sheet and js
*/
function wws_portfolio_scripts()
{
  wp_enqueue_style('portfolio-css', get_template_directory_uri() . '/inc/portfolio/css/portfolio.css');
}

add_action('wp_enqueue_scripts', 'wws_portfolio_scripts', 1);


/* Add customizer dd box to select portfolio page.
The content of this page appears on the Portfolio Archive.
The blurb can appear on the home page. */

function wws_portfoliopage_func($wp_customize)
{

  $wp_customize->add_section('wws_portfolio', array(
    'title'    => __('Portfolio Page', 'workweb_base'),
    'description' => 'Select a page that appears on the portfolio list.',
    'priority' => 120,
  ));

  $wp_customize->add_setting('wws_options[portfolio_page]', array(
    'capability'     => 'edit_theme_options',
    'type'          => 'theme_mod',

  ));

  $wp_customize->add_control('wws_portfolio_page_select', array(
    'label'      => __('Select the Portfolio Page', 'workweb_base'),
    'section'    => 'wws_portfolio',
    'type'    => 'dropdown-pages',
    'allow_addition' => true,
    'settings'   => 'wws_options[portfolio_page]',
  ));
}

add_action('customize_register', 'wws_portfoliopage_func');


function wws_get_portfoliopage()
{
  $ar_theme_ops = get_theme_mod('wws_options');

  if ($ar_theme_ops['portfolio_page']) {
    return $ar_theme_ops['portfolio_page'];
  } else {
    return NULL;
  }
}
