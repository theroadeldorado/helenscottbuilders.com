<?php
  $image = get_sub_field('image');
  $copy = get_sub_field('copy');
  $image_position = get_sub_field('image_position');

  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap <?php echo $image_position === 'right' ? ' lg:flex-row-reverse' : '';?>">
      <?php if($image):?>
        <div class="relative w-full px-4 lg:w-1/2">
          <img class="object-cover object-center w-full h-full rounded-lg" src="<?php print aq_resize($image['url'], 1200, 800, true, true, true); ?>" alt="<?php echo $image['alt']; ?>">
        </div>
      <?php endif;?>
      <div class="flex w-full px-4 lg:w-1/2 lg:max-w-lg <?php echo $image_position === 'right' ? ' lg:pr-16' : 'lg:pl-16';?>">
        <div class="max-w-2xl pt-8 mx-auto my-auto lg:py-4 lg:max-w-lg">
          <?php if($copy):?>
            <div class="mb-6 wizzy">
              <?php echo $copy;?>
            </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
<?php $section->end(); ?>