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
  <div class="delay-100 delay-[125ms] delay-[150ms] delay-[175ms] delay-[200ms] delay-[225ms] delay-[250ms] delay-[275ms] delay-[300ms] delay-[325ms] delay-[350ms] delay-[375ms] delay-[400ms] delay-[425ms] delay-[450ms] delay-[475ms] delay-[500ms] delay-[525ms] delay-[550ms] delay-[575ms] delay-[600ms] delay-[625ms] delay-[650ms] delay-[675ms] delay-[700ms] delay-[725ms] delay-[750ms] delay-[775ms] delay-[800ms] delay-[825ms] delay-[850ms] delay-[875ms] delay-[900ms] delay-[925ms] delay-[950ms] delay-[975ms] delay-[1000ms] delay-[1025ms] delay-[1050ms] delay-[1075ms] delay-[1100ms] delay-[1125ms] delay-[1150ms] delay-[1175ms] delay-[1200ms] delay-[1225ms] delay-[1250ms] delay-[1275ms] delay-[1300ms] delay-[1325ms] delay-[1350ms] delay-[1375ms] delay-[1400ms] delay-[1425ms] delay-[1450ms] delay-[1475ms] delay-[1500ms] delay-[1525ms] delay-[1550ms] delay-[1575ms] delay-[1600ms] delay-[1625ms] delay-[1650ms] delay-[1675ms] delay-[1700ms]"></div>

  <div class="px-4" x-data="galleryDisplay" x-ref="gallerySection">
    <div class="px-4 py-4 text-center" x-cloak x-data="{filters: false}">
      <button @click="filters = ! filters" class="py-2.5 px-4 mb-6 text-[16px] button button-outline">
        <span x-text="filters ? 'Hide Filters' : 'Show Filters'"></span>
      </button>
      <div class="flex flex-wrap items-center justify-center">
        <button
          @click="allProjects, viewPage(0)"
          :class="{'opacity-0 pointer-events-none translate-x-4 -translate-y-4': !filters}"
          class="py-1.5 rounded-[4px] px-2 mb-2 mr-2 text-[14px] button button-primary hover:bg-gray-700"
        ><?php esc_html_e( 'By Homes', 'fire');?></button>
        <?php $counter = 100; if ($terms):  ?>
          <?php foreach ($terms as $term): $counter = $counter + 25;?>
            <button
              x-show="filters"
              x-transition:enter="transition ease-out duration-100 delay-[<?php echo $counter;?>ms]" x-transition:enter-start="opacity-0 transform translate-x-6 translate-y-6"
              x-transition:enter-end="opacity-100 transform translate-x-0 -translate-y-0"
              x-transition:leave="transition ease-in duration-100 delay-[0ms]" x-transition:leave-start="opacity-100 transform translate-x-0 translate-y-0"
              x-transition:leave-end="opacity-0"
              @click="byTerms('<?php echo $term->slug; ?>'),viewPage(0)"
              class="py-1.5 rounded-[4px] px-2 mb-2 mr-2 text-[14px] button button-primary hover:bg-gray-700 transition-all duration-200"
            ><?php echo $term->name; ?></button>
          <?php endforeach; ?>
        <?php endif;?>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
      <!-- BASE GALLERY OF HOMES -->
      <template x-for="index in size" :key="index" x-show="currentTerm !== 'specific-home'">
        <button
          x-show="gallery[index - 1]"
          @click="clickImage(gallery[index - 1]?.id, [index - 1])"
          class="block w-full overflow-hidden transition-all duration-200 delay-100 rounded-lg aspect-w-7 aspect-h-5"
          :class="{'opacity-0 duration-0 delay-0' : loading}"
        >
          <img x-show="getImage(index - 1) !== undefined" class="object-cover w-full h-full" :src="getImage(index - 1)" alt="" width="500" :height="500"/>
        </button>
      </template>

      <template x-for="index in homeImages" :key="index" x-show="currentTerm === 'specific-home'">
        <button
          x-show="gallery?.acf?.gallery[index - 1]"
          @click="openModal([index - 1])"
          class="block w-full overflow-hidden transition-all duration-200 delay-100 rounded-lg aspect-w-7 aspect-h-5"
          :class="{'opacity-0 duration-0 delay-0' : loading}"
        >
          <img class="object-cover w-full h-full" :src="gallery?.acf?.gallery[index - 1]?.sizes?.large" alt="" width="700" height="500"/>
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

        <div class="absolute bottom-0 items-center justify-center hidden w-20 h-8 space-x-4 pointer-events-auto bg-black/60">
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
          homeImages: 0,
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
          async clickImage(id, index){
            if(this.currentTerm === "all-homes"){
              this.loading = true;
              this.scrollToTop();
              this.currentTerm = "specific-home";
              this.total = 0;
              const res = await fetch(`${this.baseEndpoint}/project/${id}`);
              this.gallery = await res.json();
              this.homeImages = this.gallery?.acf?.gallery.length;
              this.loading = false;
            } else {
              this.currentImage = index;
              this.modalImage = this.gallery[index]?.media_details?.sizes?.large?.source_url
              this.showModal = true;
            }
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
          prevImage(){
            if(this.currentImage === 0){
              this.currentImage = this.homeImages - 1;
            } else {
              this.currentImage--;
            }
            this.modalImage = this.gallery?.acf?.gallery[this.currentImage]?.sizes?.modal;
          },
          nextImage(){
            this.currentImage++;
            if(this.currentImage === this.homeImages){
              this.currentImage = 0;
            }
            this.modalImage = this.gallery?.acf?.gallery[this.currentImage]?.sizes?.modal;
          },
          getImage(id){
            return this.currentTerm === "all-homes" ? this.gallery[id]?.acf?.featured_image.url : this.gallery[id]?.media_details?.sizes?.large?.source_url;
          },
          async viewPage(index) {
            this.$el.blur();
            this.loading = true;
            this.scrollToTop();
            this.pageNumber = index;

            if(this.currentTerm === "all-homes"){
              const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}&offset=${(index * this.size)}`);
              this.gallery = await res.json();
              this.loading = false;
            } else {
              const res = await fetch(`${this.baseEndpoint}/media?per_page=${this.size}&filter[image-tags]=${this.currentTerm}&offset=${(index * this.size)}`);
              this.gallery = await res.json();
              this.total = await parseInt(res.headers.get('X-WP-Total'));
              this.loading = false;
            }
          },
          async allProjects(){
            this.loading = true;
            this.currentTerm = "all-homes";
            const res = await fetch(`${this.baseEndpoint}/project?per_page=${this.size}`);
            this.gallery = await res.json();
            this.total = await parseInt(res.headers.get('X-WP-Total'));
            this.loading = false;
          },
          async byTerms(slug){
            this.loading = true;
            this.currentTerm = slug;
            const res = await fetch(`${this.baseEndpoint}/media?per_page=${this.size}&filter[image-tags]=${slug}`);
            this.gallery = await res.json();
            this.total = await parseInt(res.headers.get('X-WP-Total'));
            this.loading = false;
          }
        }
      }
    </script>

<?php $section->end(); ?>