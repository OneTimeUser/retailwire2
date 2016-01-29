<?php
/**
 * The template for displaying an archive page for Categories.
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l braintrust-top">
				
			<?php if ( have_posts() ) : ?>
				<span class="s4-retail">braintrust // FROFILE</span>
				<div class="single-user">

					<div class="single-user-l col grid_2_of_12">

							<?php 
									  $author_id = get_the_author_id();
									  $author_facebook = get_field('facebook', 'user_'. $author_id );
						              $author_twitter = get_field('twitter', 'user_'. $author_id );
						              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
						              $author_position = get_field('position', 'user_'. $author_id );
						              $author_avata_user = get_field('avata_user', 'user_'. $author_id );
						              $author_content_user = get_field('content', 'user_'. $author_id );

						             
					        		?>	
					        		<ul class="list-single-user">
							        	 <li  class="item-single-user">
							        	 	 <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><img src="<?php echo $author_avata_user['url']; ?>"></a>
							        		 <ul class="list-so-user">
							        	 		<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li>
							        	 		<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li>
							        	 		<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li>
							        	 </li>
						        	</ul>
						        
					</div>
					<div class="single-user-r col grid_10_of_12">
						<h2 class="title-user-single"><?php echo get_the_author(); ?></a></h2>
						<span class="position-user"><?php echo $author_position; ?></span>
						<div class="content-single-user">
							<?php echo $author_content_user ?>
						</div>
						<div class="single-user-bottom">
							<div class="tab-single-user" id="tabContaier">
								<div class="group-title-top">
									<ul class="list-tab-dis">
										<li class="view-articles"><span link="#tab2">VIEW ARTICLES</a></li>
										<li class="view-comment"><span class="active" link="#tab1">VIEW COMMENT</a></li>
										
									</ul>

								</div>
								<div class="content-dis">
									<div class="tabDetails">
								    	<div id="tab1" class="tabContents">
								        	VIEW COMMENT
								        </div>
								        <div id="tab2" class="tabContents">
								        	<?php // Start the Loop 
								        	$my_query = new WP_Query( 'posts_per_page=2' );
								        	?>

											<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
												<?php get_template_part( 'content-author', get_post_format() ); ?>
											<?php endwhile; ?>
											<?php Retailwire_content_nav( 'nav-below' ); ?>
											<?php else : ?>

												<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

											<?php endif; // end have_posts() check ?>
								        </div>
								    	
										
								    </div>
									
									
								</div>

							</div>
							

						</div>
					</div>


				</div>

				

			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_braintrust') ?>
			</div>
			<div class="clear"></div>
		</div>
	

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
