<?php

  $title = get_sub_field('title');
  $projects = get_sub_field('projects');

  $section->add_classes([
    'max-w-screen overflow-x-hidden'
  ]);
  $counter =0;
?>

<?php $section->start(); ?>

  <div class="container !max-w-5xl px-4 mx-auto" x-cloak x-data="projectSlider<?php echo $section->count; ?>()">
    <?php if($title):?>
      <h2 class="mb-6 text-3xl font-bold text-center lg:text-4xl font-heading"><?php echo $title;?></h2>
    <?php endif;?>
     <div class="flex items-center justify-center mb-8 text-center">
        <button class="mr-4" @click="prev">
          <svg class="w-8 h-8 text-red-600 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
        </button>
        <button @click="next">
          <svg class="w-8 h-8 text-red-600 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </button>
      </div>
    <div class="relative grid w-full grid-cols-1 grid-rows-1">
      <?php foreach ($projects as $project) {
        $counter++;
        $title = get_the_title($project);
        $excerpt = get_field('project_description_short',$project);
        $image = get_field('featured_image',$project);
        $gallery = get_field('gallery',$project);
        $tour = get_field('virtual_tour',$project);
      ?>
        <div class="flex flex-wrap w-full col-start-1 row-start-1 pb-6 -mx-3 transition-all duration-200" :class="{'pointer-events-none': activeSlide !== <?php echo $counter;?>}">

          <div class="relative flex items-center w-full mb-8 text-center lg:mb-0 lg:text-left lg:w-1/3">
            <div class="max-w-md mx-auto mb-6 lg:max-w-xs lg:pr-16 lg:ml-0 lg:mb-0">
              <h2 class="mb-4 text-3xl font-bold leading-tight transition-all duration-200 md:text-4xl font-heading" :class="{'opacity-0 -translate-y-6': activeSlide !== <?php echo $counter;?>, 'opacity-100 delay-[75ms]': activeSlide === <?php echo $counter;?>}"><?php echo $title;?></h2>
              <?php if($excerpt):?>
                <div class="mb-6 text-xs text-gray-600 transition-all duration-200 md:text-base wizzy" :class="{'opacity-0 -translate-y-6': activeSlide !== <?php echo $counter;?>, 'opacity-100 delay-[150ms]': activeSlide === <?php echo $counter;?>}">
                  <?php echo $excerpt;?>
                </div>
              <?php endif;?>
              <div class="space-x-4 text-center lg:text-left">
                <?php if($gallery):?>
                  <a class="transition-all duration-200 button button-primary" :class="{'opacity-0 -translate-x-6': activeSlide !== <?php echo $counter;?>, 'opacity-100 delay-[225ms]': activeSlide === <?php echo $counter;?>}" href="<?php the_permalink($project);?>#gallery">Gallery</a>
                <?php endif;?>
                <?php if($tour):?>
                  <a class="transition-all duration-200 button button-outline" :class="{'opacity-0 -translate-x-6': activeSlide !== <?php echo $counter;?>, 'opacity-100 delay-[300ms]': activeSlide === <?php echo $counter;?>}" href="<?php the_permalink($project);?>#virtual-tour">Virtual Tour</a>
                <?php endif;?>
              </div>
            </div>
          </div>

          <div class="w-full px-3 transition-all duration-300 shrink-0 lg:w-2/3" :class="{'opacity-0 translate-x-24': activeSlide !== <?php echo $counter;?>, 'opacity-100': activeSlide === <?php echo $counter;?>}">
            <div class="overflow-hidden rounded-lg aspect-w-7 aspect-h-5">
              <img class="object-cover w-full h-full" src="<?php print aq_resize($image['url'], 800, 800, true, true, true); ?>" alt="<?php echo $image['alt']; ?>">
            </div>
          </div>
        </div>
      <?php }?>

    </div>
    <script>
      function projectSlider<?php echo $section->count; ?>() {
        return {
          activeSlide: 1,
           next() {
            console.log('next');
            if (this.activeSlide === <?php echo count($projects); ?>) {
              this.activeSlide = 1;
            } else {
              this.activeSlide = this.activeSlide + 1;
            }
          },
          prev() {
            console.log('prev');
            if (this.activeSlide === 1) {
              this.activeSlide = <?php echo count($projects); ?>;
            } else {
              this.activeSlide = this.activeSlide - 1;
            }
          },
        }
      }
      </script>
  </div>


<?php $section->end(); ?>