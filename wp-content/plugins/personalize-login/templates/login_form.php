<div class="login-logo"><img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" /></div>
<div class="login-form-container">
	 <fieldset class="form-boundary">
    <?php if ( $attributes['show_title'] ) : ?>
    
    <h2><?php _e( 'Sign In', 'personalize-login' ); ?></h2>
    <?php endif; ?>
     <!-- Show errors if there are any -->
		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		    <?php foreach ( $attributes['errors'] as $error ) : ?>
		        <p class="login-error">
		            <?php echo $error; ?>
		        </p>
		    <?php endforeach; ?>
		<?php endif; ?>	

		<!-- Show logged out message if user just logged out -->
		<?php if ( $attributes['logged_out'] ) : ?>
		    <p class="login-info">
		        <?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
		    </p>
		<?php endif; ?>
		<?php if ( $attributes['registered'] ) : ?>
		    <p class="login-info">
		        <?php
		            printf(
		                __( 'You have successfully registered to <strong>RetailWire</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
		                get_bloginfo( 'name' )
		            );
		        ?>
		    </p>
		<?php endif; ?>

		<?php if ( $attributes['password_updated'] ) : ?>
		    <p class="login-info">
		        <?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
		    </p>
		<?php endif; ?>

		<?php if ( $attributes['lost_password_sent'] ) : ?>
		    <p class="login-info">
		        <?php _e( 'Your link to reset your password has been sent to your email address.', 'personalize-login' ); ?>
		    </p>
		<?php endif; ?>
		<legend class="form-title module-label"> Log In  </legend>
		
    <?php
        wp_login_form(
            array(
                'label_username' => __( 'Email', 'personalize-login' ),
                'label_log_in' => __( 'Sign In', 'personalize-login' ),
                'redirect' => $attributes['redirect'],
            )
        );
    ?>
     
    <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Forgot your password?', 'personalize-login' ); ?>
    </a>
    <div class="login-reg"><p>or  <a href="<?php echo home_url(); ?>/member-register">REGISTER</a></p><p>to join in the RetailWire discussions.</div>
    </fieldset>
</div> 