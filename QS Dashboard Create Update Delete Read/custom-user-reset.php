<?php

// custom-auth/custom-auth-functions.php


function encrypt_data($data)
{
    $key = 'your_secret_key'; // Replace with a secure key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decrypt_data($data)
{
    $key = 'your_secret_key'; // Use the same key as in `encrypt_data`
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'AES-256-CBC', $key, 0, $iv);
}


// Reset Password Form
function custom_reset_password_form()
{
    ob_start();
    if (isset($_POST['reset_password'])) {
        $user_email = sanitize_email($_POST['email']);

        if (!is_email($user_email)) {
            echo "Invalid email address.";
        } else {
            $user = get_user_by('email', $user_email);

            if (!$user) {
                echo "No user found with this email address.";
            } else {
                // Generate a reset link
                $reset_key = get_password_reset_key($user);

                if (is_wp_error($reset_key)) {
                    echo "There was an error generating the reset key.";
                } else {

                    // Encrypt username and reset key
                    $encrypted_login = urlencode(encrypt_data($user->user_login));
                    $encrypted_key = urlencode(encrypt_data($reset_key));
                    // Create reset URL

                    $reset_url = add_query_arg([
                        'action' => 'reset_password',
                        'key'    => $encrypted_key,
                        'login'  => $encrypted_login,
                    ], site_url('/reset-new-password'));


                    // Send the reset email
                    $subject = "Password Reset Request";
                    $message = "Click the following link to reset your password: \n\n";
                    $message .= $reset_url;

                    if (wp_mail($user_email, $subject, $message)) {
                        echo "Password reset email sent successfully.";
                    } else {
                        echo "Failed to send the password reset email.";
                    }
                }
            }
        }
    }

?>
    <form method="POST" action="">
        <label for="user_email">Enter your email address:</label>
        <input type="email" name="email" id="user_email" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>

<?php
    return ob_get_clean();
}


?>