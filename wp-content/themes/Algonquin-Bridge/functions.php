<?php

function register_my_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'top-menu' => __( 'Top Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

function my_styles()
{
    wp_register_style('navigation', get_stylesheet_directory_uri() . '/css/navigation.css', array(), '1.0', 'all');
    wp_enqueue_style('navigation');
}
add_action('wp_enqueue_scripts', 'my_styles');

function my_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    
     wp_register_script('fontawesome', 'https://use.fontawesome.com/6ccd600e51.js', array('jquery'), '1.0.0'); // Custom scripts
     wp_enqueue_script('fontawesome');
    }
}
add_action('wp_enqueue_scripts', 'my_header_scripts');

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
if ( ! function_exists( 'et_divi_post_meta' ) ) :
function et_divi_post_meta() {
	$postinfo = is_single() ? et_get_option( 'divi_postinfo2' ) : et_get_option( 'divi_postinfo1' );

	if ( $postinfo ) :
		echo '<p class="post-meta">';
		echo et_pb_postinfo_meta( $postinfo, et_get_option( 'divi_date_format', 'm/j/y' ), esc_html__( '0 comments', 'Divi' ), esc_html__( '1 comment', 'Divi' ), '% ' . esc_html__( 'comments', 'Divi' ) );
		echo '</p>';
	endif;
}
endif;