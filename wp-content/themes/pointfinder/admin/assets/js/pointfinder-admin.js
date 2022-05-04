(function( $ ) {
	'use strict';

	$(function(){

		$('.pointfinder-regreport').on('click', function(event) {

			var drrpcode = $('#drrpcode').val();
			var drremail = $('#drremail').val();
			var drrpweb = $('#drrpweb').val();

			$('.process-pf').hide();
			$('.process-pf').html('');

			if (drrpcode == '') {
				$('.process-pf').show();
				$('.process-pf').html('Please add purchase code');
				return false;
			}

			if (drremail == '') {
				$('.process-pf').show();
				$('.process-pf').html('Please add email');
				return false;
			}

			if (drrpweb == '') {
				$('.process-pf').show();
				$('.process-pf').html('Please add web address');
				return false;
			}

			$.ajax({
				beforeSend:function(){
					$('.process-pf').show();
					$('.process-pf').html(pointfinderadminmain.rsending);
					$('#pointfinder_regreport').attr('disabled','disabled');
				},
	            type: 'POST',
	            dataType: 'json',
	            url: pointfinderadminmain.ajaxurl,
	            data: { 
	            	'action': 'pfget_registration',
	                'drrpcode': drrpcode,
	                'drremail': drremail,
	                'drrpweb': drrpweb,
	                'security': pointfinderadminmain.pfget_registration
	            },
	            success:function(data){
	            	if (data.success) {
	            		$('.process-pf').html('Your report received. We will contact with you as soon as possible.');
	            	} else if(!data.success){
	            		$('.process-pf').html(data.data);
	            	}
	            },
	            error: function (request, status, error) {
	            	console.log(request);
	            	console.log(status);
	            	console.log(error);
	            },
	        	complete: function(){
	        		$('#pointfinder_regreport').removeAttr('disabled');
	        	}
	        });
	        return false;
		});

		$('.pointfinder-deregister').on('click', function(event) {

			var drrpcode = $('#drrpcode').val();
			var drremail = $('#drremail').val();
			var drrtextarea = $('#drrtextarea').val();

			$.ajax({
				beforeSend:function(){
					$('.process-pf').show();
					$('.process-pf').html(pointfinderadminmain.rsending);
					$('#pointfinder_deregister').attr('disabled','disabled');
				},
	            type: 'POST',
	            dataType: 'json',
	            url: pointfinderadminmain.ajaxurl,
	            data: { 
	                'action': 'pfget_registration',
	                'dereg': drrpcode,
	                'drremail': drremail,
	                'drrtextarea': drrtextarea,
	                'security': pointfinderadminmain.pfget_registration
	            },
	            success:function(data){
	            	if (data.success) {
	            		$('.process-pf').html(pointfinderadminmain.rsendingcmp);
	            		setTimeout(function(){
	            			location.reload();
	            		},5000);
	            	} else {
	            		$('.process-pf').html(pointfinderadminmain.rsendingfail+data.data);
	            	}
	            },
	            error: function (request, status, error) {
	            	console.log(request);
	            	console.log(status);
	            	console.log(error);
	            },
	        	complete: function(){
	        		$('#pointfinder_deregister').removeAttr('disabled');
	        	}
	        });
	        return false;
		});

		$( '.pointfinder-register' ).on( 'click', function () {

			var productcode = $('#productcode').val();

			if (productcode == '') {
				return false;
			}else{
				$.ajax({
					beforeSend:function(){
						$('.auth-check-section').show();
						$('.auth-status').removeClass('checkedsuccess').removeClass('checkedfail').addClass('notchecked');
						$('.auth-tstatus').html(pointfinderadminmain.buttonwaitreg);
						$('#pointfinder_register').attr('disabled','disabled');
					},
		            type: 'POST',
		            dataType: 'json',
		            url: pointfinderadminmain.ajaxurl,
		            data: { 
		                'action': 'pfget_registration',
		                'productcode': productcode,
		                'security': pointfinderadminmain.pfget_registration
		            },
		            success:function(data){
		            	if (data.success) {
		            		$('.auth-check-section').show();
		            		$('.auth-status').removeClass('notchecked').addClass('checkedsuccess');
		            		$('.auth-tstatus').html(pointfinderadminmain.regsccmes);
		            		setTimeout(function(){
		            			location.reload();
		            		},5000);
		            	} else {
		            		$('.auth-check-section').show();
		            		$('.auth-status').removeClass('notchecked').addClass('checkedfail');
		            		$('.auth-tstatus').html(data.data.not_verified);
		            	}


		            },
		            error: function (request, status, error) {
		            	console.log(request);
		            	console.log(status);
		            	console.log(error);
		            },
		        	complete: function(){
		        		$('#pointfinder_register').removeAttr('disabled');
		        	}
		        });
		        return false;
			}
			
			
		});

		$('.pointfinder-api-check').on('click', function(event) {
			event.preventDefault();
			$.ajax({
				beforeSend:function(){
					$('.auth-check-section').show();
					$('.auth-status').removeClass('checkedsuccess').removeClass('checkedfail').addClass('notchecked');
					$('.auth-tstatus').html(pointfinderadminmain.buttonwaitreg);
					$('#pointfinder_api_check').attr('disabled','disabled');
				},
	            type: 'POST',
	            dataType: 'json',
	            url: pointfinderadminmain.ajaxurl,
	            data: { 
	                'action': 'pfget_registration',
	                'apistatus': 1,
	                'security': pointfinderadminmain.pfget_registration
	            },
	            success:function(data){
	            	if (data.success) {
	            		$('.auth-check-section').show();
	            		$('.auth-status').removeClass('notchecked').addClass('checkedsuccess');
	            		$('.auth-tstatus').html(pointfinderadminmain.authtstatussu);
	            		//setTimeout(function(){$('.auth-check-section').hide();},5000);
	            	}else{
	            		$('.auth-check-section').show();
	            		$('.auth-status').removeClass('notchecked').addClass('checkedfail');
	            		$('.auth-tstatus').html(pointfinderadminmain.authtstatusfa);
	            	}

	            },
	            error: function (request, status, error) {
	            	$('.auth-status').removeClass('notchecked').addClass('checkedfail');
	            	$('.auth-tstatus').text(pointfinderadminmain.authtstatusfa);
	        	},
	        	complete: function(){
	        		$('#pointfinder_api_check').removeAttr('disabled');
	        	}
	        });
		});


		$('body').on('click','#pointfindernndismiss1 button',function(){

			$.ajax({
					url: pointfinderadminmain.ajaxurl,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'pfget_nagsystem',
						nstatus: 0,
						nname: 'pointfinder_v2x_warningx',
						security: pointfinderadminmain.nagsysnonce
					}
			});

			$('body').find('#pointfindernndismiss1').hide();
		});

		$('body').on('click','#pointfinderregdismiss button',function(){
			
			$.ajax({
					url: pointfinderadminmain.ajaxurl,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'pfget_nagsystem',
						nstatus: 0,
						nname: 'pointfinder_reg_warningx',
						security: pointfinderadminmain.nagsysnonce
					},
			});
		});


			
	});



})( jQuery );
