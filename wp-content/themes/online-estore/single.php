<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Online eStore
 */

$post_sidebar =  get_theme_mod( 'online_estore_default_post_sidebar','rightsidebar' );

get_header(); ?>

<div class="container">
	<?php if( $post_sidebar == 'leftsidebar' && is_active_sidebar('sidebar-2') ){ get_sidebar('left'); } ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="articlesListing">	
				<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/

							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						?>	
							
						<nav class="navigation post-navigation wow fadeInUp" role="navigation">
							<div class="nav-links">
								<?php 
									if( $prev_post = get_previous_post() ): 
										echo'<div class="nav-previous">';
											$prevpost = get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array('class' => 'pagination-previous')); 
											previous_post_link( '%link',"$prevpost <span>".esc_html__('Previous Post','online-estore')."</span> %title", TRUE ); 
										echo'</div>';
									endif; 
										
									if( $next_post = get_next_post() ): 
										echo'<div class="nav-next">';
											$nextpost = get_the_post_thumbnail( $next_post->ID, 'thumbnail', array('class' => 'pagination-next')); 
											next_post_link( '%link',"$nextpost  <span>".esc_html__('Next Post','online-estore')."</span> %title", TRUE ); 
										echo'</div>';
									endif;
								?>
							</div>
						</nav>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?>
			</div><!-- Articales Listings -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php if( $post_sidebar == 'rightsidebar' && is_active_sidebar('sidebar-1') ){ get_sidebar(); } ?>
</div>

<?php get_footer();