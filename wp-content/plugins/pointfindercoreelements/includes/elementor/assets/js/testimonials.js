( function( $ ) {

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/pointfindertestimonials.default', function(index){
      
      var carouselel = $( index ).find('.pointfindertestimonials');
      var autoplay_status = carouselel.data("autoplay");
      var pagination_status = carouselel.data("pagination");
      var prevnext_status = carouselel.data("prevnext");
      var mode = carouselel.data("mode");

      var animateineffect, animateouteffect;

      if (mode == 'fade') {
        animateineffect = 'fadeIn'; animateouteffect = 'fadeOut';
      }else if(mode == 'slide'){
        animateineffect = 'slideInLeft'; animateouteffect = 'slideOutRight';
      }else{
        animateineffect = false; animateouteffect = false;
      }

      carouselel.owlCarousel({
          items : 1,
          nav : (prevnext_status == 'yes')?true:false,
          dots : (pagination_status == 'yes')?true:false,
          autoplay : (autoplay_status == 'yes')?true:false,
          autoplayHoverPause : true,
          autoplayTimeout:(carouselel.data('speed')*1000),
          autoHeight : true,
          responsiveClass:true,
          navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
          lazyLoad: false,
          loop: true,
          rtl:(pointfinderlcsc.rtl == 'true')?true:false,
          animateOut: animateouteffect,
          animateIn: animateineffect,
      });
    });
	});
  
} )( jQuery );
