(function ($) {
"use strict";

    var Header = function ($scope, $) {

        $scope.find('.gosofie-main-header').each(function () {

            var settings = $(this).data('godata');

            $("#nav-toggle").click(function () {
                $("#nav-content").slideToggle("hidden");
                console.log('clicked')
            });

        });
    };

        var Testimonial = function ($scope, $) {

        $scope.find('.testimonial-slider').each(function () {

            var settings = $(this).data('godata');

            $('.testimonial-slider').owlCarousel({
                center: true,
                margin:30,
                responsiveClass:true,
                nav: true,
                dots: false,
                loop:true,
                autoplay: false,
                navText:["<i class='material-icons'>west</i>","<i class='material-icons'>east</i>"],
                smartSpeed: 1000,
                items: 1,
            });

        });

    };
    $(window).on('elementor/frontend/init', function () {

        if (elementorFrontend.isEditMode()) {

            elementorFrontend.hooks.addAction('frontend/element_ready/gosofie-header.default',Header);
            elementorFrontend.hooks.addAction('frontend/element_ready/gosofie-testimonial.default',Testimonial);

        }
        else { 

            elementorFrontend.hooks.addAction('frontend/element_ready/gosofie-header.default',Header);
            elementorFrontend.hooks.addAction('frontend/element_ready/gosofie-testimonial.default',Testimonial);
        }
    });

})(jQuery);