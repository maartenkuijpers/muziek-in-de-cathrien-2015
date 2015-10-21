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
 * Template Name: Container
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class='row'>
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template (title)
				get_template_part( 'content', 'page' );

			// End the loop.
			endwhile;

			$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
			$query = new WP_Query($args);
			$thisID = get_the_ID();

			// A range of template types may be included here, but only include direct children of this container.
			while ( $query->have_posts() ) : $query->the_post();
				if ($post->post_parent == $thisID)
				{
					$template = get_post_meta( $post->ID, '_wp_page_template', true );
					switch ($template)
					{
						case "page-twee-kolommen.php": get_template_part('page-twee-kolommen'); break;
						case "page-concerten-overzicht.php": get_template_part('page-concerten-overzicht'); break;
					}
				}
			endwhile;
?>
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
