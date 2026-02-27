<?php
/**
 * Template Name: Online eStore - Full Width
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package Sparkle Themes
 *
 * @subpackage Online eStore
 *
 * @since 1.0.0
 */

get_header();  ?>

<div class="onlineestore_wrap">
	<?php

		while ( have_posts() ) : the_post();

		    the_content();

		endwhile; // End of the loop.
	?>
</div>

<?php get_footer();