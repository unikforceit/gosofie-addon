<?php
$settings = $this->get_settings();

$title = $settings['title'];
$price= $settings['price'];
$info = $settings['info'];
$info2 = $settings['info2'];
$btn = $settings['btn'];
$link = get_that_link($settings['b1url']);


echo '<div class="pricing-plan font-normal pt-6 bg-white hover:shadow-lg text-center max-w-sm mx-auto hover:text-white transition-all duration-300">
           <div class="pricing-amount p-6">
            <div class=""><span class="text-4xl font-semibold font-bold">'.$price.'</div>
          </div>
          <div class="p-6 border-b border-gray md:py-8">
            <h4 class="font-medium leading-tight text-2xl mb-2 font-semibold">'.$title.'</h4>
            <p> '.$info2.'</p>
          </div>
        
          <div class="p-6">
            <ul class="leading-loose">
            '.$info.'
            </ul>
            <div class="mt-6 py-4 pricing-btn text-center">
              <a '.$link.' class="border relative border-2 rounded-xl inline-block border-yellow-400 hover:bg-yellow-400 hover:text-white text-md h-14 w-44 transition duration-300">'.$btn.'</a>
            </div>
          </div>
        </div>';