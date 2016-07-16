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
 
global $template_order;
if (!strpos($template_order, 'page-prijzen.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}

?>

<div class="col-md-4">
	<div class="panel panel-primary text-center">
		<div class="panel-heading">
            <?php
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_recommended', true);
			if ($value != 0) {
            ?>
				<h3 class="panel-title"><?php the_title(); ?>&nbsp;<span class="label label-success"><i>Beste Keus!</i></span></h3>
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
				$line = preg_replace("/\*(.*?)\*/", "<b>$1</b>", $line);
				$line = preg_replace("/\|(.*?)\|(.*?)\|/", "<a href='?p=$1'>$2</a>", $line);
                ?>
				<li class="list-group-item"><?php echo $line; ?></li>
                <?php
				}
			}
			$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_actiontext', true);
			if (!empty($value)) {
				$value_url = get_post_meta( $post->ID, 'prijzen_item_meta_box_actionlink', true);
				if (intval($value_url) != 0) {
					$value_url = '?p=' . $value_url;
				}
            ?>
                <li class="list-group-item">
                    <a href="<?php echo $value_url; ?>" class="btn btn-success btn-primary"><?php echo $value; ?></a>
                </li>
            <?php
			}
            ?>
		</ul>
	</div>
</div>
