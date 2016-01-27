
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */

/*
Template Name: page Resource
*/

get_header(); ?>

<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l">
				<div class="list-discusssions-page" id="tabContaier">
					<div class="group-title-top">
						<span class="title-dis s3-resource module-label">Resource</span>
						<ul class="list-tab-dis">
							<li><span class="active" link="#all">all</a></li>
							<li><span link="#whitepapers">whitepapers</a></li>
							<li><span link="#webinars">webinars</a></li>
							<li><span link="#misc">misc</a></li>
						</ul>

					</div>
					<div class="content-dis">
						<div class="tabDetails">
					    	<div id="all" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_8" post_type="resources" posts_per_page="3" scroll="false"]'); ?>
					        </div>
					        <div id="whitepapers" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_8" post_type="resources" taxonomy="categoris_resources" taxonomy_terms="whitepapers" taxonomy_operator="IN" posts_per_page="3" scroll="false"] '); ?>
					        </div>
					        <div id="webinars" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_8" post_type="resources" taxonomy="categoris_resources" taxonomy_terms="webinars" taxonomy_operator="IN" posts_per_page="3" scroll="false"]'); ?>
					        </div>
					        <div id="misc" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_8" post_type="resources" taxonomy="categoris_resources" taxonomy_terms="misc" taxonomy_operator="IN" posts_per_page="3" scroll="false"]'); ?>
					        </div>
							
					    </div>
						
						
					</div>

				</div>
			</div>
			<div class="sec-1-r">
				<?php dynamic_sidebar('sidebar_discussion') ?>
			</div>
			<div class="clear"></div>


		</div>
		<?php //get_sidebar(); ?>
	</div> <!-- /#primary.site-content.row -->
<?php get_footer(); ?>
