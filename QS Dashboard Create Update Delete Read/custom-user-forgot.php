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
	<span>Please enter your email address. You will receive a link to create a new password via email.</span>
        <div class="common_input">
          <input type="email" name="email" placeholder="Email" required>
		  <label>Email</label>
	    </div>
        <button type="submit" name="forgot_password">Reset Password</button>
    </form>
<?php
    return ob_get_clean();
}
