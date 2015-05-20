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
if (!empty($actionLink))
	$actionLink = "#";
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
        <a href="<?php echo $actionLink; ?>">
			<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) ); ?>
        </a>
    </div>
    <div class="col-md-6">
        <h3>
            <a href="<?php echo $actionLink; ?>"><?php the_title(); ?></a>
        </h3>
		<p><?php the_content(); ?></p>
<?php
if (!empty($actionText))
		$actionText = str_replace(, $actionText);
        echo '<a class="btn btn-primary" href="' . $actionLink . '">' . $actionText . '&nbsp;<i class="fa fa-angle-right"></i></a>';
?>

    </div>
</div>
