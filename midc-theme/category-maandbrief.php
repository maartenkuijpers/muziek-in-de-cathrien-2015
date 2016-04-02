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
echo "door " . __FILE__ . " gerendered";

echo '<h1>' . midc_get_title(get_the_title()) . '<small>' . midc_get_sub_title(get_the_title()) . '</small></h1>';
?>

<div class="entry-content">
        <?php
            /* translators: %s: Name of current post */
            the_content( sprintf(
                __( 'Continue reading %s', 'twentyfifteen' ),
                the_title( '<span class="screen-reader-text">', '</span>', false )
            ) );
        ?>
</div><!-- .entry-content -->
