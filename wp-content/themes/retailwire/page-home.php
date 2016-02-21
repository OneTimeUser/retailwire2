
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

				              while ( $wp_query->have_posts() ) : $wp_query->the_post();
				              $featured= get_field('featured');
				              //var_dump($featured);

				              ?>
				              <?php if($featured == true){ ?>

				              <li class="list-item item-home">
				                
				              	<div class="item-discussion">
				              		<span class="module-label title-dis">
				              			Discussion
				              		</span>
				              		<div class="thumb-wrapper">
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
					                </div>  
							         <div class="info-dis">
							         		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							         		<div class="info-bottom">
							         			<span class="date-dis"><?php the_time('M d,2015'); ?></span>	
							         			<span class="info-right"><span class="comment"> <?php comments_number( '0', '1', '%'); ?></span> <span class="share">34</span></span>
							         		</div>
							         </div>  

				              	</div>
				              	<?php get_template_part( 'content-braintrust', get_post_format() ); ?>
				              </li>
				              <?php } ?>
				              

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

					// Display the active banner sidebars
					for ( $x=2; $x<=2; $x++ ) {
						if ( is_active_sidebar( 'frontpage-banner'. $x ) ) { ?>
							<div class="col <?php echo $containerClass?>">
								<div class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'frontpage-banner'. $x ); ?>
								</div> <!-- /.widget-area -->
							</div> <!-- /.col.<?php echo $containerClass?> -->
						<?php }
					} ?>

				<?php }
			/*}*/ ?>
			<a href="">
				<?php $background2 = of_get_option( 'ad_970x90', $background_defaults ); ?>
					 <img src="<?php echo esc_url( $background2['image'] );  ?>">
			</a>
		</div>
		<div class="section-3">
			<span class="s3-resource">resources</span>
			<?php echo do_shortcode('[slide_resources id="owl-demo-2"]'); ?>
		</div>
		<?php //get_sidebar(); ?>
		<div class="section-4">
			<span class="s4-retail">retail news</span>
			<div class="list-post" >
		    	<?php 
		        
		          $args = array(
		          	'post_type'=>'post',
		            'order' => 'desc',
		            'posts_per_page' => 8
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
									<span><?php the_field('news_source'); ?></span>
									
									<span class="full-date"><?php echo get_the_date('m/d/Y')?></span>
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
										<h3><a href="<?php the_field('pr_url'); ?>"><?php the_title(); ?></a></h3>
										<div class="date-press">
											<span class="cate_press"><?php the_field('pr_source'); ?></span>
											<span class="full-date-sub"><?php echo get_the_date('m/d/Y'); ?></span>
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
								<li><span link="#tab5">RW</span></li>
						    </ul>
							
						    <div class="tabDetails">
						    	<div id="tab1" class="tabContents">
						        	<?php echo do_shortcode('[db_twitter_feed feed_type="list" count="6" user="rwfeed_retail" list="Retailers/rwfeed_retail"]'); ?>
						        </div>
						    	<div id="tab2" class="tabContents">
						    		<?php echo do_shortcode('[db_twitter_feed feed_type="list" count="6" user="rwfeed_brand" list="brand/rwfeed_brand"]'); ?>
						    </div>
						    	<div id="tab3" class="tabContents">
						        	<?php echo do_shortcode('[db_twitter_feed feed_type="list" count="6" user="rwfeed_bt" list="braintrust/rwfeed_bt"]'); ?>
						        </div>
								<div id="tab4" class="tabContents">
						        	<?php echo do_shortcode('[db_twitter_feed feed_type="list" count="6" user="rwfeed_tech" list="tech/rwfeed_tech"]'); ?>
						        </div>
						        <div id="tab5" class="tabContents">
						        	<?php echo do_shortcode('[db_twitter_feed count="6" user="retailwire]'); ?>
						        </div>
								
						    </div>
						</div>

					</div>
					

					
					
				</div>
			</div>
			<div class="sec-3-r">
				<div class="space">
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
				//$containerClass = "grid_" . 12 / $footerSidebars . "_of_12";

				// Display the active footer sidebars
				for ( $x=1; $x<=4; $x++ ) {
					if ( is_active_sidebar( 'sidebar-footer'. $x ) ) { ?>
						<!--<div class="col <?php echo $containerClass?>">-->
							<div class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-footer'. $x ); ?>
							</div>
						<!--</div>--> <!-- /.col.<?php echo $containerClass?> -->
					<?php }
				} ?>

			<?php } ?>

				</div>
			</div>
		</div>
	</div> <!-- /#primary.site-content.row -->
<?php get_footer(); ?>
