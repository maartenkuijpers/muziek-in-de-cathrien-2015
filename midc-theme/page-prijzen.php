<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 * 
 * Template Name: Prijzen template
 */

$template_order = '/page-prijzen.php';

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

			// End the loop.
			endwhile;
            ?>
            
			<div class="row">

            <?php
			// Include content of pages with template "page-prijzen-item"
			$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
			$query = new WP_Query($args);
			while ( $query->have_posts() ) : $query->the_post(); 
				if ( get_post_meta( $post->ID, '_wp_page_template', true ) == "page-prijzen-item.php" ) {
					get_template_part( 'page-prijzen-item' );
				}	
			endwhile;
            ?>

			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
