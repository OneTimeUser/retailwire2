<?php
/**
 * /**
 * Template Name: Newsletter Form
 *
 * @package WordPress
 * 
 * @since Twenty Fourteen 1.0
 *
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */
get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_12_of_12">

			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'notitle' ); ?> <!-- 'template-parts/content', 'notitle' -->
				<?php endwhile; ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_8_of_12 -->
		

	</div> <!-- /#primary.site-content.row -->
	
<?php
wp_enqueue_script( 'validate' );
//Enable jQuery validate on this page so we can validate any forms
?>
<script>
	jQuery(document).ready(function() {
		jQuery('#primary form').validate();
	});
</script>
	
<?php get_footer(); ?>

