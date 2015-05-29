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
 * Template Name: Concert in beeld template
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			// End the loop.
			endwhile;

?>
<?php
			// Include content of pages with template "page-concert-in-beeld-item"
			$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
			$query = new WP_Query($args);
			while ( $query->have_posts() ) : $query->the_post(); 
				if ( get_post_meta( $post->ID, '_wp_page_template', true ) == "page-concert-in-beeld-item.php" ) {
					get_template_part( 'page-concert-in-beeld-item' );
					if ( $query->have_posts() ) {
						echo "<hr />";
					}
				}	
			endwhile;
?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
