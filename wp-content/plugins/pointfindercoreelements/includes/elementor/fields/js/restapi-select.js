( function( $ ) {

	$( window ).on( 'elementor:init', function() {
		var restapiselect2 = elementor.modules.controls.BaseData.extend( {
			getSelect2Placeholder: function() {
				return this.ui.select.children( 'option:first[value=""]' ).text();
			},

			getSelect2DefaultOptions: function(mxurl) {
				return {
					allowClear: true,
					minimumInputLength: 3,
					placeholder: this.getSelect2Placeholder(),
					dir: elementorCommon.config.isRTL ? 'rtl' : 'ltr',
					ajax: {
		              delay: 250,
		              url: mxurl,
		              dataType: 'json',
		              processResults: function (data) {
		                return {results: data};
		              }
		            }
				};
			},

			getSelect2Options: function(mxurl) {
				return jQuery.extend( this.getSelect2DefaultOptions(mxurl), this.model.get( 'select2options' ) );
			},

			onReady: function() {
				var mxurl = '';
				var pftype = '';

				if (this.ui.select[0].dataset.setting == 'locationtype') {
					pftype = 'loc';
				}else if(this.ui.select[0].dataset.setting == 'listingtype'){
					pftype = 'lis';
				}else if(this.ui.select[0].dataset.setting == 'itemtype'){
					pftype = 'it';
				}else if(this.ui.select[0].dataset.setting == 'features'){
					pftype = 'fe';
				}else if(this.ui.select[0].dataset.setting == 'conditions'){
					pftype = 'co';
				}

				if (pftype != '') {
					mxurl = pointfinderelmlocalize.resturl+'pointfindertaxlist/v1/pfgl/?fw='+pftype;

					this.ui.select.select2( this.getSelect2Options(mxurl) );
			
					if (this.ui.select.data('selected') != '') {

						var field = this.ui.select;
						var selected_data = JSON.parse("[" + this.ui.select.data('selected') + "]");

						$.ajax({
		                  type: 'GET',
		                  url: pointfinderelmlocalize.resturl+'pointfindertaxlist/v1/pfgl/?fw='+pftype+'&sl='+selected_data,
		                }).then(function (data) {
			                if ($.isEmptyObject(data)) {return;}
			                var obj = [];var option;
	        				$.each(data, function(index, element) {
        						obj[index] = element;
		                  		option = new Option(obj[index].text, obj[index].id, true, true);
		                  		field.append(option);
	        				});

			                field.trigger('change');
			                field.trigger({
			                  type: 'select2:select',
			                  params: {
			                      data: {results: data}
			                  }
			                });
			            });
					}
				}
			},
			saveValue: function() {

				this.setValue( this.ui.select.getOption() );
			},
			onBeforeDestroy: function() {
				if ( this.ui.select.data( 'select2' ) ) {
					this.ui.select.select2( 'destroy' );
				}

				this.$el.remove();
			},
		} );
		elementor.addControlView( 'mxselect2', restapiselect2 );
	} );


} )( jQuery );