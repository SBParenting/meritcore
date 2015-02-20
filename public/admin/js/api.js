

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

					if (XMLHttpRequest.responseJSON)
					{
						callback(XMLHttpRequest.responseJSON, param);
					}
					else
					{
						callback({result: false, msg: 'There was an error processing your request: '+errorThrown}, param);
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
						if (XMLHttpRequest.responseJSON)
						{
							callback(XMLHttpRequest.responseJSON, param);
						}
						else
						{
							callback({result: false, msg: 'There was an error processing your request: '+errorThrown}, param);
						}
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

		template: function(template, data, special)
		{
			if (typeof template != 'undefined')
			{
				var html = template.html();

				$.each(data, function(k, v) {
					if (typeof special[k] == 'undefined')
					{
						if (v == null) { v = ""; }
						html = $.api.strReplace(html, "(data:"+k+")", v);
						html = $.api.strReplace(html, "%28data:"+k+"%29", v);
						html = $.api.strReplace(html, "%28data%3A"+k+"%29", v);
					}
					else
					{
						html = $.api.strReplace(html, "(data:"+k+"="+v+")", special[k]);
						html = $.api.strReplace(html, "%28data:"+k+"="+v+"%29", v);
						html = $.api.strReplace(html, "%28data%3A"+k+"="+v+"%29", v);
					}
				});

				return html;
			}
		},

		strReplace: function(html, str, v)
		{
			do {
				html = html.replace(str, v);

			} while (html.indexOf(str) != -1)

			return html;
		},

	};

});