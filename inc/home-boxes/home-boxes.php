<?php

/**
 * Sets number of boxes for screen.  
 * Numboxes is array.
 */
$NumBoxes = $GLOBALS['wwbVars']['homebox_num'];

/**
 * Returns array of home boxes
 */

function wws_get_homebox($return_url = false)
{
	$ar_theme_ops = get_theme_mod('wws_options');
	$ar_results = array();

	//Parse each box
	if (!empty($ar_theme_ops['homebox'])) {

		foreach ($ar_theme_ops['homebox'] as $homebox) {
			//Get image
			if (!empty($homebox['image'])) {

				//Return image string, or file url?
				if ($return_url == true) {
					$image_url = wp_get_attachment_image_src($homebox['image'], 'homebox-slider');
				} else {
					$image_url = wp_get_attachment_image($homebox['image'], 'homebox-slider');
				}

				if (!empty($image_url)) {
					$homebox['image'] = $image_url;
				}
			}

			//Get lilnkl
			$homebox['link'] = array_key_exists('link', $homebox) ? get_permalink($homebox['link']) : NULL;

			$ar_results[] = $homebox;
		}	// end foreach

	} else {
		$ar_results[] = NULL;
	}

	return $ar_results;
}



function wws_customize_register_homebox($wp_customize)
{
	global $NumBoxes;

	for ($i = 0; $i < $NumBoxes; $i++) {
		$hb_text = $i + 1;

		/*** IMAGE ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[homebox][' . $i . '][image]',
			array(
				'default'       => NULL, //'image.jpg',
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'wws_sanitize_img_url',

			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'image_upload_wws_' . $i,
			array(
				//'label'    => __('----- Home Box ' . $hb_text . ' -----', 'workweb_base'),
				'label'    => '----- ' . __('Home Box', 'workweb_base')  . $hb_text . ' -----',
				'section'  => 'static_front_page',
				'settings' => 'wws_options[homebox][' . $i . '][image]',
			)
		));

		/*** TITLE ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[homebox][' . $i . '][title]',
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
			'homebox_' . $i . '_title',
			array(
				'label'    => __('Title:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[homebox][' . $i . '][title]',
				'type'     => 'text',
			)
		));


		/*** CONTENT ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[homebox][' . $i . '][content]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				//'sanitize_callback' => 'wws_sanitize_textarea',

			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'homebox_' . $i . '_content',
			array(
				'label'    => __('Content:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[homebox][' . $i . '][content]',
				'type'     => 'textarea',
			)
		));


		/*** LINK ***/
		//Store the item
		$wp_customize->add_setting(
			'wws_options[homebox][' . $i . '][link]',
			array(
				'default'       => NULL,
				'capability'    => 'edit_theme_options',
				'type'          => 'theme_mod',
				//'sanitize_callback' => 'wws_sanitize_text',

			)
		);
		//Add to customizer
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'homebox_' . $i . '_link',
			array(
				'label'    => __('Read More link to:', 'workweb_base'),
				'section'  => 'static_front_page',
				'settings' => 'wws_options[homebox][' . $i . '][link]',
				'type'    => 'dropdown-pages',
				'allow_addition' => true,
			)
		));
	}	// end for num slides


}	// end function

add_action('customize_register', 'wws_customize_register_homebox');



/**
 * Make it editable in Customizer preview screen
 */
function wwws_homeboxes_customize_register(WP_Customize_Manager $wp_customize)
{
	global $NumBoxes;


	for ($i = 0; $i < $NumBoxes; $i++) {
		$wp_customize->selective_refresh->add_partial(
			'wws_options[homebox][' . $i . '][image]', // settings name
			array(
				'selector' => '#homebox_' . $i,	// where it is on the screen
				'render_callback' => function () {
				},
			)
		);
	}
}
add_action('customize_register', 'wwws_homeboxes_customize_register');



/*
*  Set image sizes for portfolio
*/
add_image_size('homebox-slider', 1400, 999, false);
