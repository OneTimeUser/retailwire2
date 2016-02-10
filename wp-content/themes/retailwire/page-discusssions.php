
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
Template Name: Discussions page
*/

get_header(); ?>

	<div id="primary" class="site-content row" role="main">
		<div class="section-1">
			<div class="sec-1-l">
				<div class="list-discusssions-page" id="tabContaier">
					<div class="group-title-top">
						<span class="module-label title-dis">Discussion</span>
						<ul class="list-tab-dis">
							<li><span class="active" link="#tab1">Last</a></li>
							<li><span link="#tab2">popular</a></li>
						</ul>

					</div>
					<div class="content-dis">
						<div class="tabDetails">
					    	<div id="tab1" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more post_type="discussion" repeater="default" posts_per_page="9" scroll="true"]'); ?>
					        </div>
					    	<div id="tab2" class="tabContents">
					        	<?php echo do_shortcode('[ajax_load_more post_type="discussion" taxonomy="cate_discussions" taxonomy_terms="popular" taxonomy_operator="IN"]'); ?>
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
<!-- <script type='text/javascript' src='http://connekthq.com/wp-content/plugins/ajax-load-more/core/js/ajax-load-more.min.js?ver=1.1'></script>
<script type='text/javascript' src='http://connekthq.com/wp-content/themes/cnkt/js/libs/imagesloaded.pkgd.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://connekthq.com/wp-includes/js/masonry.min.js?ver=3.1.2'></script> -->
<script type="text/javascript">


/*jQuery(document).ready(function($){
$(function() {
  var masonryInit = true;	// set Masonry init flag
  $.fn.almComplete = function(alm){ // Ajax Load More callback function
    if($('#ajax-load-more').length){
      var $container = $('#ajax-load-more ul'); // our container
      if(masonryInit){
        // initialize Masonry only once
        masonryInit = false;
        $container.masonry({
          itemSelector: '#ajax-load-more ul li'
        });		      
      }else{
          $container.masonry('reloadItems'); // Reload masonry items oafter callback
      }
      $container.imagesLoaded( function() { // When images are loaded, fire masonry again.
        $container.masonry();
      });
    }
  };
});
    
  });*/



</script>
	</div> <!-- /#primary.site-content.row -->
<?php get_footer(); ?>
