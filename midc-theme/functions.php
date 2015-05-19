<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/* MIDC START */

// https://codex.wordpress.org/Function_Reference/add_meta_box#Examples

function midc_add_meta_boxes( $post ) {
    // Get the page template post meta
    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
    // If the current page uses our specific
    // template, then output our custom metabox
    if ( 'page-bestuur-item.php' == $page_template ) {
        add_meta_box(
			'midc-bestuurslid-meta-box', // Metabox HTML ID attribute
            'Bestuurslid Extra Velden', // Metabox title
			'midc_bestuur_item_meta_box_callback', // callback name
            'page', // post type
            'side', // context (advanced, normal, or side)
            'default' // priority (high, core, default or low)
        );
    }

	if ( 'page-prijzen-item.php' == $page_template ) {
		add_meta_box(
			'midc-prijzen-meta-box', // Metabox HTML ID attribute
            'Prijzen Extra Velden', // Metabox title
			'midc_prijzen_item_meta_box_callback', // callback name
            'page', // post type
            'side', // context (advanced, normal, or side)
            'default' // priority (high, core, default or low)
        );
	}
}

// Make sure to use "_" instead of "-"
add_action( 'add_meta_boxes_page', 'midc_add_meta_boxes' );

function midc_bestuur_item_meta_box_callback($post) {
	wp_nonce_field( 'midc_bestuur_item_meta_box', 'midc_bestuur_item_meta_box_nonce' );

	// Read stored value from database (optionally empty)
 	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_function', true );
	echo '<p><label for="bestuur_item_meta_box_function">Functie</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_function" name="bestuur_item_meta_box_function" value="' . esc_attr( $value ) . '" size="25" /></p>';

	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_full_name', true );
	echo '<p><label for="bestuur_item_meta_box_full_name">Volledige Naam</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_full_name" name="bestuur_item_meta_box_full_name" value="' . esc_attr( $value ) . '" size="25" /></p>';

	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_email', true );
	echo '<p><label for="bestuur_item_meta_box_email">';
	_e( 'Email Address', 'twentyfifteen' );
	echo '</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_email" name="bestuur_item_meta_box_email" value="' . esc_attr( $value ) . '" size="25" /></p>';

	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_facebook', true );
	echo '<p><label for="bestuur_item_meta_box_facebook">Facebook</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_facebook" name="bestuur_item_meta_box_facebook" value="' . esc_attr( $value ) . '" size="25" /></p>';

	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_twitter', true );
	echo '<p><label for="bestuur_item_meta_box_twitter">Twitter</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_twitter" name="bestuur_item_meta_box_twitter" value="' . esc_attr( $value ) . '" size="25" /></p>';

	$value = get_post_meta( $post->ID, 'bestuur_item_meta_box_linkedin', true );
	echo '<p><label for="bestuur_item_meta_box_linkedin">LinkedIn</label> ';
	echo '<input type="text" id="bestuur_item_meta_box_linkedin" name="bestuur_item_meta_box_linkedin" value="' . esc_attr( $value ) . '" size="25" /></p>';
}

function midc_prijzen_item_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'midc_prijzen_item_meta_box', 'midc_prijzen_item_meta_box_nonce' );

	/* Dit toont een mooie rich text editor 
	$content = 'Dit is <b>bold Text</b>, maar dit niet';
	$editor_id = 'mycustomeditor';
	$settings = array( 'media_buttons' => false, 'teeny' => true, 'textarea_rows' => 3, 'wpautop' => false );
	wp_editor( $content, $editor_id, $settings );
	*/

	// Read stored value from database (optionally empty)
 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_euro', true );
	echo '<p><label for="prijzen_item_meta_box_euro">Prijs (bv. 12,50 of 7,00)</label><br />';
	echo '<input type="text" id="prijzen_item_meta_box_euro" name="prijzen_item_meta_box_euro" value="' . esc_attr( $value ) . '" size="3" />';
 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_eurocenten', true );
	if (empty($value)) { $value = "00"; }
	echo '<input type="text" id="prijzen_item_meta_box_eurocenten" name="prijzen_item_meta_box_eurocenten" value="' . esc_attr( $value ) . '" size="2" /></p>';

 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_subtitle', true );
	echo '<p><label for="prijzen_item_meta_box_subtitle">Subtitel</label>';
	echo '<input type="text" id="prijzen_item_meta_box_subtitle" name="prijzen_item_meta_box_subtitle" value="' . esc_attr( $value ) . '" size="25" /></p>';

 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_recommended', true );
	echo '<p><input type="checkbox" id="prijzen_item_meta_box_recommended" name="prijzen_item_meta_box_recommended" ';
	if ($value > 0) { echo 'checked="checked"'; };
	echo ' />';
	echo '<label for="prijzen_item_meta_box_recommended">"Beste Keus!" wel of niet</label></p>';

 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_arguments', true );
	echo '<p><label for="prijzen_item_meta_box_arguments">Argumenten per regel</label>';
	echo '<textarea autocomplete="off" id="prijzen_item_meta_box_arguments" name="prijzen_item_meta_box_arguments" rows="5" cols="25">' . esc_attr( $value ) . '</textarea><br>';
	echo '<small>legenda: *dikgedrukt*, |post ID|tekst|</small>';

 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_actiontext', true );
	echo '<p><label for="prijzen_item_meta_box_actiontext">Actieknop tekst</label>';
	echo '<input type="text" id="prijzen_item_meta_box_actiontext" name="prijzen_item_meta_box_actiontext" value="' . esc_attr( $value ) . '" size="25" /></p>';

 	$value = get_post_meta( $post->ID, 'prijzen_item_meta_box_actionlink', true );
	echo '<p><label for="prijzen_item_meta_box_actionlink">Actieknop post ID of volledig URL</label>';
	echo '<input type="text" id="prijzen_item_meta_box_actionlink" name="prijzen_item_meta_box_actionlink" value="' . esc_attr( $value ) . '" size="25" /></p>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function midc_bestuur_item_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['midc_bestuur_item_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['midc_bestuur_item_meta_box_nonce'], 'midc_bestuur_item_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
	}

	/* OK, it's safe for us to save the data now. */

	if ( ! isset( $_POST['bestuur_item_meta_box_function'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_function'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_function', $my_data );

	if ( ! isset( $_POST['bestuur_item_meta_box_full_name'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_full_name'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_full_name', $my_data );

	if ( ! isset( $_POST['bestuur_item_meta_box_email'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_email'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_email', $my_data );

	if ( ! isset( $_POST['bestuur_item_meta_box_twitter'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_twitter'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_twitter', $my_data );

	if ( ! isset( $_POST['bestuur_item_meta_box_facebook'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_facebook'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_facebook', $my_data );
	
	if ( ! isset( $_POST['bestuur_item_meta_box_linkedin'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['bestuur_item_meta_box_linkedin'] );
	update_post_meta( $post_id, 'bestuur_item_meta_box_linkedin', $my_data );

}
add_action( 'save_post', 'midc_bestuur_item_save_meta_box_data' );

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function midc_prijzen_item_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['midc_prijzen_item_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['midc_prijzen_item_meta_box_nonce'], 'midc_prijzen_item_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
	}

	/* OK, it's safe for us to save the data now. */

	if (isset( $_POST['prijzen_item_meta_box_euro'] ) ) { 
		$my_data = sanitize_text_field( $_POST['prijzen_item_meta_box_euro'] );
		update_post_meta( $post_id, 'prijzen_item_meta_box_euro', $my_data );
	}
	if (isset( $_POST['prijzen_item_meta_box_eurocenten'] ) ) {
		$my_data = sanitize_text_field( $_POST['prijzen_item_meta_box_eurocenten'] );
		update_post_meta( $post_id, 'prijzen_item_meta_box_eurocenten', $my_data );
	}
	if (isset( $_POST['prijzen_item_meta_box_subtitle'] ) ) {
		$my_data = sanitize_text_field( $_POST['prijzen_item_meta_box_subtitle'] );
		update_post_meta( $post_id, 'prijzen_item_meta_box_subtitle', $my_data );
	}
	$my_data = $_POST['prijzen_item_meta_box_recommended'] ? true : false; // checkbox
	update_post_meta( $post_id, 'prijzen_item_meta_box_recommended', $my_data );

	if (isset( $_POST['prijzen_item_meta_box_arguments'] ) ) {
		$my_data =  $_POST['prijzen_item_meta_box_arguments'];
		update_post_meta( $post_id, 'prijzen_item_meta_box_arguments', $my_data );
	}
	if (isset( $_POST['prijzen_item_meta_box_actiontext'] ) ) {
		$my_data = $_POST['prijzen_item_meta_box_actiontext'];
		update_post_meta( $post_id, 'prijzen_item_meta_box_actiontext', $my_data );
	}
	if (isset( $_POST['prijzen_item_meta_box_actionlink'] ) ) {
		$my_data = $_POST['prijzen_item_meta_box_actionlink'];
		update_post_meta( $post_id, 'prijzen_item_meta_box_actionlink', $my_data );
	}
}
add_action( 'save_post', 'midc_prijzen_item_save_meta_box_data' );

function my_theme_add_editor_styles() {
    global $post;

    $my_post_type = 'posttype';

    // New post (init hook).
    // Get the page template post meta
    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
    // If the current page uses our specific
    // template, then output our custom metabox
    if ( ( stristr( $_SERVER['REQUEST_URI'], 'post-new.php' ) !== false ) ||
	     ( stristr( $_SERVER['REQUEST_URI'], 'post.php' ) !== false ) ) {
		if ( 'page-bestuur-item.php' == $page_template ) {
			add_editor_style( get_stylesheet_directory_uri()
				. '/css/editor-style-page-bestuuritem.css' );
		}
	}
}
add_action( 'init', 'my_theme_add_editor_styles' );
add_action( 'pre_get_posts', 'my_theme_add_editor_styles' );

/* MIDC END */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141212', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';
