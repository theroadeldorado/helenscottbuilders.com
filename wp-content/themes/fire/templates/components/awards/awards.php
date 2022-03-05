<?php
  $title = get_sub_field('title');
  $images = get_sub_field('logos');
  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>

  <div class="container px-4 mx-auto" >
    <?php if($title):?>
      <h2 class="mb-8 text-3xl font-bold text-center lg:mb-8 md:text-4xl font-heading"><?php echo $title;?></h2>
    <?php endif;?>

    <?php if( $images ): ?>
      <div class="mt-6 grid grid-cols-2 gap-0.5 md:grid-cols-3 lg:mt-8">
        <?php foreach( $images as $image ): ?>
          <div class="flex flex-col items-center justify-center col-span-1 space-y-4">
            <div class="relative flex items-center justify-center max-w-[220px] w-full h-[150px]">
              <?php echo wp_get_attachment_image($image['id'], $size = 'large', "", array( "class" => "object-contain w-full h-full", "loading" => "lazy" )); ?>
            </div>
              <p class="text-center text-[14px] balance-text uppercase px-4 text-gray-600 "><?php echo $image['caption']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

<?php $section->end(); ?>