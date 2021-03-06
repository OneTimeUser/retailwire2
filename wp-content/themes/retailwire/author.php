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
									  $author_id = $author->ID;
									  $author_email = get_the_author_meta( 'user_email', $author_id );
									  $author_facebook = get_field('facebook', 'user_'. $author_id );
						              $author_twitter = get_field('twitter', 'user_'. $author_id );
						              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
						              $author_position = get_field('position', 'user_'. $author_id );
						              $author_avata_user = get_field('avata_user', 'user_'. $author_id );
						              $author_bio_user = get_field('description', 'user_'. $author_id );
						              $author_content_user = get_field('content', 'user_'. $author_id );
						              $output = '';
						              						             
					        		?>	
					        			<?php	$args = array(
												'posts_per_page'   => 10,
												'author'	   => $author_id,
												'author_email'=>$author_email,
												'post_status'      => 'publish',
												'post_type'		   => 'discussion',
												'orderby'          => 'date',
												'order'            => 'DESC',
												
												);

					        			

					        			

										//$comments = get_comments($com);
										// foreach($comments as $comment) :
										// 	echo($comment->comment_author);
										// endforeach;
										
						              	$author_posts = get_posts(($args) ); 
						              	// $comments = get_comments( ($com) );	 ?>
						              	

										
					        		
					        		<ul class="list-single-user">
							        	 <li  class="item-single-user">
							        	 	 <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>
							        		 <ul class="list-so-user">
							        	 		<?php if ($author_facebook) { ?>
							        	 			<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li> <?php } else { ?>
							        	 			<li><span class="icon-face-user inactive">fa</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_twitter) { ?>
							        	 			<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li> <?php } else { ?>
							        	 			<li><span class="icon-tt-user inactive">tt</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_linked_in) { ?>
							        	 			<li><a href="<?php echo $author_linked_in; ?>" class="icon-in-user">gg</a></li> <?php } else { ?>
							        	 			<li><span class="icon-in-user inactive">gg</span></li> 
							        	 		<?php } ?>
							        	 </li>
						        	</ul>
						    
					</div>
					<div class="single-user-r col grid_10_of_12">
						<h2 class="title-user-single"><span><?php echo $author->display_name ; ?></span></h2>
						<span class="position-user"><?php echo $author_position; ?></span>
						<div class="content-single-user">
							<?php echo $author_content_user ?>
							<?php echo $author_bio_user ?>
						</div>
						<div class="single-user-bottom">
							<div class="tab-single-user" id="tabContaier">
								<div class="group-title-top">
									<ul class="list-tab-dis">
										<li class="view-articles"><span link="#tab2">VIEW ARTICLES</span></li>
										<li class="view-comment"><span class="active" link="#tab1">VIEW COMMENT</span></li>
										
									</ul>

								</div>
								<div class="content-dis">
									<div class="tabDetails">
								    	<div id="tab1" class="tabContents">
								    		<?php
												
												$comm = array(
													'author_email' => $author_email, // use user_id
													'status' => 'approve',
												);
												$comments = get_comments($comm);

												// foreach($comments as $comment) :
												// 	echo($comment->comment_content);
												// endforeach;
												
											if ( $comments )
											        {
											            $output.= "<ul class='profile-comments'>\n";
											            foreach ( $comments as $c )
											            {
											            $output.= '<li>';
											            $output.= '<span>';
											            $output.= 'Posted on: '. mysql2date('m/d/Y', $c->comment_date, $translate);
											            $output.= '</span>';
											            $output.= '<h2>';
											            if ( $pretty_permalink ) // uses a lot more queries (not recommended)
											                $output.= '<a href="'.get_comment_link( $c->comment_ID ).'">';
											            else
											                $output.= '<a href="'.get_settings('siteurl').'/?p='.$c->comment_post_ID.'#comment-'.$c->comment_ID.'">';         
											            $output.= get_the_title($c->comment_post_ID);
											            $output.= '</a></h2>';
											            
											            $output.= '<div class="content-re">';
											            $output.= $c->comment_content;
											            $output.= '</div>';
											            $output.= "</li>\n";
											            }
											            $output.= '</ul>';
											            echo $output;
											        }
											      else { echo "No comments made";} ?>
											    <script>
											    console.log(<?php echo json_encode($comm); ?>);
											     console.log(<?php echo json_encode($args); ?>);
											    console.log(<?php echo json_encode($comments); ?>);
												</script>
								        </div>
								        <div id="tab2" class="tabContents">
								        	<?php	foreach ( $author_posts as $post ) : ?>
												<?php get_template_part( 'content-author', get_post_format() ); ?>
												<?php endforeach; ?>
											
									
							
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
