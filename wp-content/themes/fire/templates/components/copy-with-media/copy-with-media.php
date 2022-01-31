<?php
  $image = get_sub_field('image');
  $copy = get_sub_field('copy');

  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap">
      <div class="relative w-full px-4 lg:w-1/2">
        <img class="object-cover object-center w-full h-full rounded-md" src="<?php print aq_resize($image['url'], 1200, 800, true); ?>" alt="<?php echo $image['alt']; ?>">
      </div>
      <div class="flex w-full px-4 lg:w-1/2 lg:max-w-lg lg:h-128 lg:pl-16">
        <div class="max-w-2xl pt-8 mx-auto my-auto lg:pt-0 lg:max-w-lg">
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