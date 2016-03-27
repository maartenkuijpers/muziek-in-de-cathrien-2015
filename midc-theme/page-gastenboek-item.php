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
 * Template Name: Gastenboek Item template
 */
 
global $template_order;
if (!strpos($template_order, 'page-gastenboek.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}

?>

<div class="row">
    <div class="col-md-4">
        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );?>
    </div>
    <div class="col-md-8">
        <h3><?php the_title();?></h3>
        <p><?php the_content();?></p>
    </div>
</div><!-- /.row -->