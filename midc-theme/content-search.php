<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
    <div class="col-md-3">
        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) ); ?>
    </div>
    <div class="col-md-9">
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    </div>
</div>
<hr />    
</article><!-- #post-## -->
