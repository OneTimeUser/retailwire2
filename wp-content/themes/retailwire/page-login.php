<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */
/*

Template Name: Login Page

*/
get_header(); ?>

	<div id="primary" class="site-content row" role="main">
		<?php if ( !is_user_logged_in() ) { ?>

		<div class="login-disqui">
	

		</div>
		<div class="login-l col grid_6_of_12">
			<div class="form-login-2">
				<?php 
	 			$args = array(
				'echo'           => true,
				'remember'       => false,
				'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'label_username' => __( 'Username' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in'   => __( 'Log In' ),
				'value_username' => '',
				'value_remember' => false
				);

	 			wp_login_form($args);

	 			?> 

			</div>
 			
		</div> <!-- /.col.grid_8_of_12 -->
		<div class="login-r col grid_6_of_12">
			<ul class="list-connect">
				<li><a href="" class="icon-tt-1">Sign in with Twitter</a></li>
				<li><a href="" class="icon-fb-1">Sign in with Facebook</a></li>
				<li><a href="" class="icon-in-1">Sign in with LinkedIn</a></li>
				<li><a href="" class="icon-gg-1">Sign in with Google</a></li>
			</ul>
			<a href="#" class="connect-b">Or sIgn up with Email</a>
			<p>If you sign up with Twitter or Facebook, we’ll start you off 
				with a network by automatically importing any followers/fol
				lowees or friends already on Medium. Also, we’ll never post 
				to Twitter or Facebook without your permission.</p>
			<button href="#" class="btn">Sign Up</button>

		</div> <!-- /.col.grid_8_of_12 -->
		
		<?php } else { ?>
		<p>Do you see reports of franchises unhappiness at McDonald's part of the normal grumbling that comes 
		with most changes or a sign of serious problem with the strategy? </p>		
		<?php

		$author_id = get_current_user_id();
		$author_facebook = get_field('facebook', 'user_'. $author_id );
		$author_twitter = get_field('twitter', 'user_'. $author_id );
		$author_linked_in = get_field('linked_in', 'user_'. $author_id );
		$author_position = get_field('position', 'user_'. $author_id );
		$author_avata_user = get_field('avata_user', 'user_'. $author_id );
		$author_content_user = get_field('content', 'user_'. $author_id );
		?>
		<form class="group-login">
			<div class="login-g-user">
				<a class="avata-login" href="<?php echo get_author_posts_url($author->ID); ?>"><img src="<?php echo $author_avata_user['url']; ?>"></a>
				<div class="info-login-user">
					<a href="<?php echo get_author_posts_url($author->ID); ?>"><?php 
						$current_user = wp_get_current_user();
						echo $current_user->user_login;
					 ?></a>
					<span class="position"><?php echo $author_position; ?></span>
				</div>
			</div>
			<div class="form-user-bottom">
				<div class="check-box clear">
				<input type="checkbox" name="publish" value="Bike"><label>You may publish this comment</label>
				</div>
				<div class="check-box">
					<input type="checkbox" name="agree" value="Bike"><label>I agree to the RetailWire "Golden Rule"</label>
				</div>
				<input type="submit" value="Publish" class="submit-user" />
			</div>
		</form>

		<?php } ?>
	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
