<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

?>

<article id="post-<?php the_ID();?>" <?php post_class();?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
    ?>
	<header class="entry-header">
		<?php echo('<h1 class="page-header entry-title">' . midc_get_title(get_the_title()) . '<small>' . midc_get_sub_title(get_the_title()) . '</small></h1>' );?>
	</header><!-- .entry-header -->
	
	<?php custom_breadcrumbs(); ?>

	<div class="entry-content">
		<?php
        the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' );?>

</article><!-- #post-## -->