<?php

  $title = get_sub_field('title');
  $copy = get_sub_field('copy');

  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="max-w-lg mx-auto mb-12 text-center">
      <?php if($title):?>
        <h2 class="mt-2 mb-4 text-3xl font-bold md:text-4xl font-heading"><?php echo $title;?></h2>
      <?php endif;?>
      <?php if($copy):?>
        <div class="text-gray-500"><?php echo $copy;?></div>
      <?php endif;?>
    </div>
    <div class="grid grid-cols-2 gap-6 mb-8 lg:grid-cols-4">
      <?php if( have_rows('projects') ):
        $counter = 0;
        while ( have_rows('projects') ) : the_row();
          $counter++;
          $project = get_sub_field('project');
          $project_image = get_field('featured_image', $project->ID); ?>
          <a href="<?php the_permalink($project->ID);?>" class="block hover:shadow-lg border border-transparent hover:border-gray-300 group transition-all duration-200 rounded-lg overflow-hidden aspect-square <?php echo $counter === 3 || $counter === 6 ? 'lg:col-span-2 lg:row-span-2' : '';?>">
            <img class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105" src="<?php echo $project_image['url'];?>" alt=""/>
          </a>
        <?php endwhile;
      endif; ?>
    </div>
  </div>
<?php $section->end(); ?>