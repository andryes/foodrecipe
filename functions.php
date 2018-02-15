<?php

function foodrecipe_init() {
	if ( ! session_id() ) {
		session_start();
	}
}

// max-width for content objects
if ( ! isset( $content_width ) ) {
	$content_width = 870;
}

function foodrecipe_enqueue_style() {
	wp_enqueue_style( 'foodrecipe-bootstrap-stylesheet', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap.css', false );
	wp_enqueue_style( 'foodrecipe-font-awesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' );
	wp_enqueue_style( 'foodrecipe-stylesheet', get_stylesheet_uri(), true );
	wp_enqueue_script( 'foodrecipe-bootstrapjs', trailingslashit( get_template_directory_uri() ) . 'js/bootstrap.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'foodrecipe-scripts', trailingslashit( get_template_directory_uri() ) . 'js/script.js', array(), '1,0', true );
	wp_localize_script( 'foodrecipe-scripts', 'fodrecipe_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function foodrecipe_setup() {
	add_editor_style();
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	load_theme_textdomain( 'foodrecipe', get_template_directory() . '/languages' );
	$locale      = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'foodrecipe' )
	) );

	$defaults = array(
		'default-image'          => '',
		'default-preset'         => 'default',
		'default-position-x'     => 'left',
		'default-position-y'     => 'top',
		'default-size'           => 'auto',
		'default-repeat'         => 'repeat',
		'default-attachment'     => 'scroll',
		'default-color'          => 'fff',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	add_theme_support( 'custom-background', $defaults );

	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 55,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	if ( ! defined( 'HEADER_TEXTCOLOR' ) ) {
		define( 'HEADER_TEXTCOLOR', '#fff' );
	}
	if ( ! defined( 'NO_HEADER_TEXT' ) ) {
		define( 'NO_HEADER_TEXT', false );
	}

	add_image_size( 'foodrecipe-slider', 4000, 780, array( 'center', 'center' ) );

	add_image_size( 'foodrecipe-gallery', 415, 415, array( 'center', 'center' ) );
}

function foodrecipe_widgets_init() {
	$args = array(
		'name'          => __( 'Sidebar', 'foodrecipe' ),
		'id'            => 'foodrecipe-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);

	register_sidebar( $args );

	$args = array(
		'name'          => __( 'Footer Sidebar', 'foodrecipe' ),
		'id'            => 'foodrecipe-sidebar-footer',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s col-sm-3">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);

	register_sidebar( $args );
}

function foodrecipe_count_display() {
	if ( ( ! isset( $_SESSION['foodrecipe_count_post'] ) && isset( $_POST['count'] ) && 0 < $_POST['count'] ) ||
	     ( isset( $_POST['count'] ) && 0 < $_POST['count'] && $_SESSION['foodrecipe_count_post'] != $_POST['count'] ) ) {
		$_SESSION['foodrecipe_count_post'] = $_POST['count'];
		$url                               = esc_url( remove_query_arg( 'paged', $_POST['url'] ) );
		$pattern                           = '/page\\/[0-9]+\\//i';
		$url                               = preg_replace( $pattern, '', $url );
		echo json_encode( array( 'action' => "success", 'url' => $url ) );
	}
	wp_die();
}

function foodrecipe_count_post( $query ) {
	if ( $query->is_main_query() && isset( $_SESSION['foodrecipe_count_post'] ) ) {
		$query->set( 'posts_per_page', $_SESSION['foodrecipe_count_post'] );
	}
	if ( $query->is_main_query() && isset( $_SESSION['foodrecipe_sort_post'] ) ) {
		$query->set( 'orderby', $_SESSION['foodrecipe_sort_post'] );
		$query->set( 'order', 'ASC' );
	}
}

function foodrecipe_sort_display() {
	if ( ( ! isset( $_SESSION['foodrecipe_sort_post'] ) && isset( $_POST['sort'] ) && '' != $_POST['sort'] ) ||
	     ( isset( $_POST['sort'] ) && '' != $_POST['sort'] && $_SESSION['foodrecipe_sort_post'] != $_POST['sort'] ) ) {
		$_SESSION['foodrecipe_sort_post'] = $_POST['sort'];
	}
	echo 'Success';
	wp_die();
}

function foodrecipe_reorder_comment_fields( $fields ) { // comments sort
	$new_fields     = array(); // our fields in new order
	$comments_order = array( 'author', 'email', 'url', 'comment' ); // our order
	foreach ( $comments_order as $key ) {
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}
	// in case more fields will appear
	if ( $fields ) {
		foreach ( $fields as $key => $val ) {
			$new_fields[ $key ] = $val;
		}
	}

	return $new_fields;
}

function foodrecipe_modify_read_more_link() { // read more button
	return '<div class="post-btn"><a class="btn read-post" href="' . get_permalink() . '">' . __( 'READ MORE', 'foodrecipe' ) . '</a></div>';
}

add_action( 'init', 'foodrecipe_init' );
add_action( 'wp_enqueue_scripts', 'foodrecipe_enqueue_style' );
add_action( 'after_setup_theme', 'foodrecipe_setup' );
add_action( 'widgets_init', 'foodrecipe_widgets_init' );
add_action( 'wp_ajax_count_display', 'foodrecipe_count_display' );
add_action( 'wp_ajax_nopriv_count_display', 'foodrecipe_count_display' );
add_action( 'wp_ajax_sort_display', 'foodrecipe_sort_display' );
add_action( 'wp_ajax_nopriv_sort_display', 'foodrecipe_sort_display' );
add_action( 'pre_get_posts', 'foodrecipe_count_post' );
add_filter( 'comment_form_fields', 'foodrecipe_reorder_comment_fields' );
add_filter( 'the_content_more_link', 'foodrecipe_modify_read_more_link' );
