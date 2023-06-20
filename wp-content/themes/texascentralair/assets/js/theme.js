jQuery( document ).ready( function() {
    const swiper = new Swiper('.review-slider', {
        // Default parameters
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
      });
} );