(function($) {
  
  const posts = $(".zen-posts")
  
  if (posts.length) {
    posts.each(function () {
      const postsFilterItems = $(this).find(".zen-posts-filter__item-link")
      const postsItems = $(this).find(".zen-post")
      
      if (postsFilterItems.length && postsItems.length) {
        postsFilterItems.each(function () {
          $(this).click(function (e) {
            e.preventDefault();
            postsFilterItems.removeClass("zen-posts-filter__item-link_active")
            
            $(this).addClass("zen-posts-filter__item-link_active")
            
            const filterKey = $(this).data("filter-key");
  
            postsItems.each(function () {
              $(this).removeClass("zen-post__hidden");
              
              if (filterKey === "all") return;
              
              const postKeys = $(this).data("filter-key").split(" ");
              
              if (!postKeys.includes(filterKey)) {
                $(this).addClass("zen-post__hidden")
              }
            })
          })
        })
      }
    
    })
  }
  
})(jQuery);
