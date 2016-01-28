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
						<div class="wrap-fix">
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
					            	<div class="small-ad"></div>
					            
				              		<?php the_content(); ?>
				              		<div class="article-author"><?php the_author(); ?> </div>
				              		<div class="article-tags"><?php the_tags('',', ',''); ?></div>
					              	<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() ) {
										comments_template( '', true );
									}
									?>
				         		</div>
				             </div>
						</div>
						<div class="single-dis-r">
							<div class="item-braintrust">
									<span class="module-label title-brain">Braintrust</span>
									<div class="desc">"Part of what we are seeing is a deep shift in retail tectonics and Wall Street seems to be oblivious to the change"</div>
									<div class="img-user">
										<a href="<?php echo get_the_author_link(); ?>">
											<?php echo get_avatar(get_the_author_meta()); ?>
										</a>
										
									</div>
									<div class="link-name-author"><h2><?php echo get_the_author(); ?></h2></div>
								</div>
							
						</div>

						
				              	
				      </div>
				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_discussion') ?>
			</div>
			<div class="clear"></div>

	</div> <!-- /#primary.site-content.row -->




<?php get_footer(); ?>
