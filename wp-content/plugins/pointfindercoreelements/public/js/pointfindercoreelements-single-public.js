(function( $ ) {
	'use strict';

	$(function() {

		var $owl1 = $("#pfitemdetail-slider");
	    var $owl2 = $("#pfitemdetail-slider-sub");
	    var flag = false;
	    var duration = 300;
	    var autoplay_status = $owl1.data("autoplay");
      	var autoheight_status = $owl1.data("autoheight");
      	var tstyle = $("#pfitemdetail-slider").data("tstyle");

      	var animatein = ''; var animateout = '';

      	
      	if (tstyle == 'fade') {
      		animatein = 'fadeIn'; animateout = 'fadeOut';
      	}else if (tstyle == 'zoom') {
      		animatein = 'zoomIn'; animateout = 'zoomOut';
      	}else if (tstyle == 'flip') {
      		animatein = 'flipInX'; animateout = 'flipOutX';
      	}

      	if ($('#pf-customize-controls').length > 0) {
      	var slider = tns({
			"container": "#pfitemdetail-slider",
			"items": 1,
			"textDirection":(pointfinderlcsc.rtl == 'true')?'rtl':'ltr',
			"controlsContainer": "#pf-customize-controls",
			"navContainer": "#pfitemdetail-slider-sub",
			"navAsThumbnails": true,
			"autoplay": (autoplay_status == 1)?true:false,
			"autoplayTimeout": parseInt($("#pfitemdetail-slider").data("timer")),
			"autoplayHoverPause": true,
			"swipeAngle": false,
			"speed": 400,
			"animateOut": animateout,
    		"animateIn": animatein,
		    "loop": false,
		    "autoHeight":(autoheight_status == 1)?true:false,
		    "lazyLoad": true,
		    "rewind": true,
		    "gutter":0,
		    "edgePadding":0,
		    
		  });
      	}

      	if ($('#pfitemdetail-slider-sub').length > 0) {
      		var amount = 7;

	      	var slider2 = tns({
				"container": "#pfitemdetail-slider-sub",
				"items": amount,
				"textDirection":(pointfinderlcsc.rtl == 'true')?'rtl':'ltr',
				"controlsContainer": "#pf-customize-controls-sub",
				"navContainer": "#pfitemdetail-slider-sub",
				"navAsThumbnails": true,
				"autoplay": (autoplay_status == 1)?true:false,
				"autoplayTimeout": parseInt($("#pfitemdetail-slider").data("timer")),
				"autoplayHoverPause": true,
				"swipeAngle": false,
				"speed": 400,
				"animateOut": animateout,
	    		"animateIn": animatein,
			    "loop": false,
			    "autoHeight":(autoheight_status == 1)?true:false,
			    "lazyLoad": true,
			    "rewind": false,
			    "gutter":10,
			    "edgePadding":0,
			    "responsive": {
			     	0 : {
		                items : 1
		            },
		            479 : {
		                items : 3
		            },
		            979 : {
		                items : 4
		            },
		            638 : {
		                items : 5
		            },
		            768 : {
		                items : 6
		            },
		            1200 : {
		                items : amount
		            }
			  	}
			  });

	      	
	      	if (slider2.isOn == false && $.pf_tablet2_check()) {
	      		setTimeout(function(){
	      			$("#pfitemdetail-slider-sub-mw").css('height', 'auto');
	      			$("#pfitemdetail-slider-sub").css('display', 'block');
	      		},300);
	      	}
	     
      	}

		$("#pfitemdetail-slider").magnificPopup({
	          delegate: "a",
	          type: "image",
	          gallery:{
	          enabled:true,
	          navigateByImgClick: true,
	          preload: [0,2],
	          arrowMarkup: "<button title=\"%title%\" type=\"button\" class=\"mfp-arrow mfp-arrow-%dir%\"></button>",
	          tPrev: ""+$("#pfitemdetail-slider").data("mes1")+"",
	          tNext: ""+$("#pfitemdetail-slider").data("mes2")+"",
	          tCounter: "<span class=\"mfp-counter\">%curr% / %total%</span>"
	          }
		  });
		
		if ($('#pfsearch-filter').length > 0) {
			$('#pfsearch-filter').dropdown();
		}

	  	if ($("#pf-itempage-video").length > 0) {
	  		$("#pf-itempage-video").fitVids();
	  	}

	  	if ($(".pftabcontainer").length > 0 ) {
		  	$.ajax({
		  		url: theme_scriptspf.ajaxurl,
		  		type: 'POST',
		  		dataType: 'json',
		  		data: {l: $(".pftabcontainer").attr('data-lid'),security:theme_scriptspf.pfget_itemcount,action:'pfget_itemcount'},
		  	})
		  	.done(function(data) {});
	  	}

  	});

})( jQuery );
