
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
 * @package Quark
 * @since Quark 1.0
 */

/*
Template Name: Retail new page
*/

get_header(); ?>

<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l">
				<div class="list-discusssions-page" id="tabContaier">
					<div class="group-title-top">
						<span class="title-dis s4-retail module-label">Retail News</span>
						<ul class="list-tab-dis">
							<li><span class="active" link="#last">Last</a></li>
							<li><span link="#popular">Popular</a></li>
						
						</ul>

					</div>
					<div class="content-dis">
						<div class="tabDetails">
					    	<div id="last" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_post" post_type="post" posts_per_page="9" scroll="true"]'); ?>
					        </div>
					        <div id="popular" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more repeater="template_post" post_type="post" taxonomy="group_post" taxonomy_terms="popular" taxonomy_operator="IN" posts_per_page="3" scroll="false"] '); ?>
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
