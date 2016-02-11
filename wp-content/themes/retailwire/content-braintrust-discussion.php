		<?php $num_comment=get_comments_number();
				              		if($num_comment > 0){ ?>
				              		<div class="item-braintrust">	
									<span class="module-label title-brain">Braintrust</span>

				              		<?php $args = array(
									    'number' => 10000,
									    'post_id' => $post->ID,
									    'status' => 'approve'
									);?>
									<?php $latest_comment = get_comments($args);


									if( $latest_comment ) foreach( $latest_comment as $comment ) { 
										
										$vote = get_comment_meta( $comment->comment_ID, 'age1', true );
										//var_dump($vote);
										if($vote=="on"){
										?>

									<div class="item-b-l">
				              			
										<?php $author_id = get_the_author_meta('ID');
											  $content_user = get_field('content', 'user_'. $author_id );
										 ?>
									<div class="desc">"<?php echo wp_html_excerpt( $comment->comment_content, 100 ); ?>"</div>
									</div>
									<div class="item-b-r">
										<a class="link-name-author" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo $comment->comment_author; ?>:</h2></a>
										<div class="img-user">
											<a href="<?php echo get_author_posts_url($author_id); ?>">
												<?php 
												 $size="110";
												 echo get_avatar($author_id,$size);
												 ?>
											</a>
										</div>
										<a class="link-name-author show-600" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo get_the_author(); ?></h2></a>
									</div>

									<?php }?> 

									<?php if($vote==""){
										?>
									<div class="item-b-l">
				              			
										<?php $author_id = get_the_author_meta('ID');
											  $content_user = get_field('content', 'user_'. $author_id );
										 ?>
									<div class="desc">"<?php echo wp_html_excerpt( $comment->comment_content, 100 ); ?>"</div>
									</div>
									<div class="item-b-r">
										<a class="link-name-author" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo $comment->comment_author; ?>:</h2></a>
										<div class="img-user">
											<a href="<?php echo get_author_posts_url($author_id); ?>">
												<?php 
												 $size="110";
												 echo get_avatar($author_id,$size);
												 ?>
											</a>
										</div>
										<a class="link-name-author show-600" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo get_the_author(); ?></h2></a>
									</div>
									<?php } ?>
									<?php } ?>
				              		
									
								</div>
								<?php	} else {  ?>

								<div class="item-braintrust ">
				              		<div class="item-b-l">
				              			<span class="module-label title-brain">Braintrust</span>
										<?php $author_id = get_the_author_meta('ID');
											  $content_user = get_field('content', 'user_'. $author_id );
										 ?>
									<div class="desc"><!--
									<?php echo $content_user; ?> -->
									</div>
									</div>
									<div class="item-b-r">
										<!--
										<a class="link-name-author" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo get_the_author(); ?></h2></a>
										<div class="img-user">
											<a href="<?php echo get_author_posts_url($author_id); ?>">
												<?php 
												 $size="110";
												 echo get_avatar($author_id,$size);
												 ?>
											</a>
										</div>

										<a class="link-name-author show-600" href="<?php echo get_author_posts_url($author_id); ?>"><h2><?php echo get_the_author(); ?></h2></a>
										-->
									</div>
									
								</div>

								<?php } ?>