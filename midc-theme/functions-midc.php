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

?>