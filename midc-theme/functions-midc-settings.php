<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Instellingen', 'Muziek i/d Cathrien', 'manage_options', 'plugin', 'midc_options_page');
}

function midc_options_page() {
	?>

	<div class="wrap">
	<h2>Muziek in de Cathrien - Instellingen</h2>
	Op deze pagina kun je de algemene informatie opgeven voor concerten. Dit worden de standaardwaarden die
	worden toegepast op concerten. Afwijkingen kunnen dan worden opgegeven per concert. 
	<form action="options.php" method="post">

	<?php
	settings_fields('midc_options_data');
	do_settings_sections('midc_options');
	submit_button();
	?>
	</form>
	</div>
 
<?php
}

add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init() {
	register_setting( 'midc_options_data', 'midc_options_data', 'midc_options_data_validate' );
	
	add_settings_section('midc_options_prijzen', 'Standaard entree prijzen', 'midc_section_prijzen', 'midc_options');
	add_settings_field('midc_option_prijs_standaard', 'Aan de kassa:', 'midc_option_prijs_standaard', 'midc_options', 'midc_options_prijzen');
	add_settings_field('midc_option_prijs_strippenkaart', 'Met Strippenkaart:', 'midc_option_prijs_strippenkaart', 'midc_options', 'midc_options_prijzen');
	add_settings_field('midc_option_prijs_cke_kaart', 'Met CKE-kaart:', 'midc_option_prijs_cke_kaart', 'midc_options', 'midc_options_prijzen');
	add_settings_field('midc_option_prijs_cjp', 'Met CJP-pas:', 'midc_option_prijs_cjp', 'midc_options', 'midc_options_prijzen');
	add_settings_field('midc_option_prijs_kinderen', 'Kinderen tot 16 jaar:', 'midc_option_prijs_kinderen', 'midc_options', 'midc_options_prijzen');

	add_settings_section('midc_options_overig', 'Standaard overige informatie', 'midc_options_overig', 'midc_options');
	add_settings_field('midc_option_overig_drankje1', 'Locatie drankje #1:', 'midc_option_overig_drankje1', 'midc_options', 'midc_options_overig');
	add_settings_field('midc_option_overig_drankje2', 'Locatie drankje #2:', 'midc_option_overig_drankje2', 'midc_options', 'midc_options_overig');
	add_settings_field('midc_option_overig_drankje3', 'Locatie drankje #3:', 'midc_option_overig_drankje3', 'midc_options', 'midc_options_overig');
}

/* SECTIE #1 - Prijzen */

function midc_section_prijzen() {
	echo '<p>Vul hieronder de standaard prijzen in voor toegang tot één concert:</p>';
}

function midc_option_prijs_standaard() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_standaard' name='midc_options_data[midc_option_prijs_standaard]' size='6' type='text' value='{$options['midc_option_prijs_standaard']}' />";
	echo "&nbsp;<small>bv. 7,00</small>";
}

function midc_option_prijs_strippenkaart() {
	$options = get_option('midc_options_data');
	echo '<select name="midc_option_prijs_strippenkaart" id="midc_option_prijs_strippenkaart">';
	for ($i = 1; $i < 9; $i++) {
		echo '<option value="', $i, '"', $options['midc_option_prijs_strippenkaart'] == $i ? ' selected="selected"' : '', '>', $i, '</option>';
	}
	echo '</select>&nbsp;<small>strip(pen)</small>';
}

function midc_option_prijs_cke_kaart() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_cke_kaart' name='midc_options_data[midc_option_prijs_cke_kaart]' size='6' type='text' value='{$options['midc_option_prijs_cke_kaart']}' />";
	echo "&nbsp;<small>bv. 7,00</small>";
}

function midc_option_prijs_cjp() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_cjp' name='midc_options_data[midc_option_prijs_cjp]' size='6' type='text' value='{$options['midc_option_prijs_cjp']}' />";
	echo "&nbsp;<small>bv. 7,00</small>";
}

function midc_option_prijs_kinderen() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_kinderen' name='midc_options_data[midc_option_prijs_kinderen]' size='6' type='text' value='{$options['midc_option_prijs_kinderen']}' />";
	echo "&nbsp;<small>bv. 7,00</small>";
}

/* SECTIE #2 - Overig */

function midc_section_overig() {
	echo '<p>Hieronder kun je overige informatie opgeven die geldt voor alle concerten, zoals de locaties waar na afloop een glaasje wordt gedronken:</p>';
}

function midc_option_overig_drankje1() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje1_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje1_naam]' size='40' type='text' value='{$options['midc_option_overig_drankje1_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje1_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje1_adres]' size='40' type='text' value='{$options['midc_option_overig_drankje1_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje1_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje1_website]' size='40' type='text' value='{$options['midc_option_overig_drankje1_website']}' />";
}

function midc_option_overig_drankje2() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje2_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje2_naam]' size='40' type='text' value='{$options['midc_option_overig_drankje2_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje2_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje2_adres]' size='40' type='text' value='{$options['midc_option_overig_drankje2_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje2_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje2_website]' size='40' type='text' value='{$options['midc_option_overig_drankje2_website']}' />";
}

function midc_option_overig_drankje3() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje3_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje3_naam]' size='40' type='text' value='{$options['midc_option_overig_drankje3_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje3_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje3_adres]' size='40' type='text' value='{$options['midc_option_overig_drankje3_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje3_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje3_website]' size='40' type='text' value='{$options['midc_option_overig_drankje3_website']}' />";
}

/* VALIDATION of all sections */

function midc_options_data_validate($input) {

	// SECTIE #1 - Prijzen
	
	if (!preg_match('/^[1-9]{1}[0-9]{0,2},[0-9]{2}$/i', $input['midc_option_prijs_standaard'])) {
		$input['midc_option_prijs_standaard'] = '7,00';
	}

	$selected = $_POST['midc_option_prijs_strippenkaart'];
	if (!preg_match('/^[1-9]{1}$/i', $selected)) {
		$input['midc_option_prijs_strippenkaart'] = '3';
	}

	if (!preg_match('/^[1-9]{1}[0-9]{0,2},[0-9]{2}$/i', $input['midc_option_prijs_cke_kaart'])) {
		$input['midc_option_prijs_cke_kaart'] = '7,00';
	}

	if (!preg_match('/^[1-9]{1}[0-9]{0,2},[0-9]{2}$/i', $input['midc_option_prijs_cjp'])) {
		$input['midc_option_prijs_cjp'] = '7,00';
	}

	if (!preg_match('/^[1-9]{1}[0-9]{0,2},[0-9]{2}$/i', $input['midc_option_prijs_kinderen'])) {
		$input['midc_option_prijs_kinderen'] = '7,00';
	}

	// SECTIE #2 - Overig

	// Drankje 1
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_overig_drankje1_naam'])) {
		$input['midc_option_overig_drankje1_naam'] = '';
	}
	if (!preg_match('/^.{1,100}$/i', $input['midc_option_overig_drankje1_adres'])) {
		$input['midc_option_overig_drankje1_adres'] = '';
	}
	if (!preg_match('/^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/i', $input['midc_option_overig_drankje1_website'])) {
		$input['midc_option_overig_drankje1_website'] = '';
	}

	// Drankje 2
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_overig_drankje2_naam'])) {
		$input['midc_option_overig_drankje2_naam'] = '';
	}
	if (!preg_match('/^.{1,100}$/i', $input['midc_option_overig_drankje2_adres'])) {
		$input['midc_option_overig_drankje2_adres'] = '';
	}
	if (!preg_match('/^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/i', $input['midc_option_overig_drankje2_website'])) {
		$input['midc_option_overig_drankje2_website'] = '';
	}

	// Drankje 3
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_overig_drankje3_naam'])) {
		$input['midc_option_overig_drankje3_naam'] = '';
	}
	if (!preg_match('/^.{1,100}$/i', $input['midc_option_overig_drankje3_adres'])) {
		$input['midc_option_overig_drankje3_adres'] = '';
	}
	if (!preg_match('/^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/i', $input['midc_option_overig_drankje3_website'])) {
		$input['midc_option_overig_drankje3_website'] = '';
	}
	

	return $input;
}


?>