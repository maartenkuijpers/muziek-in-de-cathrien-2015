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
 * Template Name: Fotoalbum
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
    ?>
    <article id="post-<?php the_ID();?>" <?php post_class();?>>
        <header class="entry-header">
            <?php echo('<h1 class="page-header entry-title">' . midc_get_title(get_the_title()) . '<small>' . midc_get_sub_title(get_the_title()) . '</small></h1>' );?>
        </header><!-- .entry-header -->
    	<?php custom_breadcrumbs(); ?>

        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
    </article><!-- #post-## -->
    <?php
    // End the loop.
    endwhile;
    ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>