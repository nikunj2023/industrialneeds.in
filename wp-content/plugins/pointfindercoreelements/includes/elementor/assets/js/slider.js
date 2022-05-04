( function( $ ) {

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/pointfinderslider.default', function(index){
      var number = $('.pfitemslider').data('number');
      var descbox = $('.pfitemslider').data('descbox');
      var interval = $('.pfitemslider').data('interval');
      var mode = $('.pfitemslider').data('mode');
      var autoplay = $('.pfitemslider').data('autoplay');
      var autoheight = $('.pfitemslider').data('autoheight');

      if (descbox != 'yes') {
        $(window).on("load resize orientationchange", function(){
          if($("#"+number).width() < 640){
            $("#"+number).addClass("pfmobile");
          }else{
            $("#"+number).removeClass("pfmobile");
          }
        });
      }

      var animateineffect, animateouteffect;

      if (mode == 'fade') {
        animateineffect = 'fadeIn'; animateouteffect = 'fadeOut';
      }else if(mode == 'bounce'){
        animateineffect = 'fadeIn'; animateouteffect = 'bounceOut';
      }else if(mode == 'slide'){
        animateineffect = 'slideInLeft'; animateouteffect = 'slideOutRight';
      }else if(mode == 'zoom'){
        animateineffect = 'zoomIn'; animateouteffect = 'zoomOut';
      }else if(mode == 'flip'){
        animateineffect = 'flipInX'; animateouteffect = 'fadeOut';
      }else if(mode == 'lightspeed'){
        animateineffect = 'lightSpeedIn'; animateouteffect = 'fadeOut';
      }else{
        animateineffect = false; animateouteffect = false;
      }

      $("#"+number).owlCarousel({
          items : 1,
          nav : true,
          dots : false,
          autoplayTimeout:(interval*1000),
          autoplay : (autoplay == 'yes')?true:false,
          autoplayHoverPause : true,
          margin: 0,
          lazyLoad: true,
          loop: true,
          autoHeight : (autoheight == 'yes')?true:false,
          rtl:(pointfinderlcsc.rtl == 'true')?true:false,
          responsiveClass:true,
          navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
          animateOut: animateouteffect,
          animateIn: animateineffect,
        });



    });
	});
  
} )( jQuery );
