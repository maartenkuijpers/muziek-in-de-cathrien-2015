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
 * This is the Concerten Overzicht Item template.
 */

global $template_order;
if (!strpos($template_order, 'page-container-concerten-overzicht.php')) {
    //wp_redirect(get_permalink( $post->post_parent ));
    //exit;
}

$locale = get_the_terms($post->ID, 'language')[0]->description;
setlocale(LC_ALL, 'nl_NL');

$date = get_post_meta($post->ID, 'midc_concerten_meta_datum', true);
$date_value = date_parse_from_format("j-n-Y", $date);
$date_unix = mktime(0, 0, 0, $date_value['month'], $date_value['day'], $date_value['year']); 
$date_long = strftime("%A %d %B", $date_unix);
if ($date_value['year'] != date('Y')) {
    $date_long .= ' ' . $date_value['year'];
}
$date_short = strftime("%a %d %b", $date_unix);
$time = get_post_meta($post->ID, 'midc_concerten_meta_aanvang', true);
$prices = midc_get_concert_prices($post->ID);;
$summary_text = wp_strip_all_tags(get_the_content('Read more'));
//$summary = substr(wp_strip_all_tags(get_the_content('Read more')), 0, 150);
$summary = $summary_text;
if (preg_match('/^.{1,150}\b/s', $summary_text, $match))
{
    $summary=$match[0];
}
$type_value = get_post_meta($post->ID, 'midc_concerten_meta_type', true);
$type = "";
switch ($type_value) {
	case 1: $type = "Event_MuziekInDeCathrien_org.png"; break;
	case 2: $type = "Event_KamerMuziekInDeCathrien_org.png"; break;
	case 3: $type = "Event_KoorMuziekInDeCathrien_org.png"; break;
	case 4: $type = "Event_OrgelMuziekInDeCathrien_org.png"; break;
	default: $type = "Event_MuziekInDeCathrien_org.png"; break;
}

?>

<a href="<?php the_permalink() ?>">
	<div class="portfolio-item">
        <div class="title"><?php the_title(); ?></div>
        <?php
        the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
        ?>
		<h3>
			<?php echo($date_long); ?>
		</h3>
		<div class="concert-summary">
			<?php echo ($summary); ?>
			<span class="link">lees meer...</span>
		</div>

		<div class="item-info">
			<img src="<?php echo(get_stylesheet_directory_uri() . "/images/" . $type); ?>" /><br />
			<?php echo( $date_short . " | " . $time . " | " . $prices ); ?>
		</div>
	</div>
</a>

