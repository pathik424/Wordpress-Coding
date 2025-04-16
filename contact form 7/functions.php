<?php
// Force Contact Form 7 to skip mail and return success
add_action('wpcf7_before_send_mail', function($cf7) {
    // Stop the mail from being sent
    $cf7->skip_mail = true;
}, 1);

// Always return success response even if no email is sent
add_filter('wpcf7_skip_mail', '__return_true');

// Optional: Customize success message
add_filter('wpcf7_form_response_output', function($output, $class) {
    if (strpos($class, 'wpcf7-mail-sent-ok') !== false) {
        return str_replace('Thank you for your message. It has been sent.', 'Your form was submitted successfully!', $output);
    }
    return $output;
}, 10, 2);
