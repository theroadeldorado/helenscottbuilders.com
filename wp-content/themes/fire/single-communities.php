<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fire
 */

get_header();
?>

<main id="primary" class="site-main">
  <?php while ( have_posts() ) :
    the_post();
    $location = get_field('location');
    $featured_image = get_field('featured_image');
    $gallery = get_field('gallery');
  ?>
    <article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container px-4 py-20 mx-auto">
        <h1 class="mt-2 mb-6 text-4xl font-bold text-center md:text-5xl font-heading"><?php the_title();?></h1>
        <?php if($location):?>
          <p class="mx-auto mb-8 text-lg text-center ">
            <?php echo $location;?>
          </p>
        <?php endif;?>
      </div>

      <?php if(have_rows('sections')) : $block_count = 1;
        while(have_rows('sections')) : the_row();
          $post_type = get_post_type();
          $layout_type = get_row_layout();
          $fire_section = new Fire_Section($block_count, $layout_type);
          ACF_Layout::render(get_row_layout(), $block_count, $fire_section); $block_count++;
        endwhile;
      endif; ?>

      <?php
      $images = get_field('gallery');
      if( $images ): ?>
        <div class="container px-4 py-20 mx-auto">
          <div class="grid gap-6 mb-6 md:grid-cols-2" id="gallery">
            <?php foreach( $images as $image ): ?>
              <div class="overflow-hidden rounded-lg">
                <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 800, 500, true, true, true); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </article>
  <?php endwhile;  ?>
</main>
<?php
get_footer();
