<?php
  /**
   * Register additional menus
   */
  function fire_register_nav_menu(){
    register_nav_menus( array(
      'footer_menu'  => __( 'Footer', 'text_domain' )
    ) );
  }
  add_action( 'after_setup_theme', 'fire_register_nav_menu', 0 );

    /**
   * Allows adding custom class to nav list items
   */
  function fire_add_menu_list_item_class($classes, $item, $args, $depth) {
    if (property_exists($args, 'list_item_class')) {
      $classes[] = $args->list_item_class;
    }

    if ($depth !== 0 && property_exists($args, 'sub_list_item_class')) {
      $classes[] = $args->sub_list_item_class;

      if ($depth === 2) {
        $classes[] = $args->sub_list_item_class . '--' . $depth;
      }
    }

    return $classes;
  }
  add_filter('nav_menu_css_class', 'fire_add_menu_list_item_class', 10, 4);

  /**
   * Allows adding custom class to nav list links
  */
  function fire_add_menu_link_class( $atts, $item, $args, $depth ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }

    if ($depth !== 0 && property_exists($args, 'sub_link_class')) {
      $atts['class'] = $args->sub_link_class;
    }

    return $atts;
  }
  add_filter( 'nav_menu_link_attributes', 'fire_add_menu_link_class', 10, 4 );
?>
