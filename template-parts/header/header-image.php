<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Historiador
 */

?>
<div class="custom-header">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
