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

    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
    $message .= sprintf(__('E-mail: %s'), $user->user_email) . "\r\n";

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

    $message = sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";

	$message .= __('Thanks for registering with RetailWire! To set your password, visit the following address:') . "\r\n\r\n";
	$message .= '' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . " \r\n\r\n";
    $message .= sprintf( __('Login, update your password and take a moment to fill in your profile.  Then continue on and read the latest in retail news and discussions. If you have any problems, please contact us at %s.'), get_option('admin_email') ) . "\r\n\r\n";
	$message .= __('Thank You!') . "\r\n\r\n";

	wp_mail($user->user_email, sprintf(__('[%s] Your username and password info'), $blogname), $message);
    }
endif; ?>