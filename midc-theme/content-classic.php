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
        <div class="row">
            <div class="col-lg-8">
            <?php
                /* translators: %s: Name of current post */
                the_content( sprintf(
                    __( 'Continue reading %s', 'twentyfifteen' ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                ) );
            ?>
            </div>
            <div class="col-lg-4">
                <?php
                $template_order = '/page-container-concerten-overzicht.php';

                // Include content of concerten with template "page-concerten-overzicht"
                $args = array('posts_per_page' => -1, 'post_type' => 'concert', 'order' => 'ASC', 'orderby' => 'menu_order' );
                $query = new WP_Query($args);
                $thisID = get_the_ID();
                $count = 2;
                while ($query->have_posts() && $count > 0) {
                    $query->the_post();
                    $count -= 1; 
                    echo "<div class='row'>";
                    get_template_part( 'page-container-concerten-overzicht-item' );
                    echo "</div>";
                    if ($count > 0)
                        echo "<hr />";
                }
                echo "</div><!-- row -->";
                ?> 
            </div>
        </div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
