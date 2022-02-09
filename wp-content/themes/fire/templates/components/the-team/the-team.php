<?php
  $title = get_sub_field('title');
  $subtitle = get_sub_field('subtitle');

  $section->add_classes([
    ''
  ]);
?>

<?php $section->start(); ?>
<div x-data="team()">
  <div class="container px-4 mx-auto text-center">
    <div class="max-w-xl mx-auto mb-12 text-center">
      <?php if($title):?>
        <h2 class="mt-2 mb-4 text-3xl font-bold md:text-4xl font-heading"><?php echo $title;?></h2>
      <?php endif;?>
      <?php if($subtitle):?>
        <div class="text-gray-500"><?php echo $subtitle;?></div>
      <?php endif;?>
    </div>
    <div class="flex flex-wrap -mx-3">
      <?php if( have_rows('team_members') ):
        while ( have_rows('team_members') ) : the_row();
          $name = get_sub_field('name');
          $title = get_sub_field('title');
          $phone_number = get_sub_field('phone_number');
          $email = get_sub_field('email');
          $thumbnail = get_sub_field('thumbnail');
          $image = get_sub_field('image');
          $bio = get_sub_field('bio');
          $bioJson= json_encode($bio);

          ?>

          <button
            type="button"
            class="w-full px-3 mb-12 md:w-1/2 lg:w-1/3"
            @click="openBio('<?php echo $name;?>', '<?php echo $title;?>', '<?php echo $email;?>', '<?php echo $phone_number;?>', <?php echo htmlspecialchars($bioJson);?>, '<?php echo $image['url'];?>', '<?php echo $image['alt'];?>', '<?php echo $thumbnail['url'];?>')"
          >
            <img class="object-cover object-top w-64 h-64 mx-auto rounded-lg" src="<?php echo $thumbnail['url'];?>" alt="<?php echo $thumbnail['alt'];?>">
            <p class="mt-6 text-xl"><?php echo $name;?></p>
            <p class="mt-2 mb-4 text-red-600"><?php echo $title;?></p>
          </button type="button">

        <?php endwhile;
      endif; ?>
    </div>
  </div>
  <div
    x-cloak
    x-trap.noscroll="openModal"
    class="fixed inset-0 flex items-center justify-center w-screen h-screen bg-black cursor-pointer bg-opacity-40"
    x-show="openModal"
  >
    <div class="hidden md:block rounded-xl w-[95vw] max-w-[900px] cursor-default p-4 h-[550px] overflow-hidden bg-white border border-gray-400" @click.away="openModal = false">
      <div class="flex h-full space-x-4">
        <div class="w-2/5 h-full shrink-0">
          <img class="object-cover w-full h-full rounded-lg" :src="image" :alt="imageAlt">
        </div>
        <div class="w-full overflow-y-scroll">
          <h3 class="block mt-2 text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl" x-text="name"></h3>
          <p class="block mt-1 text-base font-semibold tracking-wide text-red-600 uppercase" x-text="title"></p>
          <div class="flex items-center space-x-2">
            <a :href="'mailto:' + email" class="text-sm text-gray-700" x-text="email"></a>
            <span x-show="email && phone">|</span>
            <a :href="'tel:' + phone" class="text-sm text-gray-700" x-text="phone"></a>
          </div>
          <p class="pr-4 mx-auto mt-4 text-gray-700 wizzy" x-html="bio"></p>
        </div>
      </div>
    </div>


    <div class="rounded-xl w-[95vw] overflow-y-scroll cursor-default p-4 h-[550px] overflow-hidden bg-white border border-gray-400 md:hidden" @click.away="openModal = false">
      <div class="flex flex-col items-center space-y-3">

        <div class="w-3/4 h-full shrink-0">
          <img class="object-cover w-full h-full rounded-lg" :src="imageMobile" :alt="imageAlt">
        </div>

        <div class="text-center">
          <h3 class="block mt-2 text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl" x-text="name"></h3>
          <p class="block mt-1 text-base font-semibold tracking-wide text-red-600 uppercase" x-text="title"></p>
          <a :href="'mailto:' + email" class="text-sm text-gray-700" x-text="email"></a></br>
          <a :href="'tel:' + phone" class="text-sm text-gray-700" x-text="phone"></a>
        </div>

        <div class="w-full">
          <p class="pr-4 mx-auto mt-4 text-gray-700 wizzy" x-html="bio"></p>
        </div>

      </div>
    </div>
  </div>
   <script>
    function team() {
      return {
        openModal: false,
        name: '',
        title: '',
        email: '',
        phone: '',
        bio: '',
        image: '',
        imageMobile: '',
        imageAlt: '',
        openBio( name, title, email, phone, bio, image, imageAlt, imageMobile ) {
          this.openModal = true;
          this.name = name;
          this.title = title;
          this.email = email;
          this.phone = phone;
          this.bio = bio;
          this.image = image;
          this.imageMobile = imageMobile;
          this.imageAlt = imageAlt;
        }
      }
    }
  </script>
</div>
<?php $section->end(); ?>