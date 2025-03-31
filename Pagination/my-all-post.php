<?php
// Template Name: My All Post

get_header(); 

// Get current user ID
$current_user_id = get_current_user_id();

if ($current_user_id) :

    // Get the current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Query for published and pending posts with pagination
    $published_args = array(
        'author' => $current_user_id,
        'post_type' => 'post',
        'post_status' => array('publish', 'pending', 'draft'),
        'posts_per_page' => 10, // Posts per page
        'paged' => $paged, // Current page
    );

    $user_posts_query = new WP_Query($published_args);
?>
    <!-- Display Published and Pending Posts -->
    <div class="post-section">
        <h2>My Posts</h2>
        <?php if ($user_posts_query->have_posts()) : ?>
            <div class="post-list">
                <?php while ($user_posts_query->have_posts()) : $user_posts_query->the_post(); ?>
                    <div class="user-post">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><strong>Created On:</strong> <?php echo get_the_date(); ?></p>
                        <p><strong>Status:</strong> <?php echo ucfirst(get_post_status()); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $user_posts_query->max_num_pages,
                    'current' => $paged,
                    'format' => '?paged=%#%',
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                ));
                ?>
            </div>
        <?php else : ?>
            <p>No posts found.</p>
            <!-- Redirect button when no posts are available -->
            <a href="<?php echo home_url('/add-post'); ?>" class="button">Add New Post</a>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
<?php else : ?>
    <p>Please log in to view your posts.</p>
<?php endif; ?>

<?php get_footer(); ?>



<style>

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a, .pagination span {
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    color: #333;
    text-decoration: none;
}

.pagination .current {
    background-color: #333;
    color: #fff;
    border-color: #333;
}

    /* Dashboard Container */
.dashboard-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

/* Dashboard Header */
.dashboard-header {
    text-align: center;
    margin-bottom: 20px;
}

.dashboard-header h1 {
    font-size: 2em;
    color: #333;
}

.total-posts {
    font-size: 1.2em;
    color: #777;
}

/* Post Sections */
.post-section, .draft-section {
    margin-bottom: 30px;
}

.post-section h2, .draft-section h2 {
    font-size: 1.5em;
    color: #333;
    margin-bottom: 10px;
}

/* Post List */
.post-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.user-post {
    width: 100%;
    max-width: 45%;
    background-color: #fff;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.user-post h3 {
    font-size: 1.2em;
    color: #0073aa;
}

.user-post h3 a {
    color: inherit;
    text-decoration: none;
}

.user-post p {
    font-size: 0.9em;
    color: #555;
}

.user-post a:hover {
    text-decoration: underline;
}


/* Button Style */
.button {
    padding: 10px 20px; /* Add padding inside the button */
    background-color: #0073e6; /* Button background color */
    color: white; /* Text color */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    display: inline-block; /* Display inline-block to maintain the button-like behavior */
    font-size: 16px; /* Adjust font size */
    font-weight: bold; /* Make text bold */
    text-align: center; /* Center-align the text inside the button */
    transition: background-color 0.3s ease; /* Add a smooth transition on hover */
    margin-top: 20px; /* Add some space above the button */
}

/* Hover Effect */
.button:hover {
    background-color: #005bb5; /* Darken the background color when hovered */
    cursor: pointer; /* Change cursor to indicate interactivity */
}

/* Optional: Add active state for when the button is clicked */
.button:active {
    background-color: #004080; /* Even darker background on click */
}

</style>