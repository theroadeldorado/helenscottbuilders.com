<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fire
 */
  $featured_img_url = get_the_post_thumbnail_url(get_the_ID());
  $category = get_the_category();
  $category_id = $category[0]->cat_ID;
  $category_name = $category[0]->cat_name;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container px-4 py-20 mx-auto">
    <div class="max-w-2xl mx-auto mb-6 text-center">
      <h1 class="mt-2 mb-6 text-4xl font-bold md:text-5xl font-heading"><?php the_title();?></h1>
      <span class="inline-block mb-2 space-x-2 text-sm text-gray-700">
        <span><?php echo  get_the_date('F j, Y');?></span>
        <span>|</span>
        <span class="text-red-600"><?php echo $category_name;?></span>
      </span>
    </div>
    <div class="mb-8">
      <img class="object-cover mx-auto mb-6 rounded-lg h-80" src="<?php print aq_resize($featured_img_url, 1280, 400, true); ?>" alt="<?php the_title();?>">
    </div>
    <div class="max-w-2xl mx-auto wizzy">
      <?php the_content();?>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
