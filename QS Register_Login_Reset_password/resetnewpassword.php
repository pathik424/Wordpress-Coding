<?php
//Template Name: Reset New Password


get_header();

if (isset($_GET['action']) && $_GET['action'] === 'reset_password' && isset($_GET['key']) && isset($_GET['login'])) {
    $encrypted_login = sanitize_text_field($_GET['login']);
    $encrypted_key = sanitize_text_field($_GET['key']);

    // Decrypt the parameters
    $user_login = decrypt_data($encrypted_login);
    $key = decrypt_data($encrypted_key);

    if (!$user_login || !$key) {
        echo '<p>Invalid or expired reset link. Please request a new one.</p>';
        return;
    }
    $user = check_password_reset_key($key, $user_login);

    if (is_wp_error($user)) {
        echo '<p>Invalid or expired reset link. Please request a new one.</p>';
    } else {
        if (isset($_POST['submit_new_password'])) {
            $new_password = sanitize_text_field($_POST['new_password']);
            $confirm_password = sanitize_text_field($_POST['confirm_password']);

            if (empty($new_password) || empty($confirm_password)) {
                echo '<p>Please fill in all fields.</p>';
            } elseif ($new_password !== $confirm_password) {
                echo '<p>Passwords do not match. Please try again.</p>';
            } else {
                // Update the user's password
                reset_password($user, $new_password);
                echo '<p>Password reset successfully. You can now <a href="http://localhost/qs-gen/user_login/">log in</a>.</p>';
            }
        } else {
            ?>
            <form method="POST">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
                <br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
                <br>
                <button type="submit" name="submit_new_password">Reset Password</button>
            </form>
            <?php
        }
    }
} else {
    echo '<p>Invalid request. Please check your email for the reset link.</p>';
}

get_footer();
