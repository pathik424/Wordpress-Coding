<?php

/**
 * qs-gen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package qs-gen
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function qs_gen_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on qs-gen, use a find and replace
		* to change 'qs-gen' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('qs-gen', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'qs-gen'),
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
			'qs_gen_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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

	// Register navigation menu
	register_nav_menus(array(
		'header-menu' => __('header-list', 'qs-gen'),
		'footer-menu' => __('footer-list', 'qs-gen'),
		'footer-socail-menu' => __('footer-socail-list', 'qs-gen'),
	));
}
add_action('after_setup_theme', 'qs_gen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function qs_gen_content_width()
{
	$GLOBALS['content_width'] = apply_filters('qs_gen_content_width', 640);
}
add_action('after_setup_theme', 'qs_gen_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function qs_gen_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'qs-gen'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'qs-gen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'qs_gen_widgets_init');


/**
 * Enqueue scripts and styles.
 */

function qs_gen_scripts()
{
	wp_enqueue_style('qs-gen-style', get_stylesheet_uri(), array(), time());
	wp_enqueue_style('qs-gen-slider', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', array(), null);
	wp_enqueue_style('qs-gen-media', get_stylesheet_directory_uri() . '/css/media.css', array(), null);
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), null);


	wp_style_add_data('qs-gen-style', 'rtl', 'replace');

	wp_enqueue_script('qs-gen-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	wp_enqueue_script('qs-gen-slider-js', get_template_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), null, true);
	wp_enqueue_script('qs-gen-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'qs_gen_scripts');

function enqueue_load_more_script()
{
	// Enqueue the new load-more-post.js file
	wp_enqueue_script('load-more-post-js', get_template_directory_uri() . '/js/load-more-post.js', array('jquery'), null, true);

	// Localize the script to pass the ajax_url and category_id to JavaScript
	wp_localize_script('load-more-post-js', 'ajax_params', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'category_id' => get_queried_object_id(),
		'is_author_page' => is_author() ? 'true' : 'false',
		'author_id' => get_queried_object_id() // This gets the author ID if on the author page
	]);
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_script');


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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
if (function_exists('acf_add_options_page')) {

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

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Qs Stories Settings',
		'menu_title'	=> 'QS Stories',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'    => "Global Author's Advertisement",
		'menu_title'    => "Global Author's Advertisement",
		'parent_slug'   => 'theme-general-settings',
	));
}



add_filter('manage_post_posts_columns', 'posts_columns_id', 99);
add_action('manage_post_posts_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults)
{
	$defaults['wps_post_id'] = __('Article ID');
	return $defaults;
}
function posts_custom_id_columns($column_name, $id)
{
	if ($column_name === 'wps_post_id') {
		echo $id;
	}
}


function revcon_change_post_label()
{
	global $menu;
	global $submenu;
	$menu[5][0] = 'Articles';
	$submenu['edit.php'][5][0] = 'Article';
	$submenu['edit.php'][10][0] = 'Add Article';
	$submenu['edit.php'][16][0] = 'Article Tags';
}
function revcon_change_post_object()
{
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Articles';
	$labels->singular_name = 'Article';
	$labels->add_new = 'Add Article';
	$labels->add_new_item = 'Add Article';
	$labels->edit_item = 'Edit Article';
	$labels->new_item = 'Article';
	$labels->view_item = 'View Article';
	$labels->search_items = 'Search Articles';
	$labels->not_found = 'No Articles found';
	$labels->not_found_in_trash = 'No Articles found in Trash';
	$labels->all_items = 'All Articles';
	$labels->menu_name = 'Articles';
	$labels->name_admin_bar = 'Articles';
}
add_action('admin_menu', 'revcon_change_post_label');
add_action('init', 'revcon_change_post_object');


function remove_vc_column_text_shortcode($content)
{
	// Remove the opening and closing [vc_column_text] shortcode tags
	$content = str_replace(array('[vc_row]', '[vc_column]', '[vc_column_text]', '[/vc_row]', '[/vc_column]', '[/vc_column_text]'), '', $content);
	return $content;
}
add_filter('the_content', 'remove_vc_column_text_shortcode');

function load_more_posts()
{
	$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
	$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
	$is_author_page = isset($_POST['is_author_page']) && $_POST['is_author_page'] === 'true';
	$author_id = isset($_POST['author_id']) ? intval($_POST['author_id']) : 0;

	// Check if it's the author page to adjust query arguments
	$query_args = [
		'posts_per_page' => 6,
		'offset' => $offset,
	];

	if ($is_author_page) {
		$query_args['author'] = $author_id;
	} else {
		$query_args['cat'] = $category_id;
	}

	$latest_posts = new WP_Query($query_args);

	if ($latest_posts->have_posts()) :
		while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
			<div class="category_box featured_tab flex_col_20">
				<div class="featured_img animated_img flex_open post_ninty_seven">
					<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('full'); ?>
						<?php endif; ?>
					</a>
				</div>
				<div class="featured_content flex_col_20">
					<div class="banner_content_title_img_content twelve_p fourteen_p">

						<div class="banner_top_img ">
							<a href="<?php echo get_author_posts_url($author_id); ?>">
								<?php
								// Get the author's ID
								$author_id = get_the_author_meta('ID');

								// Display the author's avatar
								echo get_avatar($author_id, 34); // 64 is the size of the avatar image
								?>

								<?php the_author(); ?>
							</a>
						</div>
						<div class="small_intro">
							<ul>
								<?php
								$categories = get_the_category();
								if (!empty($categories)) {
									foreach ($categories as $category) {
										echo '<li>' . esc_html($category->name) . '</li>';
									}
								}
								?>
							</ul>
						</div>

					</div>
					<div class="banner_content_center textoverflow">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
						<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
					</div>
					<div class="read_more hover_yellow">
						<a href="<?php the_permalink(); ?>">Read More
							<div class="yellow_aero">
								<svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
									<path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
	<?php endwhile;
	endif;

	wp_reset_postdata();
	die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


// Include Custom Auth Functions
// require_once get_template_directory() . '/custom-auth/custom-auth-functions.php';
require_once get_template_directory() . '/custom-auth/custom-user-registration.php';
require_once get_template_directory() . '/custom-auth/custom-user-forgot.php';
require_once get_template_directory() . '/custom-auth/custom-user-login.php';
require_once get_template_directory() . '/custom-auth/custom-user-reset.php';


// Register Shortcodes for Authentication Forms
function register_custom_auth_shortcodes()
{
	add_shortcode('custom_register_form', 'custom_register_form');
	add_shortcode('custom_login_form', 'custom_login_form');
	add_shortcode('custom_forgot_password_form', 'custom_forgot_password_form');
	add_shortcode('custom_reset_password_form', 'custom_reset_password_form');
}
add_action('init', 'register_custom_auth_shortcodes');


function custom_password_validation_script_inline()
{ ?>
	<script>
		jQuery(document).ready(function($) {

			// Restrict input in First Name and Last Name fields
			$('#first_name, #last_name').on('input', function() {
				// Allow only letters (lowercase and uppercase) and prevent numbers and special characters
				var value = $(this).val();
				var newValue = value.replace(/[^a-zA-Z]/g, ''); // Replace anything that's not a letter
				$(this).val(newValue); // Update the field with the new value
			});

			// Username validation on blur
			$('#username').on('blur', function() {
				var username = $(this).val();
				var usernamePattern = /^[a-zA-Z][a-zA-Z0-9_]{2,23}[a-zA-Z0-9]$/;

				// Validate username format
				if (username && !usernamePattern.test(username)) {
					$('#username-error').show(); // Show error message if username is invalid
				} else {
					$('#username-error').hide(); // Hide error message if username is valid
				}
			});

			// Show requirements when the password field is focused
			$('#password').on('focus', function() {
				$('.password-requirements').slideDown(); // Show requirements
			});

			// Hide requirements on blur if all conditions are met or if field is empty
			$(document).on('click', function(e) {
				if (!$(e.target).closest('#password').length && !$(e.target).closest('.password-requirements').length) {
					var password = $('#password').val();
					var hasLowercase = /[a-z]/.test(password);
					var hasUppercase = /[A-Z]/.test(password);
					var hasNumber = /[0-9]/.test(password);
					var hasMinLength = password.length >= 8;

					// Check if all requirements are met or if the field is empty
					if (hasLowercase && hasUppercase && hasNumber && hasMinLength || password === '') {
						$('.password-requirements').slideUp(); // Hide requirements
					}
				}
			});

			// Real-time password validation
			$('#password').on('input', function() {
				var password = $(this).val();

				// Requirement checks
				var hasLowercase = /[a-z]/.test(password);
				var hasUppercase = /[A-Z]/.test(password);
				var hasNumber = /[0-9]/.test(password);
				var hasMinLength = password.length >= 8;

				// Update each requirement based on validation
				updateRequirement('.lowercase', hasLowercase);
				updateRequirement('.uppercase', hasUppercase);
				updateRequirement('.number', hasNumber);
				updateRequirement('.length', hasMinLength);
			});

			// Retype Password validation on blur
			$('#confirm_password').on('blur', function() {
				var password = $('#password').val();
				var confirmPassword = $(this).val();

				// Check if passwords match
				if (password !== confirmPassword) {
					$('#confirm-password-error').show(); // Show error if passwords do not match
				} else {
					$('#confirm-password-error').hide(); // Hide error if passwords match
				}
			});

			// Email validation on blur
			$('#email').on('blur', function() {
				var email = $(this).val();
				var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

				// Validate email format
				if (email && !emailPattern.test(email)) {
					$('#email-error').show(); // Show error message if email is invalid
				} else {
					$('#email-error').hide(); // Hide error message if email is valid
				}
			});

			// Function to update requirement styling and icon
			function updateRequirement(selector, isValid) {
				var $requirement = $(selector);
				if (isValid) {
					$requirement.addClass('valid').removeClass('invalid');
					$requirement.find('.icon').text('✔️'); // Change to check icon
				} else {
					$requirement.removeClass('valid').addClass('invalid');
					$requirement.find('.icon').text('❌'); // Change to X icon
				}
			}
		});
	</script>
<?php }
add_action('wp_footer', 'custom_password_validation_script_inline');

function custom_enqueue_scripts()
{
	wp_enqueue_script('custom-validation', get_template_directory_uri() . '/js/custom-validation.js', array('jquery'), null, true);
	wp_localize_script('custom-validation', 'ajax_object', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

// Check if email already exists
function check_email_exists()
{
	if (isset($_POST['email']) && is_email($_POST['email'])) {
		$email = sanitize_email($_POST['email']);
		if (email_exists($email)) {
			echo 'exists';
		} else {
			echo 'not_exists';
		}
	}
	wp_die(); // Close the connection properly
}
add_action('wp_ajax_check_email_exists', 'check_email_exists');
add_action('wp_ajax_nopriv_check_email_exists', 'check_email_exists');

// Check if username already exists
function check_username_exists()
{
	if (isset($_POST['username'])) {
		$username = sanitize_user($_POST['username']);
		if (username_exists($username)) {
			echo 'exists';
		} else {
			echo 'not_exists';
		}
	}
	wp_die(); // Close the connection properly
}
add_action('wp_ajax_check_username_exists', 'check_username_exists');
add_action('wp_ajax_nopriv_check_username_exists', 'check_username_exists');



//AJAX handler for user registration
function ajax_register_user()
{

	
	
	// Security: Check honeypot
	if (!empty($_POST['honeypot'])) {
		wp_send_json_error(['message' => 'Bot detected!']);
	}

	// Sanitize form inputs
	$first_name = sanitize_text_field($_POST['first_name']);
	$designation = sanitize_text_field($_POST['designation']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$email = sanitize_email($_POST['email']);
	$username = sanitize_user($_POST['username']);
	$password = trim($_POST['password']);
	$confirm_password = $_POST['confirm_password'];

	// Additional fields for institution
	$represent_institution = isset($_POST['institution']);
	$institution_name = $represent_institution ? sanitize_text_field($_POST['institution_name']) : '';

	// Check if passwords match
	if ($password !== $confirm_password) {
		wp_send_json_error(['message' => 'Passwords do not match. Please ensure that both password fields are identical.']);
	}




	// Validate password strength
	if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
		wp_send_json_error(['message' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and be at least 8 characters long.']);
	}




	// Check if username or email already exists
	if (username_exists($username) || email_exists($email)) {
		wp_send_json_error(['message' => 'Username or email already exists.']);
	}

	// Create the user
	$user_id = wp_create_user($username, $password, $email);
	if (is_wp_error($user_id)) {
		wp_send_json_error(['message' => $user_id->get_error_message()]);
	}

	// Update core user fields
	wp_update_user([
		'ID' => $user_id,
		'first_name' => $first_name,
		'last_name' => $last_name,
	]);

	// Update custom user meta
	update_user_meta($user_id, 'designation', $designation);
	update_user_meta($user_id, 'institution', $represent_institution);
	if ($represent_institution) {
		update_user_meta($user_id, 'institution_name', $institution_name);
	}



	// Set user role
	$user = new WP_User($user_id);
	$user->set_role('subscriber');


	// Send success response with redirect URL
	wp_send_json_success(['redirect_url' => home_url('/user_login')]);

	wp_die();
}
add_action('wp_ajax_register_user', 'ajax_register_user');
add_action('wp_ajax_nopriv_register_user', 'ajax_register_user');
