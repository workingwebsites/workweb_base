<?php
/* Add customizer dd box to select contact page */
function wws_featuredpage_func($wp_customize)
{

    $wp_customize->add_section('wws_featuredpage', array(
        'title'    => __('Featured Page', 'workweb_base'),
        'description' => 'Select featured page to appear on front page.',
        'priority' => 120,
    ));

    $wp_customize->add_setting('wws_options[featured_page]', array(
        'capability'     => 'edit_theme_options',
        'type'          => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wws_featured_page_select', array(
        'label'      => __('Select the Featured Page', 'workweb_base'),
        'section'    => 'wws_featuredpage',
        'type'        => 'dropdown-pages',
        'allow_addition' => true,
        'settings'   => 'wws_options[featured_page]',
    ));
}

add_action('customize_register', 'wws_featuredpage_func');


/**
 * Make it editable in Customizer preview screen
 */

function wwws_featuredpage_customize_register(WP_Customize_Manager $wp_customize)
{
    $wp_customize->selective_refresh->add_partial(
        'wws_options[featured_page]', // settings name
        array(
            'selector' => '#div_featuredpage',    // where it is on the screen
            'render_callback' => function () {
            },
        )
    );
}
add_action('customize_register', 'wwws_featuredpage_customize_register');



function wws_get_featuredpage()
{
    $ar_theme_ops = get_theme_mod('wws_options');

    if (!empty($ar_theme_ops['featured_page'])) {
        return $ar_theme_ops['featured_page'];
    } else {
        return NULL;
    }
}
