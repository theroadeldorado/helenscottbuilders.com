<?php
  $image = get_sub_field('image');
  $image_alt = get_post_meta($image['ID'] , '_wp_attachment_image_alt', true);

  $quote_content = get_sub_field('quote_content');
  $quote = $quote_content['quote'];
  $name = $quote_content['name'];
  $project = $quote_content['project'];

  $section->add_classes([
    'py-20 pb-8 mb-20 overflow-x-hidden bg-gray-100'
  ]);
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap mb-24">
      <div class="relative w-full mb-20 pb-[37%] lg:w-1/2 lg:mb-0">
        <div class="absolute top-0 right-0 w-full h-full mt-6 -mr-6 bg-gray-900 bg-opacity-5 rounded-xl"></div>
        <img class="absolute top-0 right-0 object-cover w-full h-full rounded-xl" src="<?php print aq_resize($image['url'], 900, 900, true); ?>" alt="<?php echo $image_alt; ?>">
      </div>
      <div class="w-full my-auto lg:w-1/2 lg:pl-24">
        <span><?php new Fire_SVG('quote'); ?></span>
        <h2 class="my-4 text-4xl font-bold font-heading"><?php echo $quote;?></h2>
        <p class="mb-1 text-xl"><?php echo $name;?></p>
        <p class="text-red-600"><?php echo $project;?></p>
      </div>
    </div>
  </div>

<?php $section->end(); ?>