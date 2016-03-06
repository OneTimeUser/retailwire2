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