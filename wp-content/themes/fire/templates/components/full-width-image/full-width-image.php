<?php
  $image = get_sub_field('image');

  $section->add_classes([
    'relative aspect-w-16 aspect-h-9 lg:aspect-h-6'
  ]);
?>

<?php $section->start(); ?>
<div class="absolute inset-0 z-0">
  <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 1920, 900, true); ?>" alt="<?php echo $image['alt']; ?>">
</div>

<?php $section->end(); ?>