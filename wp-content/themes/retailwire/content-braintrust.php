								<?php 
				              		if(get_field('feat_brain')){ ?>
				              	<div class="item-braintrust">

									<div class="item-b-l">
				              			<span class="module-label title-brain">Braintrust</span>
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

								</div>
									

								<?php	} else {  ?>

								<div class="item-braintrust ">
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