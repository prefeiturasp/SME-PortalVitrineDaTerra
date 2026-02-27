<?php
/**
 * The template for displaying author bio on single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Online eStore
 */

	$author_id         = get_the_author_meta( 'ID' );
	$author_avatar     = get_avatar( $author_id, 180 );
	$author_post_link  = get_the_author_posts_link();
	$author_bio        = get_the_author_meta( 'description' );
	$author_email      = get_the_author_meta('email');
?>

<div class="aboutAuthor box">
	<div class="row">

		<?php if ( $author_avatar ) { ?>
			<div class="col-xs-12 col-sm-4 imageWrap">
				<?php echo wp_kses_post( $author_avatar ); ?>
			</div>
		<?php } ?>

		<div class="col-xs-12 col-sm-8">

			<div class="infos">

				<?php if ( $author_post_link ) { ?>
					<div class="name"><?php echo wp_kses_post( $author_post_link ); ?></div>
				<?php } ?>

				<?php if ( $author_bio ) { ?>
					<p class="text">
						<?php echo wp_kses_post( $author_bio ); ?>
					</p><!-- .author-bio -->
				<?php } ?>

			</div>
		</div>
	</div>
</div><!-- About author -->