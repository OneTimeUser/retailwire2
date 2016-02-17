
									<?php 
				              		if(get_field('feat_comm')){ ?>
				              		<div class="item-braintrust">	
									<span class="module-label title-brain">Braintrust</span>
									
										<div class="item-b-l">
				              			
										<?php //$author_id = get_the_author_meta('ID');
											  //$content_user = get_field('content', 'user_'. $author_id );
											  $username = get_field('feat_brain');
											  $user_id = $username['ID'];
										 ?>
										<div class="desc">"<?php the_field('feat_comm'); ?>"</div>
										</div>
										<div class="item-b-r">
											<a class="link-name-author" href="<?php echo get_author_posts_url($user_id); ?>"><h2><?php echo $username["display_name"]; ?></h2></a>
											<div class="img-user">
												<a href="<?php echo get_author_posts_url($user_id); ?>">
													<?php 
													 $size="110";
													 echo get_avatar($user_id,$size);
													 ?>
												</a>
											</div>
											<a class="link-name-author show-600" href="<?php echo get_author_posts_url($user_id); ?>"><h2><?php echo $username["display_name"]; ?></h2></a>
										</div>
										<div class="line-5"></div>
									
									<?php 
				              		if(get_field('feat_comm_2')){ ?>

									
										<div class="item-b-l">
					              			
											<?php $username2 = get_field('feat_brain_2');
											  		$user_id2 = $username2['ID'];
											 ?>
										<div class="desc">"<?php the_field('feat_comm_2'); ?>"</div>
									</div>
									<div class="item-b-r">
										<a class="link-name-author" href="<?php echo get_author_posts_url($user_id2); ?>"><h2><?php echo $username2["display_name"]; ?></h2></a>
										<div class="img-user">
											<a href="<?php echo get_author_posts_url($user_id2); ?>">
												<?php 
												 $size="110";
												 echo get_avatar($user_id2,$size);
												 ?>
											</a>
										</div>
										<a class="link-name-author show-600" href="<?php echo get_author_posts_url($user_id2); ?>"><h2><?php echo $username2["display_name"]; ?></h2></a>
									</div>
										<div class="line-5"></div>
									
									<?php } 
									if(get_field('feat_comm_3')){ ?>
								
										<div class="item-b-l">
					              			
											<?php $username3 = get_field('feat_brain_3');
											  		$user_id3 = $username3['ID'];
											 ?>
										<div class="desc">"<?php the_field('feat_comm_3'); ?>"</div>
									</div>
									<div class="item-b-r">
										<a class="link-name-author" href="<?php echo get_author_posts_url($user_id3); ?>"><h2><?php echo $username3["display_name"]; ?></h2></a>
										<div class="img-user">
											<a href="<?php echo get_author_posts_url($user_id3); ?>">
												<?php 
												 $size="110";
												 echo get_avatar($user_id3,$size);
												 ?>
											</a>
										</div>
										<a class="link-name-author show-600" href="<?php echo get_author_posts_url($user_id3); ?>"><h2><?php echo $username3["display_name"]; ?></h2></a>
									</div>
										
									
				              		
									</div>
								
								<?php } ?>
								<?php	} else {  ?>

								<div class="item-braintrust">
				              		<div class="item-b-l">
				              			<span class="module-label title-brain">Braintrust</span>
										<?php //$author_id = get_the_author_meta('ID');
											  //$content_user = get_field('content', 'user_'. $author_id );
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