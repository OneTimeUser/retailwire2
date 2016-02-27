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
				
		
				<span class="s4-retail">PROFILE</span>
				<div class="single-user">
					<div class="single-user-l col grid_2_of_12">
							<?php 
									  $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
									  //var_dump($author);
									  $author_id = $author->ID;;
									  $author_facebook = get_field('facebook', 'user_'. $author_id );
						              $author_twitter = get_field('twitter', 'user_'. $author_id );
						              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
						              $author_position = get_field('position', 'user_'. $author_id );
						              $author_avata_user = get_field('avata_user', 'user_'. $author_id );
						              $author_content_user = get_field('content', 'user_'. $author_id );
						             
					        		?>	
					        		<ul class="list-single-user">
							        	 <li  class="item-single-user">
							        	 	 <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>
							        		 <ul class="list-so-user">
							        	 		<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li>
							        	 		<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li>
							        	 		<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li>
							        	 </li>
						        	</ul>
						    
					</div>
					<div class="single-user-r col grid_10_of_12">
						<h2 class="title-user-single"><?php echo $author->display_name ; ?></a></h2>
						<span class="position-user"><?php echo $author_position; ?></span>
						<div class="content-single-user">
							<?php echo $author_content_user ?>
						</div>
						<div class="single-user-bottom">
							<div class="tab-single-user" id="tabContaier">
								<div class="group-title-top">
									<ul class="list-tab-dis">
										<li class="view-articles"><span class="active" link="#tab2">VIEW ARTICLES</a></li>
										<li class="view-comment"><span link="#tab1">VIEW COMMENT</a></li>
										
									</ul>

								</div>
								<div class="content-dis">
									<div class="tabDetails">
								    	<div id="tab1" class="tabContents">
								        	
								        </div>
								        <div id="tab2" class="tabContents">
								        	<?php // Start the Loop 
								        	$my_query = new WP_Query( 'posts_per_page=5' );
								        	?>

											<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
												<?php get_template_part( 'content-author', get_post_format() ); ?>
											<?php endwhile; ?>
											<?php Retailwire_content_nav( 'nav-below' ); ?>
											

												
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
