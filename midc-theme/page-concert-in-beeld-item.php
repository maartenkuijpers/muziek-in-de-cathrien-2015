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

$actionLink = get_post_meta( $post->ID, 'concert_in_beeld_item_meta_box_actionlink', true);
//if (!empty($actionLink))
	//$actionLink = "#";
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
			echo '<a href="' . $actionLink . '" rel="lightbox">';
			the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) );
			echo '</a>';
		} else if ($type == 'gallery') {
?>
<div id="ngg-gallery-4___204145374-1" class="ngg-galleryoverview ngg-ajax-pagination-none">
	<div id="ngg-image-0" class="ngg-gallery-thumbnail-box">
		<div class="ngg-gallery-thumbnail">
			<!-- <a class="ngg-fancybox" rel="4___204145374" data-description="" data-title="SONY DSC" data-image-id="4" data-thumbnail="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/thumbs/thumbs_DSC05332.JPG" data-src="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/DSC05332.JPG" title="" href="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/DSC05332.JPG"> -->
			<a class="ngg-fancybox" rel="4___204145374" data-description="" data-title="SONY DSC" data-image-id="4" data-thumbnail="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/thumbs/thumbs_DSC05332.JPG" data-src="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/DSC05332.JPG" title="" href="http://muziekindecathrien.local/wp-content/gallery/cve-heeze/DSC05332.JPG">
<?php
the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) );
?>
			</a>
		</div>
	</div>
</div>

<?php
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
if (!empty($actionText) && $type != 'youtube') {
    echo '<a class="btn btn-primary" href="' . $actionLink . '">' . $actionText . '&nbsp;<i class="fa fa-angle-right"></i></a>';
}
?>
    </div>
</div> <!-- row -->
