<?php
/**
 * SpatialPixel functions and definitions
 *
 * @package SpatialPixel
 */


/** There's a settings.php file that contains private metadata, especially $schema_info for
 *  the Google schema tag support.
 */
$settingsPath = get_template_directory() . '/settings.php';
if (file_exists($settingsPath)) :
  require($settingsPath);
else:
  // Defaults for expected global settings.
  $schema_info = array();
  $vendor_scripts = array();
  $vendor_stylesheets = array();
  $meta_description = '';
  $footer_scripts = '';
  $header_scripts = '';
endif;


/**
 * Include the Null framework.
 */
require(get_template_directory() . '/null/null.php');


if (!function_exists('theme_setup')) :
  function theme_setup() {
    // For future multi-language support.
    load_theme_textdomain('spatialpixel', get_template_directory() . '/languages');

    // Feed links
    add_theme_support('automatic-feed-links');

    // Post (featured) thumbnails
    add_theme_support('post-thumbnails');

    // Navigation
    register_nav_menus(array(
      'primary' => __('Primary Menu', 'spatialpixel'),
    ));

    // Post formats
    $formats = array( 'aside', 'image', 'video', 'quote', 'link' );
    add_theme_support('post-formats', $formats);
  }
endif;
add_action('after_setup_theme', 'theme_setup');


/**
 * Custom background support.
 * https://codex.wordpress.org/Custom_Backgrounds
 */
function register_custom_background() {
  $defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'default-repeat'         => '',
    'default-position-x'     => '',
    'default-attachment'     => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
  );
  add_theme_support( 'custom-background', $defaults );
}
add_action( 'after_setup_theme', 'register_custom_background' );


/* Register the widget areas. */
function register_widget_areas() {
  register_sidebar(
    array(
      'name'          => 'Header',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Footer',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Post Sidebar',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Page Sidebar',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Post Footer',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => 'Page Footer',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    )
  );
}
add_action( 'widgets_init', 'register_widget_areas' );


/* Enqueue scripts and styles. */
function enqueue_scripts_and_stylesheets() {
  global $vendor_scripts;
  global $vendor_stylesheets;

  foreach ($vendor_stylesheets as $style_name => $style_url) {
    wp_enqueue_style($style_name, $style_url);
  }

  // Add the Google Fonts required by the other styles.
  wp_enqueue_style('google_font_arvo', 'http://fonts.googleapis.com/css?family=Arvo');
  wp_enqueue_style('google_source_sans_pro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic');

  // Include vendored (modified) skeleton.css as a requirement.
  $template_url = get_bloginfo('template_url');
  wp_enqueue_style('skeleton_normalize',  $template_url . '/vendor/skeleton/css/normalize.css');
  wp_enqueue_style('skeleton_style', $template_url . '/vendor/skeleton/css/skeleton.css');

  // style.css should be last to take precedence over skeleton.
  wp_enqueue_style('main_stylesheet', get_stylesheet_uri());

  foreach ($vendor_scripts as $script_name => $script_url) {
    wp_enqueue_script($script_name, $script_url);
  }
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_stylesheets' );


/* Adds arbitrary scripts to the footer. */
function add_footer_scripts() {
  global $footer_scripts;
  echo $footer_scripts;
}
add_action('wp_footer', 'add_footer_scripts');


/**
 * Code snippet from:
 * http://www.tcbarrett.com/2013/02/how-fast-is-your-wordpress-show-speed-and-mysql-query-count-in-footer/
 */
function tcb_note_server_side_page_speed() {
  date_default_timezone_set( get_option( 'timezone_string' ) );
  $content  = '[ ' . date( 'Y-m-d H:i:s T' ) . ' ] ';
  $content .= 'Page created in ';
  $content .= timer_stop( $display = 0, $precision = 2 );
  $content .= ' seconds from ';
  $content .= get_num_queries();
  $content .= ' queries';
  if( ! current_user_can( 'administrator' ) ) $content = "<!-- $content -->";
  echo $content;
}
add_action( 'wp_footer', 'tcb_note_server_side_page_speed' );


// Adds a <meta name="description" content="..."> tag to the <head>.
function add_meta_description() {
  global $meta_description;

  if (!is_front_page() && !is_archive()) {
    if ($post_id = get_queried_object_id()) {
      if ( ! $meta_description = get_post_field('post_excerpt', $post_id) ) {
        $meta_description = get_post_field('post_content', $post_id);
      }

      if (strpos($meta_description, '<!--more-->') !== false) {
        $parts = split('<!--more-->', $meta_description);
        $meta_description = $parts[0];
      } else {
        $parts = split("\n", $meta_description);
        $meta_description = $parts[0];
      }

      $meta_description = trim( wp_strip_all_tags( $meta_description, true ) );

      if (strlen($meta_description) > 157) {
        $meta_description = substr( $meta_description, 0, 157 )."...";
      }
    }
  }

  if (trim($meta_description) == ''):
    $meta_description = get_bloginfo('description');
  endif;

  echo '<meta name="description" content="' . $meta_description . '">';
}
add_action('wp_head', 'add_meta_description');


// ----------------------------------------------------------------------------------------------
// Remove some Wordpress features.

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove the tags from the header and footer regarding the JSON API
// http://wordpress.stackexchange.com/questions/211467/remove-json-api-links-in-header-html
function remove_json_api () {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

   // Remove all embeds rewrite rules.
   add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

}
add_action( 'after_setup_theme', 'remove_json_api' );


// Disable the JSON API if desired.
function disable_json_api () {
  // Filters for WP-API version 1.x
  add_filter('json_enabled', '__return_false');
  add_filter('json_jsonp_enabled', '__return_false');

  // Filters for WP-API version 2.x
  add_filter('rest_enabled', '__return_false');
  add_filter('rest_jsonp_enabled', '__return_false');
}
// add_action( 'after_setup_theme', 'disable_json_api' );

// Hide widget titles by specifying '[none]', '[hide]', or '[hidden]' in the widget title field.
function widget_title($title) {
  if (trim($title) == '[none]' || trim($title) == '[hidden]' || trim($title) == '[hide]'):
    return '';
  else:
    return $title;
  endif;
}
add_filter( 'widget_title', 'widget_title' );


// ----------------------------------------------------------------------------------------------
// Shortcodes that are actually useful.


function shortcode_publicationdate_func( $attr ) {
  $datetime = esc_attr(get_the_date('c'));
  $dateHtml = esc_html(get_the_date());
  return NullTag(
    'time',
    $dateHtml,
    array('datetime' => $datetime));
}
add_shortcode('publicationdate', 'shortcode_publicationdate_func');

function shortcode_author_func($attr) {
  $authorId = get_the_author_meta( 'ID' );
  $authorUrl = esc_url(get_author_posts_url($authorId));
  $author = esc_html(get_the_author());

  return NullTag('span',
      NullTag('a', $author, array('class' => 'url fn n', 'rel' => 'author', 'href' => $authorUrl))
      , array('class' => 'author vcard'));
}
add_shortcode('author', 'shortcode_author_func');

function shortcode_comments_func($attr) {
  return NullComments();
}
add_shortcode('comments', 'shortcode_comments_func');

// Enable shortcodes in text widgets. Must appear *after* the shortcodes are actually defined.
add_filter('widget_text','do_shortcode');
