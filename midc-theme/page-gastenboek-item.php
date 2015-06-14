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

?>

<div class="row">
    <div class="col-md-4"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
?>
    </div>
    <div class="col-md-8">
        <h3><?php the_title();
?>
		</h3>
        <!-- <h4>sub title</h4> -->
        <p><?php the_content();
?></p>
    </div>
</div>
<!-- /.row -->
