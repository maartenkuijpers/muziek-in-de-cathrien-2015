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
 * Template Name: Concerten Overzicht
 */

get_header(); ?>

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

			// Include content of concerten with template "bestuuritem"
			$args = array('posts_per_page' => -1, 'post_type' => 'concert', 'order' => 'ASC', 'orderby' => 'menu_order' );
			$query = new WP_Query($args);
			$thisID = get_the_ID();
			$columns = 0;
			echo "<div class='row'>";
			while ( $query->have_posts() ) : $query->the_post(); 
				get_template_part( 'page-concerten-overzicht-item' );

				$columns = $columns + 1;
				if ($columns == 3) {
					echo "</div><hr /><div class='row'>";
					$columns = 0;
				}
			endwhile;
			echo "</div><!-- row -->";
			?>

<?php get_footer(); ?>
