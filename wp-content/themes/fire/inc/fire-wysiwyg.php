<?php
  /*
  * Adds custom css styles for wysiwyg editor
  */
  function plugin_mce_css( $mce_css ) {
    if ( !empty( $mce_css ) ) {
      $mce_css = get_template_directory_uri() . '/dist/styles.css';
      return $mce_css;
    }
  }
  add_filter( 'mce_css', 'plugin_mce_css' );

  /*
  * Adds container to MCE body class attr
  */
  function fire_wysiwyg_body_class( $mce ) {
    if ( !empty( $mce ) ) {
      $mce['body_class'] = 'prose';
    }

    return $mce;
  }
  add_filter( 'tiny_mce_before_init', 'fire_wysiwyg_body_class' );

  /*
  * adds Formats dropdown to basic and full wysiwyg toolbars
  */
  function fire_custom_toolbar($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }
  add_filter('mce_buttons_2', 'fire_custom_toolbar');

  /*
  * Defines custom format options
  */
  function custom_format_styles($config) {
    $temp_array = array(
      array(
        'title' => 'Font Style Presets',
        'items' => array(
          array(
            'title' => 'Heading-1',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'classes' => 'heading-1'
          ),
          array(
            'title' => 'Heading-2',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'classes' => 'heading-2'
          ),
          array(
            'title' => 'Heading-3',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'classes' => 'heading-3'
          ),
          array(
            'title' => 'Paragraph Large',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'classes' => 'text-lg'
          ),
          array(
            'title' => 'Paragraph Small',
            'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
            'classes' => 'text-sm'
          ),
        ),
      ),
      array(
        'title' => 'Button Styles',
        'items' => array(
          array(
            'title' => 'Primary',
            'selector' => 'a',
            'classes' => 'button button-primary'
          ),

          array(
            'title' => 'Outline',
            'selector' => 'a',
            'classes' => 'button button-outline'
          ),
        ),
      ),
      array(
        'title' => 'Balance Text',
        'selector' => 'p, a, h1, h2, h3, h4, h5, h6, li, span',
        'classes' => 'balance-text'
      ),
    );
    $config['style_formats'] = json_encode( $temp_array );
    return $config;
  }
  add_filter('tiny_mce_before_init', 'custom_format_styles');

  function wpse33318_tiny_mce_before_init( $mce_init ) {
    $mce_init['cache_suffix'] = 'v='.time();

    return $mce_init;
  }
  add_filter( 'tiny_mce_before_init', 'wpse33318_tiny_mce_before_init' );

?>
