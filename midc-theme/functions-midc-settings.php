<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'midc_options_page');
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
	add_settings_section('midc_options_prijzen', 'Prijzen', 'midc_section_prijzen', 'midc_options');
	add_settings_field('plugin_text_string', 'Plugin Text Input', 'plugin_setting_string', 'midc_options', 'midc_options_prijzen');
}

function midc_section_prijzen() {
	echo '<p>Hier kun je de verschillende prijsstellingen voor concert entree opgeven.</p>';
}

function plugin_setting_string() {
	$options = get_option('midc_options_data');
	echo "<input id='plugin_text_string' name='midc_options_data[text_string]' size='40' type='text' value='{$options['text_string']}' />";
}

function midc_options_data_validate($input) {
	$newinput['text_string'] = trim($input['text_string']);
	if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
		$newinput['text_string'] = 'test';
	}
	return $newinput;
}


?>