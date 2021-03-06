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
 * Template Name: Container - Maandbrieven Overzicht
 */

global $template_order;
if (!strpos($template_order, 'page-container.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}

$args = array('category_name' => 'maandbrief', 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'DEC',  );
$query = new WP_Query($args);
if ($query->have_posts()) :
	// The Loop
	while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry"><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></div>
	<?php endwhile;
else : echo 'Nog geen informatie beschikbaar.';
endif;
?>