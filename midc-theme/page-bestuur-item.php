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
 * Template Name: Bestuur Item template
 */

global $template_order;
if (!strpos($template_order, 'page-bestuur.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}

?>

<div class="col-md-4 text-center">
	<div class="thumbnail">
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
		<div class="caption">
			<h3><?php the_title(); ?><br /><small>
			<?php echo (get_post_meta( $post->ID, 'bestuur_item_meta_box_function', true)); ?>
			</small></h3>
			<p><?php echo (get_post_meta( $post->ID, 'bestuur_item_meta_box_full_name', true)); ?></p>
			<ul class="list-inline">
				<?php // Render social channels

				$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_email', true);
				if (!empty($value)) {
					echo ("<li><a href='mailto:" . $value . "'><i class='fa fa-2x fa-envelope-square'></i></a></li>");
				}

				$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_facebook', true);
				if (!empty($value)) {
					echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-facebook-square'></i></a></li>");
				}

				$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_linkedin', true);
				if (!empty($value)) {
					echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-linkedin-square'></i></a></li>");
				}

				$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_twitter', true);
				if (!empty($value)) {
					echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-twitter-square'></i></a></li>");
				}
				?>
			</ul>
		</div>
	</div>
</div>
