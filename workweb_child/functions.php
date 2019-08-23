<?php
/**
 * Makes sure child theme styles override parents
 */
add_action( 'wp_enqueue_scripts', 'workweb_enqueue_styles' );
function workweb_enqueue_styles() {
    $parent_style = 'parent-style'; 
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style_base.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}


/**
 * Set what features to show
 * Overrides defaults set in parent.  Pick what you want
 */
function setwwbFeatures(){
    $GLOBALS['wwbFeatures']['header_image'] = true;
    $GLOBALS['wwbFeatures']['home_box'] = true;
    $GLOBALS['wwbFeatures']['slider'] = true;
    $GLOBALS['wwbFeatures']['portfolio'] = true;
    $GLOBALS['wwbFeatures']['video'] = true;
    $GLOBALS['wwbFeatures']['featured_products'] = true;
    $GLOBALS['wwbFeatures']['testimony'] = true;
    $GLOBALS['wwbFeatures']['featured_page'] = true;
    $GLOBALS['wwbFeatures']['modal'] = true;
}
setwwbFeatures();
?>