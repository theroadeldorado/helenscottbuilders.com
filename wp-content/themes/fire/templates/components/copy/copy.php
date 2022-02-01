<?php
  $copy = get_sub_field('copy');
  $section->add_classes([
    'relative bg-gray-800'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="max-w-4xl mx-auto text-white wizzy">
      <?php print $copy; ?>
    </div>
  </div>
<?php $section->end(); ?>