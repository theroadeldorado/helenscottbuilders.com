<?php
  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <?php
    $args = array(
      'post_type' => 'project',
      'posts_per_page' => '-1',
      'meta_key' => 'virtual_tour',
      'meta_value' => '',
      'meta_compare' => '!=',
      'ignore_sticky_posts' => 1
    );
    query_posts($args); ?>
    <?php while ( have_posts() ) : the_post(); $virtual_tour = get_field('virtual_tour'); ?>
    <?php if($virtual_tour):?>
      <div class="w-full mb-12 overflow-hidden rounded-lg virtual-tour aspect-w-16 aspect-h-9" id="virtual-tour" data-name="<?php echo the_title();?>">
        <iframe class="w-full h-full" src="<?php echo $virtual_tour;?>">Your browser doesn't support iframes. Please upgrade your browser</iframe>
      </div>
    <?php endif;?>
    <?php endwhile;
    wp_reset_query();
    ?>

  </div>
<?php $section->end(); ?>