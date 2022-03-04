<?php
  $quotes = get_sub_field('testimonials') ? get_sub_field('testimonials') : [] ;
  $total = count($quotes);
  $title = get_sub_field('title');

  $section->add_classes([
    'py-20 pb-8 overflow-x-hidden relative bg-gray-100'
  ]);
?>

<?php $section->start(); ?>
<div x-data="quoteSlider()">
  <div class="absolute w-72 top-4 left-8 opacity-5"><?php new Fire_SVG('quote'); ?></div>

  <div class="container px-4 mx-auto" >
    <?php if($title):?>
      <h2 class="mb-6 text-3xl font-bold text-center text-red-600 lg:mb-8 md:text-4xl font-heading"><?php echo $title;?></h2>
    <?php endif;?>
    <div class="grid">
      <?php if( have_rows('testimonials') ): $count = 0;
        while ( have_rows('testimonials') ) : the_row();
          $quote = get_sub_field('quote');
          $name = get_sub_field('name');?>
          <div
            class="flex flex-col items-center justify-center col-span-1 col-start-1 row-span-1 row-start-1 transition-all duration-500" :class="{'pointer-events-none': activeSlide !== <?php echo $count; ?>}"
          >
            <h2
              class="my-4 text-lg transition-all duration-500 font-heading wizzy"
              :class="{' opacity-0 pointer-events-none translate-y-8': activeSlide !== <?php echo $count; ?>}"
            ><?php echo $quote;?></h2>
            <?php if($name):?>
              <p
                class="w-full pl-4 text-xl font-bold text-left text-red-600 transition-all duration-500"
                :class="{'opacity-0 pointer-events-none delay-150 -translate-y-6': activeSlide !== <?php echo $count; ?>}"
              > - <?php echo $name;?></p>
            <?php endif;?>
          </div>
          <?php $count++;
        endwhile;
      endif; ?>
    </div>
  </div>

  <div class="flex items-center justify-center w-full py-4 space-x-4">
    <template x-for="(slide, index) in slidesLength" :key="index">
      <button
          class="flex items-center justify-center p-1 transition-colors duration-200 border border-red-500 rounded-full group"
          @click="dots(index)"
        >
          <span
            class="block w-3 h-3 rounded-full group-hover:bg-red-700"
            :class="{'bg-red-500': activeSlide === index, 'bg-transparent': activeSlide !== index}"
          ></span>
        </button>
    </template>
  </div>
  <script>
    function quoteSlider() {
      return {
        activeSlide: 0,
        interval: null,
        slidesLength: <?php echo $total; ?>,
        init(){
          this.rotate();
        },
        rotate(){
          if (this.slidesLength >= 1){
            this.interval = setInterval(() => {
              this.activeSlide = this.activeSlide === this.slidesLength - 1 ? 0 : this.activeSlide + 1;
            }, 10000);
          }
        },
        newRotate(){
          clearInterval(this.interval);
          this.interval = setInterval(() => {
            this.activeSlide = this.activeSlide === this.slidesLength - 1 ? 0 : this.activeSlide + 1;
          }, 10000);
        },
        dots(i) {
          this.activeSlide = i;
          this.newRotate();
        }
      }
    }
  </script>
</div>



<?php $section->end(); ?>