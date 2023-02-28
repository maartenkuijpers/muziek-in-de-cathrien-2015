<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

// Register Custom Navigation Walker
require_once('wp_bootstrap_pagination.php');

function midc_get_title($title)
{
    $parts = explode("|", $title);
    return $parts[0];
}

function midc_get_sub_title($title)
{
    $parts = explode("|", $title);
    if (count($parts) > 1) {
        return $parts[1];
    }
    return "";
}

function midc_copyright_year()
{
    echo(date("o", time()));
}

function midc_get_concert_prices($post_id)
{
    $prices = 'prijsinformatie vindt u in de tekst.';

    /*
    $array = array(
        array('regulier: ', 'midc_concerten_prijzen_standaard', '&euro;', ''),
        array('donateurs: ', 'midc_concerten_prijzen_donateurs', '&euro;', ''),
        array('strippenkaart: ', 'midc_concerten_prijzen_strippenkaart', '', ' x strip'),
        array('CKE kaart: ', 'midc_concerten_prijzen_cke_kaart', '&euro;', ''),
        array('CJP, student & jongere: ', 'midc_concerten_prijzen_cjp', '&euro;', ''),
        array('t/m 12 jaar: ', 'midc_concerten_prijzen_kinderen', '&euro;', '')
    );
    foreach ($array as $pricing) {
        $active = get_post_meta($post_id, $pricing[1] . '_active', true);
        $value = get_post_meta($post_id, $pricing[1], true);
        if ($active) {
            if (!empty($prices)) {
                $prices = $prices . ' / ';
            }
            if (floatval($value) != 0.0) {
                $prices = $prices . $pricing[0] . $pricing[2] . $value . $pricing[3];
            } else {
                $prices = $prices . $pricing[0] . 'gratis';
            }
        }
    }
    */

    return $prices;
}

// exclude any content from search results that use specific page templates
// http://stackoverflow.com/questions/7462999/how-to-exclude-wordpress-page-templatecustom-template-from-search-results
function exclude_page_templates_from_search($query)
{
    global $wp_the_query;

    if (($wp_the_query === $query) && (is_search()) && (! is_admin())) {
        $args = array_merge($wp_the_query->query, array(
        'meta_query' => array(
            array(
                'key' => '_wp_page_template',
                'value' => 'page-bestuur-item.php',
                'compare' => '!='
                ),
            array(
                'key' => '_wp_page_template',
                'value' => 'page-concert-in-beeld-item.php',
                'compare' => '!='
                ),
            array(
                'key' => '_wp_page_template',
                'value' => 'page-container-album-item.php',
                'compare' => '!='
                ),
            array(
                'key' => '_wp_page_template',
                'value' => 'page-container-twee-kolommen.php',
                'compare' => '!='
                )

            ),
        ));

        query_posts($args);
    }
}
//add_filter('pre_get_posts','exclude_page_templates_from_search');
