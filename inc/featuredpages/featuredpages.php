<?php
/* Add customizer dd box to select featured page */
$NumPages = $GLOBALS['wwbVars']['featuredpages_num'];

/**
 * Add to Customizer
 */
function wws_featuredpages_func($wp_customize)
{
    global $NumPages;


    $wp_customize->add_section('wws_featuredpages', array(
        'title' => __('Featured Pages', 'workweb_base'),
        'description' => 'Select featured pages to appear on front page',
        'priority' => 125,
    ));

    for ($i = 0; $i < $NumPages; $i++) {
        $wp_customize->add_setting('wws_options[featured_pages][' . $i . ']', array(
            'capability' => 'edit_theme_options',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'featuredpages_' . $i,
            array(
                'label' => __('Select Featured Page ID ', 'workweb_base')  . $i,
                'section' => 'wws_featuredpages',
                'type' => 'dropdown-pages',
                'allow_addition' => true,
                'settings'   => 'wws_options[featured_pages][' . $i . ']',
            )
        ));
    }
}
add_action('customize_register', 'wws_featuredpages_func');


/**
 * Make it editable in Customizer preview screen
 */

function wwws_featuredpages_customize_register(WP_Customize_Manager $wp_customize)
{
    global $NumPages;

    for ($i = 0; $i < $NumPages; $i++) {
        $wp_customize->selective_refresh->add_partial(
            'wws_options[featured_pages][' . $i . ']', // settings name
            array(
                'selector' => '#div_featuredpages_' . $i,    // where it is on the screen
                'render_callback' => function () {
                },
            )
        );
    }
}
add_action('customize_register', 'wwws_featuredpages_customize_register');



function wws_get_featuredpages()
{
    $ar_theme_ops = get_theme_mod('wws_options');

    if (!empty($ar_theme_ops['featured_pages'])) {
        return $ar_theme_ops['featured_pages'];
    } else {
        return array();
    }
}
