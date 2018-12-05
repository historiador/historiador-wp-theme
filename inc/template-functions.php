<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Historiador
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function historiador_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'historiador-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'historiador-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( ( is_page_template( 'page-with_widgets.php' ) ) ) {
		$classes[] = 'has-sidebar';
	}

	if ( is_search() ) {
		if ( is_active_sidebar( 'sidebar-search' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_category() || is_tag() || is_singular ( 'post' ) || ( is_home() && get_post_type() === 'post' ) ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'has-sidebar';
		}
	}


	// START DO NOT EDIT THIS COMMENT {{{
	// Custom post types: conditional ".has-sidebar" CSS class for body
	if ( is_post_type_archive( 'blog_en' ) || is_singular ( 'blog_en' ) ) {
		if ( is_active_sidebar( 'sidebar-blog_en' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_post_type_archive( 'books' ) || is_singular ( 'books' ) ) {
		if ( is_active_sidebar( 'sidebar-books' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_post_type_archive( 'europarl' ) || is_singular ( 'europarl' ) ) {
		if ( is_active_sidebar( 'sidebar-europarl' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_post_type_archive( 'events' ) || is_singular ( 'events' ) ) {
		if ( is_active_sidebar( 'sidebar-events' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_post_type_archive( 'podcasts' ) || is_singular ( 'podcasts' ) ) {
		if ( is_active_sidebar( 'sidebar-podcasts' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	if ( is_post_type_archive( 'videos' ) || is_singular ( 'videos' ) ) {
		if ( is_active_sidebar( 'sidebar-videos' ) ) {
			$classes[] = 'has-sidebar';
		}
	}

	// END DO NOT EDIT THIS COMMENT }}}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	return $classes;
}
add_filter( 'body_class', 'historiador_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function historiador_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Historiador.
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'historiador_front_page_sections', 8 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the front page or not.
 */
function historiador_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
