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
						<span class="category_single">
						<?php the_field('news_source'); ?>
						<!-- <?php 
						$category = get_the_category();
						$firstCategory = $category[0]->cat_name;
						echo $firstCategory ;
						 ?>--></span> 
						<span class="date_single"><strong class="date-footer"><?php 
							$dateformatstring = "m/d/Y";
							$unixtimestamp = strtotime(get_field('date_footer_post'));
							echo date_i18n($dateformatstring, $unixtimestamp);

						 ?></strong>
						 </span>
						<div class="content_single"><?php the_content(); ?> </div>
						<span class="call_single"><a href="<?php the_field('source_url'); ?>" target="_blank">READ MORE</a></span>
				    </div>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_press') ?>
			</div>
			<div class="clear"></div>

	</div> <!-- /#primary.site-content.row -->




<?php get_footer(); ?>
