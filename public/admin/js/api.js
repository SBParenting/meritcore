

jQuery(function( $ ) {

	$.api = {

		post: function(url, data, callback, param) {

			$.api.showLoader();

			$.ajax({
				type    : "POST",
				url     : url,
				data    : data,
				success : function(response)
				{ 
					$.api.hideLoader();

					if (typeof callback == 'function') {
						callback(response, param);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					
					$.api.hideLoader();

					if (typeof callback == 'function') {
						callback({result: false, msg: 'Connection error!'}, param);
					}
				},
				done: function(){

					$.api.hideLoader();

				}
			});
		},

		postForm: function(form, callback, param)
		{
			form.ajaxSubmit({
				success : function(response)
				{ 
					$.api.hideLoader();

					if (typeof callback == 'function') {
						callback(response, param);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					
					$.api.hideLoader();

					if (typeof callback == 'function') {
						callback({result: false, msg: 'Connection error!'}, param);
					}
				},
				done: function(){

					$.api.hideLoader();

				}
			});
		},

		showLoader: function() {

			$('#loader').fadeIn('fast');
		},

		hideLoader: function() {

			$('#loader').fadeOut('fast');
		},

	};

});