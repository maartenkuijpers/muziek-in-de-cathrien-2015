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
 * Template Name: Container - Service Tabs
 */

global $template_order;
if (!strpos($template_order, 'page-container.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}
$template_order .= '/page-container-service-tabs.php';

// Include content of pages with template "service tabs item"
$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
$query = new WP_Query($args);
$thisID = get_the_ID();
?>

<div class='row'>
    <div class="col-lg-12">
        <h2 class="page-header"><?php echo(midc_get_title(get_the_title())); ?></h2>
    </div>
    <div class="col-lg-12">
        <div id="myTabContent" class="tab-content">
            <ul id="myTab" class="nav nav-tabs " role="tablist"></ul>
                <div id="myTabContent" class="tab-content">
                <?php
                $active_tab = 0;
                $doc = new DOMDocument;
                $tab_lis = '';

                // Only include direct children of this container.
                while ($query->have_posts()) {
                    $query->the_post();            
                    if ($post->post_parent == $thisID)
                    {
                        $template = get_post_meta( $post->ID, '_wp_page_template', true );
                        if ($template == "page-container-service-tabs-item.php") {
                            get_template_part('page-container-service-tabs-item');
                            $tab_lis .= '<li class="';
                            if ($active_tab == 0) {
                                $tab_lis .= 'active';
                                $active_tab = $post->ID;
                            }
                            $tab_lis .= '"><a href="#service-' . $post->ID . '" data-toggle="tab">' . get_the_title($post->ID) . '</a></li>';
                        }
                    }
                }
                if ($active_tab != 0) {
                ?>
                </div>
            <script>
            $("#service-<?php echo $active_tab ?>").addClass("active in");
            $('<?php echo $tab_lis ?>').appendTo("#myTab");
            </script>
            <?php
            }
            ?>
        </div>
    </div>
</div>
