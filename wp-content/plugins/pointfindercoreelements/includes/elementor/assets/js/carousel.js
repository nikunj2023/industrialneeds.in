( function( $ ) {

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/pointfindercarousel.default', function(index){
      
      $.each($('.pointfinder-lcarousel'), function(index, val) {
        
        var pf_grid_size = $(this).data('pf_grid_size');
        var hidebuttons = $(this).data('hidebuttons');
        var pagination = $(this).data('pagination');
        var speed = $(this).data('speed');
        var autoplay = $(this).data('autoplay');
        var itemspacebetween = $(this).data('itemspacebetween');
        itemspacebetween = itemspacebetween - 5;
        $(this).owlCarousel({
          items : pf_grid_size,
          nav :(hidebuttons == 'yes')?true:false,
          dots :(pagination == 'yes')?true:false,
          autoplayTimeout: (speed*1000),
          autoplay : (autoplay == 'yes')?true:false,
          rtl:(pointfinderlcsc.rtl == 'true')?true:false,
          lazyLoad: false,
          loop: true,
          autoplayHoverPause : true,
          margin: itemspacebetween,
          autoHeight : true,
          responsive : {
              0 : {
                  items : 1
              },
              479 : {
                  items : 1
              },
              979 : {
                  items : 4
              },
              768 : {
                  items : 2
              },
              980 : {
                  items : pf_grid_size
              },
              1199 : {
                  items : pf_grid_size
              }
          },
          responsiveClass: true,
          navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
        });


      });



    });
	});
  
} )( jQuery );
