<?php

/**
 * Create custom post for videos with featured option
 * Post type = wws_post_video
 */
function wws_create_testimony_type()
{
    //Set the labels for vid
    $labels = array(
        'name'               => __('Testimony', 'workweb_base'),
        'singular_name'      => __('Testimony', 'workweb_base'),
        'menu_name'          => __('Testimonies', 'workweb_base'),
        'name_admin_bar'     => __('Testimony', 'workweb_base'),
        'add_new'            => __('Add Testimony', 'workweb_base'),
        'add_new_item'       => __('Add Testimony', 'workweb_base'),
        'new_item'           => __('New Testimony', 'workweb_base'),
        'edit_item'          => __('Edit Testimony', 'workweb_base'),
        'view_item'          => __('View Testimony', 'workweb_base'),
        'all_items'          => __('Testimonies', 'workweb_base'),
        'search_items'       => __('Search Testimonies', 'workweb_base'),
        'parent_item_colon'  => __('Parent Testimony:', 'workweb_base'),
        'not_found'          => __('No testimonies found.', 'workweb_base'),
        'not_found_in_trash' => __('No testimonies found in Trash.', 'workweb_base')
    );

    register_post_type(
        'wws_testimony',
        array(
            'labels'          => $labels,
            'description'        => __('Testimonies.', 'workweb_base'),
            'menu_icon'         => 'dashicons-format-quote',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'           => array('slug' => 'testimony'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 5,
            'supports'           => array('title', 'editor', 'page-attributes', 'post-formats', 'thumbnail', 'excerpt'),
            'taxonomies'        => array('category', 'post_tag')
        )
    );
}
add_action('init', 'wws_create_testimony_type');


/*
* Set default post format to 'video'
*/
function wws_default_testimony_format($format)
{
    global $post_type;

    return ('wws_testimony' === $post_type ? 'quote' : $format);
}

add_filter('option_default_post_format', 'wws_default_testimony_format');


/*
*  Return custom posts
*/

if (!function_exists('wws_get_testimony')) {
    //Returns Testimonies
    //Ref: https://codex.wordpress.org/Template_Tags/get_posts 
    function wws_get_testimony($num_posts = 12)
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
            'post_type'        => 'wws_testimony',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'       => '',
            'author_name'       => '',
            'post_status'      => 'publish',
            'suppress_filters' => true
        );
        return get_posts($args);
    }
}

/*
*  Add Meta boxes
*/
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

?>
    <div>
        <label for="meta-box-name">Name:</label>
        <input name="meta-box-name" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-name", true); ?>">


        <label for="meta-box-location">City:</label>
        <input name="meta-box-location" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-location", true); ?>">
    </div>
<?php
}

function add_custom_meta_box()
{
    add_meta_box("testimony-meta-box", "Testimony From", "custom_meta_box_markup", "wws_testimony", "normal", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");


function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if (!current_user_can("edit_post", $post_id))
        return $post_id;

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "wws_testimony";
    if ($slug != $post->post_type)
        return $post_id;

    $meta_box_name_value = "";
    $meta_box_location_value = "";

    if (isset($_POST["meta-box-name"])) {
        $meta_box_name_value = $_POST["meta-box-name"];
    }
    update_post_meta($post_id, "meta-box-name", $meta_box_name_value);

    if (isset($_POST["meta-box-location"])) {
        $meta_box_location_value = $_POST["meta-box-location"];
    }
    update_post_meta($post_id, "meta-box-location", $meta_box_location_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);



/*
*  Add style sheet and js
*/
function wws_testimony_scripts()
{
    //wp_enqueue_style( 'testimony-css', get_template_directory_uri() . '/inc/testimony/css/testimony.css' );
    //wp_enqueue_script( 'testimony-script', get_template_directory_uri() . '/inc/testimony/js/testimony.js' );

}

add_action('wp_enqueue_scripts', 'wws_testimony_scripts', 1);
