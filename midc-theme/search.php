<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

//echo "door " . __FILE__ . " gerendered.";

get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) { ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'midc-theme' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
            // Navigation in top and bottom
            echo '<div class="text-center">';
            if ( function_exists('wp_bootstrap_pagination') ) {
                wp_bootstrap_pagination();
            }
            echo '</div>';

			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;

            // Navigation in top and bottom
            echo '<div class="text-center">';
            if ( function_exists('wp_bootstrap_pagination') ) {
                wp_bootstrap_pagination();
            }
            echo '</div>';
        }
		// If no content, include the "No posts found" template.
		else {
			get_template_part( 'content', 'none' );
        }
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
