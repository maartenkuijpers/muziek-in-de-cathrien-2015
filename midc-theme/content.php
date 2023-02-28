<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

//echo "door " . __FILE__ . " gerendered.";

?>

<article id="post-<?php the_ID();?>" <?php post_class();?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
    ?>
	<header class="entry-header">
		<?php echo('<h1 class="page-header entry-title">' . midc_get_title(get_the_title()) . '<small>' . midc_get_sub_title(get_the_title()) . '</small></h1>' );?>
	</header><!-- .entry-header -->
	
	<?php //custom_breadcrumbs(); ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'midc-theme' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
