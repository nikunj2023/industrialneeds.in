( function( $ ) {


  $( window ).on( 'elementor/frontend/init', function() {

    
    var footer_row_height = 0;
    var footer_height = 0;
    var header_height = 0;
    var adminbarheight = 0;
    var wpfcontainermargin = 0;

    if ($('.wpf-container').length > 0) {
      wpfcontainermargin = $('.wpf-container').css('margin-top');
      wpfcontainermargin = parseInt(wpfcontainermargin.replace("px",""));
    }

    if ($('.wpf-footer-row-move').length>0) {
      footer_row_height = $('.wpf-footer-row-move').outerHeight();
      footer_row_height = footer_row_height + parseInt($('.wpf-footer-row-move').data("gbf"));
    }

    if ($('.wpf-footer').length>0) {
      footer_height = $('.wpf-footer').outerHeight();
    }

    if ($('.wpf-header').length>0) {
      header_height = $('.wpf-header').outerHeight();
    }

    if ($('#wpadminbar').length>0) {
      adminbarheight = $('#wpadminbar').outerHeight();
    }


    var total_out = footer_row_height + footer_height + wpfcontainermargin;
    
    if ($('.wpf-container').length > 0) {$('.wpf-container').css('min-height','calc(100vh - '+total_out+'px)');}

 

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pointfinderlogocarousel.default', function(index){
      
      var carouselel = $( index ).find('.pointfinderlogocarousel');
     
      carouselel.owlCarousel({
            items : carouselel.data('logoamount'),
            nav : (carouselel.data('prevnext') == 'yes')?true:false,
            dots : (carouselel.data('pagination') == 'yes')?true:false,
            autoplay : (carouselel.data('autoplay') == 'yes')?true:false,
            autoplayHoverPause : true,
            autoplayTimeout: (carouselel.data('speed')*1000),
            margin: 10,
            responsiveClass:true,
            autoHeight : false,
            loop:true,
            lazyLoad:false,
            navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
          });

          setTimeout(function(){
            carouselel.find(".vc-inner img").css("opacity","1").css("width","100%");
          },150);
      });
	});
  
} )( jQuery );
