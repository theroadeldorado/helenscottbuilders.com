<?php
/**
 * Fire functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fire
 */

if ( ! defined( 'FIRE_VERSION' ) ) {
  // Replace the version number of the theme on each release.
  define( 'FIRE_VERSION', '1.0.0' );
}

if ( ! function_exists( 'fire_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function fire_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Fire, use a find and replace
     * to change 'fire' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'fire', get_template_directory() . '/languages' );

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
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'menu-1' => esc_html__( 'Primary', 'fire' ),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
      )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background',
      apply_filters(
        'fire_custom_background_args',
        array(
          'default-color' => 'ffffff',
          'default-image' => '',
        )
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
      'custom-logo',
      array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
      )
    );

    add_image_size( 'modal', 1600, 1000, false );

  }
endif;
add_action( 'after_setup_theme', 'fire_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fire_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'fire_content_width', 640 );
}
add_action( 'after_setup_theme', 'fire_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fire_widgets_init() {
  register_sidebar(
    array(
      'name'          => esc_html__( 'Sidebar', 'fire' ),
      'id'            => 'sidebar-1',
      'description'   => esc_html__( 'Add widgets here.', 'fire' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action( 'widgets_init', 'fire_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fire_scripts() {
  $css = get_template_directory() . '/dist/styles.css';
  $css_updated_on = date("YmdGis", filemtime($css));

  $js = get_template_directory() . '/dist/scripts.js';
  $js_updated_on = date("YmdGis", filemtime($js));

  wp_enqueue_style('default', get_template_directory_uri() . '/dist/styles.css', array(), $css_updated_on);
  wp_enqueue_script('fire-js', get_template_directory_uri() . '/dist/scripts.js', array(), $js_updated_on, true);

  // Localize the script with ajax_object
  wp_localize_script(
    'fire-js',
    'ajax_object',
    array(
      'ajax_url' => admin_url('admin-ajax.php')
    )
  );
}
add_action('wp_enqueue_scripts', 'fire_scripts');

foreach (glob(get_template_directory() . "/inc/*.php") as $filename){
  include $filename;
}


add_action( 'rest_api_init', 'add_rest_taxonomy');
function add_rest_taxonomy() {
  register_rest_field( 'attachment', 'image_tag',
    array(
      'get_callback' => 'get_taxonomy_for_rest',
      'show_in_rest' => true,
    )
  );
}

function get_taxonomy_for_rest( $post ) {
  if(get_post_type($post['id']) === 'attachment') {
    $taxonomy = 'image-tags';
  }
  $terms = get_field('tags', $post['id']);
  return $terms;
}
