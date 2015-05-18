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
 * Template Name: Prijzen Item template
 */
?>

<div class="col-md-4">
	<div class="panel panel-primary text-center">
		<div class="panel-heading">
<?php
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_recommended', true);
			echo $value;
			if ($value == "on") {
?>
				<h3 class="panel-title"><?php the_title(); ?><span class="label label-success"><i>Beste Keus!</i></span></h3>
<?php
			} else {
?>
				<h3 class="panel-title"><?php the_title(); ?></h3>
<?php
			}
?>
		</div>
		<div class="panel-body">
<?php
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_euro', true);
			$value2 = get_post_meta( $post->ID, 'prijzen_item_meta_box_eurocenten', true);
			if (!empty($value) && !empty($value2)) {
?>
			<span class="price"><sup>&euro;</sup><?php echo $value; ?><sup><?php echo $value2; ?></sup></span>
<?php
			}
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_subtitle', true);
			if (!empty($value)) {
?>
			<span class="period"><?php echo $value ?></span>
<?php
			}
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_arguments', true);
			if (!empty($value)) {
?>
		</div>
		<ul class="list-group">
<?php
			$array = explode( "\r\n", $value );
			foreach ($array as &$line) {
				$output = preg_replace("/\*(.*?)\*/", "<b>$1</b>", $line);
?>
				<li class="list-group-item"><?php echo $output; ?></li>
<?php
				}
			}
?>
		</ul>
	</div>
</div>


