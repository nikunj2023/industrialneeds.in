( function ( $ ) {
	let triggerBttn = $( '.overlay-show' ),
		overlay = $( 'div.ult-overlay' ),
		closeBttn = overlay.find( 'div.ult-overlay-close' );
	( transEndEventNames = {
		WebkitTransition: 'webkitTransitionEnd',
		MozTransition: 'transitionend',
		OTransition: 'oTransitionEnd',
		msTransition: 'MSTransitionEnd',
		transition: 'transitionend',
	} ),
		( transEndEventName =
			transEndEventNames[ bsfmodernizr.prefixed( 'transition' ) ] ),
		( support = { transitions: bsfmodernizr.csstransitions } );
	function toggleOverlay( id ) {
		const ovv = 'div.ult-overlay.' + id;
		joverlay = document.querySelector( ovv );
		overlay = $( ovv );
		/* firefox transition issue fix of overflow hidden */

		if ( overlay.hasClass( 'ult-open' ) ) {
			overlay.removeClass( 'ult-open' );
			overlay.addClass( 'ult-close' );
			//classie.remove( overlay, 'ult-open' );
			//classie.add( overlay, 'ult-close' );
			var onEndTransitionFn = function ( ev ) {
				if ( support.transitions ) {
					if ( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener(
						transEndEventName,
						onEndTransitionFn
					);
				}
				overlay.removeClass( 'ult-close' );
				//classie.remove( overlay, 'ult-close' );
			};
			if ( support.transitions ) {
				joverlay.addEventListener(
					transEndEventName,
					onEndTransitionFn
				);
				overlay.removeClass( 'ult-close' );
				if ( window_height < modal_height )
					//remove overflow hidden
					$( 'html' ).css( { overflow: 'auto' } );
			} else {
				onEndTransitionFn();
			}
		} else if ( ! overlay.hasClass( 'ult-close' ) ) {
			overlay.addClass( 'ult-open' );
			//classie.add( overlay, 'ult-open' );
		}
		var modal_height = overlay.find( '.ult_modal' ).outerHeight(); //modal height
		var window_height = $( window ).outerHeight(); //window height
		if ( window_height < modal_height )
			//if window height is less than modal height
			$( 'html' ).css( { overflow: 'hidden' } ); //add overflow hidden to html
	}
	const corner_to = $( '.overlay-show-cornershape' )
		.find( 'path' )
		.attr( 'd' );
	function overlay_cornershape_f( id ) {
		const ovv = 'div.overlay-cornershape.' + id;
		const joverlay_cornershape = document.querySelector( ovv );
		const overlay_cornershape = $( ovv );
		const s = Snap( joverlay_cornershape.querySelector( 'svg' ) ),
			path = s.select( 'path' ),
			pathConfig = {
				from: 'm 0,0 1439.999975,0 0,805.99999 0,-805.99999 z ',
				to: ' m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z  ',
			};
		//var overlay_cornershape = document.querySelector( 'div.overlay-cornershape' );
		if ( overlay_cornershape.hasClass( 'ult-open' ) ) {
			overlay_cornershape.removeClass( 'ult-open' );
			overlay_cornershape.addClass( 'ult-close' );
			//classie.remove( overlay_cornershape, 'ult-open' );
			//classie.add( overlay_cornershape, 'ult-close' );
			const onEndTransitionFn = function ( ev ) {
				overlay_cornershape.removeClass( 'ult-close' );
				//classie.remove( overlay_cornershape, 'ult-close' );
			};
			path.animate(
				{ path: pathConfig.from },
				400,
				mina.linear,
				onEndTransitionFn
			);
		} else if ( ! overlay_cornershape.hasClass( 'ult-close' ) ) {
			overlay_cornershape.addClass( 'ult-open' );
			//classie.add( overlay_cornershape, 'ult-open' );
			path.animate( { path: pathConfig.to }, 400, mina.linear );
		}
	}
	function overlay_genie_f( id ) {
		const ovv = 'div.overlay-genie.' + id;
		const joverlay_genie = document.querySelector( ovv );
		const overlay_genie = $( ovv );
		const gs = Snap( joverlay_genie.querySelector( 'svg' ) ),
			geniepath = gs.select( 'path' ),
			steps = joverlay_genie.getAttribute( 'data-steps' ).split( ';' ),
			stepsTotal = steps.length;
		if ( overlay_genie.hasClass( 'ult-open' ) ) {
			var pos = stepsTotal - 1;
			overlay_genie.removeClass( 'ult-open' );
			overlay_genie.addClass( 'ult-close' );
			//classie.remove( joverlay_genie, 'ult-open' );
			//classie.add( joverlay_genie, 'ult-close' );
			var onEndTransitionFn = function ( ev ) {
					overlay_genie.removeClass( 'ult-close' );
				},
				nextStep = function ( pos ) {
					pos--;
					if ( pos < 0 ) return;
					geniepath.animate(
						{ path: steps[ pos ] },
						60,
						mina.linear,
						function () {
							if ( pos === 0 ) {
								onEndTransitionFn();
							}
							nextStep( pos );
						}
					);
				};
			nextStep( pos );
		} else if ( ! overlay_genie.hasClass( 'ult-close' ) ) {
			var pos = 0;
			overlay_genie.addClass( 'ult-open' );
			//classie.add( joverlay_genie, 'ult-open' );
			var nextStep = function ( pos ) {
				pos++;
				if ( pos > stepsTotal - 1 ) return;
				geniepath.animate(
					{ path: steps[ pos ] },
					60,
					mina.linear,
					function () {
						nextStep( pos );
					}
				);
			};
			nextStep( pos );
		}
	}
	function shuffle_overlay_box( array ) {
		let currentIndex = array.length,
			temporaryValue,
			randomIndex;
		// While there remain elements to shuffle...
		while ( 0 !== currentIndex ) {
			// Pick a remaining element...
			randomIndex = Math.floor( Math.random() * currentIndex );
			currentIndex -= 1;
			// And swap it with the current element.
			temporaryValue = array[ currentIndex ];
			array[ currentIndex ] = array[ randomIndex ];
			array[ randomIndex ] = temporaryValue;
		}
		return array;
	}
	function overlay_boxes_f( id ) {
		const ovv = 'div.overlay-boxes.' + id;
		const joverlay_boxes = document.querySelector( ovv );
		const overlay_boxes = $( ovv );
		const boxes_path = [].slice.call(
				joverlay_boxes.querySelectorAll( 'svg > path' )
			),
			pathsTotal = boxes_path.length;
		let cnt = 0;
		shuffle_overlay_box( boxes_path );
		if ( overlay_boxes.hasClass( 'ult-open' ) ) {
			overlay_boxes.removeClass( 'ult-open' );
			overlay_boxes.addClass( 'ult-close' );
			//classie.remove( joverlay_boxes, 'ult-open' );
			//classie.add( joverlay_boxes, 'ult-close' );
			boxes_path.forEach( function ( p, i ) {
				setTimeout( function () {
					++cnt;
					p.style.display = 'none';
					if ( cnt === pathsTotal ) {
						overlay_boxes.removeClass( 'ult-close' );
						//classie.remove( joverlay_boxes, 'ult-close' );
					}
				}, i * 30 );
			} );
		} else if ( ! overlay_boxes.hasClass( 'ult-close' ) ) {
			overlay_boxes.addClass( 'ult-open' );
			//classie.add( joverlay_boxes, 'ult-open' );
			boxes_path.forEach( function ( p, i ) {
				setTimeout( function () {
					p.style.display = 'block';
				}, i * 30 );
			} );
		}
	}
	$( window ).on( 'load', function () {
		const onload_modal_array = new Array();
		$( '.ult-onload' ).each( function ( index ) {
			onload_modal_array.push( $( this ) );
			setTimeout( function () {
				onload_modal_array[ index ].trigger( 'click' );
			}, parseInt( $( this ).data( 'onload-delay' ) ) * 1000 );
		} );
		$( '.ult-vimeo iframe' ).each( function ( index, element ) {
			const player_id = $( this ).attr( 'id' );
			const iframe = $( this )[ 0 ],
				player = $f( iframe );
			player.addEvent( 'ready', function () {
				player.addEvent( 'pause' );
				player.addEvent( 'finish' );
			} );
		} );
	} );
	$( document ).ready( function () {
		$( '.ult-overlay' ).each( function () {
			$( this ).appendTo( document.body );
		} );
		$( '.ult-overlay' ).show();
		$( '.overlay-show' ).each( function ( index, element ) {
			const class_id = $( this ).data( 'class-id' );
			$( '.' + class_id )
				.find( '.ult-vimeo iframe' )
				.attr( 'id', 'video_' + class_id );
			$( '.' + class_id )
				.find( '.ult-youtube iframe' )
				.attr( 'id', 'video_' + class_id );
		} );
		const modal_count = 0;
		$( document ).on( 'click', '.overlay-show', function ( event ) {
			event.stopPropagation();
			event.preventDefault();

			const class_id = $( this ).data( 'class-id' );
			if (
				$( this ).parent().hasClass( 'modal-hide-mobile' ) != true &&
				$( this ).parent().hasClass( 'modal-hide-tablet' ) != true
			) {
				$( '.' + class_id )
					.find( '.ult_modal-content' )
					.removeClass( 'ult-hide' );
				$( '.' + class_id )
					.find( '.ult-vimeo iframe' )
					.html( $( '.ult-vimeo iframe' ).html() );
				$( '.' + class_id ).addClass(
					$( this ).data( 'overlay-class' )
				);
				setTimeout( function () {
					$( 'body, html' ).addClass( 'ult_modal-body-open' );
					toggleOverlay( class_id );
					content_check( class_id );
				}, 500 );

				if (
					$( this ).parent().attr( 'data-keypress-control' ) ==
						'keypress-control-enable' ||
					$( this ).attr( 'data-keypress-control' ) ==
						'keypress-control-enable'
				) {
					window.onkeydown = function ( e ) {
						if ( e.keyCode == 27 ) {
							$( document )
								.find( '.ult-overlay.ult-open.' + class_id )
								.removeClass( 'ult-open' );
						}
					};
				}
			}
		} );

		$( document ).on(
			'click',
			'.overlay-show-cornershape',
			function ( event ) {
				event.stopPropagation();
				event.preventDefault();

				const class_id = $( this ).data( 'class-id' );
				$( '.' + class_id )
					.find( '.ult_modal-content' )
					.removeClass( 'ult-hide' );
				//$('.overlay-cornershape').removeClass('overlay-cornershape');
				setTimeout( function () {
					$( '.' + class_id ).addClass( 'overlay-cornershape' );
					overlay_cornershape_f( class_id );
					$( 'body, html' ).addClass( 'ult_modal-body-open' );
					content_check( class_id );
				}, 300 );
			}
		);

		$( document ).on(
			'click',
			'div.overlay-cornershape div.ult-overlay-close',
			function ( event ) {
				event.stopPropagation();
				const class_id = $( this )
					.parents( 'div.overlay-cornershape' )
					.data( 'class' );
				overlay_cornershape_f( class_id );
				$( 'body, html' ).removeClass( 'ult_modal-body-open' );
				$( 'html' ).css( { overflow: 'auto' } );
				$( document ).trigger( 'onUVCModalPopUpClosed', class_id );
			}
		);

		$( document ).on( 'click', '.overlay-show-boxes', function ( event ) {
			event.stopPropagation();
			event.preventDefault();

			const class_id = $( this ).data( 'class-id' );
			$( '.' + class_id )
				.find( '.ult_modal-content' )
				.removeClass( 'ult-hide' );
			setTimeout( function () {
				$( '.' + class_id ).addClass( 'overlay-boxes' );
				overlay_boxes_f( class_id );
				$( 'body, html' ).addClass( 'ult_modal-body-open' );
				content_check( class_id );
			}, 300 );
			//$('.overlay-boxes').removeClass('overlay-boxes');
		} );

		$( document ).on(
			'click',
			'div.overlay-boxes div.ult-overlay-close',
			function ( event ) {
				event.stopPropagation();
				const class_id = $( this )
					.parents( 'div.overlay-boxes' )
					.data( 'class' );
				overlay_boxes_f( class_id );
				$( 'body, html' ).removeClass( 'ult_modal-body-open' );
				$( 'html' ).css( { overflow: 'auto' } );
				$( document ).trigger( 'onUVCModalPopUpClosed', class_id );
			}
		);

		$( document ).on( 'click', '.overlay-show-genie', function ( event ) {
			event.preventDefault();

			const class_id = $( this ).data( 'class-id' );
			$( '.' + class_id )
				.find( '.ult_modal-content' )
				.removeClass( 'ult-hide' );
			//$('.overlay-genie').removeClass('overlay-genie');
			setTimeout( function () {
				$( '.' + class_id ).addClass( 'overlay-genie' );
				overlay_genie_f( class_id );
				$( 'body, html' ).addClass( 'ult_modal-body-open' );
				content_check( class_id );
				$( 'html' ).css( { overflow: 'auto' } );
			}, 300 );
		} );

		$( document ).on(
			'click',
			'div.overlay-genie div.ult-overlay-close',
			function ( event ) {
				event.stopPropagation();
				const class_id = $( this )
					.parents( 'div.overlay-genie' )
					.data( 'class' );
				overlay_genie_f( class_id );
				$( 'body, html' ).removeClass( 'ult_modal-body-open' );
				$( 'html' ).css( { overflow: 'auto' } );
				$( document ).trigger( 'onUVCModalPopUpClosed', class_id );
			}
		);

		$( document ).on(
			'click',
			'.ult-overlay .ult-overlay-close',
			function ( event ) {
				event.stopPropagation();
				$this = $( this );
				const id = $this.parents( '.ult-overlay' ).data( 'class' );
				toggleOverlay( id );

				$( 'body, html' ).removeClass( 'ult_modal-body-open' );

				if ( $this.parent().find( '.ult-vimeo' ).length ) {
					$this
						.parent()
						.find( '.ult-vimeo iframe' )
						.each( function ( i, iframe ) {
							const player_id = $( iframe );
							const src = $( iframe ).attr( 'src' );
							$( iframe ).attr( 'src', '' );
							$( iframe ).attr( 'src', src );
							var iframe = player_id[ 0 ],
								player = $f( iframe );
							player.api( 'pause' );
						} );
				}

				if ( $this.parent().find( '.ult-youtube' ).length ) {
					$this
						.parent()
						.find( '.ult-youtube iframe' )
						.each( function ( i, iframe ) {
							const src = $( iframe ).attr( 'src' );
							$( iframe ).attr( 'src', '' );
							$( iframe ).attr( 'src', src );
						} );
				}

				if ( $this.parent().find( '.ult-video-shortcode' ).length ) {
					$this
						.parent()
						.find( '.ult-video-shortcode video' )
						.each( function ( i, video ) {
							video.pause();
						} );
				}

				$( 'html' ).css( { overflow: 'auto' } );
				$( document ).trigger( 'onUVCModalPopUpClosed' );
			}
		);

		$( document ).on(
			'click',
			'.ult-overlay .ult_modal',
			function ( event ) {
				event.stopPropagation();
			}
		);

		$( document ).on( 'click', '.ult-overlay', function ( event ) {
			event.stopPropagation();
			event.preventDefault();
			$this = $( this );
			const id = $this.data( 'class' );
			const a = $( document )
				.find( '.ult-modal-input-wrapper' )
				.children();
			a.each( function () {
				const class_id = $( this ).data( 'class-id' ); // "this" is the current element in the loop
				if (
					class_id == id &&
					$( this )
						.parent( '.ult-modal-input-wrapper' )
						.data( 'overlay-control' ) == 'overlay-control-enable'
				) {
					$this.find( '.ult-overlay-close' ).trigger( 'click' );
					$( 'html' ).css( { overflow: 'auto' } );
				}
			} );
		} );
	} );
	function content_check( id ) {
		const ch = $( '.' + id )
			.find( '.ult_modal-content' )
			.height();
		const wh = $( window ).height();
		if ( ch > wh ) {
			$( '.' + id ).addClass( 'ult_modal-auto-top' );
		} else {
			$( '.' + id ).removeClass( 'ult_modal-auto-top' );
		}
		if ( $( '.' + id ).find( 'iframe' ).length > 0 ) {
			$( '.' + id )
				.find( 'iframe' )
				.each( function ( i, iframe ) {
					$( iframe ).attr( 'src', $( iframe ).attr( 'src' ) );
				} );
		}
		$( document ).trigger( 'onUVCModalPopupOpen', id );
	}

	function resize_modal_iframe() {
		$( '.ult_modal-body iframe' ).each( function ( index, element ) {
			let w = $( this ).parent().width();
			const small_modal = $( this )
				.parent()
				.parent()
				.parent()
				.hasClass( 'ult-small' )
				? true
				: false;
			const medium_modal = $( this )
				.parent()
				.parent()
				.parent()
				.hasClass( 'ult-medium' )
				? true
				: false;
			const large_modal = $( this )
				.parent()
				.parent()
				.parent()
				.hasClass( 'ult-container' )
				? true
				: false;
			const block_modal = $( this )
				.parent()
				.parent()
				.parent()
				.hasClass( 'ult-block' )
				? true
				: false;

			const c = w / 10;
			let h = w * ( 9 / 16 ) + c;

			const is_video =
				$( this ).parent().hasClass( 'ult-youtube' ) ||
				$( this ).parent().hasClass( 'ult-vimeo' )
					? true
					: false;
			if ( ! is_video ) return false;

			if ( large_modal ) {
				const window_height = $( window ).height();
				if ( window_height < h ) h = window_height - 100;
			}

			if ( block_modal ) {
				w = $( this ).attr( 'width' );
				h = $( this ).attr( 'height' );
				if ( typeof w === 'undefined' || w == '' ) w = 640;
				if ( typeof h === 'undefined' || h == '' ) h = 360;
			}

			$( this ).css( { width: w + 'px', height: h + 'px' } );
		} );
	}
	$( document ).on( 'onUVCModalPopupOpen', function () {
		resize_modal_iframe();
		$( window ).trigger( 'resize' );
	} );
} )( jQuery );
