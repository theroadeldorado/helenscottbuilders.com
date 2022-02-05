<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fire
 */

?>

  <footer class="py-16 bg-gray-100 ">
    <div class="container px-4 mx-auto">
      <div class="flex flex-col mb-10 lg:flex-row">
        <a class="inline-block mx-auto mb-10 text-3xl font-semibold leading-none text-red-600 lg:mb-0 lg:ml-0 lg:mr-auto" href="#">
          <span class="block w-40 h-16"><?php new Fire_SVG('logo-black'); ?></span>
        </a>


        <?php
        wp_nav_menu(
          array(
            'depth' => 1,
            'menu' => 3,
            'theme_location'  => 'footer',
            'container'       => 'ul',
            'menu_id'         => 'footer',
            'menu_class'      => 'flex items-center justify-center space-x-8 lg:flex-row',
            'list_item_class' => 'mx-4',
            'link_class'      => 'font-bold text-black no-underline hover:text-red-600 text-md font-heading hover:text-blueGray-600',
            )
          );
        ?>

      </div>
      <div class="flex flex-col items-center lg:flex-row lg:justify-between">
        <p class="text-xs text-gray-700">©Helen Scott Custom Builders, Inc 2021. All rights reserved.</p>
        <div class="flex items-center order-first mb-4 -mx-2 space-x-4 lg:order-last lg:mb-0">
          <?php
            $social_links = get_field('social_links', 'site_settings');
            if (empty($social_links)) {
              return;
            }
            foreach ($social_links as $platform => $link) {
              if($link):?>
                <a class="h-5 w-5 flex items-center justify-center no-underline text-red-600 hover:text-red-900 duration-200 transition-all <?php echo $social_link_classes ? $social_link_classes : '';?>" target="_blank" href="<?php echo $link;?>">
                  <?php new Fire_SVG('icon--social-' . $platform); ?>
                  <span class="sr-only"><?php echo $platform; ?></span>
                </a>
              <?php
              endif;
            }
          ?>
        </div>
      </div>
    </div>
  </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
