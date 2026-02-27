<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Online eStore
 */

$post_sidebar =  get_theme_mod( 'online_estore_search_sidebar','rightsidebar' );

get_header(); ?>

<div class="container">
	<div class="site-wrapper">
		<div id="primary" class="content-area <?php echo esc_attr( $post_sidebar ); ?>">
			<main id="main" class="site-main">
				<div class="articlesListing blogitemlist">	
					<?php if ( have_posts() ) : 
					
						/* Start the Loop */
							while ( have_posts() ) : the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								*/
								get_template_part( 'template-parts/content', 'search' );

							endwhile;

							the_posts_pagination( 
								array(
									'prev_text' => esc_html__( 'Prev', 'online-estore' ),
									'next_text' => esc_html__( 'Next', 'online-estore' ),
								)
							);

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
					?>
				</div><!-- Articales Listings -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
</div>

<?php  get_footer();