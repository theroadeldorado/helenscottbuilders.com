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

  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>

  <div class="px-4" x-data="galleryDisplay" x-ref="gallerySection">
     <div class="flex flex-wrap items-start py-4">
      <button
        @click="allProjects, viewPage(0)"
        class="py-2.5 mb-2 mr-2 border button button-primary hover:bg-gray-700"
      ><?php esc_html_e( 'Homes', 'fire');?></button>
      <?php if ($terms): ?>
        <?php foreach ($terms as $term):?>
          <button
            @click="byTerms('<?php echo $term->slug; ?>'),viewPage(0)"
            class="py-2.5 mb-2 mr-2 border button button-primary hover:bg-gray-700"
          ><?php echo $term->name; ?></button>
        <?php endforeach; ?>
      <?php endif;?>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
      <!-- BASE GALLERY OF HOMES -->
      <template x-for="index in size" :key="index" >
        <button
          x-show="gallery[index - 1]"
          @click="clickHome(gallery[index - 1]?.id)"
          class="block w-full overflow-hidden duration-500 rounded-lg aspect-w-7 aspect-h-5"
        >
          <img class="object-cover w-full h-full" :src="gallery[index - 1]?.acf?.featured_image.url" loading="lazy" :alt="gallery[index - 1]?.acf?.featured_image.alt" width="500" :height="500"/>
        </button>
      </template>

      <template x-for="index in total" :key="index" >
        <button
          x-show="gallery?.acf?.gallery[index - 1]"
          @click="openModal([index - 1])"
          class="block w-full overflow-hidden duration-500 rounded-lg aspect-w-7 aspect-h-5"
        >
          <img class="object-cover w-full h-full" :src="gallery?.acf?.gallery[index - 1]?.sizes?.large" loading="lazy" :alt="`image-${index - 1}`" width="700" height="500"/>
        </button>
      </template>
    </div>

    <div
      class="flex items-center justify-center w-full py-6 mx-auto space-x-2 md:w-1/2"
      x-show="pageCount() > 1"
    >
      <button
        @click="prevPage"
        class="text-red-600 transition-all duration-200 hover:text-red-800"
        :disabled="pageNumber === 0"
        :class="{ 'disabled cursor-not-allowed opacity-30' : pageNumber === 0 }"
      >
        <svg
          class="w-8 h-8"
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
          x-show="index < pageNumber + 4 && index >= 0 && index > pageNumber - 4 || (index > pageNumber && index < 7)"
          class="px-3 py-2 rounded"
          :class="{ 'bg-red-600 text-white font-bold' : index === pageNumber }"
          type="button"
          @click="viewPage(index)"
        >
          <span x-text="index+1"></span>
        </button>
      </template>

      <button
        @click="nextPage"
        class="text-red-600 transition-all duration-200 hover:text-red-800"
        :disabled="pageNumber >= pageCount() -1"
        :class="{ 'disabled cursor-not-allowed opacity-30' : pageNumber >= pageCount() -1 }"
      >
        <svg
          class="w-8 h-8"
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
    </div>

    <!-- MODAL -->
    <div x-cloak class="z-[10002] inset-0 fixed flex items-center justify-center w-screen h-screen transition-all duration-200 opacity-0" :class="{'opacity-0 pointer-events-none': !showModal, 'opacity-100': showModal}" x-trap.noscroll="showModal">
      <div x-show="showModal" @click="showModal = false" class="fixed inset-0 w-screen h-screen bg-black bg-opacity-60"></div>
      <div class="flex relative items-center justify-center pointer-events-none h-[80vh] w-[80vw] transition-all duration-200" :class="{'-translate-y-12': !showModal}">

        <div class="absolute bottom-0 flex items-center justify-center w-20 h-8 space-x-4 pointer-events-auto bg-black/60">
          <button @click="prevImage()">
             <svg
              class="text-white transition-transform duration-200 w-7 h-7 hover:scale-105"
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

          <button @click="nextImage()">
            <svg
              class="text-white transition-transform duration-200 w-7 h-7 hover:scale-105"
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
        </div>
        <img class="object-contain object-center max-w-full max-h-full rounded-lg" :src="modalImage" alt="Modal Image">
      </div>
    </div>
  </div>



   <script>
      function galleryDisplay() {
        return {
          showModal: false,
          loading: true,
          firstLoad: false,
          baseEndpoint: '<?php echo esc_url( home_url( '/wp-json/wp/v2' ) );?>',
          modalImage: "",
          currentImage: "",
          currentTerm: "all-homes",

          // allTerms: [],
          // currentTerms: [],
          size: 12,
          offset: 0,
          scrollPosition: 0,
          gallerySrc: [],
          gallery: [],
          pageNumber: 0,
          total: 0,
          async init(){
            this.scrollPosition = this.$refs.gallerySection.offsetTop;
            const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}`);
            this.gallerySrc = await res.json();
            this.total = await parseInt(res.headers.get('X-WP-Total'));
            this.gallery = this.gallerySrc;
            this.loading = false;
          },
          async clickHome(id){
            this.scrollToTop();
            this.currentTerm = "specific-home";
            const res = await fetch(`${this.baseEndpoint}/project/${id}`);
            this.gallery = await res.json();
            this.size = this.gallery?.acf?.gallery.length;
            console.log(this.gallery, this.size);
          },
          scrollToTop(){
            window.scrollTo({
              top: this.scrollPosition,
              behavior: 'smooth'
            });
          },
          pages() {
            return Array.from({
              length: Math.ceil(this.total / this.size),
            });
          },
           nextPage() {
            this.$el.blur();
            if(this.pageNumber < this.pageCount() - 1) {
              this.pageNumber++;
              this.viewPage(this.pageNumber);
              this.scrollToTop();
            }
          },
          prevPage() {
            this.$el.blur();
            if(this.pageNumber > 0) {
              this.pageNumber--;
              this.viewPage(this.pageNumber);
              this.scrollToTop();
            }
          },
          pageCount() {
            return Math.ceil(this.total / this.size);
          },
          openModal(img){
            this.currentImage = img;
            this.modalImage = this.gallery?.acf?.gallery[img]?.sizes?.modal;
            this.showModal = true;
          },
          viewPage(index) {
            this.scrollToTop();
            this.$el.blur();
            this.pageNumber = index;
          },
          prevImage(){
            if(this.currentImage === 0){
              this.currentImage = this.total - 1;
            } else {
              this.currentImage--;
            }
            this.modalImage = this.gallery?.acf?.gallery[this.currentImage]?.sizes?.modal;
          },
          nextImage(){
            this.currentImage++;
            if(this.currentImage === this.total){
              this.currentImage = 0;
            }
            this.modalImage = this.gallery?.acf?.gallery[this.currentImage]?.sizes?.modal;
          },
          getImage(id){
            console.log(id);
            return this.currentTerm === "all-homes" ? this.gallery[id]?.acf?.featured_image.url : this.gallery[id]?.media_details?.sizes?.large?.source_url;
          },
          async viewPage(index) {
            this.$el.blur();
            this.loading = true;
            this.scrollToTop();
            this.pageNumber = index;

            if(this.currentTerm = "all-homes"){

            } else if(''){
              const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}&offset=${(index * this.size)}`);
            } else {
              const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}&offset=${(index * this.size)}`);
            }

            this.gallery = await res.json();
            this.loading = false;
          },
          async allProjects(){
            this.currentTerm = "special-home";
            const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}`);
            this.gallery = await res.json();
            this.total = await parseInt(res.headers.get('X-WP-Total'));
            this.loading = false;
          },
          async byTerms(slug){
            // const res = await fetch(`${this.baseEndpoint}/media?per_page=${this.size}&filter[image-tags]=closet`);
            // this.gallery = await res.json();
            // this.total = await parseInt(res.headers.get('X-WP-Total'));
            // this.loading = false;
          }
        }
      }
    </script>

<?php $section->end(); ?>