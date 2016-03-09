<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta http-equiv="cleartype" content="on">

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script type="text/javascript">
function date(){
	    var currentTime = new Date()
		var hours = currentTime.getHours()
		var minutes = currentTime.getMinutes()
		if (minutes < 10){
		minutes = "0" + minutes
		}
		document.write(hours + ":" + minutes + " ")
		if(hours > 11){
		document.write("PM")
		} else {
		document.write("AM")
		}
		}

</script>
<div id="wrapper" class="hfeed site">

	<div class="visuallyhidden skip-link"><a href="#primary" title="<?php esc_attr_e( 'Skip to main content', 'Retailwire' ); ?>"><?php esc_html_e( 'Skip to main content', 'Retailwire' ); ?></a></div>
		<div class="dont-miss">
			<p><a href="<?php echo home_url(); ?>/subscribe">SIGN-UP FOR RETAILWIRE NEWSLETTERS! DON’T MISS OUT!</a></p>
			<span class="close-miss"></span>
		</div>
	<div id="headerwrapper">	
	<div id="headercontainer">
		<header id="masthead" class="site-header row" role="banner">
			
			<div class="col grid_3_of_12 site-title">
				<div class="social-media-icons hide_ipad">
					<?php echo Retailwire_get_social_media(); ?>
				</div>
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
						<?php 
						$headerImg = get_header_image();
						if( !empty( $headerImg ) ) { ?>
							<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
						<?php } 
						else {
							echo get_bloginfo( 'name' );
						} ?>
					</a>
				</h1>
			</div> <!-- /.col.grid_5_of_12 -->

			<div class="col grid_9_of_12">
				<div class="top-right hide_ipad">
					<ul>
						<li>
						<?php 
						if (is_user_logged_in()){
							$current_user = wp_get_current_user();
						?>
							<a href="<?php echo home_url(); ?>/member-account"  class="regis"><?php echo $current_user->display_name;?></a>// <a href="<?php echo wp_logout_url( home_url() ); ?>"> Logout</a>// <a href="<?php echo home_url(); ?>/subscribe">Newsletter Sign Up</a>
						<?php } else{ ?>
							<a href="<?php echo home_url(); ?>/member-login" class="regis">Sign In For Discussions</a>// <a href="<?php echo home_url(); ?>/subscribe">Newsletter Sign Up</a>
						<?php }?>
						</li>
<!-- 						<li>
							<a href="<?php echo home_url(); ?>/subscribe"  class="join">Join the Braintrust</a>
						</li> -->
						<li class="form-seach-top">
							<a href="#" class="link-search">search</a>
							<div class="content-f-top">
								<?php get_search_form(); ?>	
							</div>
						</li>

					</ul>
				</div>
				<ul class="m-top-right show_ipad">
					<li>
						<?php 
							if (is_user_logged_in()){
								$current_user = wp_get_current_user();
							?>
								<a href="<?php echo home_url(); ?>/member-account"  class="m-regis"></a>
							<?php } else{ ?>
								<a href="<?php echo home_url(); ?>/member-login" class="m-regis"></a>
						<?php }?>
					</li> 
					<!-- <li><a href="<?php echo home_url(); ?>/subscribe" class="m-join"></a></li> -->
					<li><a href="#" class="m-link-search"></a></li>

				</ul>
				<nav id="site-navigation" class="main-navigation hide_ipad" role="navigation">
					<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'Retailwire' ); ?></h3>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'Retailwire' ); ?>"><?php esc_html_e( 'Skip to content', 'Retailwire' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav> <!-- /.site-navigation.main-navigation -->
			</div> <!-- /.col.grid_7_of_12 -->
			<div class="m-menu-top show_ipad">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'Retailwire' ); ?></h3>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'Retailwire' ); ?>"><?php esc_html_e( 'Skip to content', 'Retailwire' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav>
			</div>
			<span class="m-arrow-menu"></span>
			<span class="m-arrow-search"></span>
			<div class="menu-mobile">
				<div class="m-top-menu">
					<span class="close-menu"></span>
					<div class="search-mobile">
						<?php get_search_form(); ?>
					</div>
			    </div>
				<div class="m-bottom-menu">
					<ul class="nav-menu-mobile">
							<li>
								<?php 
								if (is_user_logged_in()){
									$current_user = wp_get_current_user();
								?>
									<a href="<?php echo home_url(); ?>/member-account"  class="regis"><?php echo $current_user->display_name;?></a><br><a href="<?php echo wp_logout_url( home_url() ); ?>"> Logout</a><br>// <a href="<?php echo home_url(); ?>/subscribe">Newsletter Sign Up</a>
								<?php } else{ ?>
									<a href="<?php echo home_url(); ?>/member-login" class="regis">Sign In For Discussions</a><br><a href="<?php echo home_url(); ?>/subscribe">Newsletter Sign Up</a>
								<?php }?>							
							</li>
<!-- 							<li>
								<a href="<?php echo home_url(); ?>/contact" class="join">join the braintrust</a>
							</li> -->
					</ul>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu-mobile' ) ); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'nav-menu-mobile' ) ); ?>
					
				</div>
				
			</div>
		</header> <!-- /#masthead.site-header.row -->

	</div> <!-- /#headercontainer -->
	</div>
	<div class="date-page">
		<div class="container">
			<span class="content-date">
				<?php echo date("l, m/d/Y"); ?>

			</span>
			
		</div>
	</div>

			<?php /*if ( is_front_page() ) {*/
				// Count how many banner sidebars are active so we can work out how many containers we need
				$bannerSidebars = 0;
				for ( $x=1; $x<=2; $x++ ) {
					if ( is_active_sidebar( 'frontpage-banner' . $x ) ) {
						$bannerSidebars++;
					}
				}

				// If there's one or more one active sidebars, create a row and add them
				if ( $bannerSidebars > 0 ) { ?>
					<?php
					// Work out the container class name based on the number of active banner sidebars
					$containerClass = "grid_" . 12 / 1 . "_of_12"; //$bannerSidebars

					

				}
			/*}*/ ?>
	

	<div id="maincontentcontainer">
		<?php	do_action( 'Retailwire_before_woocommerce' ); ?>