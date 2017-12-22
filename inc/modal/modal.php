<?php
//Set shortcode

function wws_contactmodal_func( $atts ){

	$a = shortcode_atts( array('title' => 'Contact Us'
								),
						 $atts );

	$str_return = '	<!-- Button trigger modal -->
					<button class="btn but_contmodal" type="button" data-toggle="modal" data-target="#contactModal">
					'. $a['title']
					.'</button>';
	return $str_return;
}


add_shortcode( 'contactmodal', 'wws_contactmodal_func' );

/* Add customizer dd box to select contact page */
function wws_contactpage_func($wp_customize){

	$wp_customize->add_section('wws_contactmodal', array(
        'title'    => __('Contact Pop Up', 'wws_contactmodal'),
        'description' => 'Select contact page to appear on pop-up.',
        'priority' => 120,
    ));

    $wp_customize->add_setting('wws_options[contact_page]', array(
        'capability'     => 'edit_theme_options',
        'type'          => 'theme_mod',

    ));

    $wp_customize->add_control('wws_contact_page_select', array(
        'label'      => __('Select the Contact Page', 'wws_contactmodal'),
        'section'    => 'wws_contactmodal',
        'type'    => 'dropdown-pages',
        'settings'   => 'wws_options[contact_page]',
    ));
}

add_action('customize_register', 'wws_contactpage_func');


/**
 * Make it editable in Customizer preview screen
 */

function wwws_modal_customize_register( WP_Customize_Manager $wp_customize ) {
	$wp_customize->selective_refresh->add_partial( 'wws_options[contact_page]', // settings name
		array(
        'selector' => '.fp_contact',	// where it is on the screen
        'render_callback' => function() {

        },
    ) );
}
add_action( 'customize_register', 'wwws_modal_customize_register' );



function wws_get_contactpage(){
	$ar_theme_ops = get_theme_mod('wws_options');

	if( $ar_theme_ops['contact_page'] ){
		return $ar_theme_ops['contact_page'];
	}else{
		return NULL;
	}
}

?>
