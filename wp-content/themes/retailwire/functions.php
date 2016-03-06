<?php
/**
 * Retailwire functions and definitions
 *
 * @package Retailwire
 * @since Retailwire 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Retailwire 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 790; /* Default the embedded content width to 790px */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_setup' ) ) {
	function Retailwire_setup() {
		global $content_width;

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Retailwire, use a find and replace
		 * to change 'Retailwire' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'Retailwire', trailingslashit( get_template_directory() ) . 'languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Create an extra image size for the Post featured image
		add_image_size( 'post_feature_full_width', 792, 300, true );

		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'Retailwire' )
			) );

		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Add theme support for HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'fff',
				// Background image default
				'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/faint-squares.jpg'
			) );

		// Enable support for Custom Headers (or in our case, a custom logo)
		add_theme_support( 'custom-header', array(
				// Header image default
				'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
				// Header text display default
				'header-text' => false,
				// Header text color default
				'default-text-color' => '000',
				// Flexible width
				'flex-width' => true,
				// Header image width (in pixels)
				'width' => 300,
				// Flexible height
				'flex-height' => true,
				// Header image height (in pixels)
				'height' => 80
			) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for WooCommerce
		add_theme_support( 'woocommerce' );

		// Enable support for Theme Options.
		// Rather than reinvent the wheel, we're using the Options Framework by Devin Price, so huge props to him!
		// http://wptheming.com/options-framework-theme/
		if ( !function_exists( 'optionsframework_init' ) ) {
			define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'inc/' );
			require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/options-framework.php';

			// Loads options.php from child or parent theme
			$optionsfile = locate_template( 'options.php' );
			load_template( $optionsfile );
		}

		// If WooCommerce is running, check if we should be displaying the Breadcrumbs
		if( Retailwire_is_woocommerce_active() && !of_get_option( 'woocommerce_breadcrumbs', '1' ) ) {
			add_action( 'init', 'Retailwire_remove_woocommerce_breadcrumbs' );
		}
	}
}
add_action( 'after_setup_theme', 'Retailwire_setup' );


/**
 * Enable backwards compatability for title-tag support
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function Retailwire_slug_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }
	add_action( 'wp_head', 'Retailwire_slug_render_title' );
}


/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of PT Sans and Arvo by default is localized. For languages that use characters not supported by the fonts, the fonts can be disabled.
 *
 * @since Retailwire 1.2.5
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function Retailwire_fonts_url() {
	$fonts_url = '';
	$subsets = 'latin';

	/* translators: If there are characters in your language that are not supported by PT Sans, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$pt_sans = _x( 'on', 'PT Sans font: on or off', 'Retailwire' );

	/* translators: To add an additional PT Sans character subset specific to your language, translate this to 'greek', 'cyrillic' or 'vietnamese'.
	 * Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'PT Sans font: add new subset (cyrillic)', 'Retailwire' );

	if ( 'cyrillic' == $subset )
		$subsets .= ',cyrillic';

	/* translators: If there are characters in your language that are not supported by Arvo, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$arvo = _x( 'on', 'Arvo font: on or off', 'Retailwire' );

	if ( 'off' !== $pt_sans || 'off' !== $arvo ) {
		$font_families = array();

		if ( 'off' !== $pt_sans )
			$font_families[] = 'PT+Sans:400,400italic,700,700italic';

		if ( 'off' !== $arvo )
			$font_families[] = 'Arvo:400';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => $subsets,
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @since Retailwire 1.2.5
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function Retailwire_mce_css( $mce_css ) {
	$fonts_url = Retailwire_fonts_url();

	if ( empty( $fonts_url ) ) {
		return $mce_css;
	}

	if ( !empty( $mce_css ) ) {
		$mce_css .= ',';
	}

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'Retailwire_mce_css' );


/**
 * Register widgetized areas
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
function Retailwire_widgets_init() {
	register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'Retailwire' ),
			'id' => 'sidebar-main',
			'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'Retailwire' ),
			'id' => 'sidebar-blog',
			'description' => esc_html__( 'Appears in the sidebar on the blog and archive pages only', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Single Post Sidebar', 'Retailwire' ),
			'id' => 'sidebar-single',
			'description' => esc_html__( 'Appears in the sidebar on single posts only', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Page Sidebar', 'Retailwire' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Appears in the sidebar on pages only', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Front Page Banner Widget', 'Retailwire' ),
			'id' => 'frontpage-banner1',
			'description' => esc_html__( 'Appears in the banner area on the Front Page', 'Retailwire' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Front Page Banner Widget', 'Retailwire' ),
			'id' => 'frontpage-banner2',
			'description' => esc_html__( 'Appears in the banner area on the Front Page', 'Retailwire' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Front Page Widget Area', 'Retailwire' ),
			'id' => 'sidebar-homepage1',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Front Page Widget Area', 'Retailwire' ),
			'id' => 'sidebar-homepage2',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Third Front Page Widget Area', 'Retailwire' ),
			'id' => 'sidebar-homepage3',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Fourth Front Page Widget Area', 'Retailwire' ),
			'id' => 'sidebar-homepage4',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Footer Widget Area', 'Retailwire' ),
			'id' => 'sidebar-footer1',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Footer Widget Area', 'Retailwire' ),
			'id' => 'sidebar-footer2',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Third Footer Widget Area', 'Retailwire' ),
			'id' => 'sidebar-footer3',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Fourth Footer Widget Area', 'Retailwire' ),
			'id' => 'sidebar-footer4',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Retailwire' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
}
add_action( 'widgets_init', 'Retailwire_widgets_init' );


/**
 * Enqueue scripts and styles
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
function Retailwire_scripts_styles() {

	/**
	 * Register and enqueue our stylesheets
	 */

	// Start off with a clean base by using normalise. If you prefer to use a reset stylesheet or something else, simply replace this
	wp_register_style( 'normalize', trailingslashit( get_template_directory_uri() ) . 'css/normalize.css' , array(), '3.0.2', 'all' );
	wp_enqueue_style( 'normalize' );

	// Register and enqueue our icon font
	// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
	wp_register_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' , array( 'normalize' ), '4.2.0', 'all' );
	wp_enqueue_style( 'fontawesome' );

	// Our styles for setting up the grid.
	// If you prefer to use a different grid system, simply replace this and perform a find/replace in the php for the relevant styles. I'm nice like that!
	wp_register_style( 'gridsystem', trailingslashit( get_template_directory_uri() ) . 'css/grid.css' , array( 'fontawesome' ), '1.0.0', 'all' );
	wp_enqueue_style( 'gridsystem' );

	/*
	 * Load our Google Fonts.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'Retailwire-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */
	$fonts_url = Retailwire_fonts_url();
	if ( !empty( $fonts_url ) ) {
		wp_enqueue_style( 'Retailwire-fonts', esc_url_raw( $fonts_url ), array(), null );
	}

	// If using a child theme, auto-load the parent theme style.
	// Props to Justin Tadlock for this recommendation - http://justintadlock.com/archives/2014/11/03/loading-parent-styles-for-child-themes
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
	}

	// Enqueue the default WordPress stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() );


	/**
	 * Register and enqueue our scripts
	 */

	// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
	wp_register_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'js/modernizr-2.8.3-min.js', array(), '2.8.3', false );
	wp_enqueue_script( 'modernizr' );

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load jQuery Validation as well as the initialiser to provide client side comment form validation
	// You can change the validation error messages below
	if ( is_singular() && comments_open() ) {
		wp_register_script( 'validate', trailingslashit( get_template_directory_uri() ) . 'js/jquery.validate.min.1.13.0.js', array( 'jquery' ), '1.13.0', true );
		wp_register_script( 'commentvalidate', trailingslashit( get_template_directory_uri() ) . 'js/comment-form-validation.js', array( 'jquery', 'validate' ), '1.13.0', true );

		wp_enqueue_script( 'commentvalidate' );
		wp_localize_script( 'commentvalidate', 'comments_object', array(
			'req' => get_option( 'require_name_email' ),
			'author'  => esc_html__( 'Please enter your name', 'Retailwire' ),
			'email'  => esc_html__( 'Please enter a valid email address', 'Retailwire' ),
			'comment' => esc_html__( 'Please add a comment', 'Retailwire' ) )
		);
	}

	// Include this script to envoke a button toggle for the main navigation menu on small screens
	//wp_register_script( 'small-menu', trailingslashit( get_template_directory_uri() ) . 'js/small-menu.js', array( 'jquery' ), '20130130', true );
	//wp_enqueue_script( 'small-menu' );

}
add_action( 'wp_enqueue_scripts', 'Retailwire_scripts_styles' );


/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Retailwire 1.0
 *
 * @param string html ID
 * @return void
 */
if ( ! function_exists( 'Retailwire_content_nav' ) ) {
	function Retailwire_content_nav( $nav_id ) {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() ) {
			$nav_class = 'site-navigation post-navigation nav-single';
		}
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'Retailwire' ); ?></h3>

			<?php if ( is_single() ) { // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'Retailwire' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fa fa-angle-right"></i>', 'Next post link', 'Retailwire' ) . '</span>' ); ?>

			<?php } 
			elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>

				<?php echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'Retailwire' ), array( 'i' => array( 
						'class' => array() ) ) ),
					'next_text' => wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'Retailwire' ), array( 'i' => array( 
						'class' => array() ) ) )
				) ); ?>

			<?php } ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own Retailwire_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since Retailwire 1.0
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'Retailwire_comment' ) ) {
	function Retailwire_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'Retailwire' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'Retailwire' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'Retailwire' ) . '</span>' : '' );
						printf( '<a href="%1$s" title="Posted %2$s"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							sprintf( esc_html__( '%1$s @ %2$s', 'Retailwire' ), esc_html( get_comment_date() ), esc_attr( get_comment_time() ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'Retailwire' ), get_comment_date(), get_comment_time() )
						);
						?>
					</header> <!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'Retailwire' ); ?></p>
					<?php } ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'Retailwire' ), '<p class="edit-link">', '</p>' ); ?>
					</section> <!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply <span>&darr;</span>', 'Retailwire' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}


/**
 * Update the Comments form so that the 'required' span is contained within the form label.
 *
 * @since Retailwire 1.0
 *
 * @param string Comment form fields html
 * @return string The updated comment form fields html
 */
function Retailwire_comment_form_default_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? ' aria-required="true"' : "" );

	$fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'Retailwire' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields[ 'email' ] =  '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'Retailwire' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields[ 'url' ] =  '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'Retailwire' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	return $fields;

}
add_action( 'comment_form_default_fields', 'Retailwire_comment_form_default_fields' );


/**
 * Update the Comments form to add a 'required' span to the Comment textarea within the form label, because it's pointless 
 * submitting a comment that doesn't actually have any text in the comment field!
 *
 * @since Retailwire 1.0
 *
 * @param string Comment form textarea html
 * @return string The updated comment form textarea html
 */
function Retailwire_comment_form_field_comment( $field ) {

	$field = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'Retailwire' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

	return $field;

}
add_action( 'comment_form_field_comment', 'Retailwire_comment_form_field_comment' );


/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_posted_on' ) ) {
	function Retailwire_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'fa-file-o';
				break;
			case 'audio':
				$post_icon = 'fa-volume-up';
				break;
			case 'chat':
				$post_icon = 'fa-comment';
				break;
			case 'gallery':
				$post_icon = 'fa-camera';
				break;
			case 'image':
				$post_icon = 'fa-picture-o';
				break;
			case 'link':
				$post_icon = 'fa-link';
				break;
			case 'quote':
				$post_icon = 'fa-quote-left';
				break;
			case 'status':
				$post_icon = 'fa-user';
				break;
			case 'video':
				$post_icon = 'fa-video-camera';
				break;
			default:
				$post_icon = 'fa-calendar';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<i class="fa %1$s"></i> <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a>',
			$post_icon,
			esc_url( get_permalink() ),
			sprintf( esc_html__( '%1$s @ %2$s', 'Retailwire' ), esc_html( get_the_date() ), esc_attr( get_the_time() ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<i class="fa fa-pencil"></i> <address class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></address>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'Retailwire' ), get_the_author() ) ),
			get_the_author()
		);

		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'Retailwire' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<span class="comments-link"><i class="fa fa-comment"></i> <a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_comments_link() ),
			esc_attr( esc_html__( 'Comment on ' , 'Retailwire' ) . the_title_attribute( 'echo=0' ) ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'Retailwire' ), get_comments_number() ) : esc_html__( 'No Comments', 'Retailwire' ) )
		);

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'Retailwire' ), array( 
			'div' => array ( 
				'class' => array() ), 
			'span' => array( 
				'class' => array() ) ) ),
			$date,
			$author,
			$categories_list,
			( is_search() ? '' : $comments )
		);
	}
}


/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_entry_meta' ) ) {
	function Retailwire_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'Retailwire' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fa fa-tag"></i> %1$s', 'Retailwire' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}


/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
function Retailwire_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1200;
	}
}
add_action( 'template_redirect', 'Retailwire_content_width' );


/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since Retailwire 1.0
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function Retailwire_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'Retailwire_remove_more_jump_link' );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Retailwire 1.0
 *
 * @return string The 'Continue reading' link
 */
function Retailwire_continue_reading_link() {
	return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue reading', 'Retailwire' ) . ' &lsquo;' . get_the_title() . '&rsquo;">' . wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Retailwire' ), array( 'span' => array( 
			'class' => array() ) ) ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the Retailwire_continue_reading_link().
 *
 * @since Retailwire 1.0
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
function Retailwire_auto_excerpt_more( $more ) {
	return Retailwire_continue_reading_link();
}
add_filter( 'excerpt_more', 'Retailwire_auto_excerpt_more' );


/**
 * Extend the user contact methods to include Twitter, Facebook and Google+
 *
 * @since Retailwire 1.0
 *
 * @param array List of user contact methods
 * @return array The filtered list of updated user contact methods
 */
function Retailwire_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter';

	//add Facebook
	$contactmethods['facebook'] = 'Facebook';

	//add Linked In
    $contactmethods['linked_in'] = 'Linked In';

	//add Google Plus
	$contactmethods['googleplus'] = 'Google+';

	//add Position
	$contactmethods['position'] = 'Position';

	//add Disqus username

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'Retailwire_new_contactmethods', 10, 1 );


/**
 * Add a filter for wp_nav_menu to add an extra class for menu items that have children (ie. sub menus)
 * This allows us to perform some nicer styling on our menu items that have multiple levels (eg. dropdown menu arrows)
 *
 * @since Retailwire 1.0
 *
 * @param Menu items
 * @return array An extra css class is on menu items with children
 */
function Retailwire_add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'Retailwire_add_menu_parent_class' );


/**
 * Add Filter to allow Shortcodes to work in the Sidebar
 *
 * @since Retailwire 1.0
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Theme Options
 *
 * @since Retailwire 1.0
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'Retailwire_get_social_media' ) ) {
	function Retailwire_get_social_media() {
		$output = '';
		$icons = array(
			
			array( 'url' => of_get_option( 'social_facebook', '' ), 'icon' => 'fa-facebook', 'title' => esc_html__( 'Friend me on Facebook', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_twitter', '' ), 'icon' => 'fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_googleplus', '' ), 'icon' => 'fa-google-plus', 'title' => esc_html__( 'Connect with me on Google+', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_linkedin', '' ), 'icon' => 'fa-linkedin', 'title' => esc_html__( 'Connect with me on LinkedIn', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_slideshare', '' ), 'icon' => 'fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_dribbble', '' ), 'icon' => 'fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_tumblr', '' ), 'icon' => 'fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_github', '' ), 'icon' => 'fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_bitbucket', '' ), 'icon' => 'fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_foursquare', '' ), 'icon' => 'fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_youtube', '' ), 'icon' => 'fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_instagram', '' ), 'icon' => 'fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_flickr', '' ), 'icon' => 'fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_pinterest', '' ), 'icon' => 'fa-pinterest', 'title' => esc_html__( 'Follow me on Pinterest', 'Retailwire' ) ),
			array( 'url' => of_get_option( 'social_rss', '' ), 'icon' => 'fa-rss', 'title' => esc_html__( 'Subscribe to my RSS Feed', 'Retailwire' ) )
		);

		foreach ( $icons as $key ) {
			$value = $key['url'];
			if ( !empty( $value ) ) {
				$output .= sprintf( '<li class="link-%4$s"><a href="%1$s" title="%2$s"%3$s><span class="fa-stack fa-lg"><i class="fa fa-square fa-stack-2x"></i><i class="fa %4$s fa-stack-1x fa-inverse"></i></span></a></li>',
					esc_url( $value ),
					$key['title'],
					( !of_get_option( 'social_newtab', '0' ) ? '' : ' target="_blank"' ),
					$key['icon']
				);
			}
		}

		if ( !empty( $output ) ) {
			$output = '<ul>' . $output . '</ul>';
		}

		return $output;
	}
}


/**
 * Return a string containing the footer credits & link
 *
 * @since Retailwire 1.0
 *
 * @return string Footer credits & link
 */
if ( ! function_exists( 'Retailwire_get_credits' ) ) {
	function Retailwire_get_credits() {
		$output = '';
		$output = sprintf( '%1$s <a href="%2$s" title="%3$s">%4$s</a>',
			esc_html__( 'Proudly powered by', 'Retailwire' ),
			esc_url( esc_html__( 'http://wordpress.org/', 'Retailwire' ) ),
			esc_attr( esc_html__( 'Semantic Personal Publishing Platform', 'Retailwire' ) ),
			esc_html__( 'WordPress', 'Retailwire' )
		);

		return $output;
	}
}


/**
 * Outputs the selected Theme Options inline into the <head>
 *
 * @since Retailwire 1.0
 *
 * @return void
 */
function Retailwire_theme_options_styles() {
	$output = '';
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	$background = of_get_option( 'banner_background', $background_defaults );
	if ( $background ) {
		$bkgrnd_color = apply_filters( 'of_sanitize_color', $background['color'] );
		$output .= "#bannercontainer { ";
		$output .= "background: " . $bkgrnd_color . " url('" . esc_url( $background['image'] ) . "') " . $background['repeat'] . " " . $background['attachment'] . " " . $background['position'] . ";";
		$output .= " }";
	}

	$footerColour = apply_filters( 'of_sanitize_color', of_get_option( 'footer_color', '#222222' ) );
	if ( !empty( $footerColour ) ) {
		$output .= "\n#footercontainer { ";
		$output .= "background-color: " . $footerColour . ";";
		$output .= " }";
	}

	if ( of_get_option( 'footer_position', 'center' ) ) {
		$output .= "\n.smallprint { ";
		$output .= "text-align: " . sanitize_text_field( of_get_option( 'footer_position', 'center' ) ) . ";";
		$output .= " }";
	}

	if ( $output != '' ) {
		$output = "\n<style>\n" . $output . "\n</style>\n";
		echo $output;
	}
}
add_action( 'wp_head', 'Retailwire_theme_options_styles' );


/**
 * Recreate the default filters on the_content
 * This will make it much easier to output the Theme Options Editor content with proper/expected formatting.
 * We don't include an add_filter for 'prepend_attachment' as it causes an image to appear in the content, on attachment pages.
 * Also, since the Theme Options editor doesn't allow you to add images anyway, no big deal.
 *
 * @since Retailwire 1.0
 */
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars'  );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'do_shortcode' );

/**
 * Unhook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Outputs the opening container div for WooCommerce
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_before_woocommerce_wrapper' ) ) {
	function Retailwire_before_woocommerce_wrapper() {
		echo '<div id="primary" class="site-content row" role="main">';
	}
}


/**
 * Outputs the closing container div for WooCommerce
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_after_woocommerce_wrapper' ) ) {
	function Retailwire_after_woocommerce_wrapper() {
		echo '</div> <!-- /#primary.site-content.row -->';
	}
}


/**
 * Check if WooCommerce is active
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
function Retailwire_is_woocommerce_active() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Check if WooCommerce is active and a WooCommerce template is in use and output the containing div
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_setup_woocommerce_wrappers' ) ) {
	function Retailwire_setup_woocommerce_wrappers() {
		if ( Retailwire_is_woocommerce_active() && is_woocommerce() ) {
				add_action( 'Retailwire_before_woocommerce', 'Retailwire_before_woocommerce_wrapper', 10, 0 );
				add_action( 'Retailwire_after_woocommerce', 'Retailwire_after_woocommerce_wrapper', 10, 0 );		
		}
	}
	add_action( 'template_redirect', 'Retailwire_setup_woocommerce_wrappers', 9 );
}


/**
 * Outputs the opening wrapper for the WooCommerce content
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_woocommerce_before_main_content' ) ) {
	function Retailwire_woocommerce_before_main_content() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			echo '<div class="col grid_12_of_12">';
		}
		else {
			echo '<div class="col grid_8_of_12">';
		}
	}
	add_action( 'woocommerce_before_main_content', 'Retailwire_woocommerce_before_main_content', 10 );
}


/**
 * Outputs the closing wrapper for the WooCommerce content
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_woocommerce_after_main_content' ) ) {
	function Retailwire_woocommerce_after_main_content() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_main_content', 'Retailwire_woocommerce_after_main_content', 10 );
}


/**
 * Remove the sidebar from the WooCommerce templates
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_remove_woocommerce_sidebar' ) ) {
	function Retailwire_remove_woocommerce_sidebar() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
	add_action( 'woocommerce_before_main_content', 'Retailwire_remove_woocommerce_sidebar' );
}


/**
 * Remove the breadcrumbs from the WooCommerce pages
 *
 * @since Retailwire 1.3
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_remove_woocommerce_breadcrumbs' ) ) {
	function Retailwire_remove_woocommerce_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}


/**
 * Set the number of products to display on the WooCommerce shop page
 *
 * @since Retailwire 1.3.1
 *
 * @return void
 */
if ( ! function_exists( 'Retailwire_set_number_woocommerce_products' ) ) {
	function Retailwire_set_number_woocommerce_products() {
		if ( of_get_option( 'shop_products', '12' ) ) {
			$numprods = "return " . sanitize_text_field( of_get_option( 'shop_products', '12' ) ) . ";";
			add_filter( 'loop_shop_per_page', create_function( '$cols', $numprods ), 20 );
		}
	}
	add_action( 'init', 'Retailwire_set_number_woocommerce_products' );
}


function register_footer_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_footer_menu' );

register_sidebar(array(
        'name' => __('Tags'),
        'id' => 'tags',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
));

register_sidebar(array(
        'name' => __('Sidebar Discussion'),
        'id' => 'sidebar_discussion',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
));
register_sidebar(array(
        'name' => __('Sidebar Braintrust'),
        'id' => 'sidebar_braintrust',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
));
register_sidebar(array(
        'name' => __('Sidebar press releases'),
        'id' => 'sidebar_press',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
));

add_shortcode( 'ad1', 'ad1' );

function ad1(){

    ob_start();
    $background = of_get_option( 'ad_300x600', $background_defaults );
    ?>
        <img src="<?php echo esc_url( $background['image'] );  ?>">

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_shortcode( 'ad2', 'ad2' );

function ad2(){

    ob_start();
    $background_1 = of_get_option( 'ad_300x250', $background_defaults );
    ?>
        <img src="<?php echo esc_url( $background_1['image'] );  ?>">

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

function get_excerpt($number){

$excerpt = get_the_content();

$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);

$excerpt = strip_shortcodes($excerpt);

$excerpt = strip_tags($excerpt);

$excerpt = substr($excerpt, 0, $number);

$excerpt = substr($excerpt, 0, strripos($excerpt, " "));

$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));

$excerpt = $excerpt.'.';

return $excerpt;

}

add_shortcode( 'slide_resources', 'slide_resources' );

function slide_resources($args, $content){

    ob_start();
    
    ?>
    <ul class="list-resource owl-carousel owl-theme" id="<?php echo $args['id']; ?>" >
    	<?php 
          $args = array(
          	'post_type'=>'resources',
            'order' => 'desc',
            'posts_per_page' => '10'
     
          );

          $wp_query = new WP_Query( $args );

            if ( $wp_query->have_posts() ) {

              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
              <li class="item-resource item">
              	<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) { ?>
					<img src="<?php $thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
						echo $thumb_url[0];?>" title="<?php the_title();?>"/>
					<?php } else { ?>
					<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/post-2.jpg" />
					<?php } ?>
					</a>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo get_excerpt('100'); ?></p>

              </li>

            <?php endwhile; // end of the loop.
            wp_reset_postdata();
            
            }?>

    </ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}


add_shortcode( 'shortcode_discussion', 'shortcode_discussion' );

function shortcode_discussion(){

    ob_start();
    
    ?>
    <ul class="list-dis-3" >
    	<?php 
        
          $args = array(
          	'post_type'=>'discussion',
            'order' => 'desc',
            'posts_per_page' => '10'
     
          );

          $wp_query = new WP_Query( $args );

            if ( $wp_query->have_posts() ) {

              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
              <li class="item-dis-3">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<div class="bottom-footer-3">
						<span><?php the_author(); ?></span>
						<strong><?php the_time('d/m/y'); ?></strong>
					</div>
              </li>

            <?php endwhile; // end of the loop.
            wp_reset_postdata();
            
            }?>

    </ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_shortcode( 'list_resource_1', 'list_resource_1' );

function list_resource_1(){

    ob_start();
    
    ?>
    <ul class="list-resource-3" >
    	<?php 
        
          $args = array(
          	'post_type'=>'resources',
            'order' => 'desc',
            'posts_per_page' => '3'
     
          );

          $wp_query = new WP_Query( $args );

            if ( $wp_query->have_posts() ) {

              while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
              
              <li class="item-resources-3">
              	<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) { ?>
					<img src="<?php $thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
						echo $thumb_url[0];?>" title="<?php the_title();?>"/>
					<?php } else { ?>
					<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/post-2.jpg" />
					<?php } ?>
					</a>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					

              </li>

            <?php endwhile; // end of the loop.
            wp_reset_postdata();
            
            }?>

    </ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_filter('widget_text', 'do_shortcode');

add_shortcode( 'admin', 'admin' );

function admin(){

    ob_start();
    
    ?>
	<ul class="list-braintrust-1">
						<?php
							$args  = array(
							    'role' => 'Administrator'
							);

							// Create the WP_User_Query object
							global $wp_query;
							$wp_query = new WP_User_Query($args);

							// Get the results
							$authors = $wp_query->get_results();

							if($authors): ?>
								
							   
							        <?php foreach($authors as $author) : ?>
							        	<?php $author_id = $author->ID;
										  $author_facebook = get_field('facebook', 'user_'. $author_id );
							              $author_twitter = get_field('twitter', 'user_'. $author_id );
							              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
							              $author_position = get_field('position', 'user_'. $author_id );
							              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

						        		?>
							        	 <li  class="list-user">
							             <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>

										<ul class="list-so-user">
							        	 		<?php if ($author_facebook) { ?>
							        	 			<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li> <?php } else { ?>
							        	 			<li><span class="icon-face-user inactive">fa</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_twitter) { ?>
							        	 			<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li> <?php } else { ?>
							        	 			<li><span class="icon-tt-user inactive">tt</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_linked_in) { ?>
							        	 			<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li> <?php } else { ?>
							        	 			<li><span class="icon-in-user inactive">gg</span></li> 
							        	 		<?php } ?>
							        	 		
							        	 		
							        	 </ul>
							        	 <h2 class="title-user"><a href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo $author->display_name; ?></a></h2>
							        	 <span class="position-user"><?php echo $author_position; ?></span>
							        	 
							        	 

							        	</li>
							        <?php endforeach; ?>
							    
							<?php else: ?>

							    <div class="post">
							        <p>Sorry, no posts matched your criteria.</p>
							    </div>
							<?php endif; ?>

					
					</ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_shortcode( 'staff', 'staff' );

function staff(){

    ob_start();
    
    ?>
	<ul class="list-braintrust-1 staff-list">
						<?php
							$args  = array(
							    'role' => 'Staff'
							);

							// Create the WP_User_Query object
							global $wp_query;
							$wp_query = new WP_User_Query($args);

							// Get the results
							$authors = $wp_query->get_results();

							if($authors): ?>
								
							   
							        <?php foreach($authors as $author) : ?>
							        	<?php $author_id = $author->ID;
										  $author_facebook = get_field('facebook', 'user_'. $author_id );
							              $author_twitter = get_field('twitter', 'user_'. $author_id );
							              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
							              $author_position = get_field('position', 'user_'. $author_id );
							              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

						        		?>
							        	 <li  class="list-user">
							             <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>

										<ul class="list-so-user">
							        	 		<?php if ($author_facebook) { ?>
							        	 			<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li> <?php } else { ?>
							        	 			<li><span class="icon-face-user inactive">fa</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_twitter) { ?>
							        	 			<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li> <?php } else { ?>
							        	 			<li><span class="icon-tt-user inactive">tt</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_linked_in) { ?>
							        	 			<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li> <?php } else { ?>
							        	 			<li><span class="icon-in-user inactive">gg</span></li> 
							        	 		<?php } ?>
							        	 		
							        	 		
							        	 </ul>
							        	 <h2 class="title-user"><a href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo $author->display_name; ?></a></h2>
							        	 <span class="position-user"><?php echo $author_position; ?></span>
							        	 
							        	 

							        	</li>
							        <?php endforeach; ?>
							    
							<?php else: ?>

							    <div class="post">
							        <p>Sorry, no posts matched your criteria.</p>
							    </div>
							<?php endif; ?>

					
					</ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_shortcode( 'brain_featured', 'braintrust' );

function braintrust(){

    ob_start();
    
    ?>
	<ul class="list-braintrust-1">
						<?php
							$args  = array(
							    'role' => 'Author'
							);

							// Create the WP_User_Query object
							global $wp_query;
							$wp_query = new WP_User_Query($args);

							// Get the results
							$authors = $wp_query->get_results();

							if($authors): ?>
								
							   
							        <?php foreach($authors as $author) : ?>
							        	<?php $author_id = $author->ID;
										  $author_facebook = get_field('facebook', 'user_'. $author_id );
							              $author_twitter = get_field('twitter', 'user_'. $author_id );
							              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
							              $author_position = get_field('position', 'user_'. $author_id );
							              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

						        		?>
							        	 <li  class="list-user">
							        	 <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a>
										<ul class="list-so-user">
							        	 		<?php if ($author_facebook) { ?>
							        	 			<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li> <?php } else { ?>
							        	 			<li><span class="icon-face-user inactive">fa</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_twitter) { ?>
							        	 			<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li> <?php } else { ?>
							        	 			<li><span class="icon-tt-user inactive">tt</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_linked_in) { ?>
							        	 			<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li> <?php } else { ?>
							        	 			<li><span class="icon-in-user inactive">gg</span></li> 
							        	 		<?php } ?>
							        	 </ul>
							        	 
							        	 <h2 class="title-user"><a href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo $author->display_name; ?></a></h2>
							        	 <span class="position-user"><?php echo $author_position; ?></span>
							        	 

							        	</li>
							        <?php endforeach; ?>
							    
							<?php else: ?>

							    <div class="post">
							        <p>Sorry, no posts matched your criteria.</p>
							    </div>
							<?php endif; ?>

			
					</ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_shortcode( 'brain_all', 'braintrust_all' );

function braintrust_all(){

    ob_start();
    
    ?>
	<ul class="list-braintrust-1">
						<?php
							$args  = array(
							    'role' => 'Contributor'
							);

							// Create the WP_User_Query object
							global $wp_query;
							$wp_query = new WP_User_Query($args);

							// Get the results
							$authors = $wp_query->get_results();

							if($authors): ?>
								
							   
							        <?php foreach($authors as $author) : ?>
							        	<?php $author_id = $author->ID;
										  $author_facebook = get_field('facebook', 'user_'. $author_id );
							              $author_twitter = get_field('twitter', 'user_'. $author_id );
							              $author_linked_in = get_field('linked_in', 'user_'. $author_id );
							              $author_position = get_field('position', 'user_'. $author_id );
							              $author_avata_user = get_field('avata_user', 'user_'. $author_id );

						        		?>
							        	 <li  class="list-user">
							        	 <!-- <a class="avata" href="<?php echo get_author_posts_url($author->ID); ?>" class="author"><?php 
												 $size="144";
												 echo get_avatar($author_id,$size);
												 ?></a> -->
							        	 <h2 class="title-user"><a href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo $author->display_name; ?></a></h2>
							        	 <span class="position-user"><?php echo $author_position; ?></span>
							        	 <ul class="list-so-user">
							        	 		<?php if ($author_facebook) { ?>
							        	 			<li><a href="<?php echo $author_facebook; ?>" class="icon-face-user">fa</a></li> <?php } else { ?>
							        	 			<li><span class="icon-face-user inactive">fa</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_twitter) { ?>
							        	 			<li><a href="<?php echo $author_twitter; ?>" class="icon-tt-user">tt</a></li> <?php } else { ?>
							        	 			<li><span class="icon-tt-user inactive">tt</span></li> 
							        	 		<?php } ?>
							        	 		<?php if ($author_linked_in) { ?>
							        	 			<li><a href="<?php echo $linked_in; ?>" class="icon-in-user">gg</a></li> <?php } else { ?>
							        	 			<li><span class="icon-in-user inactive">gg</span></li> 
							        	 		<?php } ?>
							        	 </ul>
							        	 

							        	</li>
							        <?php endforeach; ?>
							    
							<?php else: ?>

							    <div class="post">
							        <p>Sorry, no posts matched your criteria.</p>
							    </div>
							<?php endif; ?>

					</ul>
        

    <?php $list_post = ob_get_contents(); 
    ob_end_clean();
    return $list_post;
}

add_action( 'add_meta_boxes_comment', 'comment_add_meta_box' );
function comment_add_meta_box()
{
 add_meta_box( 'my-comment-title', __( 'Your field title' ), 'comment_meta_box_age1',     'comment', 'normal', 'high' );
}

function comment_meta_box_age1( $comment )
{
    $values = get_comment_meta( $comment->comment_ID, 'age1', true );
   /// var_dump($values);
    $check = isset( $values) ? esc_attr($values) : 'off';
   ?>
 <p>
     <label for="age1"><?php _e( 'Featured' ); ?></label> :
     <input type="checkbox" name="age1" <?php checked( $check, 'on' ); ?>  class="widefat" />
 </p>
 <?php
}
add_action( 'edit_comment', 'comment_edit_function' );
function comment_edit_function( $comment_id )
{
	$chk = isset( $_POST['age1'] ) && $_POST['age1'] ? 'on' : 'off';
/*	var_dump($chk);
	exit();*/
    var_dump(update_comment_meta($comment_id, 'age1', $chk )) ;

}

function top_tags() {
        $tags = get_tags();

        if (empty($tags))
                return;

        $counts = $tag_links = array();
        foreach ( (array) $tags as $tag ) {
                $counts[$tag->name] = $tag->count;
                $tag_links[$tag->name] = get_tag_link( $tag->term_id );
        }

        asort($counts);
        $counts = array_reverse( $counts, true );

        $i = 0;
        foreach ( $counts as $tag => $count ) {
                $i++;
                $tag_link = clean_url($tag_links[$tag]);
                $tag = str_replace(' ', '&nbsp;', wp_specialchars( $tag ));
                if($i < 11){
                        print "<a href=\"$tag_link\">$tag</a>";
                }
        }
}


/**
 *	Create a custom WordPress "Lost Password" email
 *	@author Ren Ventura <EngageWP.com>
 *	@link http://www.engagewp.com/create-custom-lost-password-email-wordpress
 */

// Change "From" email address
add_filter( 'wp_mail_from', function( $email ) {
	return 'info@retailwire.com';
});

// Change "From" email name
add_filter( 'wp_mail_from_name', function( $name ) {
	return __( 'RetailWire' );
});

// Change Subject
add_filter( 'retrieve_password_title', function( $title, $user_login, $user_data ) {
	return __( 'RetailWire Password Recovery' );
}, 10, 3 );

// Change email type to HTML
add_filter( 'wp_mail_content_type', function( $content_type ) {
	return 'text/html';
});

// Change the message/body of the email
add_filter( 'retrieve_password_message', 'rv_new_retrieve_password_message', 10, 4 );
function rv_new_retrieve_password_message( $message, $key, $user_login, $user_data ){

	/**
	 *	Assemble the URL for resetting the password
	 *	see line 330 of wp-login.php for parameters
	 */
	$reset_url = add_query_arg( array(

		'action' => 'rp',
		'key' => $key,
		'login' => rawurlencode( $user_login )

	), wp_login_url() );

	ob_start();
	
	printf( '<p>%s</p>', __( 'Hi, ' ) . $user_fname );

	printf( '<p>%s</p>', __( 'It looks like you need to reset your password on the site. If this is correct, simply click the link below. If you were not the one responsible for this request, ignore this email and nothing will happen.' ) );

	printf( '<p><a href="%s">%s</a></p>', $reset_url, __( 'Reset Your Password' ) );
	
	$message = ob_get_clean();

	return $message;
}

/*function my_cpt_columns( $columns ) {
    $columns["ga1"] = "Featured";
    return $columns;
}
add_filter('manage_edit-comments_columns', 'my_cpt_columns');*/
//that's all that's needed!

