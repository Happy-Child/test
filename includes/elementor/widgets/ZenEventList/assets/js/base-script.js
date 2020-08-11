(function($) {
  const WidgetElements_ACFSliderHandler1 = function ($scope, $) {
    const zenEventList = $(".zen-event-list");
    
    if (zenEventList.length) {
      zenEventList.each(function () {
        new Swiper($(this).find(".zen-event-list__slider"), {
          spaceBetween: 100,
          navigation: {
            nextEl: $(this).find(".zen-event-list__nav_next"),
            prevEl: $(this).find(".zen-event-list__nav_prev"),
          },
          slidesPerView: 3,
          breakpoints: {
            0: {
              slidesPerView: 1,
               spaceBetween: 40,
            },
            600: {
              slidesPerView: 1,
               spaceBetween: 60,
            },
            991: {
              slidesPerView: 2,
               spaceBetween: 60,
            },
          },
        });
      })
    }
  };
  
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/zen_event_list.default', WidgetElements_ACFSliderHandler1);
  });
})(jQuery);



