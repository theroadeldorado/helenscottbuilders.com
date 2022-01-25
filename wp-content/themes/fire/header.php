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
<?php
  $client_login = get_field('client_login_button', 'site_settings');
  $contact = get_field('contact_us_button', 'site_settings');
?>
<div id="page" class="site">
  <a class="sr-only skip-link focus:not-sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'fire' ); ?></a>

  <header class="bg-white/80 relative z-[1000]" x-cloak x-data="toggleNav()">
    <div class="container px-4 mx-auto">
      <nav class="flex items-center justify-between py-4">
        <a class="block w-40 h-auto relative z-[2]" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <span class="transition-all duration-200 lg:text-red-700" :class="{'text-red-700': !openNav, 'text-white': openNav}">
            <?php new Fire_SVG('logo-black'); ?>
          </span>
          <span class="sr-only"><?php bloginfo( 'name' ); ?></span>
        </a>
        <div class="lg:hidden">
          <button @click="openNav = ! openNav" class="outline-none flex relative z-[2] items-center px-3 py-2 duration-200 transition-all" :class="{'text-black border-black': !openNav, 'text-white border-white': openNav}">
            <svg class="w-6 h-6 fill-current" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Mobile menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
          </button>
        </div>
        <div class="fixed top-0 left-0 w-screen duration-200 transition-all h-screen z-[1] bg-red-700 overflow-y-scroll lg:hidden" :class="{'-translate-x-full opacity-0 pointer-events-none': !openNav}">
          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'menu-1',
                'container'       => 'ul',
                'menu_id'         => 'mobile-menu',
                'menu_class'      => 'flex mt-32 flex-col w-full space-y-4',
                'list_item_class' => 'mx-4',
                'link_class'      => 'text-[28px] block text-center font-medium w-full no-underline text-white',
                )
              );
            ?>

          <div class="flex items-center justify-center w-full my-8 space-x-3">
            <?php if($client_login): ?>
              <a class="button button-outline-white " href="<?php echo $client_login['url']; ?>" target="<?php echo $client_login['target']?>">
                <?php echo $client_login['title'] ? $client_login['title'] : 'Client Log In'; ?>
              </a>
            <?php endif; ?>

            <?php if($contact): ?>
              <a class="button button-white" href="<?php echo $contact['url']; ?>" target="<?php echo $contact['target']?>">
                <?php echo $contact['title'] ? $contact['title'] : 'Contact Us'; ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        wp_nav_menu(
          array(
            'theme_location'  => 'menu-1',
            'container'       => 'ul',
            'menu_id'         => 'primary-menu',
            'menu_class'      => 'hidden lg:flex lg:items-center lg:w-auto lg:space-x-12',
            'list_item_class' => 'mx-4',
            'link_class'      => 'text-base no-underline text-black hover:text-red-600',
            )
          );
        ?>

        <div class="hidden space-x-2 lg:block">
          <?php if($client_login): ?>
            <a class="button button-outline" href="<?php echo $client_login['url']; ?>" target="<?php echo $client_login['target']?>">
              <?php echo $client_login['title'] ? $client_login['title'] : 'Client Log In'; ?>
            </a>
          <?php endif; ?>

          <?php if($contact): ?>
            <a class="button button-primary" href="<?php echo $contact['url']; ?>" target="<?php echo $contact['target']?>">
              <?php echo $contact['title'] ? $contact['title'] : 'Contact Us'; ?>
            </a>
          <?php endif; ?>
        </div>
      </nav>
    </div>
    <script>
      function toggleNav() {
        return {
          openNav: false,
        }
      }
    </script>
  </header>
