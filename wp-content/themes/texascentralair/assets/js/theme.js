jQuery( document ).ready( function() {
    const swiper = new Swiper('.review-slider', {
        // Default parameters
        slidesPerView: 1,
        loop: true,
        // autoplay: {
        //     delay: 5000,
        // },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
      });

      const review_slider = new Swiper('.quote-slider', {
        // Default parameters
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 7000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
      });

      jQuery('.tca-review-grid-container').masonry({
        // options
        itemSelector: '.tca-review-grid',
        columnWidth: 200
      });
} );