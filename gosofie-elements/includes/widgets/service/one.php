<?php
$settings = $this->get_settings();

$title = $settings['title'];
$info = $settings['info'];
$icon = $settings['icon'];

$link = get_that_link($settings['b1url']);

$title1 = $settings['b1url']['url'] ? '<h5 class="mb-2"><a '.$link.'>'.$title.'</a></h5>' : '<h5 class="mb-2">'.$title.'</h5>';


    echo '<div class="service-box text-center rounded-lg hover:shadow-lg shadow-md">
        <div class="py-12 px-4">
        <div class="service-icon mb-4">';
            \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
            echo'</div>
            '.$title1.'
            <p>'.$info.'</p>
        </div>
    </div>';