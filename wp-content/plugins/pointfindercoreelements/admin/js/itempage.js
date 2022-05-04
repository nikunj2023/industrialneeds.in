(function($) {
  "use strict";


  /* Map function STARTED */

    $.pf_submit_page_map = function(){
      
      var mapcontainer = $('#pfupload_map');
      var pf_istatus = mapcontainer.data('pf-istatus');
      var lat = mapcontainer.data('lat');
          var lng = mapcontainer.data('lng');
          var marker;

      if (!pf_istatus) {
        $.pointfinderuploadmapsys = $.pointfinderbuildmap('pfupload_map');
        
        $.pointfinderuploadmarker = marker = L.marker([parseFloat(lat),parseFloat(lng)])
            .on('click',function(e) {})
            .on('dragend',function(e) {

              $('.rwmb-map-coordinate').attr('value',marker.getLatLng().lat+','+marker.getLatLng().lng);
              

              if ($('#pfitempagestreetviewMap').length > 0 && theme_map_functionspf.st4_sp_medst == 1) {
                $('#pfitempagestreetviewMap').data('pfcoordinateslat',marker.getLatLng().lat);
                $('#pfitempagestreetviewMap').data('pfcoordinateslng',marker.getLatLng().lng);
              $.pfstmapregenerate(marker.getLatLng());
              }
              
            }).addTo($.pointfinderuploadmapsys);

            marker.dragging.enable();

        $('#pfupload_map').data("pf-istatus","true");
      }

    }

    $.pfstmapregenerate = function(latLng){
      $.pfstpano.setPosition(latLng);
    }
    $.pfstmapgenerate = function(){
      var current_heading = parseFloat($("#webbupointfinder_item_streetview-heading").val());
      var current_pitch = parseFloat($("#webbupointfinder_item_streetview-pitch").val());
      var current_zoom = parseInt($("#webbupointfinder_item_streetview-zoom").val());

      var pfitemcoordinatesLat = parseFloat($("#pfitempagestreetviewMap").data('pfcoordinateslat'));
      var pfitemcoordinatesLng = parseFloat($("#pfitempagestreetviewMap").data('pfcoordinateslng'));
      var pfitemzoom = parseInt($("#pfitempagestreetviewMap").data('pfzoom'));

      var pfitemcoordinates_output = L.latLng(pfitemcoordinatesLat,pfitemcoordinatesLng);

      if ($('#pfupload_map').data('lng') == 'undefied') {
        var defaultlocl = L.latLng(40.71275, -74.00597);
      }else{
        var defaultlocl = L.latLng($('#pfupload_map').data( 'lat'), $('#pfupload_map').data('lng'));
      }

      var curlatLng = (typeof pfitemcoordinatesLat != 'undefined')? pfitemcoordinates_output:defaultlocl;

      if (current_heading != 0 && current_pitch != 0) {
        var pfpanoramaOptions = {
              position: curlatLng,
              pov: {
                heading: current_heading,
                pitch: current_pitch
              },
              zoom: current_zoom
            };
            $.pfstpano = new google.maps.StreetViewPanorama(
                document.getElementById('pfitempagestreetviewMap'),
                pfpanoramaOptions);
            $.pfstpano.setVisible(true);
            setTimeout(function(){
              $.pfstpano.setPosition(curlatLng);
              $.pfstpano.setPov({heading: current_heading,pitch: current_pitch});
            },1000)
      }else{
        var pfpanoramaOptions = {
              position: curlatLng
            };
            $.pfstpano = new google.maps.StreetViewPanorama(
                document.getElementById('pfitempagestreetviewMap'),
                pfpanoramaOptions);
            $.pfstpano.setVisible(true);
      }

      $.pfstpano.addListener('pov_changed', function() {
              $("#webbupointfinder_item_streetview-heading").val($.pfstpano.getPov().heading);
              $("#webbupointfinder_item_streetview-pitch").val($.pfstpano.getPov().pitch)
              $("#webbupointfinder_item_streetview-zoom").val($.pfstpano.getPov().zoom)
            });

            $.pfstpano.addListener('position_changed', function() {
              $("#webbupointfinder_item_streetview-heading").val($.pfstpano.getPov().heading);
              $("#webbupointfinder_item_streetview-pitch").val($.pfstpano.getPov().pitch)
              $("#webbupointfinder_item_streetview-zoom").val($.pfstpano.getPov().zoom)
            });
    }

  /* Map Function END */


  $(function(){
      if (theme_map_functionspf.st4_sp_medst != 1 && $('#pfitempagestreetviewMap').length > 0) {
        $('#redux-pointfinderthemefmb_options-metabox-pf_item_streetview').remove();
      }

      $('.rwmb-map-coordinate-find').on('click', function() {

            var defaultloc = $('.rwmb-map-coordinate').attr('value') ? $('.rwmb-map-coordinate').attr('value').split( ',' ) : [0, 0];

            $.pointfinderuploadmarker.setLatLng(L.latLng(defaultloc[0],defaultloc[1]))
            $.pointfinderuploadmapsys.panTo(L.latLng(defaultloc[0],defaultloc[1]));

            if ($('#pfitempagestreetviewMap').length > 0 && theme_map_functionspf.st4_sp_medst == 1) {
              $('#pfitempagestreetviewMap').data('pfcoordinateslat',defaultloc[0]);
              $('#pfitempagestreetviewMap').data('pfcoordinateslng',defaultloc[1]);
              $.pfstmapregenerate(L.latLng(defaultloc[0],defaultloc[1]));
            }
            return false;
      });
      if ($('#pfitempagestreetviewMap').length > 0 && theme_map_functionspf.st4_sp_medst == 1) {
        $.pfstmapgenerate();
      }
      if ($('#pfupload_map').length > 0) {
        $.pf_submit_page_map();
      }


      $("#pf_search_geolocateme").on("click",function(){
        $(".pf-search-locatemebut").hide("fast");
        $(".pf-search-locatemebutloading").show("fast");
        $.pfgeolocation_findme('webbupointfinder_items_address',$('#pfupload_map').data('geoctype'));
      });


      function pointfinder_after_address_found(lat,lng,address){
          $("#webbupointfinder_items_address").attr('value',address);

             
          $('.rwmb-map-coordinate').attr('value',lat+','+lng);

          $.pointfinderuploadmarker.setLatLng(L.latLng(lat, lng))
          $.pointfinderuploadmapsys.panTo(L.latLng(lat, lng));

          if ($('#pfitempagestreetviewMap').length > 0 && theme_map_functionspf.st4_sp_medst == 1) {
            $('#pfitempagestreetviewMap').data('pfcoordinateslat',lat);
            $('#pfitempagestreetviewMap').data('pfcoordinateslng',lng);
            $.pfstmapregenerate(L.latLng(lat, lng));
          }
          

          $(".typeahead__cancel-button2").css("visibility","visible");
      };

      if ($("#webbupointfinder_items_address").length > 0) {
       $('#webbupointfinder_items_address').parent().append('<div class="typeahead__container we-change-addr-input-upl"><div class="typeahead__field"><span class="typeahead__query">');
       $('#webbupointfinder_items_address').parent().prepend('</span></div></div>');
       $('#webbupointfinder_items_address').appendTo('.typeahead__container.we-change-addr-input-upl .typeahead__query');
       $('#pf_search_geolocateme').prependTo('.typeahead__container.we-change-addr-input-upl .typeahead__query');
       
       if($('#pfupload_map').data('geoctype') == "google"){
          function pfinitAutocomplete() {
            var autocomplete_input = document.getElementById("webbupointfinder_items_address");
            var autocomplete = new google.maps.places.Autocomplete(autocomplete_input,{ types: [""+$('#pfupload_map').data('setup5typs')+""]});
            if ($('#pfupload_map').data('wemapcountry')) {
              autocomplete.setComponentRestrictions({'country': [""+$('#pfupload_map').data('wemapcountry')+""]});
            }
            autocomplete.setFields(["place_id", "name", "geometry","address_component"]);
          google.maps.event.addListener(autocomplete, "place_changed", function() {
              var place = this.getPlace();
              
              if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }
           
            if(typeof place.address_components[0].types[0] != "undefined"){
              $("#pointfinder_areatype").val(place.address_components[0].types[0]);
              if(place.address_components[0].types[0] == "administrative_area_level_1"){
                $("#pointfinder_radius_search-view2").val(theme_map_functionspf.googlelvl1);
              }
              if(place.address_components[0].types[0] == "administrative_area_level_2"){
                $("#pointfinder_radius_search-view2").val(theme_map_functionspf.googlelvl2);
              }
              if(place.address_components[0].types[0] == "locality"){
                $("#pointfinder_radius_search-view2").val(theme_map_functionspf.googlelvl3);
              }
            }

            $('.rwmb-map-coordinate').attr('value',place.geometry.location.lat()+','+place.geometry.location.lng());

            $.pointfinderuploadmarker.setLatLng(L.latLng(place.geometry.location.lat(), place.geometry.location.lng()))
              $.pointfinderuploadmapsys.panTo(L.latLng(place.geometry.location.lat(), place.geometry.location.lng()));

            if ($('#pfitempagestreetviewMap').length > 0) {
                $('#pfitempagestreetviewMap').data('pfcoordinateslat',place.geometry.location.lat());
              $('#pfitempagestreetviewMap').data('pfcoordinateslng',place.geometry.location.lng());
              $.pfstmapregenerate(L.latLng(place.geometry.location.lat(), place.geometry.location.lng()));
              }
          });

          autocomplete_input.addEventListener("keydown",function(e){
              var charCode = e.charCode || e.keyCode || e.which;
              if (charCode == 27){
                   $('.rwmb-map-coordinate').val("");
                   $('#webbupointfinder_items_address').val("");
              }
          });

          $("#webbupointfinder_items_address").on("change",function(e){
              if ($("#webbupointfinder_items_address").val() == ""){
                  $('.rwmb-map-coordinate').val("");
              }
          });
          }

          pfinitAutocomplete();
        }else if($('#pfupload_map').data('geoctype') == "here"){

          var wemap_country3 = ''; var heremapslang = '';

          if (theme_map_functionspf.wemap_country3 != '') {
            wemap_country3 = '&in=countryCode:'+theme_map_functionspf.wemap_country3
          };

          if (theme_map_functionspf.heremapslang) {
            heremapslang = '&lang='+theme_map_functionspf.heremapslang;
          };

          $.typeahead({
            input: "#webbupointfinder_items_address",
            minLength: 2,
            accent: true,
            dynamic:true,
            compression: false,
            cache: false,
            hint: false,
            loadingAnimation: true,
            cancelButton: true,
            debug: true,
            searchOnFocus: false,
            delay: 100,
            group: false,
            filter: false,
            maxItem: 10,
            maxItemPerGroup: 10,
            emptyTemplate: $('.rwmb-map-canvas').data('text1'),
            template: "{{address.label}}",
            templateValue: "{{address.label}}",
            selector: {
                  cancelButton: "typeahead__cancel-button2"
              },
              source: {
                  "items": {
                    ajax: {
                      type: "GET",
                        url: "https://geocode.search.hereapi.com/v1/geocode?q={{query}}&apiKey="+theme_map_functionspf.wemap_here_appcode+"&limit=10"+heremapslang+wemap_country3,
                        dataType: "json",
                        path: "items",
                    }
                  }
              },
              callback: {
                onLayoutBuiltAfter:function(){
                $(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#webbupointfinder_items_address").outerWidth());
                $(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#webbupointfinder_items_address").outerWidth());
                $("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
                },
                onClickBefore: function(){
                $(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
                },
              onClickAfter: function(node, a, item, event){
                event.preventDefault();
                console.log(node);console.log(a);console.log(item);
                pointfinder_after_address_found(item.position.lat, item.position.lng, item.address.label);
              },
              onCancel: function(node,event){
                $("#pointfinder_google_search_coord").val("");
                  }
              }
          });
        }else if($('#pfupload_map').data('geoctype') == "mapbox"){

          $.typeahead({
            input: "#webbupointfinder_items_address",
            minLength: 2,
            accent: true,
            dynamic:true,
            compression: false,
            cache: false,
            hint: false,
            loadingAnimation: true,
            cancelButton: true,
            debug: true,
            searchOnFocus: false,
            delay: 100,
            group: false,
            filter: false,
            maxItem: 10,
            maxItemPerGroup: 10,
            emptyTemplate: $('.rwmb-map-canvas').data('text1'),
            template: "{{place_name}}",
            templateValue: "{{place_name}}",
            selector: {
                  cancelButton: "typeahead__cancel-button2"
              },
              source: {
                  "features": {
                    ajax: {
                      type: "GET",
                        url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/{{query}}.json?limit=10&language='+theme_map_functionspf.maplanguage+'&access_token='+theme_map_functionspf.we_special_key_mapbox+'&types=address,place,region,country&country='+$('#pfupload_map').data('wemapcountry'),
                        dataType: "json",
                        path: "features",
                    }
                  }
              },
              callback: {
                onLayoutBuiltAfter:function(){
                $(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#webbupointfinder_items_address").outerWidth());
                $(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#webbupointfinder_items_address").outerWidth());
                $("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
                },
                onClickBefore: function(){
                $(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
                },
              onClickAfter: function(node, a, item, event){
                event.preventDefault();
               
                pointfinder_after_address_found(item.geometry.coordinates[1], item.geometry.coordinates[0], item.place_name);
              },
              onCancel: function(node,event){
                $("#pointfinder_google_search_coord").val("");
                  }
              }
          });
        }else if($('#pfupload_map').data('geoctype') == "yandex"){

          $.typeahead({
            input: "#webbupointfinder_items_address",
            minLength: 2,
            accent: true,
            dynamic:true,
            compression: false,
            cache: false,
            hint: false,
            loadingAnimation: true,
            cancelButton: true,
            debug: true,
            searchOnFocus: false,
            delay: 100,
            group: false,
            filter: false,
            maxItem: 10,
            maxItemPerGroup: 10,
            emptyTemplate: $('.rwmb-map-canvas').data('text1'),
            template: "{{GeoObject.metaDataProperty.GeocoderMetaData.text}}",
            templateValue: "{{GeoObject.metaDataProperty.GeocoderMetaData.text}}",
            selector: {
                  cancelButton: "typeahead__cancel-button2"
              },
              source: {
                  "response.GeoObjectCollection.featureMember": {
                    ajax: {
                      type: "GET",
                        url: 'https://geocode-maps.yandex.ru/1.x/?geocode={{query}}&results=10&lang='+theme_map_functionspf.wemap_langy+'&apikey='+theme_map_functionspf.we_special_key_yandex+'&format=json',
                        dataType: "json",
                        path: "response.GeoObjectCollection.featureMember",
                    }
                  }
              },
              callback: {
                onLayoutBuiltAfter:function(){
                $(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#webbupointfinder_items_address").outerWidth());
                $(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#webbupointfinder_items_address").outerWidth());
                $("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
                },
                onClickBefore: function(){
                $(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
                },
              onClickAfter: function(node, a, item, event){
                event.preventDefault();
                var position = item.GeoObject.Point.pos;
                var position = position.split(" ");
                pointfinder_after_address_found(position[1], position[0], item.GeoObject.metaDataProperty.GeocoderMetaData.text);
              },
              onCancel: function(node,event){
                $("#pointfinder_google_search_coord").val("");
                  }
              }
          });
        }else{
         $.typeahead({
            input: "#webbupointfinder_items_address",
            minLength: 2,
            accent: true,
            dynamic:true,
            compression: false,
            cache: false,
            hint: false,
            loadingAnimation: true,
            cancelButton: true,
            debug: false,
            searchOnFocus: false,
            delay: 300,
            group: false,
            filter: false,
            maxItem: 10,
            maxItemPerGroup: 10,
            emptyTemplate: $('.rwmb-map-canvas').data('text1'),
            template: "{{address}}",
            templateValue: "{{address}}",
            selector: {
                cancelButton: "typeahead__cancel-button2"
            },
            source: {
                "found": {
                  ajax: {
                    type: "GET",
                      url: theme_map_functionspf.ajaxurl,
                      dataType: "json",
                      path: "data.found",
                      data: {
                        action: "pfget_geocoding",
                        security: theme_map_functionspf.pfget_geocoding,
                        q: "{{query}}",
                        option: "geocode",
                        ctype: $('#pfupload_map').data('geoctype')
                      }
                  }
                }
            },
            callback: {
              onLayoutBuiltAfter:function(){
              $(".we-change-addr-input-upl").find(".typeahead__list").css("width",$("#webbupointfinder_items_address").outerWidth());
              $(".we-change-addr-input-upl").find(".typeahead__result").css("width",$("#webbupointfinder_items_address").outerWidth());
              $(".we-change-addr-input-upl ul.typeahead__list").css("min-width",$(".we-change-addr-input-upl .typeahead__field").outerWidth());
              },
              onClickBefore: function(){
                
              $(".typeahead__container.we-change-addr-input-upl .typeahead__field input").css("padding-right","66px");
              },
            onClickAfter: function(node, a, item, event){
              event.preventDefault();

              pointfinder_after_address_found(item.lat, item.lng, item.address);
             
            },
            onCancel: function(node,event){
              $(".typeahead__cancel-button2").css("visibility","hidden");
              $("#webbupointfinder_items_address").attr('value',"");
                }
            }
          });
        }
      }

      if ($('#post_author_override').length > 0) {
        var container = $('.pflistingtype-selector-main-top');
        var pfurl = container.data('pfajaxurl');
        var pfnonce = container.data('pfnoncef');
        var pfplaceh = container.data('pfplaceh');

        $('#post_author_override').select2({
           placeholder: pfplaceh,
           minimumInputLength: 3,
           ajax: {
             type: 'POST',
             dataType: "json",
             url: pfurl,
             quietMillis: 250,
             data: function (term, page) {
                 return {
                     q: term,
                     action: 'pfget_authorchangesystem',
                     security: pfnonce
                 };
             },
             results: function (data) {
                 return {results: data};
             }
           },
           formatResult: formatValues,
           formatSelection: formatValues
        });

        function formatValues(data) {
            return data.nickname;
        }
      }

  });

})(jQuery);