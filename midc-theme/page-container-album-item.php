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
 * Template Name: Container - Album Item
 */
?>

<div class="row">
    <div class="col-md-1 text-center">
        <p><i class="fa fa-camera fa-4x"></i></p>
        <p><?php echo date_i18n('d F Y', strtotime( get_the_date($post_id))); ?></p>
    </div>
    <div class="col-md-3">
<?php

        // This code gets the Preview image by gallery-ID
        $gallery_id = $actionLink;
        $results = $wpdb->get_results("SELECT ng.path, ng.id np.filename FROM wp_ngg_pictures np, wp_ngg_gallery ng WHERE np.galleryid=ng.gid AND np.galleryid=".$gallery_id." AND np.pid=ng.previewpic",ARRAY_A);
        if (!empty($results[0]['path']) && !empty($results[0]['filename'])) : 
            $imgpath = $results[0]['path'].'/'.$results[0]['filename'];
        endif;

        global $nggdb;
        $gallery_page_id = $wpdb->get_var("SELECT pageid FROM wp_ngg_gallery where gid=".$gallery_id.";");
        $perma_gallery_page_id = get_permalink($gallery_page_id);
        echo '<a href="' . $perma_gallery_page_id . '">';
            the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) );
        echo '</a>';
?>
    </div>
    <div class="col-md-8">
        <h3>
<?php
			the_title();
?>
        </h3>
		<p>
        <?php
        $content = get_the_content();
        echo preg_replace('/\[nggallery id=.*]/', '', $content);
        ?></p>
<?php
		echo '<a class="btn btn-primary" href="' . $perma_gallery_page_id . '">Open het album&nbsp;<i class="fa fa-angle-right"></i></a>';
?>
    </div>
</div> <!-- row -->
<hr/>