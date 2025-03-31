<?php



// Forgot Password Form
function custom_forgot_password_form()
{
    ob_start();
    if (isset($_POST['forgot_password'])) {
        $user_data = get_user_by('email', sanitize_email($_POST['email']));

        if ($user_data) {
            // Handle sending password reset link
            $reset_link = wp_lostpassword_url();
            echo "<p>Check your email for a password reset link.</p>";
        } else {
            echo "<p>Error: Email not found.</p>";
        }
    }
?>
    <form method="POST" action="">
        <label>Email</label><input type="email" name="email" required>
        <button type="submit" name="forgot_password">Reset Password</button>
    </form>
<?php
    return ob_get_clean();
}
