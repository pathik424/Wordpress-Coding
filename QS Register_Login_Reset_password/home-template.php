<?php
//Template Name: Home Page

get_header();
?>
<?php
$site_url_main = get_site_url();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>

    <section class="hero_banner">
        <div class="container">
            <div class="hero_banner_main_swipper swiper mySwiper">
                <div class="hero_banner_slides_otr swiper-wrapper">
                    <?php
                    $home_page_banner_slider = get_field('banner_slider_articles');

                    if ($home_page_banner_slider) {
                        foreach ($home_page_banner_slider as $post) {
                    ?>
                            <div class="hero_banner_slides swiper-slide">
                                <?php
                                // Setup post data
                                setup_postdata($post);

                                // Get post author
                                $post_author_id = $post->post_author;
                                $post_author = get_the_author_meta('display_name', $post_author_id);

                                // Get post author avatar
                                $author_avatar = get_avatar_url($post_author_id, ['size' => 34]); // 34px avatar size

                                // Get post title
                                $post_title = get_the_title($post->ID);

                                // Get post URL
                                $post_url = get_permalink($post->ID);

                                // Get post categories
                                $post_categories = get_the_category($post->ID);
                                $category_list = [];
                                if (! empty($post_categories)) {
                                    foreach ($post_categories as $category) {
                                        $category_list[] = $category->name;
                                    }
                                }

                                // Get post featured image URL
                                $post_image_url = get_the_post_thumbnail_url($post->ID, 'full');
                                if (!$post_image_url) {
                                    $post_image_url = 'default-image-url.jpg'; // Fallback image URL in case no featured image is set
                                }

                                // Get post excerpt or content and limit to 200 words
                                $post_content = wp_strip_all_tags(get_the_excerpt($post->ID) ? get_the_excerpt($post->ID) : get_the_content($post->ID));
                                $trimmed_content = wp_trim_words($post_content, 200, '<a href="' . $post_url . '"> Read More</a>'); // Replacing "..." with "Read More" and link to the post
                                ?>
                                <div class="hero_banner_img animated_img">
                                    <img src="<?php echo $post_image_url; ?>" alt="<?php echo $post_title; ?>">
                                </div>
                                <div class="hero_banner_slides_content flex_col_20">
                                    <div class="banner_content_title_img_content fourteen_p">
                                        <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                            <div class="banner_top_img ">
                                                <img src="<?php echo $author_avatar; ?>" alt="Author Avatar">
                                                <p><?php echo $post_author; ?></p>
                                            </div>
                                        </a>
                                        <div class=small_intro>
                                            <ul>
                                                <li><?php echo implode(', ', $category_list); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="banner_content_center">
                                        <h3><?php echo $post_title; ?></h3>
                                        <p><?php echo $trimmed_content; ?></p>
                                    </div>
                                    <div class="read_more hover_yellow">
                                        <a href="<?php echo $post_url; ?>">Read More
                                            <div class="yellow_aero">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10"
                                                    viewBox="0 0 11 10" fill="none">
                                                    <path
                                                        d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z"
                                                        fill="#1D1D1B" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }

                        // Reset post data after loop
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <div class="swiper-pagination banner_pagination"></div>
            </div>
        </div>
    </section>

    <section class="trending_now">
        <div class="container">
            <div class="trending_main">
                <div class="trending_main_title">
                    <div class="title_left">
                        <h1 class="title_h1"><?php echo get_field('spotlight_stories_section_title'); ?></h1>
                        <div class="featured_slides_pagination trending_tab_pagination">
                            <div class="swiper_pag_aero swiper-button-prev left_aero">
                                <img src="<?php echo $site_url_main; ?>/wp-content/uploads/2024/10/left_aero.svg" alt="">
                            </div>
                            <div class="swiper_pag_aero swiper-button-next right_aero">
                                <img src="<?php echo $site_url_main; ?>/wp-content/uploads/2024/10/right_aero.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="view_all">
                        <a href="#" class="btn black_btn">View all</a>
                    </div>
                </div>
                <div class="trending_content_otr  swiper mySwiper mobile_swiper">
                    <div class="trending_content_main ">
                        <?php
                        $spotlight_stories = get_field('select_spotlight_stories');

                        if ($spotlight_stories) {
                            foreach ($spotlight_stories as $post) {
                        ?>
                                <div class="trending_tab flex_col_20 swiper-slide">
                                    <?php
                                    // Setup post data
                                    setup_postdata($post);

                                    // Get post title
                                    $post_title = get_the_title($post->ID);

                                    // Get post URL
                                    $post_url = get_permalink($post->ID);

                                    // Get post categories
                                    $post_categories = get_the_category($post->ID);
                                    $category_list = '';
                                    if (! empty($post_categories)) {
                                        $category_list .= '<ul>';
                                        foreach ($post_categories as $category) {
                                            $category_list .= '<li>' . $category->name . '</li>';
                                        }
                                        $category_list .= '</ul>';
                                    }

                                    // Get post author details
                                    $post_author_id = $post->post_author;
                                    $author_name = get_the_author_meta('display_name', $post_author_id); // Author name
                                    $author_avatar = get_avatar_url($post_author_id, ['size' => 34]); // 34px avatar size

                                    // Get post excerpt or content and limit to 100 words
                                    $post_content = wp_strip_all_tags(get_the_excerpt($post->ID) ? get_the_excerpt($post->ID) : get_the_content($post->ID));
                                    $trimmed_content = wp_trim_words($post_content, 100, '<a href="' . $post_url . '"> Read More</a>');

                                    ?>
                                    <div class="banner_content_title_img_content twelve_p fourteen_p">
                                        <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                            <div class="banner_top_img ">
                                                <img src="<?php echo $author_avatar; ?>" alt="">
                                                <p><?php echo $author_name; ?></p>
                                            </div>
                                        </a>
                                        <div class=small_intro>

                                            <?php echo $category_list; ?>

                                        </div>
                                    </div>
                                    <div class="banner_content_center textoverflow">
                                        <h3><?php echo $post_title; ?></h3>
                                        <p><?php echo $trimmed_content; ?></p>
                                    </div>
                                    <div class="read_more hover_yellow">
                                        <a href="<?php echo $post_url; ?>">Read More
                                            <div class="yellow_aero">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                                                    fill="none">
                                                    <path
                                                        d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z"
                                                        fill="#1D1D1B" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        <?php
                            }

                            // Reset post data after loop
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <div class="mobile_trending_content_main swiper-wrapper">
                        <?php
                        $spotlight_stories = get_field('select_spotlight_stories');

                        if ($spotlight_stories) {
                            $total_posts = count($spotlight_stories);
                            $posts_per_slide = 3; // Number of posts per slide
                            $chunks = array_chunk($spotlight_stories, $posts_per_slide); // Break the posts into chunks of 3

                            foreach ($chunks as $chunk) {
                        ?>
                                <div class="trending_slides swiper-slide">
                                    <?php foreach ($chunk as $post) {
                                        // Setup post data
                                        setup_postdata($post);

                                        // Get post title
                                        $post_title = get_the_title($post->ID);

                                        // Get post URL
                                        $post_url = get_permalink($post->ID);

                                        // Get post categories
                                        $post_categories = get_the_category($post->ID);
                                        $category_list = '';
                                        if (!empty($post_categories)) {
                                            $category_list .= '<ul>';
                                            foreach ($post_categories as $category) {
                                                $category_list .= '<li>' . $category->name . '</li>';
                                            }
                                            $category_list .= '</ul>';
                                        }

                                        // Get post author details
                                        $post_author_id = $post->post_author;
                                        $author_name = get_the_author_meta('display_name', $post_author_id); // Author name
                                        $author_avatar = get_avatar_url($post_author_id, ['size' => 34]); // 34px avatar size

                                        // Get post excerpt or content and limit to 100 words
                                        $post_content = wp_strip_all_tags(get_the_excerpt($post->ID) ? get_the_excerpt($post->ID) : get_the_content($post->ID));
                                        $trimmed_content = wp_trim_words($post_content, 100, '<a href="' . $post_url . '"> Read More</a>');
                                    ?>
                                        <div class="trending_tab flex_col_20">
                                            <a href="<?php echo $post_url; ?>">
                                                <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                    <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                                        <div class="banner_top_img">
                                                            <img src="<?php echo $author_avatar; ?>" alt="">
                                                            <p><?php echo $author_name; ?></p>
                                                        </div>
                                                    </a>
                                                    <div class="small_intro">
                                                        <ul>
                                                            <?php echo $category_list; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="banner_content_center textoverflow">
                                                    <h3><?php echo $post_title; ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php
                            }
                            // Reset post data after loop
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured" id="featured">
        <div class="container">
            <div class="featured_main">
                <div class="featured_top">
                    <div class="featured_left">
                        <div class="featured_title">
                            <div class="featured_title_left">
                                <h1 class="title_h1">Latest</h1>
                                <div class="featured_slides_pagination featured_pag">
                                    <div class="swiper_pag_aero swiper-button-prev left_aero">
                                        <img src="<?php echo $site_url_main; ?>/wp-content/uploads/2024/10/left_aero.svg" alt="">
                                    </div>
                                    <div class="swiper_pag_aero swiper-button-next right_aero">
                                        <img src="<?php echo $site_url_main; ?>/wp-content/uploads/2024/10/right_aero.svg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="view_all">
                                <a href="#" class="btn black_btn">View all</a>
                            </div>
                        </div>
                        <div class="featured_slide_otr featured_slide swiper mySwiper">
                            <div class="featured_slide_main swiper-wrapper">
                                <?php
                                // Define your custom query arguments
                                $args = array(
                                    'post_type'      => 'post', // Change 'post' if you want to fetch a different post type
                                    'posts_per_page' => 10, // Number of posts to display
                                    'orderby'        => 'date', // Order by date
                                    'order'          => 'DESC', // Descending order
                                    'post_status'    => 'publish', // Only show published posts
                                );

                                // Create a new instance of WP_Query
                                $query = new WP_Query($args);

                                // Check if there are posts
                                if ($query->have_posts()) {
                                    $post_count = 0; // Initialize a counter
                                    while ($query->have_posts()) {
                                        $query->the_post(); // Set up post data

                                        // Get the post data
                                        $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Featured image
                                        $author_id = get_the_author_meta('ID'); // Author ID
                                        $author_logo = get_avatar_url($author_id, ['size' => 34]); // Author logo

                                        $author_name = get_the_author(); // Author name
                                        $categories = get_the_category(); // Get categories
                                        $post_categories = !empty($categories) ? wp_list_pluck($categories, 'name') : []; // Extract category names
                                        $post_title = get_the_title(); // Post title
                                        $post_excerpt = get_the_excerpt(); // Short description (excerpt)

                                        // If it's the start of a new row
                                        if ($post_count % 2 === 0) {
                                            echo '<div class="featured_slides swiper-slide">'; // Open a new slide
                                        }
                                ?>
                                        <div class="featured_tab flex_col_20">
                                            <div class="featured_img animated_img">
                                                <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr($post_title); ?>">
                                            </div>
                                            <div class="featured_content flex_col_20">
                                                <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                    <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                        <div class="banner_top_img">
                                                            <img src="<?php echo esc_url($author_logo); ?>" alt="<?php echo esc_attr($author_name); ?>">
                                                            <p><?php echo esc_html($author_name); ?></p>
                                                        </div>
                                                    </a>
                                                    <div class="small_intro">
                                                        <ul>
                                                            <?php foreach ($post_categories as $category) : ?>
                                                                <li><?php echo esc_html($category); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="banner_content_center textoverflow">
                                                    <h3><?php echo esc_html($post_title); ?></h3>
                                                    <p><?php echo esc_html($post_excerpt); ?></p>
                                                </div>
                                                <div class="read_more hover_yellow">
                                                    <a href="<?php echo esc_url(get_permalink()); ?>">Read More
                                                        <div class="yellow_aero">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                                                                <path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $post_count++; // Increment the counter

                                        // If it's the end of the row (after 2 posts), close the slide
                                        if ($post_count % 2 === 0) {
                                            echo '</div>'; // Close the slide
                                        }
                                    }

                                    // Close the last slide if it has an odd number of posts
                                    if ($post_count % 2 !== 0) {
                                        echo '</div>'; // Close the last slide
                                    }

                                    // Reset post data
                                    wp_reset_postdata();
                                } else {
                                    echo 'No posts found. Check if there are published posts in your dashboard.';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="featured_sidebar">
                        <h1 class="title_h1"><?php echo get_field('meg_main_title'); ?> </h1>
                        <div class="featured_side_img">
                            <?php $meg_image = get_field('meg_image');
                            if (!empty($meg_image)): ?>
                                <img src="<?php echo esc_url($meg_image['url']); ?>" alt="<?php echo esc_attr($meg_image['alt']); ?>" />
                            <?php endif; ?>
                            <div class="featured_hover_content">
                                <div class="featured_content_top">
                                    <h3><?php echo get_field('mag_title'); ?> </h3>
                                    <p><?php echo get_field('mag_description'); ?> </p>
                                </div>
                                <div class="featured_btn">
                                    <div class="read_more hover_yellow">
                                        <?php
                                        $button_link = get_field('button_link');
                                        if ($button_link): ?>
                                            <div class="read_more hover_yellow">
                                                <a href="<?php echo esc_url($button_link); ?>">
                                                    Read More
                                                    <div class="yellow_aero">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                                                            <path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="featured_btm">
                    <?php
                    $latest_post_advertise = get_field('latest_post_advertise');
                    $latest_post_advertise_link = get_field('latest_post_advertise_link'); // ACF field for the link
                    if (!empty($latest_post_advertise) && !empty($latest_post_advertise_link)): ?>
                        <a href="<?php echo esc_url($latest_post_advertise_link); ?>" target="_blank">
                            <img src="<?php echo esc_url($latest_post_advertise['url']); ?>" alt="<?php echo esc_attr($latest_post_advertise['alt']); ?>" />
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="qs_stories">
        <div class="container">
            <div class="qs_stories_main">
                <h2 class="title_h2"><?php echo get_field('qs_stories_title'); ?> </h2>
                <p><?php echo get_field('qs_stories_description'); ?> </p>
                <?php
                $button_link = get_field('stories_btn_link');
                $button_text = get_field('stories_btn_text');
                if ($button_link && $button_text): ?>
                    <div class="btn black_btn">
                        <a class="btn black_btn" href="<?php echo esc_url($button_link); ?>">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <section class="tabbing regions" id="regions">
        <div class="container">
            <div class="tabbing_main">
                <div class="tabbing_title">
                    <h1 class="title_h1">Regions</h1>
                    <a href="#" class="btn black_btn">View all</a>
                </div>
                <div class="tabbing_tab_otr">
                    <div class="tabbing_tabs">
                        <ul>
                            <li><a href="#category-153">Global</a></li>
                            <li><a href="#category-56">Asia & Oceania</a></li>
                            <li><a href="#category-57">Europe & Americas</a></li>
                            <li><a href="#category-65">Middle East</a></li>
                        </ul>
                    </div>
                    <div class="tabbing_content_otr">
                        <?php
                        // Define the category IDs
                        $categories = [153, 56, 57, 65];

                        foreach ($categories as $category_id) :
                            // Set up the query for each category
                            $args = array(
                                'cat' => $category_id, // Category ID
                                'posts_per_page' => 3, // Get latest 3 posts
                            );
                            $query = new WP_Query($args);

                            if ($query->have_posts()) : ?>
                                <div id="category-<?php echo $category_id; ?>" class="tabbing_content_box">
                                    <div class="region_left_right_otr">
                                        <?php
                                        // Counter to control which post goes where
                                        $post_counter = 0;
                                        while ($query->have_posts()) : $query->the_post();

                                            // First post goes to the left section
                                            if ($post_counter == 0) : ?>
                                                <div class="region_left">
                                                    <div class="featured_tab flex_col_20">
                                                        <div class="featured_img animated_img">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if (has_post_thumbnail()) : ?>
                                                                    <?php the_post_thumbnail('full'); ?>
                                                                <?php else : ?>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                        <div class="featured_content flex_col_20">
                                                            <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                                <?php $author_id = get_the_author_meta('ID'); ?>
                                                                <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                                    <div class="banner_top_img ">
                                                                        <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), ['size' => 34]); ?>" alt="<?php the_author(); ?>">
                                                                        <p><?php the_author(); ?></p>
                                                                    </div>
                                                                </a>
                                                                <div class="small_intro">
                                                                    <ul>
                                                                        <?php $categories = get_the_category();
                                                                        if ($categories) {
                                                                            foreach ($categories as $cat) {
                                                                                echo '<li>' . $cat->name . '</li>';
                                                                            }
                                                                        } ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="banner_content_center textoverflow">
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            // Posts 2 and 3 go to the right section
                                            if ($post_counter == 1 || $post_counter == 2) : ?>
                                                <?php if ($post_counter == 1) { ?>
                                                    <div class="region_right">
                                                    <?php } ?>
                                                    <div class="featured_tab flex_col_20 flex_row">
                                                        <div class="featured_img animated_img">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if (has_post_thumbnail()) : ?>
                                                                    <?php the_post_thumbnail('full'); ?>
                                                                <?php else : ?>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                        <div class="featured_content flex_col_20">
                                                            <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                                <?php $author_id = get_the_author_meta('ID'); ?>
                                                                <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                                    <div class="banner_top_img ">
                                                                        <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), ['size' => 34]); ?>" alt="<?php the_author(); ?>">
                                                                        <p><?php the_author(); ?></p>
                                                                    </div>
                                                                </a>
                                                                <div class="small_intro">
                                                                    <ul>
                                                                        <?php $categories = get_the_category();
                                                                        if ($categories) {
                                                                            foreach ($categories as $cat) {
                                                                                echo '<li>' . $cat->name . '</li>';
                                                                            }
                                                                        } ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="right_content_text banner_content_center">
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                <div class="right_content_text_btn textoverflow">
                                                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                                                    <a href="<?php the_permalink(); ?>" class="yellow_aero">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10"
                                                                            viewBox="0 0 11 10" fill="none">
                                                                            <path
                                                                                d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z"
                                                                                fill="#1D1D1B" />
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($post_counter == 2) { ?>
                                                    </div>
                                                <?php } ?>
                                            <?php endif; ?>

                                        <?php
                                            $post_counter++;
                                        endwhile; ?>
                                    </div>
                                    <div class="view_all_btn">
                                        <a href="<?php echo get_category_link($category_id); ?>" class="btn black_btn">View All</a>
                                    </div>
                                </div>
                        <?php endif;
                            wp_reset_postdata();
                        endforeach; ?>
                    </div>
                </div>
                <div class="extra_space">
                    <div class="region_advertise">
                        <?php
                        $region_ad_link = get_field('region_ad_link');
                        $region_ad_img = get_field('region_ad_img');

                        // Check if the link and image exist
                        if (!empty($region_ad_link) && !empty($region_ad_img['url'])) :
                        ?>
                            <div class="header_top_slide swiper-slide">
                                <a target="_blank" href="<?php echo esc_url($region_ad_link); ?>">
                                    <img src="<?php echo esc_url($region_ad_img['url']); ?>" alt="<?php echo esc_attr($region_ad_img['alt']); ?>">
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </section>

    <section class="editorials bg_light_black">
        <div class="container">
            <div class="editorials_main">
                <div class="editorials_title">
                    <h1 class="title_h1"><?php echo get_field('editorials_main_title'); ?></h1>
                    <a href="#" class="btn black_btn">View all</a>
                </div>
                <div class="editorials_content">
                    <div class="tabbing_content_box">
                        <?php
                        // Get selected editorial posts from ACF
                        $editorials_selection_articles = get_field('editorials_selection_post');

                        if ($editorials_selection_articles) {
                            // Show the first post on the left side
                            $first_post = $editorials_selection_articles[0]; // First post for the left side
                            setup_postdata($first_post);

                            // Get first post data
                            $post_author_id = $first_post->post_author;
                            $post_author = get_the_author_meta('display_name', $post_author_id);
                            $author_avatar = get_avatar_url($post_author_id, ['size' => 34]);
                            $post_title = get_the_title($first_post->ID);
                            $post_url = get_permalink($first_post->ID);
                            $post_categories = get_the_category($first_post->ID);
                            $category_list = [];
                            if (!empty($post_categories)) {
                                foreach ($post_categories as $category) {
                                    $category_list[] = $category->name;
                                }
                            }
                            $post_image_url = get_the_post_thumbnail_url($first_post->ID, 'full');
                            if (!$post_image_url) {
                                $post_image_url = 'default-image-url.jpg';
                            }
                            $post_content = wp_strip_all_tags(get_the_excerpt($first_post->ID) ? get_the_excerpt($first_post->ID) : get_the_content($first_post->ID));
                            $trimmed_content = wp_trim_words($post_content, 40, '<a href="' . $post_url . '"> Read More</a>');

                            // Output the first post on the left side
                        ?>
                            <div class="left_side_content animated_img">
                                <img src="<?php echo $post_image_url; ?>" alt="<?php echo $post_title; ?>">
                                <div class="left_img_text">
                                    <div class="banner_content_title_img_content fourteen_p twelve_p">
                                        <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                            <div class="banner_top_img">
                                                <img src="<?php echo $author_avatar; ?>" alt="Author Avatar">
                                                <p><?php echo $post_author; ?></p>
                                            </div>
                                        </a>
                                        <div class="small_intro">
                                            <ul>
                                                <li><?php echo implode(', ', $category_list); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="left_content_btm">
                                        <div class="banner_content_center">
                                            <div class="left_content_btm_title">
                                                <h3><?php echo $post_title; ?></h3>
                                            </div>
                                            <div class="left_btm_content_text textoverflow">
                                                <p><?php echo $trimmed_content; ?></p>
                                                <div class="read_more hover_yellow">
                                                    <a href="<?php echo $post_url; ?>">Read More
                                                        <div class="yellow_aero">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                                                                <path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            wp_reset_postdata(); // Restore original post data after displaying the first post

                            // Show the next two posts on the right side
                            ?>
                            <div class="right_side_content">
                                <?php
                                // Loop through the remaining posts starting from index 1
                                $remaining_posts = array_slice($editorials_selection_articles, 1, 2); // Get the next 2 posts
                                foreach ($remaining_posts as $post) {
                                    setup_postdata($post);

                                    // Get post data
                                    $post_author_id = $post->post_author;
                                    $post_author = get_the_author_meta('display_name', $post_author_id);
                                    $author_avatar = get_avatar_url($post_author_id, ['size' => 34]);
                                    $post_title = get_the_title($post->ID);
                                    $post_url = get_permalink($post->ID);
                                    $post_categories = get_the_category($post->ID);
                                    $category_list = [];
                                    if (!empty($post_categories)) {
                                        foreach ($post_categories as $category) {
                                            $category_list[] = $category->name;
                                        }
                                    }
                                    $post_image_url = get_the_post_thumbnail_url($post->ID, 'full');
                                    if (!$post_image_url) {
                                        $post_image_url = 'default-image-url.jpg';
                                    }
                                    $post_content = wp_strip_all_tags(get_the_excerpt($post->ID) ? get_the_excerpt($post->ID) : get_the_content($post->ID));
                                    $trimmed_content = wp_trim_words($post_content, 40, '<a href="' . $post_url . '"> Read More</a>');
                                ?>
                                    <div class="right_content_box">

                                        <div class="right_content_title">
                                            <div class="banner_content_title_img_content fourteen_p twelve_p">
                                                <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                                    <div class="banner_top_img ">
                                                        <img src="<?php echo $author_avatar; ?>" alt="Author Avatar">
                                                        <p><?php echo $post_author; ?></p>
                                                    </div>
                                                </a>
                                                <div class=small_intro>
                                                    <ul>
                                                        <li><?php echo implode(', ', $category_list); ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right_content_img_text">
                                            <div class="right_content_img animated_img">
                                                <img src="<?php echo $post_image_url; ?>" alt="<?php echo $post_title; ?>">
                                            </div>
                                            <div class="right_content_text">
                                                <h3><?php echo $post_title; ?></h3>
                                                <div class="right_content_text_btn textoverflow">
                                                    <p><?php echo $trimmed_content; ?></p>
                                                    <a href="<?php echo $post_url; ?>" class="yellow_aero">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                                                            <path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                }
                                wp_reset_postdata(); // Restore original post data after displaying the remaining posts
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="most_read bg_light_blue">
        <div class="container">
            <div class="most_read_main">
                <div class="most_read_title">
                    <h1 class="title_h1">Most read</h1>
                </div>
                <div class="most_read_content_adv">
                    <div class="most_read_content">
                        <?php
                        // Get selected editorial posts from ACF
                        $editorials_selection_articles = get_field('editorials_selection_post');

                        if ($editorials_selection_articles) {
                            // Show the first post at the top
                            $first_post = $editorials_selection_articles[0]; // First post for the top section
                            setup_postdata($first_post);

                            // Get first post data
                            $post_author_id = $first_post->post_author;
                            $post_author = get_the_author_meta('display_name', $post_author_id);
                            $author_avatar = get_avatar_url($post_author_id, ['size' => 34]);
                            $post_title = get_the_title($first_post->ID);
                            $post_url = get_permalink($first_post->ID);
                            $post_categories = get_the_category($first_post->ID);
                            $category_list = [];
                            if (!empty($post_categories)) {
                                foreach ($post_categories as $category) {
                                    $category_list[] = $category->name;
                                }
                            }
                            $post_image_url = get_the_post_thumbnail_url($first_post->ID, 'full');
                            if (!$post_image_url) {
                                $post_image_url = 'default-image-url.jpg'; // Fallback if no image exists
                            }
                            $post_content = wp_strip_all_tags(get_the_excerpt($first_post->ID) ? get_the_excerpt($first_post->ID) : get_the_content($first_post->ID));
                            $trimmed_content = wp_trim_words($post_content, 40, '<a href="' . $post_url . '"> Read More</a>');

                            // Output the first post on the top
                        ?>
                            <div class="most_read_content_top">
                                <div class="region_right">
                                    <div class="featured_tab flex_col_20 flex_row">
                                        <div class="featured_img animated_img">
                                            <img src="<?php echo esc_url($post_image_url); ?>" alt="">
                                        </div>
                                        <div class="featured_content flex_col_20">
                                            <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                                    <div class="banner_top_img">
                                                        <img src="<?php echo esc_url($author_avatar); ?>" alt="">
                                                        <p><?php echo esc_html($post_author); ?></p>
                                                    </div>
                                                </a>
                                                <div class="small_intro">
                                                    <ul>
                                                        <?php foreach ($category_list as $category_name) : ?>
                                                            <li><?php echo esc_html($category_name); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="right_content_text banner_content_center">
                                                <a href="<?php echo esc_url($post_url); ?>">
                                                    <h3><?php echo esc_html($post_title); ?></h3>
                                                </a>
                                                <div class="right_content_text_btn textoverflow">
                                                    <p><?php echo wp_kses_post($trimmed_content); ?></p>
                                                    <a href="<?php echo esc_url($post_url); ?>" class="yellow_aero">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                                                            fill="none">
                                                            <path
                                                                d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z"
                                                                fill="#1D1D1B" />
                                                        </svg>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                            // Show the second and third posts at the bottom
                            ?>
                            <div class="most_read_content_btm">
                                <?php
                                for ($i = 1; $i <= 2; $i++) { // Loop through the second and third posts
                                    if (isset($editorials_selection_articles[$i])) {
                                        $post = $editorials_selection_articles[$i];
                                        setup_postdata($post);

                                        // Get post data
                                        $post_author_id = $post->post_author;
                                        $post_author = get_the_author_meta('display_name', $post_author_id);
                                        $author_avatar = get_avatar_url($post_author_id, ['size' => 34]);
                                        $post_title = get_the_title($post->ID);
                                        $post_url = get_permalink($post->ID);
                                        $post_categories = get_the_category($post->ID);
                                        $category_list = [];
                                        if (!empty($post_categories)) {
                                            foreach ($post_categories as $category) {
                                                $category_list[] = $category->name;
                                            }
                                        }
                                        $post_content = wp_strip_all_tags(get_the_excerpt($post->ID) ? get_the_excerpt($post->ID) : get_the_content($post->ID));
                                        $trimmed_content = wp_trim_words($post_content, 40, '<a href="' . $post_url . '"> Read More</a>');

                                        // Output the post
                                ?>
                                        <div class="featured_content flex_col_20">
                                            <div class="banner_content_title_img_content twelve_p fourteen_p">
                                                <a href="<?php echo get_author_posts_url($post_author_id); ?>">
                                                    <div class="banner_top_img">
                                                        <img src="<?php echo esc_url($author_avatar); ?>" alt="">
                                                        <p><?php echo esc_html($post_author); ?></p>
                                                    </div>
                                                </a>
                                                <div class="small_intro">
                                                    <ul>
                                                        <?php foreach ($category_list as $category_name) : ?>
                                                            <li><?php echo esc_html($category_name); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="right_content_text banner_content_center">
                                                <a href="<?php echo esc_url($post_url); ?>">
                                                    <h3><?php echo esc_html($post_title); ?></h3>
                                                    <div class="read_more hover_yellow">
                                                        <a href="<?php echo esc_url($post_url); ?>">Read More
                                                            <div class="yellow_aero">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"
                                                                    fill="none">
                                                                    <path
                                                                        d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z"
                                                                        fill="#1D1D1B" />
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php
                            // Reset Post Data
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <div class="most_read_adv_otr">
                        <div class="most_read_adv_slides swiper mySwiper">
                            <?php if (have_rows('most_read_adv_slides')): ?>
                                <div class="most_read_adv_main swiper-wrapper">
                                    <?php while (have_rows('most_read_adv_slides')): the_row();
                                        $image = get_sub_field('image'); // Assuming 'image' is the subfield for the image
                                        $link = get_sub_field('link'); // Assuming 'link' is the subfield for the link
                                    ?>
                                        <div class="most_read_adv_slide swiper-slide">
                                            <a href="<?php echo esc_url($link); ?>">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>

<?php
get_footer();
?>