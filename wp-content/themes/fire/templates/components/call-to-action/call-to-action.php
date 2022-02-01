<?php
  $image = get_sub_field('image');

  $copy = get_sub_field('copy');

  $section->add_classes([
    'relative bg-gray-800'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="py-10 pt-16 text-center lg:py-20">
      <div class="max-w-lg mx-auto text-white wizzy">
        <?php print $copy; ?>
      </div>
    </div>
  </div>
<?php $section->end(); ?>