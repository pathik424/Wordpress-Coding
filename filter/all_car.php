<?php
/*
 * Template name: All Car
 */

get_header(); ?>

<div class="all-car-wrapper">
    <h1 class="all-car-title">All Cars</h1>

    <div class="car-filter">
        <label for="car-sort">Sort By:</label>
        <select id="car-sort">
            <option value="most_recent">Most Recent</option>
            <option value="price_high_low">Price: High to Low</option>
            <option value="price_low_high">Price: Low to High</option>
            <option value="oldest">Oldest to Newest</option>
            <option value="newest">Newest to Oldest</option>
        </select>
    </div>

    <div class="all-car-posts" id="car-posts-container">
        <?php
        // Default query to display all posts
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1, // Fetch all posts
            'orderby' => 'date',
            'order' => 'DESC', // Show most recent posts first by default
        );
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
            ?>
            <p class="no-posts">No posts found.</p>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>

<style>
    .car-filter {
    margin-bottom: 20px;
}

.car-filter select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.all-car-posts {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.car-post {
    width: calc(33.333% - 20px);
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.car-post-link {
    text-decoration: none;
    color: #333;
    display: block;
}

.car-post-image img {
    width: 100%;
    height: auto;
}

.car-post-content {
    padding: 15px;
}

.car-post-title {
    font-size: 1.2em;
    margin: 0 0 10px;
    font-weight: bold;
}

.post-price {
    color: #007BFF;
    font-weight: bold;
}

</style>