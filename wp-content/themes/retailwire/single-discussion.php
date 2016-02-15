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

					<div class="content-single-dis">
						
							<div class="single-dis-l">
								<div class="item-discussion">
					              		<span class="module-label title-dis">
					              			Discussion
					              		</span>
					              		<?php

										if ( has_post_thumbnail() ) { ?>
											<img src="<?php
								            $thumb_id = get_post_thumbnail_id();
								            $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
								            echo $thumb_url[0];?>" title="<?php the_title();?>"/>
										<?php }
										else { ?>
											<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/post-2.jpg" />
										<?php }
										?>
						                  
								         <div class="info-dis">
								         		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								         		<div class="info-bottom">
								         			<span class="date-dis"><?php the_time('M d,2015'); ?></span>	
								         			<span class="info-right"><span class="comment"> <?php comments_number( '0', '1', '%'); ?></span> <span class="share">34</span></span>
								         		</div>
								         </div>  
					            </div>
					            <div class="content-post">
					            	<!-- <div class="small-ad"><?php echo adrotate_ad(3); ?></div>  -->
				              		<?php the_content(); ?>
				              		<div class="article-author"><?php the_author(); ?> </div>
				              		<div class="article-tags"><?php the_tags('',', ',''); ?></div>
				              		<div class="article-excerpt"><?php the_excerpt(); ?></div>
					              	<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() ) {
										comments_template( '', true );
									}
									?>
				         		</div>
				            </div>
						<div class="single-dis-r">
							<?php get_template_part( 'content-braintrust-discussion', get_post_format() ); ?>
							
						</div>
				      </div>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="sec-1-r">
				<div class="ad-2">
					<?php $background = of_get_option( 'ad_300x600', $background_defaults ); ?>
					 <img src="<?php echo esc_url( $background['image'] );  ?>">
				</div>
				<?php dynamic_sidebar('sidebar_discussion') ?>

				<span class="s3-resource">resources</span>
		
				<?php echo do_shortcode('[slide_resources id="owl-demo"]'); ?>
			</div>
			<div class="clear"></div>

	</div> <!-- /#primary.site-content.row -->




<?php get_footer(); ?>
