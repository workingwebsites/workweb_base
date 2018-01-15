<?php
/**
 * components functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package workweb_base
 */

if ( ! function_exists( 'workweb_base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function workweb_base_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'workweb_base' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'workweb_base', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'workweb_base-featured-image', 640, 9999 );
	add_image_size( 'workweb_base-portfolio-featured-image', 800, 9999 );


	/**
	 * Add support for core custom logo.
	 */

	add_theme_support( 'custom-logo', array(
		'height'      => 'thumbnail',
		'width'       => 'thumbnail',
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'workweb_base_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Set refresh widgets in customizer
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'workweb_base_setup' );

/**
 * Add menus
 */
 function wws_register_menus() {
   register_nav_menus(
     array(
       'short-top-menu' => __( 'Short Top Menu' ),
       'full-top-menu' => __( 'Full Top Menu' )
     )
   );
 }
 add_action( 'init', 'wws_register_menus' );

 /**
  * Add bootstrap classes to menu items
  */
 function wws_bootstrap_navitem_class( $classes, $item, $args ) {
		if ( 'short-top-menu' === $args->theme_location ){
			$str_current = empty( $item->current ) ? NULL : ' active';
			$classes[] = 'nav-item'.$str_current;
		}

 		return $classes;

 }

 add_filter( 'nav_menu_css_class', 'wws_bootstrap_navitem_class', 10, 4 );

 /**
  * Add bootstrap classes to menu links
  */
 function add_specific_menu_location_atts( $atts, $item, $args ) {
    if( 'short-top-menu' === $args->theme_location  ) {
      $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function workweb_base_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'workweb_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'workweb_base_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function workweb_base_widgets_init() {
	//Sidebar Top Bar Right
	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar Right', 'workweb_base' ),
		'id'            => 'topbar-right',
		'description'   => 'Sidebar on the top bar.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Sidebar Home Middle Right
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Right', 'workweb_base' ),
		'id'            => 'home-middle-right',
		'description'   => 'Sidebar in the middle of the home page.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Sidebar Home Page
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Home', 'workweb_base' ),
		'id'            => 'sidebar-home',
		'description'   => 'Sidebar on the home page.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Sidebar Inside
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Inside', 'workweb_base' ),
		'id'            => 'sidebar-inside',
		'description'   => 'Sidebar on all pages execept home page.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Footer sidebars
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'workweb_base' ),
		'id'            => 'sidebar-footer-1',
		'description'   => 'First sidebar in footer.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'workweb_base' ),
		'id'            => 'sidebar-footer-2',
		'description'   => 'Second sidebar in footer.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'workweb_base' ),
		'id'            => 'sidebar-footer-3',
		'description'   => 'Third sidebar in footer.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'workweb_base' ),
		'id'            => 'sidebar-footer-4',
		'description'   => 'Fourth sidebar in footer.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'workweb_base_widgets_init' );


/* Allow shortcodes in widget areas */
add_filter('widget_text', 'do_shortcode');

/**
 * Enqueue scripts and styles.
 */
function workweb_base_scripts() {

	wp_enqueue_script( 'workweb_base-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'workweb_base-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Add bootstrap
	/*
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/bootstrap-3.3.7/css/bootstrap.min.css' );

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/bootstrap-3.3.7/js/bootstrap.min.js', array( 'jquery' ) );
	*/
	//Bootstrap 4.0

	//Needs Tether first
	wp_enqueue_script( 'tether-script', get_template_directory_uri() . '/assets/tether/js/tether.min.js', array( 'jquery' ) );

	//Now Bootstrap
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css' );

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js', array( 'jquery' ) );


	//Add Fonts
	//wp_enqueue_style( 'fonts-google', get_stylesheet_directory_uri().'/style_fonts.css' );
	wp_enqueue_style( 'fonts-google', get_template_directory_uri().'/style_fonts.css' );

	//Add Base Style
	wp_enqueue_style( 'base-style',   get_template_directory_uri().'/style_base.css' );

}
add_action( 'wp_enqueue_scripts', 'workweb_base_scripts', 1 );


/**
 * Load style sheet last
 * Make sure local style gets last word
 */
function workweb_base_mainstyle(){
	wp_enqueue_style( 'workweb_base-style', get_stylesheet_uri(), array( 'bootstrap-style', 'fonts-google', 'base-style' ) );
}
add_action( 'wp_enqueue_scripts', 'workweb_base_mainstyle');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Home Box file.
 */
require get_template_directory() . '/inc/home-boxes/home-boxes.php';

/**
 * Support WooCommerce
 */
require get_template_directory() . '/inc/woocommerce.php';


/**
 * Load Custom TinyMCE file.
 */
require get_template_directory() . '/assets/custom-tinymce/custom-tinymce.php';

/**
 * Load Contact Modal.
 */
require get_template_directory() . '/inc/modal/modal.php';

/**
 * Load Video Posts.
 */
require get_template_directory() . '/inc/post-video/post_video.php';

/**
 * Load Portfolio.
 */
require get_template_directory() . '/inc/portfolio/portfolio.php';

/**
 * Load Testimony.
 */
require get_template_directory() . '/inc/testimony/testimony.php';



/**
 * Add Bootstrap classes
*/
function workweb_base_primary_class(){
	echo 	"col-md-12";
}

function workweb_base_main_class(){
	//echo 	"row";
}

function workweb_base_primary_sidebar_class(){
	echo 	"col-md-8 col-lg-7 col-lg-offset-1";
}

function workweb_base_sidebar_class(){
	echo 	"col-md-4 col-lg-3";
}

function category_id_class( $classes ) {
	$arClass[] = "col-md-12";

	return $arClass;
}

add_filter( 'post_class', 'category_id_class' );



/**
 * replace one of the widget image sizes
 *
 * examples replaces the banner layout's image with the 'large' size image from Settings > Media
 *
 * If you replacing $size with a custom image size, you must register that separately with add_image_size()
 *
 * @param	$size	string		slug of registered image size
 * @return	string|array	slug of registered image size or "array( width, height )" (not recommended)
 */
function fpw_change_image_size( $size ) {
	// check if image uses the "banner" layout image size
	if( $size === 'fpw_big' ) {
		$size = 'fpw_square';
	}
	return $size;
}
add_filter( 'fpw_image_size', 'fpw_change_image_size' );


/**
 * Add editor style so more WYSIWYG in editing
 */

$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );


/**
 * Return thumbnail sized custom logo
 */
function wws_get_custom_logo(){
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
	if ( has_custom_logo() ) {
			echo '<img class="img-fluid" src="'. esc_url( $logo[0] ) .'">';
	}
}
?>
