<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fire
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
  <a class="sr-only skip-link focus:not-sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'fire' ); ?></a>

  <header class="site-header">

    <a class="block w-8 h-8" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
      <?php new Fire_SVG('fire'); ?>
      <span class="sr-only"><?php bloginfo( 'name' ); ?></span>
    </a>

    <nav id="site-navigation" class="main-navigation">

      <?php
      wp_nav_menu(
        array(
          'theme_location'  => 'menu-1',
          'menu_id'         => 'primary-menu',
          'menu_class'      => 'list-none flex items-center',
          'list_item_class' => 'mx-4',
          'link_class'      => 'text-gray-500',
          )
        );
      ?>
    </nav>

    <?php
    $fire_description = get_bloginfo( 'description', 'display' );
    if ( $fire_description || is_customize_preview() ) :
      ?>
      <p class="site-description"><?php echo $fire_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    <?php endif; ?>
  </header>
