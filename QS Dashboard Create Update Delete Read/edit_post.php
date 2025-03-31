<?php
//Template Name: Edit Post


get_header();

if (!is_user_logged_in()) {
    wp_redirect(home_url('/user_login'));
    exit;
}

// Get the post ID from the URL query string
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id) {
    $post = get_post($post_id);


    if ($post && $post->post_type === 'post') {
        // Get custom meta fields
        $tell_us_your_story = get_post_meta($post_id, '_tell_us_your_story', true);
        $categories = get_categories();
        $selected_categories = wp_get_post_categories($post_id);


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update a Post</title>
        </head>

        <body>



            <form method="POST" enctype="multipart/form-data" action="">
                <input type="hidden" name="update_post_nonce" value="<?php echo wp_create_nonce('update_post_action'); ?>">
                <input type="hidden" name="action" value="update_post">
                <input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID); ?>">
                <input type="hidden" id="remove_image_flag" name="remove_image_flag" value="0">


                <div class="company_img_main_inr">
                    <div class="company_img_div_inr">
                        <input type="file" id="inputFile" name="image" onchange="readUrl(this)">
                        <div class="company_img_box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.93587 10C1.93587 9.75218 2.13676 9.55128 2.38458 9.55128L9.55086 9.55128L9.55086 2.385C9.55086 2.13718 9.75176 1.93629 9.99958 1.93629C10.2474 1.93629 10.4483 2.13718 10.4483 2.385L10.4483 9.55128L17.6146 9.55128C17.8624 9.55128 18.0633 9.75218 18.0633 10C18.0633 10.2478 17.8624 10.4487 17.6146 10.4487L10.4483 10.4487L10.4483 17.615C10.4483 17.8628 10.2474 18.0637 9.99958 18.0637C9.75176 18.0637 9.55086 17.8628 9.55086 17.615L9.55086 10.4487L2.38458 10.4487C2.13676 10.4487 1.93587 10.2478 1.93587 10Z" fill="white" />
                            </svg>
                            Upload image
                        </div>
                    </div>
                    <?php
                    // Fetch the current post's featured image URL
                    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                    // Use the placeholder image if no featured image is found
                    $display_image_url = $featured_image_url ? $featured_image_url : 'http://placehold.it/180';
                    // print_r($featured_image_url);
                    // exit;
                    ?>
                    <img src="<?php echo esc_url($display_image_url); ?>" id="blah" alt="Featured Image" class="uploaded-img"><br>
                    <button type="button" onclick="removeImg()">Close</button>
                    <div class="company_img_div_btm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.95238C7.00314 2.95238 2.95238 7.00314 2.95238 12C2.95238 16.9969 7.00314 21.0476 12 21.0476C16.9969 21.0476 21.0476 16.9969 21.0476 12C21.0476 7.00314 16.9969 2.95238 12 2.95238ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM12 7.71429C12.263 7.71429 12.4762 7.92748 12.4762 8.19048V12C12.4762 12.263 12.263 12.4762 12 12.4762C11.737 12.4762 11.5238 12.263 11.5238 12V8.19048C11.5238 7.92748 11.737 7.71429 12 7.71429ZM11.5238 15.8095C11.5238 15.5465 11.737 15.3333 12 15.3333H12.0095C12.2725 15.3333 12.4857 15.5465 12.4857 15.8095C12.4857 16.0725 12.2725 16.2857 12.0095 16.2857H12C11.737 16.2857 11.5238 16.0725 11.5238 15.8095Z" fill="#5D5D5B" />
                        </svg>
                        Images have to be of the size 1920x1080px.
                    </div>
                </div>


                <div class="common_input">
                    <input type="text" id="title" name="title" value="<?php echo esc_attr($post->post_title); ?>" maxlength="100" required>
                    <label for="title">Title</label>
                </div>


                <div class="common_input">
                    <textarea id="description" name="description" rows="5" maxlength="200" required><?php echo esc_textarea($post->post_content); ?></textarea>
                    <label for="description">Description</label>
                </div>


                <div class="common_input">
                    <textarea id="tell_us_your_story" name="tell_us_your_story" rows="5" required><?php echo esc_textarea($tell_us_your_story); ?></textarea>
                    <label for="tell_us_your_story">Tell Us Your Story</label>
                </div>

                <button type="button" id="openPopup">Update Popup</button>
                <button type="button" id="closingPopup">Cancel</button>
                <input type="hidden" id="post_status" name="post_status" value="">


                <div id="popup" style="display: none;">
                    <div id="popupContent">



                        <?php
                        $category_ids = [153, 56, 66, 57, 65];
                        $categories = get_terms([
                            'taxonomy' => 'category',
                            'include' => $category_ids,
                            'hide_empty' => false,
                        ]);

                        if (!empty($categories) && !is_wp_error($categories)) {
                            // Displaying categories using checkboxes
                            echo '<label for="categories">Select the categories your story fits into:</label>';

                            foreach ($categories as $category) {
                                // Check if the category is selected (from $selected_categories)
                                $selected = in_array($category->term_id, $selected_categories) ? 'checked' : '';

                                echo '<label class="checkbox-button">';
                                echo '<input type="checkbox" name="selected_categories[]" value="' . esc_attr($category->term_id) . '" ' . $selected . '>';
                                echo '<span>' . esc_html($category->name) . '</span>';
                                echo '</label>';
                            }
                        } else {
                            echo '<p>No categories found.</p>';
                        }
                        ?>



                        <!-- Action Buttons -->
                        <div class="button-wrapper">
                            <button type="submit" class="action-btn" onclick="document.getElementById('post_status').value='draft'">Save as draft</button>
                            <button type="submit" class="action-btn" onclick="document.getElementById('post_status').value='pending'">Submit story</button>
                        </div>

                    </div>
                </div>
            </form>

    <?php
    } else {
        echo '<p>Invalid post ID or post type.</p>';
    }
} else {
    echo '<p>No post ID provided.</p>';
}
    ?>

        </body>




        <script>
            // for 1st popup
            document.addEventListener("DOMContentLoaded", function() {
                const openPopupButton = document.getElementById("openPopup");
                const popup = document.getElementById("popup");
                const closePopupButton = document.getElementById("closePopup");
                const popupSubmitButton = document.getElementById("popupSubmit");
                const form = document.getElementById("createPostForm");

                // Open the popup
                openPopupButton.addEventListener("click", function() {
                    popup.style.display = "flex";
                });

                // Close the popup
                closePopupButton.addEventListener("click", function() {
                    popup.style.display = "none";
                });

                // Submit the form via the popup button
                popupSubmitButton.addEventListener("click", function() {
                    form.submit();
                });
            });


            // for 2nd popup



            document.addEventListener("DOMContentLoaded", function() {
                const openPopupButton = document.getElementById("closingPopup");
                const popup = document.getElementById("close1popup");
                const closePopupButton = document.getElementById("closedPopup");
                const popupSubmitButton = document.getElementById("popupSubmit");
                const form = document.getElementById("createPostForm");

                // Open the popup
                openPopupButton.addEventListener("click", function() {
                    popup.style.display = "flex";
                });

                // Close the popup
                closePopupButton.addEventListener("click", function() {
                    popup.style.display = "none";
                });

                // Submit the form via the popup button
                popupSubmitButton.addEventListener("click", function() {
                    form.submit();
                });
            });

            ////// For Image Upload//////

            const a = document.getElementById("blah");
            const inputFile = document.getElementById("inputFile");

            // Preview image when uploaded
            function readUrl(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        a.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImg() {
                document.getElementById('blah').src = 'http://placehold.it/180'; // Reset to placeholder image
                document.getElementById('inputFile').value = ''; // Clear the file input
                document.getElementById('remove_image_flag').value = '1'; // Set flag to remove image
            }
        </script>
        <style>
            /* For Image Upload */
            .company_img_main_inr {
                text-align: center;
            }

            .uploaded-img {
                display: block;
                margin: 10px auto;
                max-width: 200px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            button {
                display: block;
                margin: 10px auto;
                padding: 10px 15px;
                background-color: #ff5555;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover {
                background-color: #e04444;
            }

            /* Ensure the popup overlays above the form */
            #popup {
                position: fixed;
                /* Make the popup fixed on the screen */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                /* Semi-transparent background */
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                /* High z-index to ensure it's above other content */
            }

            /* Styling for the popup content */
            #popupContent {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
                width: 300px;
            }
        </style>

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 20px;
            }

            form {
                max-width: 500px;
                margin: auto;
                padding: 20px;
                background: white;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
            }

            input[type="text"],
            textarea,
            input[type="file"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
            }

            button {
                background: #0073aa;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
            }

            button:hover {
                background: #005f8d;
            }

            .error {
                color: red;
                margin-bottom: 20px;
            }

            .success {
                color: green;
                margin-bottom: 20px;
            }

            #popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            #popupContent {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                width: 400px;
                position: relative;
                text-align: center;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 15px;
            }

            p {
                font-size: 16px;
                margin-bottom: 20px;
            }


            .category-wrapper {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
                margin-bottom: 20px;
            }

            .category-btn {
                background-color: #fff;
                border: 2px solid #ccc;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                color: #333;
                transition: all 0.3s ease;
            }

            .category-btn:hover {
                background-color: #FFBC00;
                border-color: #FFBC00;
                color: white;
            }

            .category-btn:active {
                background-color: #f0f0f0;
            }

            .button-wrapper {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .action-btn {
                background-color: #FFBC00;
                border: none;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            .action-btn:hover {
                background-color: #e6a900;
            }

            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                background: none;
                border: none;
                font-size: 20px;
                color: #333;
                cursor: pointer;
            }

            .category-checkboxes {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .checkbox-button {
                display: inline-block;
                position: relative;
                padding: 10px 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .checkbox-button input[type="checkbox"] {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }

            .checkbox-button span {
                font-size: 16px;
                font-weight: 600;
                color: #333;
            }

            .checkbox-button:hover {
                background-color: #ddd;
            }

            .checkbox-button input[type="checkbox"]:checked+span {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
                padding: 10px 20px;
                border-radius: 5px;
            }

            .submit-button {
                margin-top: 20px;
                padding: 10px 15px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .submit-button:hover {
                background-color: #0056b3;
            }


            /* Basic Styling for Popup Background */
            #close1popup {
                display: none;
                /* Initially hidden */
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                /* Dark transparent background */
                z-index: 9999;
                /* Ensures it's on top of other content */
            }

            /* Popup Content Box */
            #close1popupContent {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                /* Center the popup */
                width: 90%;
                /* Width on smaller screens */
                max-width: 400px;
                /* Maximum width */
                background-color: #fff;
                /* White background */
                border-radius: 8px;
                /* Rounded corners */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                /* Subtle shadow */
                padding: 20px;
                text-align: center;
            }

            /* Header Styling */
            #close1popupContent h2 {
                margin: 0 0 15px;
                font-size: 1.5rem;
                color: #333;
            }

            /* Paragraph Styling */
            #close1popupContent p {
                font-size: 1rem;
                color: #666;
                margin-bottom: 20px;
                line-height: 1.5;
            }

            /* Button Wrapper */
            .button-wrapper {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-top: 20px;
            }

            /* Buttons */
            .button-wrapper a,
            .button-wrapper .action-btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 0.9rem;
                border-radius: 4px;
                text-decoration: none;
                text-align: center;
                cursor: pointer;
                color: #fff;
                background-color: #007bff;
                /* Blue */
                transition: background-color 0.3s ease;
            }

            .button-wrapper a:hover,
            .button-wrapper .action-btn:hover {
                background-color: #0056b3;
                /* Darker blue on hover */
            }

            /* Close Button */
            #closedPopup {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: #ff4d4d;
                /* Red background */
                color: #fff;
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                font-size: 1.2rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            #closedPopup:hover {
                background-color: #cc0000;
                /* Darker red on hover */
            }

            /* Responsive Adjustments */
            @media (max-width: 480px) {
                #close1popupContent {
                    width: 95%;
                    padding: 15px;
                }

                #close1popupContent h2 {
                    font-size: 1.2rem;
                }

                #close1popupContent p {
                    font-size: 0.9rem;
                }

                .button-wrapper a,
                .button-wrapper .action-btn {
                    padding: 8px 15px;
                    font-size: 0.8rem;
                }
            }
        </style>