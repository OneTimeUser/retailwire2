<?php
/**
 * Plugin Name: Custom new user notification email
 * Description: Overwrites the pluggable 'wp_new_user_notification()' plugin to allow the sending of a custom email
 * Author: jason aston
 * Version: 1.0
 */

if ( !function_exists('wp_new_user_notification') ) :
/**
 * Pluggable - Email login credentials to a newly-registered user
 *
 * A new user registration notification is also sent to admin email.
 *
 * @since 2.0.0
 *
 * @param int    $user_id        User ID.
 * @param string $plaintext_pass Optional. The user's plaintext password. Default empty.
 */
function wp_new_user_notification($user_id, $deprecated=null, $notify= ''){
	if ( $deprecated !== null ) {
		_deprecated_argument( __FUNCTION__, '4.3.1' );
	}
	global $wpdb, $wp_hasher;
    $user = get_userdata($user_id);
    $userEmail = $user->user_email;
    $logoUrl = plugin_dir_url( __FILE__ ).'/rw-new.jpg';

    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);



    $message  = sprintf(__('New user registration on your site %s:'), $blogname);
    $message .= "\r\n\r\n" . sprintf(__('Username: %s'), $user->user_login);
    $message .= "\r\n\r\n" . sprintf(__('E-mail: %s'), $user->user_email) . "\r\n";

    @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

    if ( 'admin' === $notify || empty( $notify ) ) {
		return;
	}

	// Generate something random for a password reset key.
	$key = wp_generate_password( 20, false );

	/** This action is documented in wp-login.php */
	do_action( 'retrieve_password_key', $user->user_login, $key );

	// Now insert the key, hashed, into the DB.
	if ( empty( $wp_hasher ) ) {
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );
	}
	$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );

	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = '<html><body>';
	$message .= '<img src="' . $logoUrl . '" />';
	$message .= '<h1>Hello, Welcome to RetailWire!</h1>';
	$message .= '<h3>Thanks for registering.  Just three quick steps, and you&quot;re all done:</h3>';
	$message .= '<h3>1. Set your password by clicking this link:</h3>';
	$message .= '<p>' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . "</p>";
	$message .= '<h3>2. After setting your password, you’ll be taken to a page to complete your profile. Please take a moment to complete the form.</h3>';
	$message .= '<h3>3. And be sure to subscribe to our newsletters so we can keep you informed. Click here to join our list:</h3>';
	$message .= '<p>' . network_site_url("subscribe") . "</p>";	
	$message .= '<h3>If you have any problems, please contact us at</h3>';
	$message .= get_option('admin_email');
	$message .= '</body></html>';

 //    $message = sprintf(__('Username: %s'), $user->user_login) . "\r\n";

	// $message .= __('Thanks for registering with RetailWire! To set your password, visit the following address:') . "\r\n";
	// $message .= '' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . "\r\n";
 //    $message .= sprintf( __('Login, update your password and take a moment to fill in your profile.  Then continue on and read the latest in retail news and discussions. If you have any problems, please contact us at %s.'), get_option('admin_email') ) . "\n\n";
	// $message .= __('Thank You!') . "\n";

	wp_mail($user->user_email, sprintf(__('[%s] Welcome! Please complete your RetailWire profile.'), $blogname), $message, $headers);
    }
endif; ?>