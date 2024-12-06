<?php
// Template Name: Dashboard

if (!is_user_logged_in()) {
    wp_redirect(home_url('/user_login'));
    exit;
}
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


?>

    <div class="dashboard-main">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Saved stories</h1>
                <p class="total-posts"><strong><?php echo $post_count; ?></strong></p>
                <a href="<?php echo home_url('/dashboard/all-post/'); ?>">View All <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                        <g clip-path="url(#clip0_5068_6086)">
                            <path d="M22 44C34.1503 44 44 34.1503 44 22C44 9.84974 34.1503 0 22 0C9.84974 0 0 9.84974 0 22C0 34.1503 9.84974 44 22 44Z" fill="#FECC01" />
                            <path d="M17.84 22.84H24.14L22.22 24.76C21.89 25.09 21.89 25.62 22.22 25.95C22.55 26.28 23.08 26.28 23.41 25.95L26.77 22.59C27.1 22.26 27.1 21.73 26.77 21.4L23.41 18.04C23.25 17.88 23.03 17.79 22.82 17.79C22.61 17.79 22.39 17.87 22.23 18.04C21.9 18.37 21.9 18.9 22.23 19.23L24.15 21.15H17.85C17.39 21.15 17.01 21.53 17.01 21.99C17.01 22.45 17.39 22.83 17.85 22.83L17.84 22.84Z" fill="#1D1D1B" />
                        </g>
                        <defs>
                            <clipPath id="clip0_5068_6086">
                                <rect width="44" height="44" fill="white" />
                            </clipPath>
                        </defs>
                    </svg></a>
            </div>

            <!-- Display Published and Pending Posts -->
            <div class="dashboard_btm_main">
                <div class="post-section">
                    <h2>My stories </h2>
                    <?php if ($user_posts_query->have_posts()) : ?>
                        <div class="post-list">
                            <?php while ($user_posts_query->have_posts()) : $user_posts_query->the_post(); ?>
                                <div class="user_post_main">
                                    <div class="user-post">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php

                                        $status = ucfirst(get_post_status());

                                        ?>
                                        <div class="user_post_para user_dot yellow_dot <?php echo strtolower($status); ?>">
                                            <?php

                                            $status_class = strtolower($status); // Converts "Pending" to "pending", "Publish" to "publish", etc.

                                            ?>
                                            <p><?php echo get_the_date('d M, Y'); ?></p>
                                            <p><?php echo $status; ?></p>
                                        </div>
                                    </div>
                                    <a href="#." class="dot_btn"><svg xmlns="http://www.w3.org/2000/svg" width="5" height="24" viewBox="0 0 5 24" fill="none">
                                            <circle cx="2.5" cy="3" r="2.5" fill="black" />
                                            <circle cx="2.5" cy="12" r="2.5" fill="black" />
                                            <circle cx="2.5" cy="21" r="2.5" fill="black" />
                                        </svg>
                                    </a>
                                    <div class="post_dummy_text">
                                        <?php if ($status_class !== 'publish') : ?>
                                            <button class="edit_button" data-post-id="<?php echo get_the_ID(); ?>">Edit</button>
                                        <?php endif; ?>
                                        <button class="delete_button" data-post-id="<?php echo get_the_ID(); ?>">Delete</button>
                                    </div>

                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <p>No draft posts found.</p>
                        <!-- Redirect button when no draft posts are available -->
                        <a href="<?php echo home_url('/dashboard/post'); ?>" class="button">Add New Post</a>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <!-- Display Draft Posts -->
                <div class="draft-section">
                    <div class="draft_post_main">
                        <h2>Draft</h2>
                        <a href="<?php echo home_url('/dashboard/post'); ?>" class="button">Add New Post</a>
                    </div>

                    <?php
                    // Query for draft posts
                    $current_user_id = get_current_user_id(); // Get the current logged-in user ID
                    $draft_args = array(
                        'author' => $current_user_id,
                        'post_type' => 'post',
                        'post_status' => 'draft',
                        'posts_per_page' => -1, // Get all draft posts
                    );

                    $draft_posts_query = new WP_Query($draft_args);


                    // Check if there are draft posts
                    if ($draft_posts_query->have_posts()) :
                    ?>
                        <div class="draft_btm_box">
                            <?php while ($draft_posts_query->have_posts()) : $draft_posts_query->the_post(); ?>
                                <div class="user_post_main">
                                    <div class="user-post">
                                        <p>
                                            <?php the_title();
                                            $story = get_post_meta(get_the_ID(), '_tell_us_your_story', true); // Retrieve the "Tell Us Your Story" field
                                            ?>
                                            <span>(<?php echo $story ? str_word_count(strip_tags($story)) : 0; ?> words)</span>
                                        </p>
                                    </div>
                                    <a href="#." class="dot_btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="24" viewBox="0 0 5 24" fill="none">
                                            <circle cx="2.5" cy="3" r="2.5" fill="black" />
                                            <circle cx="2.5" cy="12" r="2.5" fill="black" />
                                            <circle cx="2.5" cy="21" r="2.5" fill="black" />
                                        </svg>
                                    </a>
                                    <div class="post_dummy_text">
                                     <button class="delete_button" data-post-id="<?php echo get_the_ID(); ?>">Delete</button>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php
                    else :
                    ?>
                        <!-- Redirect button when no draft posts are available -->

                        <a href="<?php echo home_url('/dashboard/post'); ?>" class="button">Add New Post</a>

                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>

                <!-- Confirmation Popup (Initially Hidden) -->
                <div id="delete-confirmation-popup" class="confirmation-popup">
                    <div class="popup-content">
                        <p>Are you sure you want to delete this post?</p>
                        <button id="confirm-delete" class="button">Yes, Delete</button>
                        <button id="cancel-delete" class="button">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php else : ?>
    <p>Please log in to view your posts.</p>
<?php endif; ?>

<script>
    jQuery(document).ready(function($) {
        $('.dot_btn').click(function(e) {
            e.preventDefault(); // Prevent default anchor behavior

            // Toggle the 'active' class on the clicked element
            $(this).toggleClass('active');

            // Optionally, if you want to remove the 'active' class from other .dot_btn elements:
            $('.dot_btn').not($(this)).removeClass('active');
        });
    });

    /////////////////////popup and delete////////////////////////////
    document.addEventListener('DOMContentLoaded', function() {
        let deleteButtons = document.querySelectorAll('.delete_button');
        let popup = document.getElementById('delete-confirmation-popup');
        let confirmDeleteButton = document.getElementById('confirm-delete');
        let cancelDeleteButton = document.getElementById('cancel-delete');
        let postIdToDelete = null;

        // Show the confirmation popup when the "Delete" button is clicked
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                postIdToDelete = button.getAttribute('data-post-id');
                popup.style.display = 'flex'; // Show the popup
            });
        });

        // Handle cancellation
        cancelDeleteButton.addEventListener('click', function() {
            popup.style.display = 'none'; // Hide the popup
        });

        // Handle confirmation of deletion
        confirmDeleteButton.addEventListener('click', function() {
            if (postIdToDelete) {
                // Send AJAX request to delete the post
                var data = {
                    action: 'delete_draft_post',
                    post_id: postIdToDelete,
                    security: '<?php echo wp_create_nonce('delete_post_nonce'); ?>' // Security nonce
                };

                jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    if (response.success) {
                        location.reload(); // Reload the page after successful deletion
                    } else {
                        alert('Failed to delete the post.');
                    }
                });
            }
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit_button');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const redirectUrl = `http://localhost/qs-gen/dashboard/edit-post/?post_id=${postId}`;
                window.location.href = redirectUrl;
            });
        });
    });
</script>

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
    .post-section,
    .draft-section {
        margin-bottom: 30px;
    }

    .post-section h2,
    .draft-section h2 {
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
        padding: 10px 20px;
        /* Add padding inside the button */
        background-color: #0073e6;
        /* Button background color */
        color: white;
        /* Text color */
        text-decoration: none;
        /* Remove underline */
        border-radius: 5px;
        /* Rounded corners */
        display: inline-block;
        /* Display inline-block to maintain the button-like behavior */
        font-size: 16px;
        /* Adjust font size */
        font-weight: bold;
        /* Make text bold */
        text-align: center;
        /* Center-align the text inside the button */
        transition: background-color 0.3s ease;
        /* Add a smooth transition on hover */
        margin-top: 20px;
        /* Add some space above the button */
    }

    /* Hover Effect */
    .button:hover {
        background-color: #005bb5;
        /* Darken the background color when hovered */
        cursor: pointer;
        /* Change cursor to indicate interactivity */
    }

    /* Optional: Add active state for when the button is clicked */
    .button:active {
        background-color: #004080;
        /* Even darker background on click */
    }
</style>