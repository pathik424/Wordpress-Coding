<?php

// custom-auth/custom-auth-functions.php

// Registration Form
 function custom_register_form()
{


    // Handle form submission
    // if (isset($_POST['register_user'])) {
    //     // Security: Check honeypot
    //     if (!empty($_POST['honeypot'])) {
    //         wp_die('Bot detected!');
    //     }

    //     // Sanitize form inputs
    //     $first_name = sanitize_text_field($_POST['first_name']);
    //     $last_name = sanitize_text_field($_POST['last_name']);
    //     $email = sanitize_email($_POST['email']);
    //     $username = sanitize_user($_POST['username']);
    //     $password = $_POST['password'];
    //     $confirm_password = $_POST['confirm_password'];

    //     // Check if passwords match and meet requirements
    //     if ($password !== $confirm_password) {
    //         wp_die('Passwords do not match. Please ensure that both password fields are identical.');
    //     }

    //     // // Improved Password validation
    //     // if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
    //     //     wp_die('Password must contain at least one lowercase letter, one uppercase letter, one number, and be at least 8 characters long.');
    //     // }


    //     // Check if email or username exists
    //     if (username_exists($username) || email_exists($email)) {
    //         wp_die('Username or email already exists.');
    //     }

    //     // Create user
    //     $user_id = wp_create_user($username, $password, $email);
    //     if (is_wp_error($user_id)) {
    //         wp_die($user_id->get_error_message());
    //     }

    //     // Update user meta
    //     wp_update_user([
    //         'ID' => $user_id,
    //         'first_name' => $first_name,
    //         'last_name' => $last_name,
    //     ]);

    //     // Set user role
    //     $user = new WP_User($user_id);
    //     $user->set_role('subscriber');

    //     // Success message and redirect
    //     // wp_safe_redirect(home_url('/user_login'));
    //     exit;
    // }
    ob_start();
    // Output the registration form
?>
    <div class="register_main">
        <div class="register_left">
            <h2>Why create an account? </h2>
            <div class="register_left_otr">
                <div class="register_left_row">
                    <div class="register_img">
                        <img src="https://prelive.qs-gen.com/wp-content/uploads/2024/11/register_img1.png" alt="img">
                    </div>
                    <p>Be the first to know all about education</p>
                </div>
                <div class="register_left_row">
                    <div class="register_img">
                        <img src="https://prelive.qs-gen.com/wp-content/uploads/2024/11/register_img2.png" alt="img">
                    </div>
                    <p>Get access to members-only content and features</p>
                </div>
                <div class="register_left_row">
                    <div class="register_img">
                        <img src="https://prelive.qs-gen.com/wp-content/uploads/2024/11/register_img3.png" alt="img">
                    </div>
                    <p>Publish your own articles</p>
                </div>
                <div class="register_left_row">
                    <div class="register_img">
                        <img src="https://prelive.qs-gen.com/wp-content/uploads/2024/11/register_img4.png" alt="img">
                    </div>
                    <p>Join an online community of like-minded education professionals</p>
                </div>
            </div>
        </div>
        <div class="register_form">
            <h2>Register</h2>
            <form method="POST" action="">
                <div id="server-error" style="color: red; display: none;"></div>
                <div class="common_register_top">
                    <div class="register_input_row">
                        <div class="common_input">
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                            <label>First Name</label>
                        </div>
                        <div class="common_input">
                            <input type="text" id="last_name" name="last_name" placeholder="last Name" required>
                            <label>Last Name</label>
                        </div>
                    </div>
                    <div class="common_input">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                        <label>Email Address</label>
                        <p id="email-error" style="color: red; display: none;">Please enter a valid email address.</p>
                        <p id="auth-email-error" style="color: red; display: none;"></p>
                    </div>
                </div>

                <div class="register_center">
                    <label>I represent an Institution</label>
                    <label class="switch">
                        <input type="checkbox" name="institution">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="common_register_bottom">
                    <div class="register_input_row">
                        <div class="common_input">
                            <input type="text" name="designation" placeholder="Designation" required>
                            <label>Designation</label>
                        </div>
                        <div class="common_input">
                            <select name="country" required>
                                <option value="">Select your country</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <!-- Add other countries as options -->
                            </select>
                            <label>Country/Region</label>
                        </div>
                    </div>
                    <div class="register_input_row">
                        <div class="common_input">
                            <input type="text" id="username" name="username" placeholder="Username" required>
                            <label>Username</label>
                            <p id="username-error" style="color: red; display: none;">Username must start with a letter, be 4-25 characters, contain only letters, numbers, or underscores, and not end with an underscore.</p>
                            <p id="auth-username-error" style="display: none;"></p>
                        </div>
                        <div class="common_input">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <label>Password</label>
                            <div class="password-requirements" style="display: none;"> <!-- Hidden by default -->
                                <p class="requirement lowercase"><span class="icon">❌</span> A lowercase letter</p>
                                <p class="requirement uppercase"><span class="icon">❌</span> A capital (uppercase) letter</p>
                                <p class="requirement number"><span class="icon">❌</span> A number</p>
                                <p class="requirement length"><span class="icon">❌</span> Minimum 8 characters</p>
                            </div>
                            <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <p>By registering, you agree to our <strong>Terms and Conditions</strong>, and to have read our <strong>FAQs .</strong></p>

                    <div class="common_input">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Retype Password" required>
                        <label>Retype Password</label>
                        <p id="confirm-password-error" style="color: red; display: none;">Passwords do not match.</p>
                    </div>
                    <input type="text" name="honeypot" style="display:none">
                    <button type="button" id="register_user_button" name="register_user">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>

<?php
    return ob_get_clean();
}

// Login Form
function custom_login_form()
{
    ob_start();
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
        <button type="submit" name="login_user">Login</button>
    </form>
<?php
    return ob_get_clean();
}

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

// Reset Password Form
function custom_reset_password_form()
{
    ob_start();
    if (isset($_POST['reset_password'])) {
        $user = check_password_reset_key($_POST['key'], $_POST['login']);

        if (!is_wp_error($user)) {
            reset_password($user, $_POST['password']);
            echo "<p>Password reset successfully!</p>";
        } else {
            echo "<p>Error: " . $user->get_error_message() . "</p>";
        }
    }
?>
    <form method="POST" action="">
        <div class="common_input">
            <input type="password" name="password" placeholder="New Password" required>
            <label>New Password</label>
        </div>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
<?php
    return ob_get_clean();
}


?>

