<?php
/**
 * retro-classic-car functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package retro-classic-car
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
function retro_classic_car_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on retro-classic-car, use a find and replace
		* to change 'retro-classic-car' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'retro-classic-car', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'header-list', 'retro-classic-car' ),
			'header-menu-right' => esc_html__('header-menu-list', 'retro-classic-car'),
			'footer-menu' => esc_html__( 'footer-list', 'retro-classic-car' ),
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
			'retro_classic_car_custom_background_args',
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
add_action( 'after_setup_theme', 'retro_classic_car_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function retro_classic_car_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'retro_classic_car_content_width', 640 );
}
add_action( 'after_setup_theme', 'retro_classic_car_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function retro_classic_car_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'retro-classic-car' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'retro-classic-car' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'retro_classic_car_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function retro_classic_car_scripts() {
	wp_enqueue_style( 'retro-classic-car-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'retro-classic-car-style', 'rtl', 'replace' );
	
	// / Custom CSS /      
	wp_enqueue_style( 'retro-classic-car-media',get_template_directory_uri()  . '/css/media.css', array(), _S_VERSION );
	wp_enqueue_style( 'retro-classic-car-swiper-bundle.css',get_template_directory_uri()  . '/css/swiper-bundle.css', array(), _S_VERSION ); 

	// / Custom Js /
	wp_enqueue_script( 'retro-classic-car-jquery2', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, false );
	wp_enqueue_script( 'retro-classic-car-jquery1', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), _S_VERSION, false );
	wp_enqueue_script( 'retro-classic-car-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION, true );

	wp_enqueue_script( 'retro-classic-car-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'retro_classic_car_scripts' );

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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> true,
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Header Settings',
			'menu_title'	=> 'Header',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Footer Settings',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'theme-general-settings',
		));

	}


	function register_testimonials_endpoint() {
		register_rest_route('custom/v1', '/testimonials/', array(
			'methods'  => 'GET',
			'callback' => 'load_more_testimonials',
			'permission_callback' => '__return_true', // Allow public access
		));
	}
	
	add_action('rest_api_init', 'register_testimonials_endpoint');
	
	function load_more_testimonials($data) {
		$paged = isset($data['page']) ? intval($data['page']) : 1;
	
		$args = array(
			'post_type'      => 'testimonials',
			'post_status'    => 'publish',
			'posts_per_page' => 3, // Adjust as needed
			'paged'          => $paged,
		);
	
		$query = new WP_Query($args);
	
		if ($query->have_posts()) {
			ob_start();
			while ($query->have_posts()) {
				$query->the_post();
				?>
				<div class="testimonial_main">
					<div class="testimonial_list_content">
						<div class="testimonial_heading">
							<h3><?php the_title(); ?></h3>
							<p><?php the_date(); ?></p>
						</div>
						<?php the_content(); ?>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
			return ob_get_clean();
		} else {
			return '<p>No more posts found.</p>';
		}
	}
	
	add_action('wp_ajax_load_more_testimonials', 'load_more_testimonials');
	add_action('wp_ajax_nopriv_load_more_testimonials', 'load_more_testimonials');	




	function add_price_meta_box() {
		add_meta_box(
			'price_meta_box',         // Unique ID
			'Price Section',          // Box title
			'render_price_meta_box',  // Content callback
			'post',                   // Post type
			'side',                   // Context
			'default'                 // Priority
		);
	}
	add_action('add_meta_boxes', 'add_price_meta_box');
	
	function render_price_meta_box($post) {
		// Add a nonce field for security
		wp_nonce_field('save_price_meta_box', 'price_meta_box_nonce');
	
		// Retrieve the current value (if any) from the database
		$price = get_post_meta($post->ID, '_price', true);
	
		echo '<label for="price_field">Enter Price:</label>';
		echo '<input type="number" id="price_field" name="price_field" value="' . esc_attr($price) . '" style="width:100%;" step="0.01" min="0">';
	}

	
	function save_price_meta_box($post_id) {
		// Check if nonce is set
		if (!isset($_POST['price_meta_box_nonce'])) {
			return;
		}
	
		// Verify nonce
		if (!wp_verify_nonce($_POST['price_meta_box_nonce'], 'save_price_meta_box')) {
			return;
		}
	
		// Prevent autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
	
		// Check user permissions
		if (isset($_POST['post_type']) && $_POST['post_type'] === 'post') {
			if (!current_user_can('edit_post', $post_id)) {
				return;
			}
		}
	
		// Save the price
		if (isset($_POST['price_field'])) {
			update_post_meta($post_id, '_price', sanitize_text_field($_POST['price_field']));
		} else {
			delete_post_meta($post_id, '_price');
		}
	}
	add_action('save_post', 'save_price_meta_box');

	
	function enqueue_car_filter_scripts() {
		wp_enqueue_script('car-filter-script', get_template_directory_uri() . '/js/car-filter.js', array('jquery'), null, true);
		wp_localize_script('car-filter-script', 'ajax_obj', array('ajax_url' => admin_url('admin-ajax.php')));
	}
	add_action('wp_enqueue_scripts', 'enqueue_car_filter_scripts');
	


	function filter_cars_ajax() {
		$order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'most_recent';
	
		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		);
	
		switch ($order) {
			case 'most_recent':
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
				break;
			case 'price_high_low':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;
			case 'price_low_high':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				break;
			case 'oldest':
				$args['orderby'] = 'date';
				$args['order'] = 'ASC';
				break;
			case 'newest':
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
				break;
		}
	
		$query = new WP_Query($args);
	
		if ($query->have_posts()) :
			while ($query->have_posts()) :
				$query->the_post();
				$price = get_post_meta(get_the_ID(), '_price', true);
				?>
				<div class="car-post">
					<a href="<?php the_permalink(); ?>" class="car-post-link">
						<?php if (has_post_thumbnail()) : ?>
							<div class="car-post-image">
								<?php the_post_thumbnail('medium'); ?>
							</div>
						<?php endif; ?>
						<div class="car-post-content">
							<h2 class="car-post-title"><?php the_title(); ?></h2>
							<div class="car-post-excerpt">
								<p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
							</div>
							<?php if ($price) : ?>
								<p class="post-price"><strong>Price:</strong> ₹<?php echo esc_html($price); ?></p>
							<?php endif; ?>
						</div>
					</a>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			echo '<p>No posts found.</p>';
		endif;
	
		wp_die();
	}
	add_action('wp_ajax_filter_cars', 'filter_cars_ajax');
	add_action('wp_ajax_nopriv_filter_cars', 'filter_cars_ajax');
	
