<?php
  /**
   * The template for getting our 'page_content' from
   * our default ACF flexible layout field group
   *
   * @var $block_count - used in layouts to target specific block for inline <style>
   */
  if(have_rows('sections')) : $block_count = 1; while(have_rows('sections')) : the_row();

  $post_type = get_post_type();
  $layout_type = get_row_layout();
?>
  <?php if(!is_front_page() && $block_count === 1 && $layout_type !== 'hero'):?>
    <div class="container text-center">
      <h1 class="py-8 text-4xl font-medium text-red-600 lg:py-14 lg:text-6xl"><?php the_title();?></h1>
    </div>
  <?php endif;?>

  <?php $fire_section = new Fire_Section($block_count, $layout_type); ?>
  <?php ACF_Layout::render(get_row_layout(), $block_count, $fire_section); $block_count++; ?>

<?php
  endwhile;
  endif;
?>
