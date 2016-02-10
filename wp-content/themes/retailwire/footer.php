<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */
?>

		<?php	do_action( 'Retailwire_after_woocommerce' ); ?>
	</div> <!-- /#maincontentcontainer -->

	<div id="footercontainer">

		<footer class="site-footer row" role="contentinfo">

			<?php
			// Count how many footer sidebars are active so we can work out how many containers we need
			$footerSidebars = 0;
			for ( $x=1; $x<=4; $x++ ) {
				if ( is_active_sidebar( 'sidebar-footer' . $x ) ) {
					$footerSidebars++;
				}
			}

			// If there's one or more one active sidebars, create a row and add them
			if ( $footerSidebars > 0 ) { ?>
				<?php
				// Work out the container class name based on the number of active footer sidebars
				$containerClass = "grid_" . 12 / $footerSidebars . "_of_12";

				// Display the active footer sidebars
				for ( $x=1; $x<=4; $x++ ) {
					if ( is_active_sidebar( 'sidebar-footer'. $x ) ) { ?>
						<div class="col <?php echo $containerClass?>">
							<div class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-footer'. $x ); ?>
							</div>
						</div> <!-- /.col.<?php echo $containerClass?> -->
					<?php }
				} ?>

			<?php } ?>

		</footer> <!-- /.site-footer.row -->
		<div class="footer-bottom">
			<div class="container">
				<div class="col grid_8_of_12">
					<div class="menu-footer m-menu-footer">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu' ) ); ?>
					</div>
					<div class="logo-footer">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
								<?php 
								$headerImg = get_header_image();
								if( !empty( $headerImg ) ) { ?>
									<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
								<?php } 
								 ?>
							</a>

					</div>
					<div class="menu-footer">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu' ) ); ?>

					</div>

				</div>
				<div class="col grid_4_of_12">
					<div class="social-media-icons  social-footer">
						<?php echo Retailwire_get_social_media(); ?>
					</div>
					<?php if ( of_get_option( 'footer_content', Retailwire_get_credits() ) ) {
						echo '<div class="row smallprint">';
						echo apply_filters( 'meta_content', wp_kses_post( of_get_option( 'footer_content', Retailwire_get_credits() ) ) );
						echo '</div> <!-- /.smallprint -->';
					} ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		

	</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/hmac.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.close-miss').click(function(){
	      $('.dont-miss').fadeOut(1000);
	    });


		$(".tabContents").hide(); 
		$(".tabContents:first").show(); 
		
		$("#tabContaier ul li span").click(function(){ 
			var activeTab = $(this).attr("link"); 
			$("#tabContaier ul li span").removeClass("active"); 
			$(this).addClass("active"); 
			$(".tabContents").hide(); 
			$(activeTab).fadeIn(); 
		});
			
	  $("#owl-demo").owlCarousel({
	      navigation : true, 
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      singleItem:true
	 
	  });
	  $("#owl-demo-2").owlCarousel({
	      navigation : true, 
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      items : 3,
		  itemsCustom : [
	        [1600, 3]
	      ]
	  });

	  $('.m-arrow-menu,.m-arrow-search').click(function(){
              $('.menu-mobile').slideToggle(500);
        })
	  $('.close-menu').click(function(){
              $('.menu-mobile').slideToggle(500);
              
        })

	   $(window).scroll(function() {
		if ($(this).scrollTop() > 200){  
		    $('#headercontainer').addClass("sticky");
		  }
		  else{
		    $('#headercontainer').removeClass("sticky");
		  }
		});
	  /* $(window).bind('resize', function(e){*/
 
 		   	if( $(window).width()<=768 ) {
 	          	$('.addthis_toolbox').detach().appendTo(".share-post-mobile");
 	        }else {
 	        	$('.addthis_toolbox').detach().appendTo(".content-post");
 	        }
  
 		/*});*/
 	   	$('.link-search').click(function(){
               $('.content-f-top').slideToggle(500);
         })





	});

</script>
<script type="text/javascript">
var disqus_config = function () {
    // The generated payload which authenticates users with Disqus
    this.page.remote_auth_s3 = '<message> <hmac> <timestamp>';
    this.page.api_key = '2jV4kkaizbc8U4auShxMeRCzFUA0hO8mX3pKfmkCPPj81xi58G1FVyEDwPTnJi1j';

// This adds the custom login/logout functionality
    this.sso = {
          name:   "SampleNews",
          button:  "http://retailwire.icodedark.com/wp-content/uploads/2016/01/img-post.png",
          icon:     "http://retailwire.icodedark.com/wp-content/uploads/2016/01/img-post.png",
          url:        "retailwire.icodedark.com/login/",
          logout:  "retailwire.icodedark.com/login",
          width:   "800",
          height:  "400"
    };
};
</script>
<!-- Start of Async HubSpot Analytics Code -->
  <script type="text/javascript">
    (function(d,s,i,r) {
      if (d.getElementById(i)){return;}
      var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
      n.id=i;n.src='//js.hs-analytics.net/analytics/'+(Math.ceil(new Date()/r)*r)+'/452866.js';
      e.parentNode.insertBefore(n, e);
    })(document,"script","hs-analytics",300000);
  </script>
<!-- End of Async HubSpot Analytics Code -->
</body>

</html>

