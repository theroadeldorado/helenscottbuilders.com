<?php
  $title = get_sub_field('title');
  $left_column_copy = get_sub_field('left_column_copy');
  $right_column_copy = get_sub_field('right_column_copy');

  $section->add_classes([
    'relative py-10 lg:py-20 bg-gray-50'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <?php if($title):?>
      <h2 class="mb-6 text-3xl font-bold text-center lg:mb-8 md:text-4xl font-heading"><?php echo $title;?></h2>
    <?php endif;?>
    <div class="flex flex-wrap items-start justify-between max-w-2xl mb-12 lg:max-w-full">
      <div class="w-full mb-4 lg:w-1/2 lg:mb-0">
        <div class="leading-loose text-gray-700 wizzy">
          <?php echo $left_column_copy;?>
        </div>
      </div>
      <div class="w-full lg:w-1/2 lg:pl-16">
        <div class="leading-loose text-gray-700 wizzy">
          <?php echo $right_column_copy;?>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-4 text-center md:grid-cols-3">
      <?php if( have_rows('features') ):
        while ( have_rows('features') ) : the_row();
          $feature_title = get_sub_field('title');
          $image = get_sub_field('image');
          $copy = get_sub_field('copy');
          ?>
          <div class="h-full p-6 bg-white border border-gray-200 shadow-md rounded-xl">
            <?php if($feature_title):?>
              <h3 class="mb-4 text-2xl font-bold font-heading text-rose-600"><?php echo $feature_title;?></h3>
            <?php endif;?>
            <?php if($image):?>
              <div class="w-full mb-4 overflow-hidden rounded-lg aspect-w-3 aspect-h-2">
                <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 900, 600, true); ?>" alt="<?php echo $image['alt']; ?>">
              </div>
            <?php endif;?>
            <?php if($copy):?>
              <div class="text-sm leading-relaxed text-gray-700 wizzy"><?php echo $copy;?></div>
            <?php endif;?>
          </div>
        <?php endwhile;
      endif; ?>
    </div>
  </div>
<?php $section->end(); ?>