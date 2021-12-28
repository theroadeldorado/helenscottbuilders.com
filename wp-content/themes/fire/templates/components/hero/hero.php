<?php
  $image = get_sub_field('image');
  $image_alt = get_post_meta($image['ID'] , '_wp_attachment_image_alt', true);

  $copy = get_sub_field('copy');

  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>

  <img src="<?php print aq_resize($image['url'], 1920, 600, true); ?>" alt="<?php echo $image_alt; ?>">
  <?php print $copy; ?>

<?php $section->end(); ?>
