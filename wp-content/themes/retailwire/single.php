<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
			<div class="sec-1-l">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="content-single-dis ">
						<span class="s4-retail">Retail News</span>
						<h1 class="title_single"><?php the_title(); ?></h1>
						<span class="category_single"><?php 
						$category = get_the_category();
						$firstCategory = $category[0]->cat_name;
						echo $firstCategory ;
						 ?></span>
						<span class="date_single"><?php the_time( 'm/d/Y' ); ?></span>
						<div class="content_single"><?php the_content(); ?> </div>
				    </div>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_press') ?>
			</div>
			<div class="clear"></div>

	</div> <!-- /#primary.site-content.row -->




<?php get_footer(); ?>
