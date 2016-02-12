
<li class="item-resource-2 no-thumbnail" >
	<div class="info-resource">
		<span class="date-dis"><?php the_time('M d, Y'); ?></span>	
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="content-re"><?php echo get_excerpt('200'); ?>.. <strong class="date-footer"><?php 
			$dateformatstring = "m/d/Y";
			$unixtimestamp = strtotime(get_field('date_footer_post'));
			echo date_i18n($dateformatstring, $unixtimestamp);

		 ?></strong></div>
	</div>									
</li>
