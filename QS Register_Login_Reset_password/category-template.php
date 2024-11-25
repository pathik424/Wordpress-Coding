<?php

//Template Name: Category Page

get_header();

// Get Current Category ID
$category_id = get_queried_object_id();

// Check if ACF 'category_banner_slide' has value
echo $has_banner_slide = have_rows('category_banner_slide', 'category_' . $category_id);
?>

<section class="inner_banner_otr category_banner ">
    <div class="container">
        <div class="inner_banner_main">
            <div class="title_top_inner_banner title_btn">
                <h1 class="title_h1"><?php echo get_field('category_title_main', 'category_' . $category_id); ?></h1>
                <?php
                $category_title_btn = get_field('category_title_btn', 'category_' . $category_id);
                if ($category_title_btn):
                    $category_title_btn_url = $category_title_btn['url'];
                    $category_title_btn_title = $category_title_btn['title'];
                    $category_title_btn_target = $category_title_btn['target'] ? $category_title_btn['target'] : '_self';
                ?>
                    <a class="a_btn" href="<?php echo esc_url($category_title_btn_url); ?>" target="<?php echo esc_attr($category_title_btn_target); ?>"><?php echo esc_html($category_title_btn_title); ?></a>
                <?php endif; ?>
            </div>
            <div class="inner_banner_btm">
                <div class="category_btm_otr">
                    <div class="only_latest_category">
                        <div class="hero_banner_slides">
                            <?php
                            // Get the latest post from the current category
                            $latest_post = new WP_Query([
                                'posts_per_page' => 1, // Only one post
                                'cat' => get_queried_object_id(), // Get current category ID
                            ]);

                            if ($latest_post->have_posts()) :
                                while ($latest_post->have_posts()) : $latest_post->the_post(); ?>
                                    <div class="hero_banner_img animated_img flex_open banner_flex_img">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full'); ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="hero_banner_slides_content flex_col_20">
                                        <div class="banner_content_title_img_content fourteen_p">
                                            
                                                <div class="banner_top_img ">
                                                <?php 
                                                     // Get the author's ID
                                                     $author_id = get_the_author_meta('ID');
                                                    ?>
                                                    <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                        <?php
                                                        // Display the author's avatar
                                                        echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                                        ?>

                                                        <?php the_author(); ?>
                                                    </a>
                                                </div>

                                                <div class="small_intro">
                                                    <ul>
                                                        <?php
                                                        // Get the categories of the post
                                                        $categories = get_the_category();

                                                        // Loop through each category and display it in its own <li>
                                                        if (!empty($categories)) {
                                                            foreach ($categories as $category) {
                                                                echo '<li>' . esc_html($category->name) . '</li>';
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                          
                                        </div>
                                        <div class="banner_content_center">
                                            <a href="<?php the_permalink(); ?>">
                                                <h3><?php the_title(); ?></h3>
                                            </a>
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
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
                            <?php endwhile;
                            endif;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="multiple_category">
                        <?php
                        $posts_to_display = $has_banner_slide ? 5 : 6;

                        // Get the latest posts from the current category, excluding the first one
                        $latest_posts = new WP_Query([
                            'posts_per_page' => $posts_to_display,
                            'offset' => 1, // Skip the first post
                            'cat' => get_queried_object_id(), // Get current category ID
                            'post_status' => 'publish',
                        ]);

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
                                                    <?php 
                                                     // Get the author's ID
                                                     $author_id = get_the_author_meta('ID');
                                                    ?>
                                                    <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                        <?php
                                                       

                                                        // Display the author's avatar
                                                        echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                                        ?>

                                                        <?php the_author(); ?>
                                                    </a>
                                                </div>
                                                <div class="small_intro">
                                                    <ul>
                                                        <?php
                                                        // Get the categories of the post
                                                        $categories = get_the_category();

                                                        // Loop through each category and display it in its own <li>
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
                        wp_reset_postdata(); ?>

                        <?php
                        $category_id = get_queried_object_id(); // Get the current category ID
                        if (have_rows('category_banner_slide', 'category_' . $category_id)) : ?>
                            <!-- Display the advertisement section if ACF has values -->
                            <div class="category_box category_advertise_box">
                                <div class="category_advertise_box_otr swiper mySwiper">
                                    <div class="category_advertise_box_main swiper-wrapper">
                                        <?php while (have_rows('category_banner_slide', 'category_' . $category_id)): the_row();
                                            $image = get_sub_field('category_banner_slider_img', 'category_' . $category_id);
                                            $ad_image_url = get_sub_field('new_custom_advertisement', 'category_' . $category_id);

                                            // $link_url = $link['url'];
                                            // $link_target = isset($link['target']) ? $link['target'] : '_self'; // Optional: Handle link target
                                        ?>
                                            <div class="most_read_adv_slide swiper-slide">

                                                <a href="<?php echo $ad_image_url; ?>">

                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                                </a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="category_most_read ">
    <div class="container">
        <div class="category_most_read_main">
            <div class="category_title title_btn">
                <h1 class="title_h1"><?php echo get_field('most_read_title_main', 'category_' . $category_id); ?></h1>
                <?php
                $category_title_btn = get_field('category_title_btn', 'category_' . $category_id);
                if ($category_title_btn):
                    $category_title_btn_url = $category_title_btn['url'];
                    $category_title_btn_title = $category_title_btn['title'];
                    $category_title_btn_target = $category_title_btn['target'] ? $category_title_btn['target'] : '_self';
                ?>
                    <a class="a_btn" href="<?php echo esc_url($category_title_btn_url); ?>" target="<?php echo esc_attr($category_title_btn_target); ?>"><?php echo esc_html($category_title_btn_title); ?></a>
                <?php endif; ?>
            </div>

            <div class="tabbing_content_box">
                <?php
                // Query for top 3 most read posts in the current category
                $top_posts = new WP_Query([
                    'posts_per_page' => 3,
                    'cat' => get_queried_object_id(), // Get current category ID
                    'meta_key' => 'post_views_count', // Assuming you track views with a meta key
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'post_status' => 'publish',
                ]);

                if ($top_posts->have_posts()) :
                    // Get the first post for the left side content
                    $top_posts->the_post();
                ?>
                    <!-- Left Side Content (First Post) -->
                    <div class="left_side_content animated_img post_thirty_four flex_open">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php endif; ?>
                        </a>
                        <div class="left_img_text">
                            <div class="banner_content_title_img_content fourteen_p twelve_p">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="banner_top_img">
                                        <?php
                                        // Get the author's ID
                                        $author_id = get_the_author_meta('ID');

                                        // Display the author's avatar
                                        echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                        ?>
                                        <p><?php the_author(); ?></p>
                                    </div>
                                    <div class="small_intro">
                                        <ul>
                                            <?php
                                            // Get the categories of the post
                                            $categories = get_the_category();

                                            // Loop through each category and display it in its own <li>
                                            if (!empty($categories)) {
                                                foreach ($categories as $category) {
                                                    echo '<li>' . esc_html($category->name) . '</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div class="left_content_btm">
                                <div class="banner_content_center">
                                    <div class="left_content_btm_title">
                                        <a href="<?php the_permalink(); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                    </div>
                                    <div class="left_btm_content_text textoverflow">
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
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
                        </div>
                    </div>

                    <!-- Right Side Content (Next Two Posts) -->
                    <div class="right_side_content">
                        <?php while ($top_posts->have_posts()) : $top_posts->the_post(); ?>
                            <div class="right_content_box">
                                <div class="right_content_title">
                                    <div class="banner_content_title_img_content fourteen_p twelve_p">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="banner_top_img">
                                                <?php
                                                // Get the author's ID
                                                $author_id = get_the_author_meta('ID');

                                                // Display the author's avatar
                                                echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                                ?>
                                                <p><?php the_author(); ?></p>
                                            </div>
                                            <div class="small_intro">
                                                <ul>
                                                    <?php
                                                    // Get the categories of the post
                                                    $categories = get_the_category();

                                                    // Loop through each category and display it in its own <li>
                                                    if (!empty($categories)) {
                                                        foreach ($categories as $category) {
                                                            echo '<li>' . esc_html($category->name) . '</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="right_content_img_text">
                                    <div class="right_content_img animated_img post_zero_four flex_open">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full'); ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="right_content_text">
                                        <a href="<?php the_permalink(); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                        <div class="right_content_text_btn textoverflow">
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="yellow_aero">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                                                    <path d="M0.84001 5.84004H7.14001L5.22001 7.76004C4.89001 8.09004 4.89001 8.62004 5.22001 8.95004C5.55001 9.28004 6.08001 9.28004 6.41001 8.95004L9.77001 5.59004C10.1 5.26004 10.1 4.73004 9.77001 4.40004L6.41001 1.04004C6.25001 0.880039 6.03001 0.790039 5.82001 0.790039C5.61001 0.790039 5.39001 0.870039 5.23001 1.04004C4.90001 1.37004 4.90001 1.90004 5.23001 2.23004L7.15001 4.15004H0.85001C0.39001 4.15004 0.0100098 4.53004 0.0100098 4.99004C0.0100098 5.45004 0.39001 5.83004 0.85001 5.83004L0.84001 5.84004Z" fill="#1D1D1B" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>


<section class="all_post_top">
    <div class="container">
        <div class="all_post_top_main">
            <div class="multiple_category">
                <?php

                $offset = $has_banner_slide ? 6 : 7;
                $posts_to_display = 6;


                $latest_posts = new WP_Query([
                    'posts_per_page' => $posts_to_display,
                    'offset' => $offset,
                    'cat' => $category_id,
                    'post_status' => 'publish',
                ]);

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
                                            <?php
                                            // Get the author's ID
                                            $author_id = get_the_author_meta('ID');

                                            // Display the author's avatar
                                            echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                            ?>
                                            <p><?php the_author(); ?></p>
                                        </div>
                                        <div class="small_intro">
                                            <ul>
                                                <?php
                                                // Get the categories of the post
                                                $categories = get_the_category();

                                                // Loop through each category and display it in its own <li>
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
                <?php
                    endwhile;
                endif;

                // Reset post data
                wp_reset_postdata();
                ?>

            </div>
        </div>
    </div>
</section>

<section class="extra_space_otr category_space_otr">
    <div class="container">
        <div class="extra_space">
            <div class="region_advertise">
                <?php
                $category_extra_ad_link = get_field('category_extra_ad_link', 'category_' . $category_id);
                $category_extra_ad_img = get_field('category_extra_ad_img', 'category_' . $category_id);

                // Check if the link and image exist
                if (!empty($category_extra_ad_link) && !empty($category_extra_ad_img['url'])) :
                ?>
                    <div class="header_top_slide swiper-slide">
                        <a target="_blank" href="<?php echo esc_url($category_extra_ad_link); ?>">
                            <img src="<?php echo esc_url($category_extra_ad_img['url']); ?>" alt="<?php echo esc_attr($category_extra_ad_img['alt']); ?>">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php
// Get the total number of published posts for the current category
$category_id = get_queried_object_id();
$total_published_posts = (new WP_Query([
    'posts_per_page' => -1,
    'cat' => $category_id,
    'post_status' => 'publish', // Only count published posts
]))->found_posts;
?>

<section class="all_post_btm post_cat_pagintion">
    <div class="container">
        <div class="all_post_btm_main">
            <div class="multiple_category">
                <?php
                // Get total published posts for this category
                $category_id = get_queried_object_id(); // Get current category ID
                $total_published_posts_query = new WP_Query([
                    'cat' => $category_id,
                    'post_status' => 'publish',
                    'posts_per_page' => -1 // Fetch all published posts in this category
                ]);
                $total_published_posts = $total_published_posts_query->found_posts;

                // Initial offset logic based on whether the banner slide exists
                $offset = $has_banner_slide ? 12 : 13;
                $posts_to_display = 6;

                // Fetch the initial set of posts with the offset
                $latest_posts = new WP_Query([
                    'posts_per_page' => $posts_to_display,
                    'offset' => $offset,
                    'cat' => $category_id,
                    'post_status' => 'publish',
                ]);

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
                                            <?php
                                            // Get the author's ID
                                            $author_id = get_the_author_meta('ID');

                                            // Display the author's avatar
                                            echo get_avatar($author_id, 34); // 64 is the size of the avatar image
                                            ?>
                                            <p><?php the_author(); ?></p>
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
                <?php
                    endwhile;
                endif;

                // Set the new offset for the "Load More" button
                $new_offset = $has_banner_slide ? 18 : 19;
                ?>
            </div>

            <!-- Display post count -->
            <div id="post-count-main">
                <div id="post-count">
                    <p>1 - <?php echo min($new_offset, $total_published_posts); ?> of <?php echo $total_published_posts; ?> results</p>
                </div>

                <!-- Load More Button -->
                <div class="load-more-wrapper">
                    <div class="progress-bar_otr">
                        <div id="progress-bar" style="width: 0%; background-color: #F7A70D; height: 100%; border-radius: 4px;"></div>
                    </div>
                    <button id="load-more" data-offset="<?php echo $new_offset; ?>" data-max-posts="<?php echo $total_published_posts; ?>">Load More</button>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="qs_stories category">
    <div class="container">
        <div class="qs_stories_main">
            <h2 class="title_h2">
                <?php echo get_field('qs_stories_title', 'option'); ?>
            </h2>
            <p>
                <?php echo get_field('qs_stories_description', 'option'); ?>
            </p>
            <?php
            $qs_stories_btn = get_field('qs_stories_btn', 'option');
            if ($qs_stories_btn):
                $qs_stories_btn_url = $qs_stories_btn['url'];
                $qs_stories_btn_title = $qs_stories_btn['title'];
                $qs_stories_btn_target = $qs_stories_btn['target'] ? $qs_stories_btn['target'] : '_self';
            ?>
                <a class="btn black_btn" href="<?php echo esc_url($qs_stories_btn_url); ?>" target="<?php echo esc_attr($qs_stories_btn_target); ?>">
                    <?php echo esc_html($qs_stories_btn_title); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>





<?php
get_footer();
?>