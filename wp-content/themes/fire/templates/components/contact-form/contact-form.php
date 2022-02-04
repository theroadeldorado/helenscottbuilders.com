<?php
  $copy = get_sub_field('copy');
  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="grid gap-12 md:grid-cols-2">
      <div class="row-start-2 p-6 bg-gray-100 border border-gray-200 rounded-lg shadow-lg md:row-start-1">
        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
      </div>
      <div class="wizzy">
        <?php print $copy; ?>
      </div>
    </div>
  </div>
<?php $section->end(); ?>