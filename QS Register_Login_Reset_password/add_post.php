<?php

//Template Name: Add Post

get_header();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
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
    </style>
</head>
<body>

<form id="postForm" method="post" enctype="multipart/form-data">
    <h2>Create a Post</h2>
    <?php if (isset($_GET['post_created']) && $_GET['post_created'] === 'true') : ?>
    <div class="feedback" style="color: green;">Post created successfully!</div>
<?php endif; ?>

    <label for="title">Title</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5" required></textarea>
    
    <label for="tell_us_your_story">Tell Us Your Story</label>
    <textarea id="tell_us_your_story" name="tell_us_your_story" rows="5" required></textarea>

    <label for="image">Image</label>
    <input type="file" id="image" name="image">

    <input type="hidden" name="action" value="create_post">
    <?php wp_nonce_field('create_post_action', 'create_post_nonce'); ?>

    <button type="submit">Submit</button>
</form>



</body>
</html>




<?php
get_footer();
?>