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
 * Template Name: Container - Concerten Overzicht
 */

global $template_order;
if (!strpos($template_order, 'page-container.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}
$template_order .= '/page-container-concerten-overzicht.php';

// Include content of concerten with template "page-concerten-overzicht"
//$args = array('posts_per_page' => -1, 'post_type' => 'concert', 'order' => 'DEC', 'orderby' => 'meta_value', 'meta_key' => 'midc_concerten_meta_unix' );
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'concert',
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'midc_concerten_meta_unix',
    'meta_query' => array(
        array(
            'key'     => 'midc_concerten_meta_unix',
            'value'   => date_i18n( 'U' ),
            'compare' => '>',
        ),
    ),
);
$query = new WP_Query($args);

$thisID = get_the_ID();
$columns = 0;
echo "<div class='row'>";
while ( $query->have_posts() ) : $query->the_post();
    echo "<div class='col-lg-4 col-md-6 col-sm-9'>"; 
	get_template_part( 'page-container-concerten-overzicht-item' );
    echo "</div>";

	$columns = $columns + 1;
	if ($columns == 3) {
		echo "</div><div class='row'>";
		$columns = 0;
	}
endwhile;
echo "</div><!-- row -->";
?>
