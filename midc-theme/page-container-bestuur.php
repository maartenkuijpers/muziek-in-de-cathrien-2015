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
 * Template Name: Container - Bestuur
 */

global $template_order;
if (!strpos($template_order, 'page-container.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}
$template_order .= '/page-container-bestuur.php';
?>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"><?php echo(midc_get_title(get_the_title()));?>
            <small><?php echo(midc_get_sub_title(get_the_title()));?></small>
        </h2>
    </div>
</div>

<?php
the_content();

$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
$query = new WP_Query($args);
$thisID = get_the_ID();

echo "<div class='row'>";
while ( $query->have_posts() ) : $query->the_post();
    if ($post->post_parent == $thisID)
    {
        $template = get_post_meta($post->ID, '_wp_page_template', true);
        if ($template == "page-container-bestuur-item.php")
        {
            get_template_part( 'page-container-bestuur-item' );
        }
    }
endwhile;
echo "</div>";
?>