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
 * Template Name: Container - Header Carousel Item
 */
/*
 <img class="img-responsive" src="<?php echo($url); ?>" alt="">
*/
$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID) );
?>

<div class="fill" style="background-image:url('<?php echo($url); ?>');"></div>
<div class="carousel-caption">
    <h2><?php the_title() ?></h2>
</div>