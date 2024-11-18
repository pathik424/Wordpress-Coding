<?php

// custom-auth/custom-auth-functions.php

// Registration Form


// Login Form
ob_start();
function custom_login_form()
{
    // if (is_user_logged_in()) {
    //     wp_redirect(home_url('/dashboard'));
    //     exit;
    // }

    if (isset($_POST['login_user'])) {
        $creds = array(
            'user_login'    => $_POST['username'],
            'user_password' => $_POST['password'],
            'remember'      => isset($_POST['remember']),
        );

        $user = wp_signon($creds, false);

        if (!is_wp_error($user)) {
            wp_redirect(home_url('/dashboard'));
            exit;
        } else {
            echo "<p>Error: " . $user->get_error_message() . "</p>";
        }
    }
?>
    <form method="POST" action="">
        <div class="common_input">
            <input type="text" name="username" placeholder="Username" required>
            <label>Username</label>
        </div>
        <div class="common_input">
            <input type="password" name="password" placeholder="Password" required>
            <label>Password</label>
        </div>
        <label><input type="checkbox" name="remember"> Remember Me</label>
        <br>
        <a href="http://localhost/qs-gen/reset-password/">Forgot your password?</a>

        <button type="submit" name="login_user">Login</button>
    </form>
<?php
    return ob_get_clean();
}
