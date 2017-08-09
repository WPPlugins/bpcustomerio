(function( $ ) {
	$(window).load(function() {	
	$( "#abc_dialog" ).dialog({ 
		modal: true, title: 'Subscribe Now', zIndex: 10000, autoOpen: true,
		width: '500', resizable: false,
		position: {my: "center", at:"center", of: window },
		dialogClass: 'dialogButtons',
		buttons: {
			Yes: function () {
				// $(obj).removeAttr('onclick');
				// $(obj).parents('.Parent').remove();
				var email_id = $('#txt_user_sub_abc').val();

				var data = {
				'action': 'add_plugin_user_abc',
				'email_id': email_id
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					$('#abc_dialog').html('<h2>You have been successfully subscribed');
					$(".ui-dialog-buttonpane").remove();
				});

				
			},
			No: function () {
				var email_id = $('#txt_user_sub_abc').val();

				var data = {
				'action': 'hide_subscribe_abc',
				'email_id': email_id
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				$.post(ajaxurl, data, function(response) {
					        					 
				});
				
				$(this).dialog("close");
				
			}
		},
		close: function (event, ui) {
			$(this).remove();
		}
	});

	$("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");
    $("div.dialogButtons .ui-dialog-buttonpane .ui-button").css("width","80px");
	});
})( jQuery );
