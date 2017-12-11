<?php 
/**
 * Changes editor (TinyMCE)
 * Ref: https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_external_plugins
 */
add_action( 'admin_init', 'wws_tinymce_init' );

function wws_tinymce_init() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		
		//Add buttons
		add_filter( 'mce_buttons', 'wws_register_tinymce_button' );
		add_filter( 'mce_external_plugins', 'wws_add_tinymce_button' );
		
		//Add row and cd-md-xx to Formats dd box
		add_filter( 'mce_buttons_2', 'wws_mce_buttons_2' );
		add_filter( 'tiny_mce_before_init', 'wws_insert_formats' ); 
		
		//Add the styles
		add_editor_style( get_template_directory_uri() . '/assets/custom-tinymce/editor-style.css' ); 

	}
}


/**
 * Adds TinyMCE call to action option in editor
 * Ref: https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_external_plugins
 */
function wws_register_tinymce_button( $buttons ) {
     array_push( $buttons, "button_cta" );
     return $buttons;
}

function wws_add_tinymce_button( $plugin_array ) {
	 $plugin_array['wws_button_script'] = get_template_directory_uri() . '/assets/custom-tinymce/custom-css.js';
     return $plugin_array;
}


/**
 * Adds Add row and cd-md-xx to Formats dd box
 * Ref: https://codex.wordpress.org/TinyMCE_Custom_Styles
 */

function wws_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

// Callback function to filter the MCE settings
function wws_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		/* FOR THIS SITE ONLY */
		
		/* BOOTSTRAP STUFF */
		array(  
			'title' => 'Full',  
			'classes' => 'col-md-12',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		),
		
		array(  
			'title' => '3/4',  
			'classes' => 'col-md-9',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		), 
		
		array(  
			'title' => '1/2',
			'classes' => 'col-md-6',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		),
		
		array(  
			'title' => '1/4',  
			'classes' => 'col-md-3',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		), 
		
		array(  
			'title' => '2/3',  
			'classes' => 'col-md-8',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		), 
		
		array(  
			'title' => '1/3',  
			'classes' => 'col-md-4',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => false,
		),
		
		array(  
			'title' => 'Row',  
			'classes' => 'row',
			'block' => 'div',  
			'exact' => true,
			'wrapper' => true,
		),
		
		
		 
  

	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
?>