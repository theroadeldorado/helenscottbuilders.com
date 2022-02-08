<?php
  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>

  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap -mx-3">

      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array('post_type' => 'post', 'posts_per_page' => '6', 'paged' => $paged );
      query_posts($args); ?>
      <?php while ( have_posts() ) : the_post();
        $cat = get_the_category();
        $post_image_url = wp_get_attachment_url(get_post_thumbnail_id());
        $post_image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
      ?>
        <div class="w-full px-3 mb-12 lg:w-1/3">
          <a class="no-underline" href="<?php the_permalink();?>">
            <img
                class="object-cover w-full rounded-lg h-80"
                src="<?php echo aq_resize($post_image_url, 500, 500, true, true, true); ?>"
                alt="<?php echo $post_image_alt;?>"
              >
            <p class="mt-6 text-sm text-red-600">
              <?php if($cat[0]->name) :?>
                <span class="uppercase">
                  <?php echo $cat[0]->name;?>
                </span>
              <?php endif;?>
              <span class="ml-3 text-gray-600">
                <?php echo get_the_time('M j, Y'); ?>
              </span>
            </p>
            <h3 class="my-2 text-2xl font-bold text-black font-heading"><?php the_title(); ?></h3>
            <p class="text-lg leading-loose text-gray-600 line-clamp-2"><?php the_excerpt();?></p>
          </a>
        </div>
      <?php endwhile; ?>
      <div class="flex items-center justify-between w-full blog-pagination">
        <div class="grow"><?php next_posts_link( 'Older posts' ); ?></div>
        <div class="text-right grow"><?php previous_posts_link( 'Newer posts' ); ?></div>
      </div>
      <?php
      wp_reset_query();
      ?>
    </div>
  </div>

<?php $section->end(); ?>