<?php
// Template Name: Dashboard

// if (!is_user_logged_in()) {
//     wp_redirect(home_url('/user_login'));
//     exit;
// }
get_header(); 

// Get current user ID
$current_user_id = get_current_user_id();

if ($current_user_id) :

    // Query to count posts authored by the current user across all statuses
    $args = array(
        'author' => $current_user_id,
        'post_type' => 'post',  // Use custom post type if needed
        'post_status' => array('publish', 'pending', 'draft'), // Include all post statuses
        'fields' => 'ids', // Only get post IDs for performance
    );

    $user_posts = new WP_Query($args);
    $post_count = $user_posts->found_posts;

    // Query for published and pending posts
    $published_args = array(
        'author' => $current_user_id,
        'post_type' => 'post',
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1, // Get all posts
    );

    $user_posts_query = new WP_Query($published_args);

    // Query for draft posts
    $draft_args = array(
        'author' => $current_user_id,
        'post_type' => 'post',
        'post_status' => 'draft',
        'posts_per_page' => -1, // Get all posts
    );

    $draft_posts_query = new WP_Query($draft_args);

?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome to Your Dashboard</h1>
            <p class="total-posts">You have a total of <strong><?php echo $post_count; ?></strong> posts</p>
            <a href="http://localhost/qs-gen/my-all-post/">View All</a>
        </div>

        <!-- Display Published and Pending Posts -->
        <div class="post-section">
            <h2>My Posts (Published & Pending)</h2>
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
            <?php else : ?>
                               <p>No draft posts found.</p>
        <!-- Redirect button when no draft posts are available -->
        <a href="<?php echo home_url('/add-post'); ?>" class="button">Add New Post</a>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>

        <!-- Display Draft Posts -->
        <div class="draft-section">
            <h2>My Draft Posts</h2>
            <?php if ($draft_posts_query->have_posts()) : ?>
                <div class="post-list">
                    <?php while ($draft_posts_query->have_posts()) : $draft_posts_query->the_post(); ?>
                        <div class="user-post">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><strong>Created On:</strong> <?php echo get_the_date(); ?></p>
                            <p><strong>Status:</strong> <?php echo ucfirst(get_post_status()); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>No draft posts found.</p>
        <!-- Redirect button when no draft posts are available -->
        <a href="<?php echo home_url('/add-post'); ?>" class="button">Add New Post</a>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>

<?php else : ?>
    <p>Please log in to view your posts.</p>
<?php endif; ?>

<?php get_footer(); ?>


<style>
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