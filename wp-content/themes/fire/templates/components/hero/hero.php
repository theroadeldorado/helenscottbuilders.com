<?php
  $image = get_sub_field('image');
  $image_alt = get_post_meta($image['ID'] , '_wp_attachment_image_alt', true);

  $copy = get_sub_field('copy');

  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>
  <div class="absolute inset-0 z-0">
    <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 1920, 600, true); ?>" alt="<?php echo $image_alt; ?>">
  </div>
  <div class="relative bg-black z-1 bg-opacity-40">
    <div class="container px-4 mx-auto">
      <div class="pt-16 text-center pb-14 lg:pt-40 lg:pb-36 hero__content">
        <div class="max-w-lg mx-auto mb-8 text-white wizzy">
          <?php print $copy; ?>
        </div>
      </div>
    </div>
  </div>

<?php $section->end(); ?>