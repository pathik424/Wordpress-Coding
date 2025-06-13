<?php 


function send_test_email() {
    $to = 'mailto:p4pathik424@gmail.com'; // Change this to your email address
    $subject = 'Test Email from Developer';
    $message = 'This is a test email by developer using code.';
    $headers = 'From: Mayevsky <mailto:dev_test_normal_user@yopmail.com>'; // Change this to your name and email address
    // Send email
    $result = wp_mail($to, $subject, $message, $headers);
    if ($result) {
        // Email sent successfully
        error_log('Test email sent successfully.');
    } else {
        // Email sending failed
error_log('Failed to send test email.');
}
}
// Hook the custom function to fire when the home page is loaded
add_action('wp_loaded', 'send_test_email');
 

?>