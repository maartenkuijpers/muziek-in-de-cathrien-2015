<?php
/**
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

// https://codex.wordpress.org/Function_Reference/add_meta_box#Examples

function midc_add_meta_boxes($post)
{
    $page_template = get_post_meta($post->ID, '_wp_page_template', true);

    switch ($page_template) {
        case 'page-container-twee-kolommen.php':
            add_meta_box(
                'midc-twee-kolommen-meta-box', // Metabox HTML ID attribute
                'Extra velden voor Twee Kolommen', // Metabox title
                'midc_twee_kolommen_meta_box_callback', // callback name
                'page', // post type
                'normal', // context (advanced, normal, or side)
                'default' // priority (high, core, default or low)
            ); break;

        case 'page-container-bestuur-item.php':
            add_meta_box(
                'midc-bestuur-item-meta-box',
                'Bestuurslid Extra Velden',
                'midc_bestuur_item_meta_box_callback',
                'page',
                'side',
                'default'
            ); break;

        case 'page-prijzen-item.php':
            add_meta_box(
                'midc-prijzen-item-meta-box',
                'Prijzen Extra Velden',
                'midc_prijzen_item_meta_box_callback',
                'page',
                'side',
                'default'
            ); break;

        case 'page-concert-in-beeld-item.php':
            add_meta_box(
                'midc-concert-in-beeld-item-meta-box',
                'Concert in beeld item Extra Velden',
                'midc_concert_in_beeld_item_meta_box_callback',
                'page',
                'side',
                'default'
            ); break;
    }
}
// Make sure to use "_" instead of "-"
add_action('add_meta_boxes_page', 'midc_add_meta_boxes');

function meta_box_can_do_save($nonce, $metabox)
{
    // The nonce must exist, otherwise this is not the appropriate save-handler.
    if (! isset($_POST[$nonce])) {
        return false;
    }

    // The nonce must match.
    if (! wp_verify_nonce($_POST[$nonce], $metabox)) {
        return false;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return false;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (! current_user_can('edit_page', $post_id)) {
            return false;
        }
    } else {
        if (! current_user_can('edit_post', $post_id)) {
            return false;
        }
    }

    return true; // It's safe to save the data now
}


function midc_twee_kolommen_meta_box_callback($post)
{
    wp_nonce_field('midc_twee_kolommen_meta_box', 'midc_twee_kolommen_meta_box_nonce');

    // Weergave type
    $options = array(
        'text50-text50' => '50% tekst : 50% tekst',
        'text33-text66' => '33% tekst : 66% tekst',
        'text66-text33' => '66% tekst : 33% tekst',
        'text50-picture50' => '50% tekst : 50% foto',
        'text33-picture66' => '33% tekst : 66% foto',
        'text66-picture33' => '66% tekst : 33% foto',
        'picture50-text50' => '50% foto : 50% tekst',
        'picture33-text66' => '66% foto : 33% tekst',
        'picture66-text33' => '33% foto : 66% tekst'
    );
    $value = get_post_meta($post->ID, 'midc_twee_kolommen_type', true);
    $selected = '';
    echo '<p><label for="midc_twee_kolommen_type">Weergave type:</label>&nbsp;';
    echo '<select id="midc_twee_kolommen_type" name="midc_twee_kolommen_type">';
    foreach ($options as $key => $option) {
        if ($value == $key) {
            $selected = ' selected';
        } else {
            $selected = '';
        }
        echo '<option value="' . $key . '"' . $selected . '>' . $option . '</option>';
    }
    echo '</select></p>';

    // Tweede content
    $value = get_post_meta($post->ID, 'midc_twee_kolommen_second_content', true);
    $settings = array( 'media_buttons' => true, 'teeny' => false, 'textarea_rows' => 5, 'wpautop' => false );
    echo '<p><label for="midc_twee_kolommen_second_content">Vul hieronder de extra content in wanneer er twee keer een foto of tekst gebruikt wordt:</label> ';
    wp_editor($value, 'midc_twee_kolommen_second_content', $settings);
    echo '</p>';
}

function midc_twee_kolommen_meta_box_save($post_id)
{
    if (!meta_box_can_do_save("midc_twee_kolommen_meta_box_nonce", "midc_twee_kolommen_meta_box")) {
        return;
    }

    if (isset($_POST['midc_twee_kolommen_second_content'])) {
        $my_data = stripslashes($_POST['midc_twee_kolommen_second_content']);
        update_post_meta($post_id, 'midc_twee_kolommen_second_content', $my_data);
    }

    if (isset($_POST['midc_twee_kolommen_type'])) {
        $my_data = $_POST['midc_twee_kolommen_type'];
        update_post_meta($post_id, 'midc_twee_kolommen_type', $my_data);
    }
}
add_action('save_post', 'midc_twee_kolommen_meta_box_save');


function midc_bestuur_item_meta_box_callback($post)
{
    wp_nonce_field('midc_bestuur_item_meta_box', 'midc_bestuur_item_meta_box_nonce');

    // Read stored value from database (optionally empty)
    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_function', true);
    echo '<p><label for="bestuur_item_meta_box_function">Functie</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_function" name="bestuur_item_meta_box_function" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_full_name', true);
    echo '<p><label for="bestuur_item_meta_box_full_name">Volledige Naam</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_full_name" name="bestuur_item_meta_box_full_name" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_email', true);
    echo '<p><label for="bestuur_item_meta_box_email">';
    _e('Email Address', 'midc-theme');
    echo '</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_email" name="bestuur_item_meta_box_email" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_facebook', true);
    echo '<p><label for="bestuur_item_meta_box_facebook">Facebook</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_facebook" name="bestuur_item_meta_box_facebook" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_twitter', true);
    echo '<p><label for="bestuur_item_meta_box_twitter">Twitter</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_twitter" name="bestuur_item_meta_box_twitter" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'bestuur_item_meta_box_linkedin', true);
    echo '<p><label for="bestuur_item_meta_box_linkedin">LinkedIn</label> ';
    echo '<input type="text" id="bestuur_item_meta_box_linkedin" name="bestuur_item_meta_box_linkedin" value="' . esc_attr($value) . '" size="25" /></p>';
}


function midc_prijzen_item_meta_box_callback($post)
{
    wp_nonce_field('midc_prijzen_item_meta_box', 'midc_prijzen_item_meta_box_nonce');

    /* Dit toont een mooie rich text editor
    $content = 'Dit is <b>bold Text</b>, maar dit niet';
    $editor_id = 'mycustomeditor';
    $settings = array( 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 3, 'wpautop' => false );
    wp_editor( $content, $editor_id, $settings );
    */

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_euro', true);
    echo '<p><label for="prijzen_item_meta_box_euro">Prijs (bv. 12,50 of 7,00)</label><br />';
    echo '<input type="text" id="prijzen_item_meta_box_euro" name="prijzen_item_meta_box_euro" value="' . esc_attr($value) . '" size="3" />';
    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_eurocenten', true);
    if (empty($value)) {
        $value = "00";
    }
    echo '<input type="text" id="prijzen_item_meta_box_eurocenten" name="prijzen_item_meta_box_eurocenten" value="' . esc_attr($value) . '" size="2" /></p>';

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_subtitle', true);
    echo '<p><label for="prijzen_item_meta_box_subtitle">Subtitel</label>';
    echo '<input type="text" id="prijzen_item_meta_box_subtitle" name="prijzen_item_meta_box_subtitle" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_recommended', true);
    echo '<p><input type="checkbox" id="prijzen_item_meta_box_recommended" name="prijzen_item_meta_box_recommended" ';
    if ($value > 0) {
        echo 'checked="checked"';
    };
    echo ' />';
    echo '<label for="prijzen_item_meta_box_recommended">"Beste Keus!" wel of niet</label></p>';

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_arguments', true);
    echo '<p><label for="prijzen_item_meta_box_arguments">Argumenten per regel</label>';
    echo '<textarea autocomplete="off" id="prijzen_item_meta_box_arguments" name="prijzen_item_meta_box_arguments" rows="5" cols="25">' . esc_attr($value) . '</textarea><br>';
    echo '<small>legenda: *dikgedrukt*, |post ID|tekst|</small>';

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_actiontext', true);
    echo '<p><label for="prijzen_item_meta_box_actiontext">Actieknop tekst</label>';
    echo '<input type="text" id="prijzen_item_meta_box_actiontext" name="prijzen_item_meta_box_actiontext" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'prijzen_item_meta_box_actionlink', true);
    echo '<p><label for="prijzen_item_meta_box_actionlink">Actieknop post ID of volledig URL</label>';
    echo '<input type="text" id="prijzen_item_meta_box_actionlink" name="prijzen_item_meta_box_actionlink" value="' . esc_attr($value) . '" size="25" /></p>';
}


function midc_concert_in_beeld_item_meta_box_callback($post)
{
    wp_nonce_field('midc_concert_in_beeld_item_meta_box', 'midc_concert_in_beeld_item_meta_box_nonce');

    $options = array(
        'gallery' => 'Fotoserie',
        'link' => 'Post link',
        'youtube' => 'YouTube'
    );
    $value = get_post_meta($post->ID, 'concert_in_beeld_item_meta_box_type', true);
    $selected = '';
    echo '<p><label for="concert_in_beeld_item_meta_box_type">Weergave type</label>&nbsp;';
    echo '<select id="concert_in_beeld_item_meta_box_type" name="concert_in_beeld_item_meta_box_type">';
    foreach ($options as $key => $option) {
        if ($value == $key) {
            $selected = ' selected';
        } else {
            $selected = '';
        }
        echo '<option value="' . $key . '"' . $selected . '>' . $option . '</option>';
    }
    echo '</select>';

    $value = get_post_meta($post->ID, 'concert_in_beeld_item_meta_box_actionlink', true);
    echo '<p><label for="concert_in_beeld_item_meta_box_actionlink">Post ID van fotoserie of post link<br />of YouTube code</label>';
    echo '<input type="text" id="concert_in_beeld_item_meta_box_actionlink" name="concert_in_beeld_item_meta_box_actionlink" value="' . esc_attr($value) . '" size="25" /></p>';

    $value = get_post_meta($post->ID, 'concert_in_beeld_item_meta_box_actiontext', true);
    echo '<p><label for="concert_in_beeld_item_meta_box_actiontext">Actieknop tekst</label>';
    echo '<input type="text" id="concert_in_beeld_item_meta_box_actiontext" name="concert_in_beeld_item_meta_box_actiontext" value="' . esc_attr($value) . '" size="25" /></p>';
}


function midc_bestuur_item_save_meta_box_data($post_id)
{
    if (!meta_box_can_do_save("midc_bestuur_item_meta_box_nonce", "midc_bestuur_item_meta_box")) {
        return;
    }

    if (isset($_POST['bestuur_item_meta_box_function'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_function']);
        update_post_meta($post_id, 'bestuur_item_meta_box_function', $my_data);
    }

    if (isset($_POST['bestuur_item_meta_box_full_name'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_full_name']);
        update_post_meta($post_id, 'bestuur_item_meta_box_full_name', $my_data);
    }

    if (isset($_POST['bestuur_item_meta_box_email'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_email']);
        update_post_meta($post_id, 'bestuur_item_meta_box_email', $my_data);
    }

    if (isset($_POST['bestuur_item_meta_box_twitter'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_twitter']);
        update_post_meta($post_id, 'bestuur_item_meta_box_twitter', $my_data);
    }

    if (isset($_POST['bestuur_item_meta_box_facebook'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_facebook']);
        update_post_meta($post_id, 'bestuur_item_meta_box_facebook', $my_data);
    }
    
    if (isset($_POST['bestuur_item_meta_box_linkedin'])) {
        $my_data = sanitize_text_field($_POST['bestuur_item_meta_box_linkedin']);
        update_post_meta($post_id, 'bestuur_item_meta_box_linkedin', $my_data);
    }
}
add_action('save_post', 'midc_bestuur_item_save_meta_box_data');


function midc_prijzen_item_save_meta_box_data($post_id)
{
    if (!meta_box_can_do_save("midc_prijzen_item_meta_box_nonce", "midc_prijzen_item_meta_box")) {
        return;
    }

    if (isset($_POST['prijzen_item_meta_box_euro'])) {
        $my_data = sanitize_text_field($_POST['prijzen_item_meta_box_euro']);
        update_post_meta($post_id, 'prijzen_item_meta_box_euro', $my_data);
    }
    if (isset($_POST['prijzen_item_meta_box_eurocenten'])) {
        $my_data = sanitize_text_field($_POST['prijzen_item_meta_box_eurocenten']);
        update_post_meta($post_id, 'prijzen_item_meta_box_eurocenten', $my_data);
    }
    if (isset($_POST['prijzen_item_meta_box_subtitle'])) {
        $my_data = sanitize_text_field($_POST['prijzen_item_meta_box_subtitle']);
        update_post_meta($post_id, 'prijzen_item_meta_box_subtitle', $my_data);
    }
    $my_data = $_POST['prijzen_item_meta_box_recommended'] ? true : false; // checkbox
    update_post_meta($post_id, 'prijzen_item_meta_box_recommended', $my_data);

    if (isset($_POST['prijzen_item_meta_box_arguments'])) {
        $my_data =  $_POST['prijzen_item_meta_box_arguments'];
        update_post_meta($post_id, 'prijzen_item_meta_box_arguments', $my_data);
    }
    if (isset($_POST['prijzen_item_meta_box_actiontext'])) {
        $my_data = $_POST['prijzen_item_meta_box_actiontext'];
        update_post_meta($post_id, 'prijzen_item_meta_box_actiontext', $my_data);
    }
    if (isset($_POST['prijzen_item_meta_box_actionlink'])) {
        $my_data = $_POST['prijzen_item_meta_box_actionlink'];
        update_post_meta($post_id, 'prijzen_item_meta_box_actionlink', $my_data);
    }
}
add_action('save_post', 'midc_prijzen_item_save_meta_box_data');


function midc_concert_in_beeld_item_save_meta_box_data($post_id)
{
    if (!meta_box_can_do_save("midc_concert_in_beeld_item_meta_box_nonce", "midc_concert_in_beeld_item_meta_box")) {
        return;
    }

    if (isset($_POST['concert_in_beeld_item_meta_box_type'])) {
        $my_data = $_POST['concert_in_beeld_item_meta_box_type'];
        update_post_meta($post_id, 'concert_in_beeld_item_meta_box_type', $my_data);
    }
    if (isset($_POST['concert_in_beeld_item_meta_box_actiontext'])) {
        $my_data = sanitize_text_field($_POST['concert_in_beeld_item_meta_box_actiontext']);
        update_post_meta($post_id, 'concert_in_beeld_item_meta_box_actiontext', $my_data);
    }
    if (isset($_POST['concert_in_beeld_item_meta_box_actionlink'])) {
        $my_data = sanitize_text_field($_POST['concert_in_beeld_item_meta_box_actionlink']);
        update_post_meta($post_id, 'concert_in_beeld_item_meta_box_actionlink', $my_data);
    }
}
add_action('save_post', 'midc_concert_in_beeld_item_save_meta_box_data');
