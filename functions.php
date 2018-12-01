<?php
/**
 * Historiador functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Historiador
 * @since 1.0
 */

/**
 * Historiador only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function historiador_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/historiador
	 * If you're building a theme based on Historiador, use a find and replace
	 * to change 'historiador' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'historiador' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'historiador-featured-image', 2000, 1200, true );

	add_image_size( 'historiador-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'historiador' ),
			'social' => __( 'Social Links Menu', 'historiador' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo', array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

// NOTE by Protesilaos on 2018-11-29
//
// I have disabled this, because there is no point in trying to mimic
// how the content will look on the actual page.  If we wanted that, we
// would be using the Gutenberg editor.  The assumption here is that
// writers are using their own editor and only interfacing with WP to
// post their writings.  Furthermore, this is disabled to reduce the
// amount of style sheets that need to be maintained.
//
//	/*
//	 * This theme styles the visual editor to resemble the theme style,
//	 * specifically colors, and column width.
//	  */
//	add_editor_style( array( 'assets/css/editor-style.css' ) );

// NOTE by Protesilaos on 2018-11-29
//
// This was the default in Twenty Seventeen.  Needs to be adapted.
//
//	// Define and register starter content to showcase the theme on new sites.
//	$starter_content = array(
//		'widgets'     => array(
//			// Place three core-defined widgets in the sidebar area.
//			'sidebar-1' => array(
//				'text_business_info',
//				'search',
//				'text_about',
//			),
//
//			// Add the core-defined business info widget to the footer 1 area.
//			'sidebar-2' => array(
//				'text_business_info',
//			),
//
//			// Put two core-defined widgets in the footer 2 area.
//			'sidebar-3' => array(
//				'text_about',
//				'search',
//			),
//		),
//
//		// Specify the core-defined pages to create and add custom thumbnails to some of them.
//		'posts'       => array(
//			'home',
//			'about'            => array(
//				'thumbnail' => '{{image-sandwich}}',
//			),
//			'contact'          => array(
//				'thumbnail' => '{{image-espresso}}',
//			),
//			'blog'             => array(
//				'thumbnail' => '{{image-coffee}}',
//			),
//			'homepage-section' => array(
//				'thumbnail' => '{{image-espresso}}',
//			),
//		),
//
//		// Create the custom image attachments used as post thumbnails for pages.
//		'attachments' => array(
//			'image-espresso' => array(
//				'post_title' => _x( 'Espresso', 'Theme starter content', 'historiador' ),
//				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
//			),
//			'image-sandwich' => array(
//				'post_title' => _x( 'Sandwich', 'Theme starter content', 'historiador' ),
//				'file'       => 'assets/images/sandwich.jpg',
//			),
//			'image-coffee'   => array(
//				'post_title' => _x( 'Coffee', 'Theme starter content', 'historiador' ),
//				'file'       => 'assets/images/coffee.jpg',
//			),
//		),
//
//		// Default to a static front page and assign the front and posts pages.
//		'options'     => array(
//			'show_on_front'  => 'page',
//			'page_on_front'  => '{{home}}',
//			'page_for_posts' => '{{blog}}',
//		),
//
//		// Set the front page section theme mods to the IDs of the core-registered pages.
//		'theme_mods'  => array(
//			'panel_1' => '{{homepage-section}}',
//			'panel_2' => '{{about}}',
//			'panel_3' => '{{blog}}',
//			'panel_4' => '{{contact}}',
//		),
//
//		// Set up nav menus for each of the two areas registered in the theme.
//		'nav_menus'   => array(
//			// Assign a menu to the "top" location.
//			'top'    => array(
//				'name'  => __( 'Top Menu', 'historiador' ),
//				'items' => array(
//					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
//					'page_about',
//					'page_blog',
//					'page_contact',
//				),
//			),
//
//			// Assign a menu to the "social" location.
//			'social' => array(
//				'name'  => __( 'Social Links Menu', 'historiador' ),
//				'items' => array(
//					'link_yelp',
//					'link_facebook',
//					'link_twitter',
//					'link_instagram',
//					'link_email',
//				),
//			),
//		),
//	);

	/**
	 * Filters Historiador array of starter content.
	 *
	 * @since Historiador 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'historiador_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'historiador_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function historiador_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( historiador_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Historiador content width of the theme.
	 *
	 * @since Historiador 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'historiador_content_width', $content_width );
}
add_action( 'template_redirect', 'historiador_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function historiador_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog PT Sidebar', 'historiador' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on PT blog posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'historiador' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'historiador' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Search results Sidebar', 'historiador' ),
			'id'            => 'sidebar-search',
			'description'   => __( 'Add widgets here to appear in your sidebar on pages that display search results.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// START DO NOT EDIT THIS COMMENT {{{
	// Sidebars for custom post types
	register_sidebar(
		array(
			'name'          => __( 'Blog EN Sidebar', 'historiador' ),
			'id'            => 'sidebar-blog_en',
			'description'   => __( 'Add widgets here to appear in your sidebar on "The Man from Lisbon" posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Books Sidebar', 'historiador' ),
			'id'            => 'sidebar-books',
			'description'   => __( 'Add widgets here to appear in your sidebar on Book posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Europarl Sidebar', 'historiador' ),
			'id'            => 'sidebar-europarl',
			'description'   => __( 'Add widgets here to appear in your sidebar on Europarl posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Events Sidebar', 'historiador' ),
			'id'            => 'sidebar-events',
			'description'   => __( 'Add widgets here to appear in your sidebar on Event posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Podcast Sidebar', 'historiador' ),
			'id'            => 'sidebar-podcasts',
			'description'   => __( 'Add widgets here to appear in your sidebar on Podcast posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Videos Sidebar', 'historiador' ),
			'id'            => 'sidebar-videos',
			'description'   => __( 'Add widgets here to appear in your sidebar on Video posts and archive pages.', 'historiador' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// END DO NOT EDIT THIS COMMENT }}}
}
add_action( 'widgets_init', 'historiador_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Historiador 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function historiador_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'historiador' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'historiador_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Historiador 1.0
 */
function historiador_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'historiador_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function historiador_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'historiador_pingback_header' );

// TODO candidate for removal
/**
 * Display custom color CSS.
 */
function historiador_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo historiador_custom_colors_css(); ?>
	</style>
<?php
}
add_action( 'wp_head', 'historiador_colors_css_wrap' );

// TODO enqueue all js through main.min.js or some appropriate file?
/**
 * Enqueue scripts and styles.
 */
function historiador_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'historiador-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Webfont stylesheet.
	wp_enqueue_style( 'historiador-webfonts', get_theme_file_uri( 'webfonts.min.css' ), array( 'historiador-style' ), '1.20181128174405' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'historiador-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'historiador-style' ), '1.0' );
	}

	wp_enqueue_script( 'historiador-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$historiador_l10n = array(
		'quote' => historiador_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'historiador-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$historiador_l10n['expand']   = __( 'Expand child menu', 'historiador' );
		$historiador_l10n['collapse'] = __( 'Collapse child menu', 'historiador' );
		$historiador_l10n['icon']     = historiador_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script( 'historiador-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'historiador-skip-link-focus-fix', 'historiadorScreenReaderText', $historiador_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'historiador_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Historiador 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function historiador_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'historiador_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Historiador 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function historiador_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'historiador_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Historiador 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function historiador_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'historiador_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Historiador 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function historiador_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'historiador_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Historiador 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function historiador_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'historiador_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

// TODO review the customizer additions.  No need for bloat.
/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
