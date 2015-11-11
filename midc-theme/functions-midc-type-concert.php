<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

function midc_create_post_type() {
  register_post_type( 'concert',
    array(
      'labels' => array(
        'name' => __( 'Concerten' ),
        'singular_name' => __( 'Concert' ),
        'add_new' => __( 'Nieuw Concert' ), 
        'add_new_item' => __( 'Nieuw Concert' ), 
        'edit_item' => __( 'Edit Concert' ), 
        'new_item' => __( 'Nieuw Concert' ), 
        'view_item' => __( 'View Concert' ), 
        'search_items' => __( 'Zoek Concert' ), 
        'not_found' => __( 'Geen concerten gevonden' ), 
        'not_found_in_trash' => __( 'Geen concerten gevonden in prullenbak' ) 
      ),
      'public' => true,
	  'supports' => array( 'title', 'editor', 'thumbnail' ),
	  'menu_position' => 5,
	  'register_meta_box_cb' => 'midc_concert_post_meta_box_callback',
    )
  );
}
add_action( 'init', 'midc_create_post_type' );

// Show posts of 'post', 'page' and 'movie' post types on home page
function add_concert_post_types_to_query( $query ) {
  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array( 'concert' ) ); // you can also add 'post', 'page', it defines the order
  return $query;
}
add_action( 'pre_get_posts', 'add_concert_post_types_to_query' );

function midc_concert_post_meta_box_callback() {
	add_meta_box('midc_concerten_meta', 'Algemene gegevens', 'midc_concerten_meta_callback', 'concert', 'side', 'default');
	add_meta_box('midc_concerten_artistiek', 'Programma & Uitvoerenden', 'midc_concerten_artistiek_callback', 'concert', 'side', 'default');
	add_meta_box('midc_concerten_prijzen', 'Prijsgegevens', 'midc_concerten_prijzen_callback', 'concert', 'side', 'default');
	add_meta_box('midc_concerten_overig', 'Overige', 'midc_concerten_overig_callback', 'concert', 'side', 'default');
}

function midc_concerten_artistiek_callback($post) {
	//global $post; 
	wp_nonce_field( 'midc_concerten_artistiek', 'midc_concerten_artistiek_nonce' );

	// Programma
	echo '<p><label for="midc_concerten_artistiek_programma">Programma: <small>Compacte weergave van de uit te voeren werken</small></label>'; 
    $value = get_post_meta($post->ID, 'midc_concerten_artistiek_programma', true); 
	if ($value == "") $value = '<p>Het programma voor dit concert wordt binnenkort toegevoegd. Kom gauw weer eens kijken!</p>';
	$editor_id = 'midc_concerten_artistiek_programma';
	$settings = array( 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 5, 'wpautop' => false );
	wp_editor( $value, $editor_id, $settings );
    echo '</p>';

	// Uitvoerenden
	echo '<p><label for="midc_concerten_artistiek_uitvoerenden">Uitvoerenden: <small>Compacte weergave van de uitvoerenden</small></label>'; 
    $value = get_post_meta($post->ID, 'midc_concerten_artistiek_uitvoerenden', true); 
	if ($value == "") $value = 'Informatie over de uitvoerenden van dit concert wordt binnenkort toegevoegd. Kom gauw weer eens kijken!';
	$editor_id = 'midc_concerten_artistiek_uitvoerenden';
	$settings = array( 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 5, 'wpautop' => false );
	wp_editor( $value, $editor_id, $settings );
    echo '</p>';
}

function midc_concerten_artistiek_save($post_id, $post) {
	if ( !isset( $_POST['midc_concerten_artistiek_nonce'] ) )
		return $post_id;
	if ( !wp_verify_nonce( $_POST['midc_concerten_artistiek_nonce'], 'midc_concerten_artistiek' ) )
		return $post_id;

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;

	// Programma
	if ( ! isset( $_POST['midc_concerten_artistiek_programma'] ) ) { return; }
	$my_data = stripslashes( $_POST['midc_concerten_artistiek_programma'] );
	update_post_meta( $post_id, 'midc_concerten_artistiek_programma', $my_data );

	// Uitvoerenden
	if ( ! isset( $_POST['midc_concerten_artistiek_uitvoerenden'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_artistiek_uitvoerenden'] );
	update_post_meta( $post_id, 'midc_concerten_artistiek_uitvoerenden', $my_data );
}
add_action('save_post', 'midc_concerten_artistiek_save');

function midc_concerten_meta_callback($post) {
	//global $post; 
	wp_nonce_field( 'midc_concerten_meta', 'midc_concerten_meta_nonce' );

	// Concert type
    $value = get_post_meta($post->ID, 'midc_concerten_meta_type', true);
	echo '<p><label for="midc_concerten_meta_type">Type concert:</label><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="1"' . checked( "1", $value, false) . '>Muziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="2"' . checked( "2", $value, false ) . '>OrgelMuziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="3"' . checked( "3", $value, false ) . '>KoorMuziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="4"' . checked( "4", $value, false ) . '>KamerMuziek in de Cathrien</input><br>';
    echo '</p>';

	// Subtitel Uitvoerenden
    $value = get_post_meta($post->ID, 'midc_concerten_artistiek_subtitel', true); 
	echo '<p><label for="midc_concerten_artistiek_subtitel">Subtitel: <small>Uitvoerenden in &eacute;&eacute;n zin</small></label>'; 
    echo '<input type="text" id="midc_concerten_artistiek_subtitel" name="midc_concerten_artistiek_subtitel" value="' . $value . '" class="widefat" /></p>';

	// Datum
    $value = get_post_meta($post->ID, 'midc_concerten_meta_datum', true); 
	if ($value == "") $value = date("d-m-o", time());
	echo '<p><label for="midc_concerten_meta_datum">Datum: <small>(dd-mm-jjjj)</small></label>'; 
    echo '<input type="text" id="midc_concerten_meta_datum" name="midc_concerten_meta_datum" value="' . $value . '" class="widefat" /></p>';

	// Tijdstip
    $value = get_post_meta($post->ID, 'midc_concerten_meta_tijd', true); 
	if ($value == "") $value = "15.00";
	echo '<p><label for="midc_concerten_meta_tijd">Aanvangstijd: <small>(15.00)</small></label>'; 
    echo '<input type="text" id="midc_concerten_meta_tijd" name="midc_concerten_meta_tijd" value="' . $value . '" class="widefat" /></p>';

	// Locatie
    $value = get_post_meta($post->ID, 'midc_concerten_meta_locatie', true); 
	if ($value == "") $value = "Stadskerk St. Cathrien";
	echo '<p><label for="midc_concerten_meta_locatie">Locatie:</label>'; 
    echo '<input type="text" id="midc_concerten_meta_locatie" name="midc_concerten_meta_locatie" value="' . $value . '" class="widefat" /></p>';
}

function midc_concerten_meta_save($post_id, $post) {
	if ( !isset( $_POST['midc_concerten_meta_nonce'] ) )
		return $post_id;
	if ( !wp_verify_nonce( $_POST['midc_concerten_meta_nonce'], 'midc_concerten_meta' ) )
		return $post_id;

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;

	// Concert type
	if ( ! isset( $_POST['midc_concerten_meta_type'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_meta_type'] );
	update_post_meta( $post_id, 'midc_concerten_meta_type', $my_data );

	// Subtitel Uitvoerenden
	if ( ! isset( $_POST['midc_concerten_artistiek_subtitel'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_artistiek_subtitel'] );
	update_post_meta( $post_id, 'midc_concerten_artistiek_subtitel', $my_data );

	// Datum
	if ( ! isset( $_POST['midc_concerten_meta_datum'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_meta_datum'] );
	update_post_meta( $post_id, 'midc_concerten_meta_datum', $my_data );

	// Tijdstip
	if ( ! isset( $_POST['midc_concerten_meta_tijd'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_meta_tijd'] );
	update_post_meta( $post_id, 'midc_concerten_meta_tijd', $my_data );

	// Locatie
	if ( ! isset( $_POST['midc_concerten_meta_locatie'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['midc_concerten_meta_locatie'] );
	update_post_meta( $post_id, 'midc_concerten_meta_locatie', $my_data );
}
add_action('save_post', 'midc_concerten_meta_save');

function midc_concerten_prijzen_callback($post) {
	wp_nonce_field( 'midc_concerten_prijzen', 'midc_concerten_prijzen_nonce' );
	$options = get_option('midc_options_data');
	
	// NB: Bij eerste load staan alle prijzen-checkboxen aan

	// Aan de kassa
   	$value = (metadata_exists( 'post', $post->ID, 'midc_concerten_prijzen_standaard_active' )) ? get_post_meta($post->ID, 'midc_concerten_prijzen_standaard_active', true) : 'on';
	echo '<p><input name="midc_concerten_prijzen_standaard_active" type="checkbox" ' . checked("on", $value, false) . '>';
    $value = get_post_meta($post->ID, 'midc_concerten_prijzen_standaard', true); 
	if ($value == "") $value = $options['midc_option_prijs_standaard'];
	echo '<label for="midc_concerten_prijzen_standaard">Aan de kassa:</label> €'; 
    echo '<input size="6" type="text" id="midc_concerten_prijzen_standaard" name="midc_concerten_prijzen_standaard" value="' . $value . '" /><small>&nbsp;bv. 7,00</small></p>';

	// Strippenkaart
   	$value = (metadata_exists( 'post', $post->ID, 'midc_concerten_prijzen_strippenkaart_active' )) ? get_post_meta($post->ID, 'midc_concerten_prijzen_strippenkaart_active', true) : 'on';
	echo '<p><input name="midc_concerten_prijzen_strippenkaart_active" type="checkbox" ' . checked( "on", $value, false) . '/>';
    $value = get_post_meta($post->ID, 'midc_concerten_prijzen_strippenkaart', true); 
	if ($value == "") $value = $options['midc_option_prijs_strippenkaart'];
	echo '<label for="midc_concerten_prijzen_strippenkaart">Strippenkaart:</label>&nbsp;'; 
    echo '<input size="2" type="text" id="midc_concerten_prijzen_strippenkaart" name="midc_concerten_prijzen_strippenkaart" value="' . $value . '" /><small>&nbsp;bv. 1</small></p>';

	// Met CKE-kaart
   	$value = (metadata_exists( 'post', $post->ID, 'midc_concerten_prijzen_cke_kaart_active' )) ? get_post_meta($post->ID, 'midc_concerten_prijzen_cke_kaart_active', true) : 'on';
	echo '<p><input name="midc_concerten_prijzen_cke_kaart_active" type="checkbox" ' . checked( "on", $value, false) . '/>';
    $value = get_post_meta($post->ID, 'midc_concerten_prijzen_cke_kaart', true); 
	if ($value == "") $value = $options['midc_option_prijs_cke_kaart'];
	echo '<label for="midc_concerten_prijzen_cke_kaart">CKE-kaart:</label> €'; 
    echo '<input size="6" type="text" id="midc_concerten_prijzen_cke_kaart" name="midc_concerten_prijzen_cke_kaart" value="' . $value . '" /><small>&nbsp;bv. 7,00</small></p>';

	// Met CJP-pas
   	$value = (metadata_exists( 'post', $post->ID, 'midc_concerten_prijzen_cjp_active' )) ? get_post_meta($post->ID, 'midc_concerten_prijzen_cjp_active', true) : 'on';
	echo '<p><input name="midc_concerten_prijzen_cjp_active" type="checkbox" ' . checked( "on", $value, false) . '/>';
    $value = get_post_meta($post->ID, 'midc_concerten_prijzen_cjp', true); 
	if ($value == "") $value = $options['midc_option_prijs_cjp'];
	echo '<label for="midc_concerten_prijzen_cjp">CJP-pas:</label> €'; 
    echo '<input size="6" type="text" id="midc_concerten_prijzen_cjp" name="midc_concerten_prijzen_cjp" value="' . $value . '" /><small>&nbsp;bv. 7,00</small></p>';

	// Met Kinderen
   	$value = (metadata_exists( 'post', $post->ID, 'midc_concerten_prijzen_kinderen_active' )) ? get_post_meta($post->ID, 'midc_concerten_prijzen_kinderen_active', true) : 'on';
	echo '<p><input name="midc_concerten_prijzen_kinderen_active" type="checkbox" ' . checked( "on", $value, false) . '/>';
    $value = get_post_meta($post->ID, 'midc_concerten_prijzen_kinderen', true); 
	if ($value == "") $value = $options['midc_option_prijs_kinderen'];
	echo '<label for="midc_concerten_prijzen_kinderen">Kinderen tot 16:</label> €'; 
    echo '<input size="6" type="text" id="midc_concerten_prijzen_kinderen" name="midc_concerten_prijzen_kinderen" value="' . $value . '" /><small>&nbsp;bv. 7,00</small></p>';
}

function midc_concerten_prijzen_save($post_id, $post) {
	if (!meta_box_can_do_save("midc_concerten_prijzen_nonce", "midc_concerten_prijzen"))
		return $post_id;

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;

	// Aan de kassa
	update_post_meta( $post_id, 'midc_concerten_prijzen_standaard_active', $_POST['midc_concerten_prijzen_standaard_active'] );
	if (isset( $_POST['midc_concerten_prijzen_standaard'] ))
		update_post_meta( $post_id, 'midc_concerten_prijzen_standaard', sanitize_text_field( $_POST['midc_concerten_prijzen_standaard'] ));

	// Strippenkaart
	update_post_meta( $post_id, 'midc_concerten_prijzen_strippenkaart_active', $_POST['midc_concerten_prijzen_strippenkaart_active'] );
	if (isset( $_POST['midc_concerten_prijzen_strippenkaart'] ))
		update_post_meta( $post_id, 'midc_concerten_prijzen_strippenkaart', sanitize_text_field( $_POST['midc_concerten_prijzen_strippenkaart'] ));

	// Met CKE-kaart
	update_post_meta( $post_id, 'midc_concerten_prijzen_cke_kaart_active', $_POST['midc_concerten_prijzen_cke_kaart_active'] );
	if (isset( $_POST['midc_concerten_prijzen_cke_kaart'] ))
		update_post_meta( $post_id, 'midc_concerten_prijzen_cke_kaart', sanitize_text_field( $_POST['midc_concerten_prijzen_cke_kaart'] ));

	// Met CJP-pas
	update_post_meta( $post_id, 'midc_concerten_prijzen_cjp_active', $_POST['midc_concerten_prijzen_cjp_active'] );
	if (isset( $_POST['midc_concerten_prijzen_cjp'] ))
		update_post_meta( $post_id, 'midc_concerten_prijzen_cjp', sanitize_text_field( $_POST['midc_concerten_prijzen_cjp'] ));

	// Met Kinderen
	update_post_meta( $post_id, 'midc_concerten_prijzen_kinderen_active', $_POST['midc_concerten_prijzen_kinderen_active'] );
	if (isset( $_POST['midc_concerten_prijzen_kinderen'] ))
		update_post_meta( $post_id, 'midc_concerten_prijzen_kinderen', sanitize_text_field( $_POST['midc_concerten_prijzen_kinderen'] ));
}
add_action('save_post', 'midc_concerten_prijzen_save');