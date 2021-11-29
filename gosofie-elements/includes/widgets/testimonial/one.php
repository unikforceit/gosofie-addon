<?php
$settings = $this->get_settings();

$lists = $settings['lists'];

echo '<div class="testimonial-slider">';
foreach ($lists as $item) {
    $title = $item['title'];
    $des = $item['des'];
    $info = $item['info'];

    $link = get_that_link($item['b1url']);
    $img = get_that_image($item['img']);

  echo '<div class="px-5 py-4 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <div class="flex mb-4">
      <div class="w-12 h-12 rounded-full shadow-md">
            '.$img.'
      </div>
      <div class="ml-2 mt-0.5">
        <h5 class="block font-bold text-base leading-snug text-black dark:text-gray-100">'.$title.'</h5>
        <span class="block text-sm text-gray-500 dark:text-gray-400 font-light leading-snug">'.$des.'</span>
      </div>
    </div>
    <p class="text-gray-800 dark:text-gray-100 leading-snug md:leading-normal">'.$info.'</p>
  </div>';

}

echo'</div>';