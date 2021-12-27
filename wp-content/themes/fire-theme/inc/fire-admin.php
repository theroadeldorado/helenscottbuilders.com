<?php
  function fire_register_options_page() {
    if( function_exists('acf_add_options_page') ) {
      /*
      * Creates options page for global settings
      */
      acf_add_options_page(array(
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'position' => '2',
        'post_id' => 'site_settings'
      ));

    }
  }
  add_action('acf/init', 'fire_register_options_page', 10);
?>
