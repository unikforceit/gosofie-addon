<?php
$settings = $this->get_settings();

$logo = $settings['logo']['url'];

$menu = $settings['menu'];

$link = get_that_link($settings['b1url']);

$btn = $settings['b1url']['url'] ? '<a '.$link.' class="inline-block font-semibold text-center text-yellow-400 border-2 border-solid border-yellow-400 rounded-sm leading-8 h-10 w-40">'.$settings['b1lbl'].'</a>' : '';


?>
<header id="main-header" class="gosofie-main-header">
<nav class="flex items-center justify-between flex-wrap p-6 w-full z-10 top-0">
    <div class="flex items-center flex-shrink-0 mr-6 lg:flex-1">
        <?php echo get_builder_image($logo,'no-underline');?>
    </div>
    <div class="block lg:hidden">
        <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600">
            <i class="material-icons">menu</i>
        </button>
    </div>

    <div class="w-full lg:flex-1 flex-grow lg:flex lg:items-center lg:w-auto lg:block pt-6 lg:pt-0 hidden" id="nav-content">
        <?php
        echo wp_nav_menu( array(
                'echo' => false,
                'menu' => $menu,
                'items_wrap' => '<ul id="main-nav" class="list-reset lg:flex justify-end flex-1 items-center leading-10">%3$s</ul>'
            )
        );
        ?>
        <div class="header-btn lg:ml-8 flex-1">
            <?php echo $btn;?>
        </div>
    </div>
</nav>
</header>