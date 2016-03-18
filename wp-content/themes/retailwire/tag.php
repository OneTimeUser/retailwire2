<?php
/**
 * The template for displaying an archive page for Tags.
 *
 * @package Quark
 * @since Quark 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

			<div class="col grid_8_of_12">

				<?php //if ( have_posts() ) : ?>

					<header class="archive-header">
						<h1 class="archive-title"><?php printf( esc_html__( 'Tag Archives: %s', 'quark' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

						<?php if ( tag_description() ) { // Show an optional tag description ?>
							<div class="archive-meta"><?php echo tag_description(); ?></div>
						<?php } ?>
					</header>

					<?php // Start the Loop ?>
					<?php
						$term_id = get_query_var('tag_id');
						$query = new WP_Query( array( "post_type" => array("discussion", "resources"), "tag_id" => $term_id ) );
						$count = $query->post_count;

						?>
						<script>
						    console.log(<? echo json_encode($query); ?>);
						</script>
						<?php

						if ($query->have_posts() ){?>
					<?php while ($query->have_posts() ) { 
						$query->the_post(); ?>
					
						<?php get_template_part( 'template-parts/content', 'extract' ); ?>  <!-- 'extract'   -->
					<?php } ?>
						<?php Retailwire_content_nav( 'nav-below' ); ?>
					<?php }else{ ?>
						<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>
					<?php } ?>
			</div> <!-- /.col.grid_8_of_12 -->
			<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
