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
 * Template Name: Concert in beeld Item template
 */

global $template_order;
if (!strpos($template_order, 'page-concert-in-beeld.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}

$actionLink = get_post_meta( $post->ID, 'concert_in_beeld_item_meta_box_actionlink', true);
$actionText = get_post_meta( $post->ID, 'concert_in_beeld_item_meta_box_actiontext', true);
$type = get_post_meta( $post->ID, 'concert_in_beeld_item_meta_box_type', true);
$icons = array(
		'gallery' => 'fa fa-camera fa-4x',
		'link' => 'fa fa-file-text fa-4x',
		'youtube' => 'fa fa-film fa-4x'
		);
$icon = $icons[$type];
?>

<div class="row">
    <div class="col-md-1 text-center">
        <p><i class="<?php echo $icon; ?>"></i></p>
        <p><?php echo date_i18n('d F Y', strtotime( get_the_date($post_id))); ?></p>
    </div>
    <div class="col-md-5">
<?php
		if ($type == 'youtube') {		
			echo '<div class="embed-responsive embed-responsive-16by9">';
			echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $actionLink . '" frameborder="0"></iframe>';
			echo '</div>';
		} else if ($type == 'link') {
			echo '<a href="' . $actionLink . '" >';
			the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) );
			echo '</a>';
		} else if ($type == 'gallery') {
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
			if (!empty($imgpath))
				echo '<img class="img-responsive img-hover" src="/' . $imgpath . '">';
			else
				the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) );
			echo '</a>';
			
			//$image->pageid
		}
?>
    </div>
    <div class="col-md-6">
        <h3>
<?php
			the_title();
?>
        </h3>
		<p><?php the_content(); ?></p>
<?php
		if (!empty($actionText)) {
			if ($type == 'gallery') {
				echo '<a class="btn btn-primary" href="' . $perma_gallery_page_id . '">' . $actionText . '&nbsp;<i class="fa fa-angle-right"></i></a>';
			} else if ($type == 'link') { 
				echo '<a class="btn btn-primary" href="' . $actionLink . '">' . $actionText . '&nbsp;<i class="fa fa-angle-right"></i></a>';
			}
		}
?>
    </div>
</div> <!-- row -->
