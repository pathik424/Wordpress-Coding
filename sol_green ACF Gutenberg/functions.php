<?php
/**
 * sol_green functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sol_green
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sol_green_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on sol_green, use a find and replace
		* to change 'sol_green' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'sol_green', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'css/media.css' ) );

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

	require get_template_directory() . '/inc/class-footer-menu-walker.php';

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'sol_green' ),
			'header-menu'    => esc_html__( 'Header Menu', 'sol_green' ),
		'footer-menu'    => esc_html__( 'Footer Menu', 'sol_green' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'sol_green_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sol_green_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sol_green_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sol_green_content_width', 640 );
}
add_action( 'after_setup_theme', 'sol_green_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sol_green_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sol_green' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sol_green' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sol_green_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
// function sol_green_scripts() {
// 	wp_enqueue_style( 'sol_green-style', get_stylesheet_uri(), array(), _S_VERSION );
// 	wp_enqueue_style('sol_green-media', get_template_directory_uri() . '/css/media.css', array(), filemtime(get_template_directory() . '/css/media.css'), 'all');
// 	wp_style_add_data( 'sol_green-style', 'rtl', 'replace' );
// 	 // Swiper CSS
//     wp_enqueue_style(
//         'swiper-css',
//         'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css',
//         array(),
//         '11.0.5'
//     );
// 	wp_enqueue_script( 'sol_green-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
// 	wp_enqueue_script( 'sol_green-custom', get_template_directory_uri() . '/js/custom.js', array( 'swiper-js' ), time(), true );
// 	    // Swiper JS
//     wp_enqueue_script(
//         'swiper-js',
//         'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js',
//         array(),
//         '11.0.5',
//         true
//     );


// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'sol_green_scripts' );


// 1. Load styles natively inside Gutenberg Editor
// function sol_green_setups() {
//     add_theme_support( 'editor-styles' );
//     add_editor_style( array(
//         'style.css',
//         'css/media.css',
//         'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css'
//     ) );
// }
// add_action( 'after_setup_theme', 'sol_green_setups' );

// 2. Enqueue Scripts & Frontend Styles
function sol_green_scripts() {
    // Styles
    wp_enqueue_style( 'sol_green-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 
        'sol_green-media', 
        get_template_directory_uri() . '/css/media.css', 
        array(), 
        filemtime( get_template_directory() . '/css/media.css' ), 
        'all' 
    );
    wp_style_add_data( 'sol_green-style', 'rtl', 'replace' );

    wp_enqueue_style(
        'swiper-css',
        'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css',
        array(),
        '11.0.5'
    );

    // Scripts (Register dependencies BEFORE dependent scripts)
    wp_enqueue_script(
        'swiper-js',
        'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js',
        array(),
        '11.0.5',
        true
    );

    wp_enqueue_script( 'sol_green-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'sol_green-custom', get_template_directory_uri() . '/js/custom.js', array( 'swiper-js' ), time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'sol_green_scripts' );

/**
 * Load the frontend layout styles in the block editor iframe.
 */
function sol_green_editor_styles() {
	wp_enqueue_style( 'sol_green-editor-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style(
		'sol_green-editor-media',
		get_template_directory_uri() . '/css/media.css',
		array( 'sol_green-editor-style' ),
		filemtime( get_template_directory() . '/css/media.css' )
	);
}
add_action( 'enqueue_block_editor_assets', 'sol_green_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



require get_template_directory() . '/inc/blocks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




// add_action( 'init', 'register_test_block' );

// function register_test_block() {

//     register_block_type( get_template_directory() . '/blocks/test-block' );

// }

// add_action( 'init', 'register_my_acf_blocks' );

// function register_my_acf_blocks() {

//     register_block_type(
//         get_template_directory() . '/blocks/test-block'
//     );

// }


// add_action( 'acf/init', 'register_test_block_fields' );

// function register_test_block_fields() {

//     if ( ! function_exists( 'acf_add_local_field_group' ) ) {
//         return;
//     }

//     acf_add_local_field_group( array(

//         'key' => 'group_test_block',
//         'title' => 'Test Block Fields',

//         'fields' => array(

//             array(
//                 'key'   => 'field_test_title',
//                 'label' => 'Title',
//                 'name'  => 'title',
//                 'type'  => 'text',
//             ),

//             array(
//                 'key'   => 'field_test_description',
//                 'label' => 'Description',
//                 'name'  => 'description',
//                 'type'  => 'textarea',
//             ),

//             array(
//                 'key'           => 'field_test_image',
//                 'label'         => 'Image',
//                 'name'          => 'image',
//                 'type'          => 'image',
//                 'return_format' => 'array',
//                 'preview_size'  => 'medium',
//             ),

//             array(
//                 'key'   => 'field_test_button_text',
//                 'label' => 'Button Text',
//                 'name'  => 'button_text',
//                 'type'  => 'text',
//             ),

//             array(
//                 'key'   => 'field_test_button_url',
//                 'label' => 'Button URL',
//                 'name'  => 'button_url',
//                 'type'  => 'url',
//             ),

//         ),

//         'location' => array(

//             array(
//                 array(
//                     'param'    => 'block',
//                     'operator' => '==',
//                     'value'    => 'acf/test-block',
//                 ),
//             ),

//         ),

//     ) );

// }