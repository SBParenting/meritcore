jQuery(function() {


	$.app = {

		timer: 0,

		init: function() {

			$('.do-tooltip').tooltip({
				container:'body'
			});

			$.app.initControls();

			$.app.initNav();

			$.app.initSorting();

			if ($('#notifications .notification').length > 0)
			{
				(function (el) {

					$.app.timer = setTimeout(function () {
						el.stop().slideUp('fast');
					}, 3000);
				}($('#notifications')));
			}
		},

		initControls: function(){

			$('form').not('.submit-on-enter').off('keydown').on('keydown', function(e) {
				if (e.which == 13)
				{
					e.preventDefault();
					return false;
				}
			});

			$('.js-post').off('click').on('click', function(e) {
				e.preventDefault();

				$.api.post( $(this).attr('href'), {}, $.app.showPostResponse, $(this) );
			});

			$('.js-post-remove').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				bootbox.confirm("<h1>Are you sure?</h1><p>If you are not sure what you are doing, please stop.", function(result) {

					if(result) {

						$.api.post( elem.attr('href'), {}, $.app.showPostRemoveResponse, elem );
					}

				});

			});

			$('.js-remove').off('click').on('click', function(e) {
				e.preventDefault();

				$($(this).data('target')).remove();
			});

			$('.js-post-confirm').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				bootbox.confirm("<h1>Are you sure?</h1>", function(result) {

					if(result) {
						
						$.api.post( elem.attr('href'), {}, $.app.showPostRemoveResponse, elem );
					} 

				});

			});

			$('.js-post-lock').off('click').on('click', function(e) {
				e.preventDefault();

				$.api.post( $(this).attr('href'), {}, function() {
					$('body').addClass('app-locked');
				}, $(this) );

			});

			$('.unlock-form').off('keydown').on('keydown', function(e) {
				if (e.which == 13)
				{
					e.preventDefault();
					$(this).find('.btn-submit').click();
					return false;
				}
			});

			$('.js-post-unlock').off('click').on('click', function(e) {
				e.preventDefault();

				var input = $(this).parent().find("input[name='password']");

				var data = {password:input.val()};

				$.api.post( $(this).attr('href'), data, function(response) {

					if (response.result)
					{
						$('.page-lock').removeClass('has-error');
						$('body').removeClass('app-locked');
						$('.page-lock').find("input[name='password']").val("");
					}
					else 
					{
						$.app.showNotification("danger", response.msg);
						
						$('.page-lock').addClass('has-error');
					}
				}, $(this) );

			});

			$('.js-post-bulk').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				bootbox.confirm("<h1>Are you sure?</h1><p>If you are not sure what you are doing, please stop.", function(result) {

					if(result) {

						var items = $('.checked .js-select');

						var ids = [];

						items.each(function() {
							ids.push( $(this).data('record-id') );
						});

						$.api.post( elem.attr('href'), {ids:ids}, $.app.showPostResponse, $(this) );

					}

				});
			});

			$('.post-bulk').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				bootbox.confirm("<h1>Are you sure?</h1><p>If you are not sure what you are doing, please stop.", function(result) {

					if(result) {

						var items = $('.checked .js-select');

						var ids = [];

						items.each(function() {
							ids.push( $(this).data('record-id') );
						});

						var form = $(elem.data('target'));

						console.log(elem.data('target'));

						form.find("input[name='ids']").val(ids);

						form.submit();

					}

				});
			});

			$('.js-post-checkbox').off('ifChanged').on('ifChanged', function(event) {

				var data = {};
				var elem = $(this);

				data[elem.data('record-id')] = event.target.checked;

				$.api.post( elem.data('url'), data, $.app.showPostCheckboxResponse, elem );
			});

			if (typeof Dropzone != 'undefined')
			{

				Dropzone.options.myImagesDropzone = {

					autoProcessQueue: false,
					uploadMultiple: true,
					parallelUploads: 100,
					maxFiles: 100,
					acceptedFiles: "image/*",

					init: function() {

						var myDropzone = this;

						$("#my-images-dropzone").parent().find('.js-post-uploads').on('click', function(e){
							e.preventDefault();
							e.stopPropagation();
							myDropzone.processQueue();
						});
					}

				}

				Dropzone.options.myFilesDropzone = {

					autoProcessQueue: false,
					uploadMultiple: true,
					parallelUploads: 100,
					maxFiles: 100,
					acceptedFiles: ".pdf,.doc,.docx,.odt",

					init: function() {

						var myDropzone = this;

						$("#my-files-dropzone").parent().find('.js-post-uploads').on('click', function(e){
							e.preventDefault();
							e.stopPropagation();
							myDropzone.processQueue();
						});
					},
				}
			}

			if ($('.fancybox').length > 0)
			{
				$('.fancybox').fancybox({
					openEffect	: 'none',
					closeEffect	: 'none'
				});
			}

			$('.js-post-add-template').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				var urlPost = elem.data('url-post');

				if (typeof urlPost != 'undefined')
				{
					var data = $(elem.data('source')).data();

					$.api.post(urlPost, data, $.app.showPostAddTemplateResponse, elem);
				}
			});

			$('.js-add-template').off('click').on('click', function(e) {
				e.preventDefault();

				$.app.processAddTemplate($(this));
			});

		},

		initNav: function () {
			$('#nav a.has-children').on('click', function(e) {
				e.preventDefault();
				if (!$(this).parent().hasClass('open'))
				{
					$('#nav').find('li.open').removeClass('open');
					$('#nav').find('ul.open').slideUp('fast', function() { $(this).removeClass('open'); });
					$(this).parent().find('ul').slideToggle('fast', function() { $(this).addClass('open'); });
					$(this).parent().addClass('open');
				}
				else
				{
					$('#nav').find('ul.open').slideUp('fast', function() { $(this).removeClass('open'); });
				}
			});
			$('.toggle-min').on('click', function(e) {
				e.preventDefault();
				$('body').toggleClass('nav-min');
				$("#nav").find("ul.open").hide();

			});
			$('.menu-button').on('click', function (e) {
				e.preventDefault();
				$('body').toggleClass('on-canvas');
			});
		},

		initSorting: function() {

			if (typeof state != 'undefined' && typeof state.sort != 'undefined' && state.sort != '' && typeof state.order != 'undefined' && state.order != '')
			{

				$('.sortable i').remove();

				$('.sortable.sorting').removeClass('sorting');

				var current = $(".sortable[data-field='" + state.sort + "']");

				current.addClass('sorting');

				if (state.order == 'asc')
				{
					current.append("<i class='fa fa-sort-up'></i>");
				}
				else {
					current.append("<i class='fa fa-sort-down'></i>");
				}

				current.off('click').on('click', function(e){

					e.preventDefault();

					state.order = state.order == 'asc' ? 'desc' : 'asc';

					$.app.loadUrlQuery();

				});

				var other = $(".sortable").not('.sorting');

				other.append("<i class='fa fa-sort'></i>");

				other.off('click').on('click', function(e){

					e.preventDefault();

					state.sort = $(this).data('field');

					state.order = 'asc';

					$.app.loadUrlQuery();
				});
			}
		},

		showPostResponse: function(response, elem)
		{
			try
			{
				if (response.result) {

					if (typeof response.url != 'undefined')
					{
						$.app.loadUrl(response.url);
					}
					else
					{
						$.app.showNotification("success", response.msg);
					}

					if (typeof elem.data('hide') != 'undefined')
					{
						$(elem.data('hide')).hide();
					}

					if (typeof elem.data('show') != 'undefined')
					{
						$(elem.data('show')).show();
					}

					$('.show-post-success').show();

					$('.hide-post-success').hide();

				}
				else
				{
					$.app.showNotification("danger", response.msg);
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}
		},

		showPostAddTemplateResponse: function(response, elem)
		{
			try
			{
				if (response.result) {

					if (typeof response.url != 'undefined')
					{
						$.app.loadUrl(response.url);
					}
					else
					{
						$.app.showNotification("success", response.msg);

						elem.attr('data-recordid', response.id);

						$(elem.data('source')).data('recordid', response.id);

						$.app.processAddTemplate(elem);
					}
				}
				else
				{
					$.app.showNotification("danger", response.msg);
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}
		},

		showPostRemoveResponse: function(response, elem)
		{
			try
			{
				if (response.result) {

					if (typeof response.url != 'undefined')
					{
						$.app.loadUrl(response.url);
					}
					else
					{
						$.app.showNotification("success", response.msg);
					}

					elem.tooltip('destroy');

					var target = $(elem.data('remove'));

					target.slideUp('fast', function() {
						target.remove();
					});
				}
				else
				{
					$.app.showNotification("danger", response.msg);
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}
		},

		showPostCheckboxResponse: function(response, elem)
		{
			try
			{
				if (response.result) {

					if (typeof response.url != 'undefined')
					{
						$.app.loadUrl(response.url);
					}
					else
					{
						$.app.showNotification("success", response.msg);
					}
				}
				else
				{
					$.app.showNotification("danger", response.msg);

					elem.iCheck('disable');
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");

				elem.iCheck('disable');
			}
		},

		showNotification: function(type, msg) {

			(function (el) {
				clearTimeout($.app.timer);
				$.app.timer = setTimeout(function () {
					el.stop().slideUp('fast');
				}, 3000);
			}($('#notifications').hide().html("<div class='notification " + type + "'>" + msg + "</div>").slideDown('fast')));

		},

		loadUrl: function (url) {
			window.location.href = url;
		},

		loadUrlQuery: function ()
		{
			window.location.href = request + "?" + jQuery.param( state );
		},

		getUID: function () {
			var idstr=String.fromCharCode(Math.floor((Math.random()*25)+65));
			do {
				var ascicode=Math.floor((Math.random()*42)+48);
				if (ascicode<58 || ascicode>64){
					idstr+=String.fromCharCode(ascicode);
				}
			} while (idstr.length<32);

			return (idstr);
		},

		processAddTemplate: function(elem) {

			var num = String(elem.attr('data-num'));

			if (num.indexOf("#") != -1)
			{
				num = parseInt( $(num).text() );
			}
			else { num = parseInt(num); }

			var html = '';
			var failed = false;

			html = $(elem.attr('data-template')).html();

			if (html != '') {

				html = html.replace(/{num}/g,num);
				var uid = $.app.getUID();
				html = html.replace(/{uid}/g,uid);

				if (typeof elem.data('source') != 'undefined')
				{
					var data = $(elem.data('source')).data();

					if (typeof data != 'undefined')
					{
						for (key in data)
						{
							html = html.replace(new RegExp("{"+key+"}","g"),data[key]);
						}

					}
					else {
						failed = true;
					}
				}

				if (!failed)
				{
					if (elem.attr('data-target') != 'undefined') {
						$(elem.attr('data-target')).append(html);
					}
					if (elem.attr('data-target-before') != 'undefined') {
						$(elem.attr('data-target-before')).before(html);
					}
					if (elem.attr('data-target-after') != 'undefined') {
						$(elem.attr('data-target-after')).after(html);
					}

					elem.attr('data-num', num+1);

					if (elem.attr('data-limit') != '' && parseInt(elem.attr('data-limit')) >= num) {
						elem.hide();
					}

					var remove = elem.data('remove');

					if (typeof remove != 'undefined')
					{
						$(remove).remove();
					}

					var callback = elem.data('callback');

					if (typeof callback != 'undefined')
					{
						$.app.executeFunction(callback, window);
					}

					$.app.init();

					$.form.init();
				}
			}

		},

	};


	$.app.init();
});