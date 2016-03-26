<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

function midc_get_title( $title )
{
	$parts = explode("|", $title);
	return $parts[0];
}

function midc_get_sub_title( $title )
{
	$parts = explode("|", $title);
	if (count($parts) > 1)
		return $parts[1];
	return "";
}

function midc_copyright_year()
{
	echo(date("o", time()));
}

function midc_get_concert_prices( $post_id )
{
    $array = array ( 
        array('regulier: ', 'midc_concerten_prijzen_standaard', '&euro;', ''),
        array('donateurs: ', 'midc_concerten_prijzen_donateurs', '&euro;', ''),
        array('strippenkaart: ', 'midc_concerten_prijzen_strippenkaart', '', ' x strip'),
        array('CKE kaart: ', 'midc_concerten_prijzen_cke_kaart', '&euro;', ''),
        array('CJP: ', 'midc_concerten_prijzen_cjp', '&euro;', ''),
        array('tot 16 jaar: ', 'midc_concerten_prijzen_kinderen', '&euro;', '')
    );
    $prices = '';
    foreach ($array as $pricing) {
        $active = get_post_meta($post_id, $pricing[1] . '_active', true);
        $value = get_post_meta($post_id, $pricing[1], true);
        if ($active)
        {
            if (!empty($prices))
                $prices = $prices . ' / '; 
            if (floatval($value) != 0.0)
                $prices = $prices . $pricing[0] . $pricing[2] . $value . $pricing[3];
            else
                $prices = $prices . $pricing[0] . 'gratis';
        }
    }
    
    return $prices; 
}
?>