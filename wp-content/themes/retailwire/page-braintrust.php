
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
Template Name: Braintrust page
*/

get_header(); ?>


<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l braintrust-top">
				<span class="s4-retail module-label">braintrust // FEATURED</span>
				<ul class="list-braintrust-page">
					<?php
						$args  = array(
						    'role' => 'Author'
						);

						// Create the WP_User_Query object
						global $wp_query;
						$wp_query = new WP_User_Query($args);

						// Get the results
						$authors = $wp_query->get_results();

						if($authors): ?>
							
						   
						        <?php foreach($authors as $author) : ?>
						        	<?php $author_id = $author->ID;
									  $author_facebook = get_field('facebook', 'user_'. $author_id );
						              $author_twitter = get_field('twitter', 'user_'. $author_id );
						              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
						              $author_position = get_field('position', 'user_'. $author_id );
						              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

					        		?>
						        	 <li  class="list-user">
						             <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>
						        	 <ul class="list-so-user">
						        	 		<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li>
						        	 		<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li>
						        	 		<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li>
						        	 </ul>
						        	 <h2 class="title-user"><a href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo $author->display_name; ?></a></h2>
						        	 <span class="position-user"><?php echo $author_position; ?></span>
						        	 
						        	 	
						        	</li>
						        <?php endforeach; ?>
						    
						<?php else: ?>

						    <div class="post">
						        <p>Sorry, no posts matched your criteria.</p>
						    </div>
						<?php endif; ?>

				</ul>
			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_braintrust') ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="braintrust-all">
			<span class="s4-retail module-label">Braintrust // all</span>
			<div class="content-braintrust-all">
				 <ul class="list-braintrust-bottom">
					<?php
						$args  = array(
						    'role' => 'Contributor'
						);

						// Create the WP_User_Query object
						global $wp_query;
						$wp_query = new WP_User_Query($args);

						// Get the results
						$authors = $wp_query->get_results();

						if($authors): ?>
							
						   
						        <?php foreach($authors as $author) : ?>
						        	<?php $author_id = $author->ID;
									  $author_facebook = get_field('facebook', 'user_'. $author_id );
						              $author_twitter = get_field('twitter', 'user_'. $author_id );
						              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
						              $author_position = get_field('position', 'user_'. $author_id );
						              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

					        		?>
						        	 <li  class="list-user-bottom">
						            	<h2 class="title-user"><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo $author->display_name; ?></a></h2>
						        	 	<span class="position-user"><?php echo $author_position; ?></span>
						        		 <ul class="list-so-user">
						        	 		<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li>
						        	 		<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li>
						        	 		<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li>
						        	 </ul>
						        	 
						        	 	
						        	</li>
						        <?php endforeach; ?>
						    
						<?php else: ?>

						    <div class="post">
						        <p>Sorry, no posts matched your criteria.</p>
						    </div>
						<?php endif; ?>
					</ul>

			</div>
		</div>
		<?php //get_sidebar(); ?>
	</div> <!-- /#primary.site-content.row -->
<?php get_footer(); ?>

