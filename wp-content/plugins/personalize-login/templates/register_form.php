<div id="register-form" class="widecolumn">
    <?php if ( $attributes['show_title'] ) : ?>
        <h3><?php _e( 'Register', 'personalize-login' ); ?></h3>
    <?php endif; ?>

    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
        <?php foreach ( $attributes['errors'] as $error ) : ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
 
    <form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
        <p class="form-row">
            <div class="label-row"><label for="email"><?php _e( 'Email', 'personalize-login' ); ?> <strong>*</strong></label></div>
            <input type="text" name="email" id="email">
        </p>
 
        <p class="form-row">
             <div class="label-row"><label class="label-row" for="display_name"><?php _e( 'Username', 'personalize-login' ); ?></label></div>
            <input type="text" name="display_name" id="display-name">
        </p>

        <p class="form-row">
             <div class="label-row"><label class="label-row" for="first_name"><?php _e( 'First name', 'personalize-login' ); ?></label></div>
            <input type="text" name="first_name" id="first-name">
        </p>
 
        <p class="form-row">
             <div class="label-row"><label class="label-row" for="last_name"><?php _e( 'Last name', 'personalize-login' ); ?></label></div>
            <input type="text" name="last_name" id="last-name">
        </p>
 
        <p class="form-row">
            <?php _e( 'Note: Your password will be generated automatically and sent to your email address.', 'personalize-login' ); ?>
        </p>

        <?php if ( $attributes['recaptcha_site_key'] ) : ?>
            <div class="recaptcha-container">
                <div class="g-recaptcha" data-sitekey="<?php echo $attributes['recaptcha_site_key']; ?>"></div>
            </div>
        <?php endif; ?>
 
        <p class="signup-submit">
            <input type="submit" name="submit" class="register-button"
                   value="<?php _e( 'Register', 'personalize-login' ); ?>"/>
        </p>
    </form>
</div>