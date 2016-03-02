<li class="item-dis-2">
   <a href="<?php the_permalink(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
			<img src="<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
			 echo $thumb_url[0];?>" title="<?php the_title();?>"/>										
	<?php } else { ?>
			<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/post-2.jpg" />
			<?php } ?>											
	</a>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="bottom-dis-2">
		<span class="date-dis"><?php the_time('M d,Y'); ?></span>	
		<span class="info-right"><span class="comment"> <span><?php the_permalink();?>#disqus_thread"></span></span><span class="share">
							         				<?php
								         				$json = file_get_contents('http://api-public.addthis.com/url/shares.json?url='.get_post_permalink().'');
														$obj = json_decode($json);
														echo $obj->shares;
							         				?>
							         			</span></span>
	</div>							
</li>