
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */

/*
Template Name: Home page
*/

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l">
				
				<div class="group-discussion">
					<ul>

						<?php 
				          
				          $args = array(
				          	'post_type'=>'discussion',
				            'order' => 'desc',
				            'posts_per_page' => '3'
				          );

				          $wp_query = new WP_Query( $args );

				            if ( $wp_query->have_posts() ) {

				              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>

				              <li class="list-item">
				                <div class="item-braintrust">
									<span class="module-label title-brain">Braintrust</span>
									<?php $author_id = get_the_author_meta('ID');
										  $content_user = get_field('content', 'user_'. $author_id );
									 ?>
									
									<div class="desc"><?php echo $content_user; ?></div>
									<a class="link-name-author" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo get_the_author(); ?></h2></a>
									<div class="img-user">
										<a href="<?php echo get_author_posts_url($author_id); ?>">
											<?php echo get_avatar(get_the_author_meta()); ?>
										</a>
										
										
									</div>
									
								</div>
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
				              	

				              </li>
				              

				            <?php endwhile; // end of the loop.
				            wp_reset_query();
				      
				            
				            }?>
						


					</ul>

				</div>
			</div>
			<div class="sec-1-r">
				<div class="ad-2">
					<?php $background = of_get_option( 'ad_300x600', $background_defaults ); ?>
					 <img src="<?php echo esc_url( $background['image'] );  ?>">
				</div>
				<div class="tag">
					<?php dynamic_sidebar('tags'); ?>
				</div>
			</div>
			<div class="clear"></div>


		</div>
		<?php //get_sidebar(); ?>
		<div class="section-2">
			<a href="">
				<?php $background2 = of_get_option( 'ad_970x90', $background_defaults ); ?>
					 <img src="<?php echo esc_url( $background2['image'] );  ?>">
			</a>
		</div>
		<div class="section-3">
			<span class="module-label s3-resource">resources</span>
			<?php echo do_shortcode('[slide_resources id="owl-demo-2"]'); ?>
		</div>
		<?php //get_sidebar(); ?>
		<div class="section-4">
			<span class="module-label s4-retail">retail news</span>
			<div class="list-post" >
		    	<?php 
		        
		          $args = array(
		          	'post_type'=>'post',
		            'order' => 'desc',
		            'posts_per_page' => 12
		          );

		          $wp_query = new WP_Query( $args );

		            if ( $wp_query->have_posts() ) {

		              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
		              
		              <div class="sub-list-post <?php  if ( has_post_thumbnail() == '' ) { echo 'not-thumbnail'; } ?>">
		              	<a href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) { ?>
							<div class="thumnail-icon"><img src="<?php $thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size' , true);
								echo $thumb_url[0];?>" title="<?php the_title();?>"/></div>
							<?php } ?>
							</a>
							<div class="group-info">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="date">
									<span><?php the_category(); ?></span>
									<span class="full-date"><?php echo get_the_date('d/m/Y')?></span>
								</div>
							</div>
		              </div>

		            <?php endwhile; // end of the loop.
		            wp_reset_query();
		            
		            }?>

		    </div>
		</div>
		<div class="section-5">
			<div class="module sec-3-l">
				<div class="home-press">
					<span class="module-label title-press">PRESS RELEASES</span>
					<div class="list-press" >
				    	<?php 
				          $args2 = array(
				          	'post_type'=>'press_releases',
				            'order' => 'desc',
				            'posts_per_page' => 10
				          );

				          $wp_query = new WP_Query( $args2 );

				            if ( $wp_query->have_posts() ) {

				              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
				              
				              <div class="sub-list-press <?php  if ( has_post_thumbnail() == '' ) { echo 'not-thumbnail'; } ?>">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="date-press">
											<span class="cate_press"><?php the_category(); ?></span>
											<span class="full-date-sub"><?php echo get_the_date('d/m/Y'); ?></span>
										</div>
				              </div>

				            <?php endwhile; // end of the loop.
				            wp_reset_query();
				            }?>

				    </div>

				</div>
			</div>
			<div class="module sec-3-m">
				<div class="home-twitter">
					<span class="module-label title-twitter">TWITTER FEEDS</span>
					<div class="content-twitter">
						<div id="tabContaier">
							<ul>
						    	<li><span class="active" link="#tab1">Retailers</span></li>
						    	<li><span link="#tab2">Brands</span></li>
						    	<li><span link="#tab3">Braintrust</span></li>
								<li><span link="#tab4">Tech/Services</span></li>
						    </ul>
							
						    <div class="tabDetails">
						    	<div id="tab1" class="tabContents">
						        	<?php echo do_shortcode('[AIGetTwitterFeeds ai_username="rwfeed_retail" ai_numberoftweets="5"]'); ?>
						        </div>
						    	<div id="tab2" class="tabContents">
						        	<?php echo do_shortcode('[AIGetTwitterFeeds ai_username="rwfeed_bt" ai_numberoftweets="5"]'); ?>
						        </div>
						    	<div id="tab3" class="tabContents">
						        	<?php echo do_shortcode('[AIGetTwitterFeeds ai_username="rwfeed_tech" ai_numberoftweets="5"]'); ?>
						        </div>
								<div id="tab4" class="tabContents">
						        	<?php echo do_shortcode('[AIGetTwitterFeeds ai_username="rwfeed_rw" ai_numberoftweets="5"]'); ?>
						        </div>
								
						    </div>
						</div>

					</div>
					

					
					
				</div>
			</div>
			<div class="sec-3-r">
				<div class="space">
					<div class="ad-2">
						<?php $background = of_get_option( 'ad_300x250', $background_defaults ); ?>
						<img src="<?php echo esc_url( $background['image'] );  ?>">
					</div>
					<div class="ad-2">
						<?php $background = of_get_option( 'ad-300x250', $background_defaults ); ?>
						<img src="<?php echo esc_url( $background['image'] );  ?>">
					</div>
					<div class="ad-2">
						<?php $background = of_get_option( 'ad300x250', $background_defaults ); ?>
						<img src="<?php echo esc_url( $background['image'] );  ?>">
					</div>
				</div>
			</div>
		</div>
	</div> <!-- /#primary.site-content.row -->
<?php get_footer(); ?>
