
<li class="item-resource-2 <?php if (!has_post_thumbnail()) { echo "no-thumbnail";} ?>">
	<span class="categoris-re">

	 			<?php
				$terms = get_the_terms( $post->ID, 'categoris_resources' );
				if ( $terms && ! is_wp_error( $terms ) ) : 

					$draught_links = array();

					foreach ( $terms as $term ) {
						$draught_links[] = $term->name;
					}
										
					$on_draught = join( ", ", $draught_links );
				?>
				<?php echo $on_draught; ?>

				<?php endif; ?>
	 </span>
	 <a href="<?php the_permalink(); ?>" class="img-item-res">
	 	<?php if (has_post_thumbnail()) { ?>
				<img src="<?php
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
				 echo $thumb_url[0];?>" title="<?php the_title();?>"/>
		<?php } ?>
	</a>									
	<div class="info-resource">
		<span class="date-dis"><?php the_time('M d, Y'); ?></span>	
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="content-re"><?php the_excerpt(); ?> <!-- <strong class="date-footer"><?php 
			$dateformatstring = "d/m/Y";
			$unixtimestamp = strtotime(get_field('date_footer'));
			echo date_i18n($dateformatstring, $unixtimestamp);

		 ?></strong> -->
		 </div>
	</div>									
</li>
