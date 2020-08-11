(function($) {
  const WidgetElements_ACFSliderHandler1 = function ($scope, $) {
    const zenPrograms = $(".zen-programs");
    
    if (zenPrograms.length) {
      zenPrograms.each(function () {
        const $sliderMain = $(this).find(".gallery-main");
        const $sliderThumbs = $(this).find(".gallery-thumbs");
        
        console.log(Swiper)
  
        const sliderThumbs = new Swiper($sliderThumbs, {
          spaceBetween: 10,
          slidesPerView: 7,
          freeMode: true,
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
        });
        const sliderMain = new Swiper($sliderMain, {
          spaceBetween: 10,
          navigation: {
            nextEl: $(".zen-programs .swiper-button-next"),
            prevEl: $(".zen-programs .swiper-button-prev"),
          },
          thumbs: {
            swiper: sliderThumbs
          }
        });
      })
    }
  };

  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/program_block.default', WidgetElements_ACFSliderHandler1);

  });


})(jQuery);



