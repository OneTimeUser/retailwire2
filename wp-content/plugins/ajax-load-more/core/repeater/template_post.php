
<li class="item-resource-2 no-thumbnail" >
	<div class="info-resource retail-news-listing">
		<span class="date-dis"><?php //the_time('M d, Y'); ?></span>
		<h2><a href="<?php the_field('source_url'); ?>" target="_blank"><?php the_title(); ?></a></h2>
		<div class="content-re"><?php the_content(); ?>
		<div class="date"><span><?php echo get_field('news_source') ?></span>
		<span class="date-footer">

		<?php 
			$dateformatstring = "m/d/Y";
			$unixtimestamp = strtotime(get_field('date_footer_post'));
			echo date_i18n($dateformatstring, $unixtimestamp);

		 ?></span>
		 </div>
		 </div>
	</div>									
</li>
