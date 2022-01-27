<?php

  $title = get_sub_field('title');
  $projects = get_sub_field('projects');

  $section->add_classes([
    'py-12 md:py-20'
  ]);
?>

<?php $section->start(); ?>

  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap -mx-3">

      <?php foreach ($projects as $project) {
        var_dump($project);
      }?>

      <div class="relative w-full mb-8 text-center lg:w-1/3 lg:mb-0 lg:text-left">
        <div class="max-w-md mx-auto mb-6 lg:max-w-xs lg:pr-16 lg:ml-0 lg:mb-0">
          <h2 class="mb-4 text-3xl font-bold leading-tight md:text-4xl font-heading">Recently Completed Hinkley Home</h2>
          <p class="mb-6 text-xs text-gray-600 md:text-base">Our homeowners did a wonderful job selecting their finishes and fixtures throughout to complete this finished product. See for yourself!</p>
          <div class="flex items-center justify-start space-x-4 "><a class="inline-block px-4 py-3 text-xs font-semibold leading-none text-red-600 border border-red-600 rounded" href="#">Gallery</a><a class="inline-block px-4 py-3 text-xs font-semibold leading-none text-white bg-red-600 rounded hover:bg-red-700" href="#">Virtual Tour</a></div>
        </div>
        <div class="flex justify-center lg:absolute lg:bottom-0 lg:left-0">
          <a class="mr-4" href="#">
            <svg class="w-8 h-8 text-red-600 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
          </a>
          <a href="#">
            <svg class="w-8 h-8 text-red-600 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
          </a>
        </div>
      </div>
      <div class="flex flex-wrap w-full px-3 lg:w-2/3">
        <img class="rounded" src="https://images.unsplash.com/photo-1613082294483-fec382d8367e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1500&amp;q=80" alt=""/>
      </div>
    </div>

  </div>


<?php $section->end(); ?>