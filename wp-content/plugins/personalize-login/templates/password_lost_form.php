<div class="login-logo"><img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" /></div>

<div id="password-lost-form" class="widecolumn">
    <fieldset class="form-boundary">
  
 
    <p>
        <?php
            _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'personalize_login'
            );
        ?>
    </p>

    <?php if ( $attributes['lost_password_sent'] ) : ?>
        <p class="login-info">
            <?php _e( 'Check your email for a link to reset your password.', 'personalize-login' ); ?>
        </p>
    <?php endif; ?>
    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
        <?php foreach ( $attributes['errors'] as $error ) : ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
     <legend class="form-title module-label"> Password Recovery </legend>
    <form class-"pure-form pure-form-stacked" id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
        <p class="form-row">
            <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?>
            <input type="text" name="user_login" id="user_login">
        </p>
 
        <p class="lostpassword-submit">
            <input type="submit" name="submit" class="lostpassword-button"
                   value="<?php _e( 'Reset Password', 'personalize-login' ); ?>"/>
        </p>
    </form>
    </fieldset>
</div>