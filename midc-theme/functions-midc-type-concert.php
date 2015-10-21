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
}

function midc_concerten_artistiek_callback($post) {
	//global $post; 
	wp_nonce_field( 'midc_concerten_artistiek', 'midc_concerten_artistiek_nonce' );

	// Programma
	echo '<p><label for="midc_concerten_artistiek_programma">Programma: <small>Compacte weergave van de uit te voeren werken</small></label>'; 
    $value = get_post_meta($post->ID, 'midc_concerten_artistiek_programma', true); 
	if ($value == "") $value = '<p>Het programma voor dit concert wordt binnenkort toegevoegd. Onze excuses voor het ongemak.</p>';
	$editor_id = 'midc_concerten_artistiek_programma';
	$settings = array( 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 5, 'wpautop' => false );
	wp_editor( $value, $editor_id, $settings );
    echo '</p>';

	// Uitvoerenden
	echo '<p><label for="midc_concerten_artistiek_uitvoerenden">Uitvoerenden: <small>Compacte weergave van de uitvoerenden</small></label>'; 
    $value = get_post_meta($post->ID, 'midc_concerten_artistiek_uitvoerenden', true); 
	if ($value == "") $value = 'Informatie over de uitvoerenden van dit concert wordt binnenkort toegevoegd. Onze excuses voor het ongemak.';
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
	$my_data = sanitize_text_field( $_POST['midc_concerten_artistiek_programma'] );
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
	echo '<input name="midc_concerten_meta_type" type="radio" value="1"' . checked( '1', $value ) . '>Muziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="2"' . checked( '2', $value ) . '>OrgelMuziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="3"' . checked( '3', $value ) . '>KoorMuziek in de Cathrien</input><br>';
	echo '<input name="midc_concerten_meta_type" type="radio" value="4"' . checked( '4', $value ) . '>KamerMuziek in de Cathrien</input><br>';
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
