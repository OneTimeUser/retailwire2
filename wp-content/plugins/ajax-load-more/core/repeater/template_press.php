<div class="sub-list-press <?php  if ( has_post_thumbnail() == '' ) { echo 'not-thumbnail'; } ?>">
		<h3><a href="<?php the_field('pr_url'); ?>" target="_blank"><?php the_title(); ?></a></h3>
		<div class="date-press">
			<span class="cate_press"><?php the_field('pr_source'); ?></span>
			<span class="full-date-sub"><?php echo get_the_date('m/d/Y'); ?></span>
		</div>
</div>