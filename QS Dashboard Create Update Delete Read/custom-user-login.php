<?php

// custom-auth/custom-auth-functions.php

// Registration Form

// Track Failed Login Attempts and Block IPs

// Track Failed Login Attempts and Block IPs
function track_failed_login_attempts($ip_address) {
    $failed_attempts = get_transient("failed_attempts_$ip_address") ?: 0;

    $failed_attempts++;
    set_transient("failed_attempts_$ip_address", $failed_attempts, 1 * MINUTE_IN_SECONDS); // Store attempts for 1 minute
    
    // Block IP after 5 failed attempts.
    if ($failed_attempts >= 5) {
        set_transient("blocked_ip_$ip_address", time() + 1 * MINUTE_IN_SECONDS, 1 * MINUTE_IN_SECONDS); // Block for 1 minute
    }
}

// Check if IP is Blocked
function is_ip_blocked($ip_address) {
    return get_transient("blocked_ip_$ip_address") ? true : false;
}

// Get Remaining Block Time
function get_remaining_block_time($ip_address) {
    $block_expiration = get_transient("blocked_ip_$ip_address"); // Get the expiration time of the blocked IP
    
    if (!$block_expiration) {
        return 0; // If no expiration time, return 0 (no block)
    }
    
    $remaining_time = $block_expiration - time();
    
    if ($remaining_time <= 0) {
        // Reset the blocked IP if the block time has expired
        delete_transient("blocked_ip_$ip_address");
        return 0;
    }
    
    return $remaining_time;
}

// Login Form
ob_start();
function custom_login_form()
{
    $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

    // Check if the IP is blocked
    if (is_ip_blocked($ip_address)) {
        echo "<p>Your IP address has been temporarily blocked due to multiple failed login attempts. Please try again later.</p>";
        
        // Calculate the remaining time for the block to expire
        $remaining_time = get_remaining_block_time($ip_address);

        if ($remaining_time > 0) {
            // Display remaining time
            $minutes = floor($remaining_time / 60);
            $seconds = $remaining_time % 60;
            echo "<p>Remaining time before unblock: <span id='countdown'>$minutes minutes and $seconds seconds</span>.</p>";
            ?>

            <script type="text/javascript">
                var remainingTime = <?php echo $remaining_time; ?>; // Total remaining time in seconds
                function updateCountdown() {
                    var minutes = Math.floor(remainingTime / 60);
                    var seconds = remainingTime % 60;
                    document.getElementById('countdown').innerHTML = minutes + ' minutes and ' + seconds + ' seconds';

                    if (remainingTime <= 0) {
                        clearInterval(countdownInterval);
                        document.getElementById('countdown').innerHTML = 'Your IP is now unblocked!';
                    }

                    remainingTime--;
                }

                // Update countdown every second
                var countdownInterval = setInterval(updateCountdown, 1000);
            </script>

            <?php
        }

        return; // Stop rendering the form
    }

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
            track_failed_login_attempts($ip_address);
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
        <a href="<?php echo home_url( '/forgot-password/' ); ?>">Forgot your password?</a>

        <button type="submit" name="login_user">Login</button>
    </form>
<?php
    return ob_get_clean();
}
