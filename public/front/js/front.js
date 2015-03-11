jQuery(function() {

	$.front = {

		init: function() {

			$('.slide-next').off('click').on('click', function(e) {
				e.preventDefault();
				$.front.showNextSlide($(this));
			});

			$('.slide-back').off('click').on('click', function(e) {
				e.preventDefault();
				$.front.showPrevSlide($(this));
			});

			$('.submit-slide').off('click').on('click', function(e) {
				e.preventDefault();

				var data = {};
				var token = $("input[name='_token']").val();

				data = $($(this).data('current')).find('input').serialize();
				data += "&_token=" + token;

				$.front.showLoaderInside( $(this) );

				$.api.post($(this).data('url'), data, $.front.showSlideResponse, $(this));
			});

			History.Adapter.bind(window,'statechange',function(){

				var State = History.getState();
				var url = State.hash;
				var currentSlide = $('.wizard-slide.active');
				if(currentSlide.length > 0 && url.indexOf(currentSlide.attr('id')) == -1)
				{
					window.location.href = State.url;
				}
			});

			var currentSlide = $('.wizard-slide.active');

			if (typeof currentSlide.attr('data-slide-index') != 'undefined')
			{
				var index = currentSlide.data('slide-index');
				var total = $(".wizard-slide[data-slide-index]").length;
				$('#progress').html('Step ' + index + ' of ' + total).css({'width':(index/total*100)+"%"});
			}
			else
			{
				if (currentSlide.hasClass('first'))
				{
					$('#progress').html("").css({'width':"0%"});
				}

				if (currentSlide.hasClass('last'))
				{
					$('#progress').html('Complete!').css({'width':"100%"});
				}
			}
		},

		showSlide: function(current, next) {

			$('.wizard-slide').removeClass('active');

			current.fadeOut('fast', function() {
				next.fadeIn('fast');
				next.addClass('active');
			});

			if (typeof next.data('slide-index') != 'undefined')
			{
				var index = next.data('slide-index');
				var total = $(".wizard-slide[data-slide-index]").length;

				$('#progress').html('Step ' + index + ' of ' + total).css({'width':(index/total*100)+"%"});
			}
			else
			{
				$('#progress').html('Complete!').css({'width':"100%"});
			}

			$.front.currentUrl = next.attr('id');
		},

		showNextSlide: function(button) {
			var current = $(button.data('current'));
			var next = $(button.data('next'));

			$('.wizard-slide').removeClass('active');

			current.fadeOut('fast', function() {
				next.fadeIn('fast');
				next.addClass('active');
			});

			if (typeof next.data('slide-index') != 'undefined')
			{
				var index = next.data('slide-index');
				var total = $(".wizard-slide[data-slide-index]").length;

				$('#progress').html('Step ' + index + ' of ' + total).css({'width':(index/total*100)+"%"});
			}
			else
			{
				$('#progress').html('Complete!').css({'width':"100%"});
			}

			History.pushState(null, $(document).find("title").text(), "?s="+next.attr('id'));
		},

		showPrevSlide: function(button) {
			var current = $(button.data('current'));
			var prev = $(button.data('prev'));

			$('.wizard-slide').removeClass('active');

			current.fadeOut('fast', function() {
				prev.fadeIn('fast');
				prev.addClass('active');
			});

			var index = prev.data('slide-index');
			var total = $(".wizard-slide[data-slide-index]").length;

			$('#progress').html('Step ' + index + ' of ' + total).css({'width':(index/total*100)+"%"});

			History.pushState(null, $(document).find("title").text(), "?s="+prev.attr('id'));
		},

		showSlideResponse: function(response, button)
		{
			$.form.resetForm($('form'));

			$.front.hideLoaderInside(button);

			try
			{
				if (response.result) {
					//$.app.showNotification("success", response.msg);

					$.front.showNextSlide(button);
				}
				else
				{
					$.app.showNotification("danger", response.msg);

					if (typeof response.fields != 'undefined')
					{
						$.form.showFormErrorFields($('form'), response.fields);
					}
					else if (typeof response.errors != 'undefined')
					{
						$.form.showFormErrors($('form'), response.errors);
					}
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}

		},

		updateTeachers: function() {
			var teachers = $('.teacher-info');
			var num = 0;
			teachers.each(function() {
				num++;
				$(this).find('input').each(function() {
					var name = $(this).data('single-name');
					$(this).attr('name', "teachers["+num+"]["+name+"]");
					$(this).attr('data-name', "teachers."+num+"."+name);
				});
				$(this).find('[data-num]').html(num);
				$(this).find('.js-remove').attr('data-target', "#teacherInfo"+num)
				$(this).attr('id', "teacherInfo"+num);
			});

			$('#addTeacher').attr('data-num', num+1);
		},

		showLoaderInside: function(button)
		{
			button.attr('data-html', button.html()).addClass('loading-inside');
			button.html("<div class='spinner'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div>");
		},

		hideLoaderInside: function(button)
		{
			button.html(button.attr('data-html'));
		}

	};

	$.front.init();
});