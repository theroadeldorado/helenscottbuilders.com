<?php

  $terms = get_terms(array(
    'taxonomy' => 'image-tags',
    'hide_empty' => true,
    'orderby' => 'ID',
    'order' => 'ASC',
  ));
  $all_terms = [];

  foreach ($terms as $term) {
    array_push($all_terms, $term->term_id);
  }

  $all_string = implode(",",$all_terms);
  $images = [];
  $args = array('post_type' => 'project', 'posts_per_page' => '-1');
  query_posts($args);
  while ( have_posts() ) : the_post();
    $post_images = get_field('gallery');
    if( $post_images ):
      foreach( $post_images as $image ):
        $tags_array = [];
        $tags = get_field('tags', $image['ID']);
        if( $tags ):
          foreach( $tags as $tag ):
            array_push($tags_array, [$tag->term_id, $tag->name]);
          endforeach;
        endif;
        array_push($images, ['ID' => $image['ID'], 'url' => $image['url'], 'alt' => $image['alt'], 'tags' => $tags_array]);
      endforeach;
    endif;
  endwhile;
  wp_reset_query();
  $section->add_classes([
    'relative'
  ]);
?>

<?php $section->start(); ?>

  <div x-data="gallery()">
    <div class="container mx-auto" x-ref="gallery">
      <?php if ($terms): ?>
        <div class="flex flex-wrap items-start py-4">
          <button
            @click="termID = '', viewPage(0)"
            class="py-2.5 mb-2 mr-2 border button button-primary hover:bg-gray-700"
            :class="{'bg-gray-700': termID === ''}"
          ><?php esc_html_e( 'All', 'fire');?></button>
          <?php foreach ($terms as $term):?>
            <button
              @click="termID = '<?php echo $term->term_id; ?>',viewPage(0)"
              class="py-2.5 mb-2 mr-2 border button button-primary hover:bg-gray-700"
              :class="{'bg-gray-700': termID === '<?php echo $term->term_id; ?>'}"
            ><?php echo $term->name; ?></button>
          <?php endforeach; ?>
        </div>
      <?php endif;?>
    </div>

    <div class="grid grid-cols-2 gap-6 mx-6 mt-4 md:grid-cols-3 lg:grid-cols-4">
      <template x-for="(item, index) in filteredEmployees" :key="index">
        <button
          type="button"
          class="overflow-hidden rounded-xl"
          @click="openModal(item.image, item.imageAlt)"
        >
          <img
            loading="lazy"
            class="object-cover w-full h-full"
            :src="item.thumbnail"
            :alt="item.imageAlt"
          />
        </button>
      </template>
    </div>

    <div class="py-6">
      <div
        class="flex items-center justify-between w-full py-6 mx-auto md:w-1/2"
        x-show="pageCount() > 1"
      >
        <button
          x-on:click="viewPage(0)"
          :disabled="pageNumber==0"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
        >
          <svg
            class="w-8 h-8 text-red-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polygon points="19 20 9 12 19 4 19 20"></polygon>
            <line x1="5" y1="19" x2="5" y2="5"></line>
          </svg>
        </button>
        <button
          x-on:click="prevPage"
          :disabled="pageNumber==0"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
        >
          <svg
            class="w-8 h-8 text-red-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <template x-for="(page,index) in pages()" :key="index">
          <button
            class="px-3 py-2 rounded"
            :class="{ 'bg-red-600 text-white font-bold' : index === pageNumber }"
            type="button"
            x-on:click="viewPage(index)"
          >
            <span x-text="index+1"></span>
          </button>
        </template>
        <button
          x-on:click="nextPage"
          :disabled="pageNumber >= pageCount() -1"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
        >
          <svg
            class="w-8 h-8 text-red-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
        <button
          x-on:click="viewPage(Math.ceil(total/size)-1)"
          :disabled="pageNumber >= pageCount() -1"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
        >
          <svg
            class="w-8 h-8 text-red-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polygon points="5 4 15 12 5 20 5 4"></polygon>
            <line x1="19" y1="5" x2="19" y2="19"></line>
          </svg>
        </button>
      </div>

      <div
        x-cloak
        class="z-[10002] inset-0 fixed flex items-center justify-center w-screen h-screen transition-all duration-200 bg-black bg-opacity-60"
        :class="{'opacity-0 pointer-events-none': !showModal}"
        x-trap.noscroll="showModal"
        @click="showModal = false"
        >
        <div class="flex relative items-center justify-center h-[80vh] w-[80vw] transition-all duration-200" :class="{'-translate-y-12': !showModal}">
          <img class="object-contain object-center w-full h-full" :src="modalImage" :alt="modalAlt">
        </div>
      </div>
    </div>

    <script>
      var sourceData = [
        <?php foreach( $images as $image ):?>
        {
          id: "<?php echo $image['url'];?>",
          thumbnail: "<?php echo aq_resize($image['url'], 500, 500, true); ?>",
          image: "<?php echo aq_resize($image['url'], 1400, null, false, true, true); ?>",
          imageAlt: "<?php echo $image['alt'];?>",
          tags: "<?php foreach( $image['tags'] as $tag): echo $tag[0] . ' '; endforeach;?>",
        },
        <?php endforeach; ?>
      ];

      function gallery() {
        return {
          termID: "",
          pageNumber: 0,
          size: 12,
          total: "",
          myForData: sourceData,
          showModal: false,
          modalImage: "",
          modalAlt: "",

          get filteredEmployees() {
            const start = this.pageNumber * this.size,
              end = start + this.size;

            if (this.termID === "") {
              this.total = this.myForData.length;
              return this.myForData.slice(start, end);
            }

            this.total = this.myForData.filter((item) => {
              return item.tags.includes(this.termID);
            }).length;

            return this.myForData.filter((item) => {
              return item.tags.includes(this.termID);
            }).slice(start, end);
          },
          openModal(src, alt){
            console.log(src, alt);
            this.modalImage = src;
            this.modalAlt = alt;
            this.showModal = true;
          },
          pages() {
            return Array.from({
              length: Math.ceil(this.total / this.size),
            });
          },
          nextPage() {
            this.pageNumber++;
          },
          prevPage() {
            this.pageNumber--;
          },
          pageCount() {
            return Math.ceil(this.total / this.size);
          },
          startResults() {
            return this.pageNumber * this.size + 1;
          },
          endResults() {
            let resultsOnPage = (this.pageNumber + 1) * this.size;
            if (resultsOnPage <= this.total) {
              return resultsOnPage;
            }
            return this.total;
          },
          scrollToTop(){
            window.scrollTo({
              top: window.pageYOffset + this.$refs.gallery.getBoundingClientRect().top,
              behavior: 'smooth'
            });
          },
          viewPage(index) {
            this.scrollToTop();
            this.$el.blur();
            this.pageNumber = index;
          },
        };
      }
    </script>
  </div>

<?php $section->end(); ?>