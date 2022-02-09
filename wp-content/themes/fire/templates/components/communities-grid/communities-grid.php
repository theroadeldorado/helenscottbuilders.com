<?php
  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>

  <div class="container px-4 mx-auto">
    <div class="grid gap-6 mb-6 md:grid-cols-2" id="gallery">
    <?php
    $args = array('post_type' => 'communities', 'posts_per_page' => '');
    query_posts($args); ?>
    <?php while ( have_posts() ) : the_post();
      $featured_image = get_field('featured_image');
      $location = get_field('location');
     ?>
        <a href="<?php the_permalink();?>" class="no-underline group">
          <div class="mb-3 overflow-hidden transition-all duration-200 rounded-lg group-hover:shadow-lg">
            <img class="object-cover w-full h-full transition-all duration-500 group-hover:scale-105" src="<?php print aq_resize($featured_image['url'], 800, 500, true, true, true); ?>" alt="<?php echo esc_attr($featured_image['alt']); ?>" />
          </div>
          <h2 class="mb-2 text-xl font-bold text-center text-gray-900 transition-all duration-200 md:text-3xl font-heading group-hover:text-red-600"><?php the_title();?></h2>
          <?php if($location):?>
            <p class="mx-auto mb-8 text-center text-gray-900 transition-all duration-200 md:text-lg group-hover:text-red-600">
              <?php echo $location;?>
            </p>
          <?php endif;?>
        </a>

      <?php endwhile; wp_reset_query(); ?>
    </div>
  </div>

<?php $section->end(); ?>