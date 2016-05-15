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
 * Template Name: Container - Service Tabs - Item
 */
 
global $template_order;
if (!strpos($template_order, 'page-container-service-tabs.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}
$template_order .= '/page-container-service-tabs-item.php';
?>

<div class="tab-pane fade" role="tabpanel" id="service-<?php the_ID(); ?>">
    <h4></h4>
    <?php the_content(); ?>
</div>
