<?php
/**
 * The template for displaying all single posts and attachments
 * Oftewel, alle berichten van de oude stijl
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'classic' );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->

<?php get_footer(); ?>

	</div><!-- .content-area -->
