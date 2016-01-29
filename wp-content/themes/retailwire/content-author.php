<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" class="theme-post-1">
		<div class="item-dis-2">
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
				<span class="date-dis">Jan 05,2015</span>	
				<span class="info-right">
					<span class="comment"> 0</span><span class="share">34</span>
				</span>
			</div>							
		</div>
	</article> <!-- /#post -->
