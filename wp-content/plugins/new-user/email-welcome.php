
<!-- wp-content/plugins/user-emails/email_welcome.php -->
 
<a href="<?php echo $siteUrl; ?>"><img src="<?php echo $logoUrl; ?>" alt="RetailWire"/></a>
 
<?php if ( $user->first_name != '' ) : ?>
<h1><?php echo $user->first_name; ?>, Welcome to RetailWire</h1>
<?php else : ?>
    <h1>Welcome to RetailWire</h1>
<?php endif; ?>
 
<p>
    Thanks for registering with us! Now it's time to set your password.  Visit the following address:
</p>
<p>
	<?php network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login'); ?>
</p>
<p>
	Login, update your password and take a moment to fill in your profile.  Then continue on and read the latest in retail news and discussions. If you have any problems, please contact us at <?php get_option('admin_email') ) ?>.  Thanks again.
</p>
 
<p>
    
</p>
 
<p>
    Thank you,<br>
    <a href="<?php echo $siteUrl; ?>">RetailWire</a>
</p>
