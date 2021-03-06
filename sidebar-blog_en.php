<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Historiador
 */

if ( ! is_active_sidebar( 'sidebar-blog_en' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar for The Man from Lisbon', 'historiador' ); ?>">
	<?php dynamic_sidebar( 'sidebar-blog_en' ); ?>
</aside><!-- #secondary -->
