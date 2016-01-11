<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package Quark
 * @since Quark 1.0
 */
?>

		<?php	do_action( 'quark_after_woocommerce' ); ?>
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
						<?php echo quark_get_social_media(); ?>
					</div>
					<?php if ( of_get_option( 'footer_content', quark_get_credits() ) ) {
						echo '<div class="row smallprint">';
						echo apply_filters( 'meta_content', wp_kses_post( of_get_option( 'footer_content', quark_get_credits() ) ) );
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
<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".tabContents").hide(); // Ẩn toàn bộ nội dung của tab
		$(".tabContents:first").show(); // Mặc định sẽ hiển thị tab1
		
		$("#tabContaier ul li span").click(function(){ //Khai báo sự kiện khi click vào một tab nào đó
			
			var activeTab = $(this).attr("link"); 
			$("#tabContaier ul li span").removeClass("active"); 
			$(this).addClass("active"); 
			$(".tabContents").hide(); 
			$(activeTab).fadeIn(); 
		});
	});
</script>
</body>

</html>