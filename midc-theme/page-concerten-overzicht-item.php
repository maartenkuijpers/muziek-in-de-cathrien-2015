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

$date = get_post_meta($post->ID, 'midc_concerten_meta_datum', true);
$date_long = $date;
$date_short = $date;
$time = get_post_meta($post->ID, 'midc_concerten_meta_tijd', true);
$prices = "&euro;7,- / gratis voor donateurs, CJP, studenten en kinderen tot 16 jaar";
$summary = substr( wp_strip_all_tags( get_the_content() ), 0, 140);
$type_value = get_post_meta($post->ID, 'midc_concerten_meta_type', true);
$type = "";
switch ($type_value) {
	case 1: $type = "Event_MuziekInDeCathrien_org.png"; break;
	case 2: $type = "Event_OrgelMuziekInDeCathrien_org.png"; break;
	case 3: $type = "Event_KoorMuziekInDeCathrien_org.png"; break;
	case 4: $type = "Event_KamerMuziekInDeCathrien_org.png"; break;
	default: $type = "Event_MuziekInDeCathrien_org.png"; break;
}

?>

<div class="col-md-4 portfolio-item">
    <a href="concert.html">
        <div class="title"><?php the_title();
?></div>
<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
?>
    </a>
    <h3>
        <a href="concert.html"><?php echo($date_long);
?></a>
    </h3>

    <p>
        <?php echo ($summary);
?>
        <a href="concert.html">lees meer...</a>
    </p>

    <p>
        <div class="item-info">
            <img src="<?php echo(get_stylesheet_directory_uri() . "/images/" . $type);
?>" /><br />
<?php echo( $date_short . " | " . $time . " | " . $prices );
?>
        </div>
    </p>
</div>
