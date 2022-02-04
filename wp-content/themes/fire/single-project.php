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
  <?php
  while ( have_posts() ) :
    the_post();
    $featured_image = get_field('featured_image');
    $project_description_short = get_field('project_description_short');
    $gallery = get_field('gallery');
    $virtual_tour = get_field('virtual_tour');
  ?>
    <article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container px-4 py-20 mx-auto">
        <div class="max-w-2xl mx-auto mb-6 text-center">
          <h1 class="mt-2 mb-6 text-4xl font-bold md:text-5xl font-heading"><?php the_title();?></h1>
          <?php if($project_description_short):?>
            <div class="mx-auto mb-8 text-lg text-center ">
              <?php echo $project_description_short;?>
            </div>
          <?php endif;?>
        </div>

        <?php
        $images = get_field('gallery');
        if( $images ): ?>
          <div class="grid gap-6 mb-6 md:grid-cols-2" >
            <?php foreach( $images as $image ): ?>
              <div class="overflow-hidden rounded-lg">
                <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 800, 500, true); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>


        <?php if($virtual_tour):?>
          <div class="w-full overflow-hidden rounded-lg virtual-tour aspect-w-16 aspect-h-9">
            <iframe class="w-full h-full " src="<?php echo $virtual_tour;?>">Your browser doesn't support iframes. Please upgrade your browser</iframe>
          </div>
        <?php endif;?>
      </div>

    </article>
  <?php endwhile;  ?>
</main>
<?php
get_footer();
