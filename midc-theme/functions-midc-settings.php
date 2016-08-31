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

	add_settings_section('midc_options_algemeen', 'Algemene informatie', 'midc_options_algemeen', 'midc_options');
	add_settings_field('midc_option_algemeen_locatie_naam', 'Naam:', 'midc_option_algemeen_locatie_naam', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_locatie_adres', 'Adres:', 'midc_option_algemeen_locatie_adres', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_locatie_plaats', 'Plaats:', 'midc_option_algemeen_locatie_plaats', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_tijd_aanvang', 'Aanvang:', 'midc_option_algemeen_tijd_aanvang', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_tijd_einde', 'Einde:', 'midc_option_algemeen_tijd_einde', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_contact', 'Contact pagina:', 'midc_option_algemeen_contact', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_social_facebook', 'Facebook URL:', 'midc_option_algemeen_social_facebook', 'midc_options', 'midc_options_algemeen');
	add_settings_field('midc_option_algemeen_social_twitter', 'Twitter URL:', 'midc_option_algemeen_social_twitter', 'midc_options', 'midc_options_algemeen');
	
	add_settings_section('midc_options_prijs', 'Standaard entree prijzen', 'midc_options_prijs', 'midc_options');
	add_settings_field('midc_option_prijs_standaard', 'Aan de kassa:', 'midc_option_prijs_standaard', 'midc_options', 'midc_options_prijs');
	add_settings_field('midc_option_prijs_donateurs', 'Donateurs:', 'midc_option_prijs_donateurs', 'midc_options', 'midc_options_prijs');
	add_settings_field('midc_option_prijs_strippenkaart', 'Met Strippenkaart:', 'midc_option_prijs_strippenkaart', 'midc_options', 'midc_options_prijs');
	add_settings_field('midc_option_prijs_cke_kaart', 'Met CKE-kaart:', 'midc_option_prijs_cke_kaart', 'midc_options', 'midc_options_prijs');
	add_settings_field('midc_option_prijs_cjp', 'Met CJP-pas:', 'midc_option_prijs_cjp', 'midc_options', 'midc_options_prijs');
	add_settings_field('midc_option_prijs_kinderen', 'Kinderen tot 16 jaar:', 'midc_option_prijs_kinderen', 'midc_options', 'midc_options_prijs');

	add_settings_section('midc_options_overig', 'Standaard overige informatie', 'midc_options_overig', 'midc_options');
	add_settings_field('midc_option_overig_drankje1', 'Locatie drankje #1:', 'midc_option_overig_drankje1', 'midc_options', 'midc_options_overig');
	add_settings_field('midc_option_overig_drankje2', 'Locatie drankje #2:', 'midc_option_overig_drankje2', 'midc_options', 'midc_options_overig');
	add_settings_field('midc_option_overig_drankje3', 'Locatie drankje #3:', 'midc_option_overig_drankje3', 'midc_options', 'midc_options_overig');

	add_settings_section('midc_options_footer', 'Footer kolommen', 'midc_options_footer', 'midc_options');
	add_settings_field('midc_option_footer1', 'Kolom #1:', 'midc_option_footer1', 'midc_options', 'midc_options_footer');
	add_settings_field('midc_option_footer2', 'Kolom #2:', 'midc_option_footer2', 'midc_options', 'midc_options_footer');
	add_settings_field('midc_option_footer3', 'Kolom #3:', 'midc_option_footer3', 'midc_options', 'midc_options_footer');
	add_settings_field('midc_option_footer4', 'Kolom #4:', 'midc_option_footer4', 'midc_options', 'midc_options_footer');
}

/* SECTIE #1 - Algemeen */

function midc_options_algemeen() {
	echo '<p>Geef hieronder de algemene informatie die wordt gebruikt bij het aanmaken van een <strong>nieuw</strong> concert.</br>';
	echo 'Let op dat voor bestaande concerten de gegevens niet gewijzigd worden!</p>';
}

function midc_option_algemeen_locatie_naam() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_locatie_naam' placeholder='naam' name='midc_options_data[midc_option_algemeen_locatie_naam]' maxlength='40' size='40' type='text' value='{$options['midc_option_algemeen_locatie_naam']}' />";
	echo "&nbsp;<small>bv. Stadskerk St. Cathrien</small>";
}

function midc_option_algemeen_locatie_adres() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_locatie_adres' placeholder='straat, nummer' name='midc_options_data[midc_option_algemeen_locatie_adres]' maxlength='40' size='40' type='text' value='{$options['midc_option_algemeen_locatie_adres']}' />";
	echo "&nbsp;<small>bv. Kerkstraat 1</small>";
}

function midc_option_algemeen_locatie_plaats() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_locatie_plaats' placeholder='plaatsnaam' name='midc_options_data[midc_option_algemeen_locatie_plaats]' maxlength='40' size='40' type='text' value='{$options['midc_option_algemeen_locatie_plaats']}' />";
	echo "&nbsp;<small>bv. Eindhoven</small>";
}

function midc_option_algemeen_tijd_aanvang() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_tijd_aanvang' placeholder='hh.mm' name='midc_options_data[midc_option_algemeen_tijd_aanvang]' maxlength='5' size='5' type='text' value='{$options['midc_option_algemeen_tijd_aanvang']}' />";
	echo "&nbsp;<small>bv. 15.00</small>";
}

function midc_option_algemeen_tijd_einde() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_tijd_einde' placeholder='hh.mm' name='midc_options_data[midc_option_algemeen_tijd_einde]' maxlength='5' size='5' type='text' value='{$options['midc_option_algemeen_tijd_einde']}' />";
	echo "&nbsp;<small>bv. 16.00</small>";
}

function midc_option_algemeen_contact() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_contact' placeholder='url van de contactpagina' name='midc_options_data[midc_option_algemeen_contact]' maxlength='255' size='40' type='text' value='{$options['midc_option_algemeen_contact']}' />";
}

function midc_option_algemeen_social_facebook() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_social_facebook' placeholder='https://www.facebook.com/...' name='midc_options_data[midc_option_algemeen_social_facebook]' maxlength='255' size='40' type='text' value='{$options['midc_option_algemeen_social_facebook']}' />";
}

function midc_option_algemeen_social_twitter() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_algemeen_social_twitter' placeholder='https://www.twitter.com/...' name='midc_options_data[midc_option_algemeen_social_twitter]' maxlength='255' size='40' type='text' value='{$options['midc_option_algemeen_social_twitter']}' />";
}

/* SECTIE #2 - Prijzen */

function midc_options_prijs() {
	echo '<p>Geef hieronder de standaard prijzen in die worden gebruikt bij het aanmaken van een nieuw concert:</p>';
}

function midc_option_prijs_standaard() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_standaard' name='midc_options_data[midc_option_prijs_standaard]' maxlength='6' size='6' type='text' value='{$options['midc_option_prijs_standaard']}' />";
	echo "&nbsp;<small>bv. 7,00 of 0,00 voor gratis</small>";
}

function midc_option_prijs_donateurs() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_donateurs' name='midc_options_data[midc_option_prijs_donateurs]' maxlength='6' size='6' type='text' value='{$options['midc_option_prijs_donateurs']}' />";
	echo "&nbsp;<small>bv. 7,00 of 0,00 voor gratis</small>";
}

function midc_option_prijs_strippenkaart() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_prijs_strippenkaart' maxlength='1' name='midc_options_data[midc_option_prijs_strippenkaart]' size='1' type='text' value='{$options['midc_option_prijs_strippenkaart']}' />";
	echo "</select>&nbsp;<small>strip(pen)</small>";
}

function midc_option_prijs_cke_kaart() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_cke_kaart' name='midc_options_data[midc_option_prijs_cke_kaart]' maxlength='6' size='6' type='text' value='{$options['midc_option_prijs_cke_kaart']}' />";
	echo "&nbsp;<small>bv. 7,00 of 0,00 voor gratis</small>";
}

function midc_option_prijs_cjp() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_cjp' name='midc_options_data[midc_option_prijs_cjp]' maxlength='6' size='6' type='text' value='{$options['midc_option_prijs_cjp']}' />";
	echo "&nbsp;<small>bv. 7,00 of 0,00 voor gratis</small>";
}

function midc_option_prijs_kinderen() {
	$options = get_option('midc_options_data');
	echo "€<input id='midc_option_prijs_kinderen' name='midc_options_data[midc_option_prijs_kinderen]' maxlength='6' size='6' type='text' value='{$options['midc_option_prijs_kinderen']}' />";
	echo "&nbsp;<small>bv. 7,00 of 0,00 voor gratis</small>";
}

/* SECTIE #3 - Overig */

function midc_options_overig() {
	echo '<p>Geef hieronder de locaties op voor een drankje die worden gebruikt bij het aanmaken van een nieuw concert:</p>';
}

function midc_option_overig_drankje1() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje1_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje1_naam]' maxlength='40' size='40' type='text' value='{$options['midc_option_overig_drankje1_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje1_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje1_adres]' maxlength='100' size='40' type='text' value='{$options['midc_option_overig_drankje1_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje1_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje1_website]' maxlength='255' size='40' type='text' value='{$options['midc_option_overig_drankje1_website']}' />";
}

function midc_option_overig_drankje2() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje2_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje2_naam]' maxlength='40' size='40' type='text' value='{$options['midc_option_overig_drankje2_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje2_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje2_adres]' maxlength='10040' size='40' type='text' value='{$options['midc_option_overig_drankje2_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje2_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje2_website]' maxlength='255' size='40' type='text' value='{$options['midc_option_overig_drankje2_website']}' />";
}

function midc_option_overig_drankje3() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_overig_drankje3_naam' placeholder='naam' name='midc_options_data[midc_option_overig_drankje3_naam]' maxlength='40' size='40' type='text' value='{$options['midc_option_overig_drankje3_naam']}' /><br />";
	echo "<input id='midc_option_overig_drankje3_adres' placeholder='straat, huisnummer (in Eindhoven)' name='midc_options_data[midc_option_overig_drankje3_adres]' maxlength='100' size='40' type='text' value='{$options['midc_option_overig_drankje3_adres']}' /><br />";
	echo "<input id='midc_option_overig_drankje3_website' placeholder='website' name='midc_options_data[midc_option_overig_drankje3_website]' maxlength='255' size='40' type='text' value='{$options['midc_option_overig_drankje3_website']}' />";
}

/* SECTIE #4 - Footer Kolommen */

function midc_options_footer() {
	echo 'Gebruik de footer kolommen om informatie in de footer weer te geven. Je kunt maximaal 4 kolommen gebruiken. ';
	echo 'Een kolom wordt alleen weergegeven wanneer zowel de <strong>Breedte</strong> als de <strong>Body</strong> gevuld is. ';
	echo 'De kolombreedte is in totaal 12 (vanwege Bootstrap-grid). Per kolom kun je aangeven welk 12e deel wordt gebruikt. ';
	echo 'Zo is de waarde 3 gelijk aan 25% breedte, 4 = 33%, 6 = 50%, etc. Het totaal van de kolombreedtes mag niet boven de 12 uitkomen.';
	echo 'In de Body kun je van alles kwijt: tekst, plaatjes, lijstjes, links, ruwe html etc.';
}

function midc_option_footer1() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_footer1_breedte' placeholder='breedte [12e deel]' name='midc_options_data[midc_option_footer1_breedte]' maxlength='2' size='20' type='text' value='{$options['midc_option_footer1_breedte']}' />";

	$editor_id = 'midc_option_footer1_body';
	$settings = array( 'media_buttons' => true, 'teeny' => false, 'textarea_rows' => 10, 'wpautop' => false, 'textarea_name' => 'midc_options_data[midc_option_footer1_body]' );
	wp_editor( $options[$editor_id], $editor_id, $settings );
}

function midc_option_footer2() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_footer2_breedte' placeholder='breedte [12e deel]' name='midc_options_data[midc_option_footer2_breedte]' maxlength='2' size='20' type='text' value='{$options['midc_option_footer2_breedte']}' />";

	$editor_id = 'midc_option_footer2_body';
	$settings = array( 'media_buttons' => true, 'teeny' => false, 'textarea_rows' => 10, 'wpautop' => false, 'textarea_name' => 'midc_options_data[midc_option_footer2_body]' );
	wp_editor( $options[$editor_id], $editor_id, $settings );
}

function midc_option_footer3() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_footer3_breedte' placeholder='breedte [12e deel]' name='midc_options_data[midc_option_footer3_breedte]' maxlength='2' size='20' type='text' value='{$options['midc_option_footer3_breedte']}' />";

	$editor_id = 'midc_option_footer3_body';
	$settings = array( 'media_buttons' => true, 'teeny' => false, 'textarea_rows' => 10, 'wpautop' => false, 'textarea_name' => 'midc_options_data[midc_option_footer3_body]' );
	wp_editor( $options[$editor_id], $editor_id, $settings );
}

function midc_option_footer4() {
	$options = get_option('midc_options_data');
	echo "<input id='midc_option_footer4_breedte' placeholder='breedte [12e deel]' name='midc_options_data[midc_option_footer4_breedte]' maxlength='2' size='20' type='text' value='{$options['midc_option_footer4_breedte']}' />";

	$editor_id = 'midc_option_footer4_body';
	$settings = array( 'media_buttons' => true, 'teeny' => false, 'textarea_rows' => 10, 'wpautop' => false, 'textarea_name' => 'midc_options_data[midc_option_footer4_body]' );
	wp_editor( $options[$editor_id], $editor_id, $settings );
}

/* VALIDATION of all sections */

function midc_options_data_validate($input) {

	// SECTIE #1 - Algemeen
	
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_algemeen_locatie_naam'])) {
		$input['midc_option_algemeen_locatie_naam'] = '';
	}
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_algemeen_locatie_adres'])) {
		$input['midc_option_algemeen_locatie_adres'] = '';
	}
	if (!preg_match('/^.{1,40}$/i', $input['midc_option_algemeen_locatie_plaats'])) {
		$input['midc_option_algemeen_locatie_plaats'] = '';
	}
	if (!preg_match('/^\d{1,2}\.\d{2}$/i', $input['midc_option_algemeen_tijd_aanvang'])) {
		$input['midc_option_algemeen_tijd_aanvang'] = '';
	}
	if (!preg_match('/^\d{1,2}\.\d{2}$/i', $input['midc_option_algemeen_tijd_einde'])) {
		$input['midc_option_algemeen_tijd_einde'] = '';
	}

	// Contact
	if (!preg_match('/^.{0,255}$/i', $input['midc_option_algemeen_contact'])) {
		$input['midc_option_algemeen_contact'] = '';
	}

	// Social Channels
	if (!preg_match('/^.{0,255}$/i', $input['midc_option_algemeen_social_facebook'])) {
		$input['midc_option_algemeen_social_facebook'] = '';
	}
	if (!preg_match('/^.{0,255}$/i', $input['midc_option_algemeen_social_twitter'])) {
		$input['midc_option_algemeen_social_twitter'] = '';
	}

	
	// SECTIE #2 - Prijzen
	
	if (!preg_match('/^[0-9]{1,2},[0-9]{2}$/i', $input['midc_option_prijs_standaard'])) {
		$input['midc_option_prijs_standaard'] = '7,00';
	}

	if (!preg_match('/^[0-9]{1,2},[0-9]{2}$/i', $input['midc_option_prijs_donateurs'])) {
		$input['midc_option_prijs_donateurs'] = '7,00';
	}

	if (!preg_match('/^[1-9]{1}$/i', $input['midc_option_prijs_strippenkaart'])) {
		$input['midc_option_prijs_strippenkaart'] = '1';
	}

	if (!preg_match('/^[0-9]{1,2},[0-9]{2}$/i', $input['midc_option_prijs_cke_kaart'])) {
		$input['midc_option_prijs_cke_kaart'] = '7,00';
	}

	if (!preg_match('/^[0-9]{1,2},[0-9]{2}$/i', $input['midc_option_prijs_cjp'])) {
		$input['midc_option_prijs_cjp'] = '7,00';
	}

	if (!preg_match('/^[0-9]{1,2},[0-9]{2}$/i', $input['midc_option_prijs_kinderen'])) {
		$input['midc_option_prijs_kinderen'] = '7,00';
	}

	// SECTIE #3 - Overig

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
	
	// SECTIE #4 - Footer kolommen

	// Footer 1
	if (!preg_match('/^.{1,2}$/i', $input['midc_option_footer1_breedte'])) {
		$input['midc_option_footer1_breedte'] = '';
	}
	// Footer 2
	if (!preg_match('/^.{1,2}$/i', $input['midc_option_footer2_breedte'])) {
		$input['midc_option_footer2_breedte'] = '';
	}
	// Footer 3
	if (!preg_match('/^.{1,2}$/i', $input['midc_option_footer3_breedte'])) {
		$input['midc_option_footer3_breedte'] = '';
	}
	// Footer 4
	if (!preg_match('/^.{1,2}$/i', $input['midc_option_footer4_breedte'])) {
		$input['midc_option_footer4_breedte'] = '';
	}

	return $input;
}

?>