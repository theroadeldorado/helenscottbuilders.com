<?php
  $title = get_sub_field('title');


  $section->add_classes([
    'relative py-10 lg:py-20 bg-red-600'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
     <?php if($title):?>
      <h2 class="mb-6 text-3xl font-bold text-center text-white lg:mb-8 md:text-4xl font-heading"><?php echo $title;?></h2>
    <?php endif;?>

    <div class="grid grid-cols-1 gap-4 text-center md:grid-cols-3">
      <?php if( have_rows('steps') ): $counter = 0;
        while ( have_rows('steps') ) : the_row();
          $counter++;
          $feature_title = get_sub_field('title');
          $copy = get_sub_field('short_description');
          ?>
          <div class="relative flex flex-col items-center justify-center h-full px-6 py-6 overflow-hidden bg-white shadow rounded-xl">
            <div class="absolute top-0 left-0 inline-flex items-center justify-center w-12 h-12 mb-3 leading-6 text-white bg-red-900 rounded-br-lg">
              <span class="text-2xl font-bold"><?php echo $counter;?></span>
            </div>
            <?php if($feature_title):?>
              <h3 class="px-8 mb-4 text-2xl font-bold font-heading text-rose-600"><?php echo $feature_title;?></h3>
            <?php endif;?>
            <?php if($image):?>
              <div class="w-full mb-4 overflow-hidden rounded-lg aspect-w-3 aspect-h-2">
                <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 900, 600, true); ?>" alt="<?php echo $image['alt']; ?>">
              </div>
            <?php endif;?>
            <?php if($copy):?>
              <div class="leading-relaxed text-gray-700 wizzy"><?php echo $copy;?></div>
            <?php endif;?>
          </div>
        <?php endwhile;
      endif; ?>
    </div>
  </div>
<?php $section->end(); ?>