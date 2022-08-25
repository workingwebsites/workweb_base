<?php
/**
 * Sets number of boxes for screen
 */
$NumSliders = $GLOBALS['wwbVars']['slider_num'];

/**
 * Returns array of sliders
 */

function wws_get_sliders($return_url = false)
{
	$ar_theme_ops = get_theme_mod('wws_options');

	$ar_results = array();

	//Bail if nothing
	//if

	//Parse each box
	if (!empty($ar_theme_ops['slider'])) {
		foreach ($ar_theme_ops['slider'] as $slider) {
			//Get image
			if (!empty($slider['image'])) {

				//Return image string, or file url?
				if ($return_url == true) {
					$image_url = wp_get_attachment_image_src($slider['image'], 'slider-slider');
				} else {
					$image_url = wp_get_attachment_image($slider['image'], 'slider-slider');
				}

				if (!empty($image_url)) {
					$slider['image'] = $image_url;
				}
			}

			//Get lilnkl
			$slider['link'] = empty($slider['link']) ? NULL : get_permalink($slider['link']);

			$ar_results[] = $slider;
		}
	} else {

		$ar_results[] = NULL;
	}


	return $ar_results;
}


function wws_customize_register_slider($wp_customize)
{
	global $NumSliders;

	for ($i = 0; $i < $NumSliders; $i++) {
		$hb_text = $i + 1;

		/*** IMAGE ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[slider][' . $i . '][image]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'wws_sanitize_img_url',
			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'image_upload_wws_slider' . $i,
			array(
				//'label'    => __('----- Slider ' . $hb_text . ' -----', 'workweb_base'),
				'label'    => '----- ' . __('Slider', 'workweb_base')  . $hb_text . ' -----',
				'section'  => 'static_front_page',
				'settings' => 'wws_options[slider][' . $i . '][image]',
			)
		));

		/*** TITLE ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[slider][' . $i . '][title]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'wws_sanitize_text',
			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'slider_' . $i . '_title',
			array(
				'label'    => __('Title:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[slider][' . $i . '][title]',
				'type'     => 'text',
			)
		));


		/*** CONTENT ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[slider][' . $i . '][content]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'slider_' . $i . '_content',
			array(
				'label'    => __('Content:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[slider][' . $i . '][content]',
				'type'     => 'textarea',
			)
		));


		/*** LINK ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[slider][' . $i . '][link]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'wws_sanitize_text',
			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'slider_' . $i . '_link',
			array(
				'label'    => __('Read More link to:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[slider][' . $i . '][link]',
				'type'    => 'dropdown-pages',
				'allow_addition' => true,
			)
		));
	}
}

add_action('customize_register', 'wws_customize_register_slider');


/**
 * Functions to clean up text boxes
 */
/*
function wws_sanitize_text( $str_text ){
	return sanitize_text_field( $str_text );
}

function wws_sanitize_textarea( $str_text ){
	return sanitize_textarea_field( $str_text );
}


function wws_sanitize_img_url( $str_url ){
	$id = attachment_url_to_postid( $str_url );
	return $id;
}
*/

/**
 * Make it editable in Customizer preview screen
 */
function wwws_slideres_customize_register(WP_Customize_Manager $wp_customize)
{
	global $NumSliders;


	for ($i = 0; $i < $NumSliders; $i++) {
		$wp_customize->selective_refresh->add_partial(
			'wws_options[slider][' . $i . '][image]', // settings name
			array(
				'selector' => '#slider_' . $i,	// where it is on the screen
				'render_callback' => function () {
				},
			)
		);
	}
}
add_action('customize_register', 'wwws_slideres_customize_register');



/*
*  Set image sizes for portfolio
*/
add_image_size('slider-slider', 1400, 999, false);

/*
*  Add style sheet and js
*/
function wws_slider_scripts()
{
	wp_enqueue_style('slider-css', get_template_directory_uri() . '/inc/slider/css/slider.css');
}

add_action('wp_enqueue_scripts', 'wws_slider_scripts', 1);
