<?php
  $title = get_sub_field('title');
  $copy = get_sub_field('copy');

  $section->add_classes([
    'py-20 bg-red-600'
  ]);
?>

<?php $section->start(); ?>

    <div class="container px-4 mx-auto">
      <div class="max-w-xl mx-auto text-center">
        <?php if($title):?>
          <h2 class="mb-4 text-3xl font-bold text-white lg:text-4xl font-heading"><?php echo $title;?></h2>
        <?php endif;?>
        <?php if($copy):?>
          <div class="mb-8 text-white">Stay up-to-date with all of our current homes in progress.</div>
        <?php endif;?>

        <div class="flex items-center justify-center space-x-5">
          <?php
            $social_links = get_field('social_links', 'site_settings');
            if (empty($social_links)) {
              return;
            }
            foreach ($social_links as $platform => $link) {
              if($link):?>
                <a class="h-8 w-8 flex items-center justify-center no-underline text-white hover:text-red-300 duration-200 transition-all <?php echo $social_link_classes ? $social_link_classes : '';?>" target="_blank" href="<?php echo $link;?>">
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

<?php $section->end(); ?>