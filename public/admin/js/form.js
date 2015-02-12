jQuery(function() {


	$.form = {

		timer: [],

		init: function() {

			$.form.initControls();

			$.form.initCheck();
		},

		initControls: function() {

			$('form').not('.no-ajax').off('submit').on('submit', function(e) {
				e.preventDefault();

				$.api.postForm($(this), $.form.showFormResult, $(this));

			});

			$('form').find('.no-submit-on-enter').off('keypress').on('keypress', function(e) {
				return e.which != 13;
			});

			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});

			$('.get-form-avatar').off('change').on('change', function() {
				if ($(this).val() != "")
				{
					var token = $("input[name='_token']").val();
					$.api.post($(this).data('avatar-url'), {email:$(this).val(),'_token':token}, $.form.showFormAvatar, $(this));
				}
				else {
					$('.form-avatar').hide();
				}
			});

			$('.js-dropdown-select a').off('click').on('click', function(e) {
				e.preventDefault();

				var elem = $(this);

				var container = elem.parent().parent().parent();

				var dropdown = container.find('.dropdown-menu');

				container.find('a').removeClass('active');

				elem.addClass('active');

				container.find('.dropdown-toggle').removeClass('placeholding');

				container.find('.display-value').html(elem.html());

				container.find('.dropdown-value').val(elem.data('value')).change();

				dropdown.parent().off('hide.bs.dropdown');

			});

			$('.js-dropdown-select input').each(function() {

				var elem = $(this);

				elem.off('focus').on('focus', function(e) {
					e.preventDefault();

					var dropdown = elem.parent().parent();

					dropdown.parent().off('hide.bs.dropdown').on('hide.bs.dropdown', function(e){
						return false;
					});
				});

				elem.off('keyup').on('keyup', function(e) {
					e.preventDefault();
					var dropdown = elem.parent().parent();
					var search = $.form.searchDropdown(dropdown, elem.val());
				});

				if (elem.attr('data-value') != 'undefined')
				{
					var container = elem.parent().parent().parent();

					var dropdown = container.find('.dropdown-menu');

					container.find('a').removeClass('active');

					var active = container.find("a[data-value='" + elem.attr('data-value') + "']");

					active.addClass('active');

					container.find('.display-value').html(active.html());

				}
			});

			$('.generate-slug').off('keyup').on('keyup', function(){
				var elem = $(this);
				var value = elem.val().toLowerCase();
				value = value.replace(/\W+/g, '-');
				value = value.replace(/-$/, '');
				$(elem.attr('data-target')).val(value);

			});

			$('.generate-slug').off('change').on('change', function() {
				$(this).keyup();
			});

			if ($('.summernote').length > 0)
			{
				var elem = $('.summernote');

				$('.summernote').summernote({
					toolbar: [["style",["style"]],["font",["bold","italic","underline","clear"]],["color",["color"]],["para",["ul","ol","paragraph"]],["height",["height"]],["insert",["link","picture","video"]],["view",["fullscreen"]],["help",["help"]]],
					onChange: function(contents, $editable) {
						elem.val(contents.html());
					},
				});
			}

			$('.fileinput-button input').off('change').on('change', function() {

				if ($(this).val() != '')
				{
					$(this).parent().find('.display-text').text('File selected: ' + $(this).val().split('\\').pop() );
				}
			});

			if ($('.input-group.date').length > 0)
			{
				$('.input-group.date').datepicker({
					todayBtn: "linked",
					keyboardNavigation: true,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					format: "yyyy-mm-dd"
				});
			}

			if ($('.input-group.time').length > 0)
			{
				$('.input-group.time input').timepicker({defaultTime:false});
			}

			if ($('.selectpicker').length > 0)
			{
				$('.selectpicker').selectpicker({});
			}

			if ($('.autosize').length > 0)
			{
				$('.autosize').autosize();
			}

			$('.submit-on-change input').on('change', function() {
				$('form').submit();
			});

			$('.select-button').on('click', function(e) {
				e.preventDefault();

				if ($(this).hasClass('btn-white'))
				{
					$(this).find('input').val( $(this).data('value') ).change();

					$(this).removeClass('btn-white').addClass('btn-primary');
				}

				else if ($(this).hasClass('btn-primary'))
				{
					$(this).find('input').val( "" ).find('input').change();

					$(this).removeClass('btn-primary').addClass('btn-white');
				}

				if ($(this).hasClass('submit-on-change'))
				{
					$('form').submit();
				}
			});

			$(".autosize").keydown(function(e) {
				if(e.keyCode === 9) { // tab was pressed
					// get caret position/selection
					var start = this.selectionStart;
						end = this.selectionEnd;

					var $this = $(this);

					// set textarea value to: text before caret + tab + text after caret
					$this.val($this.val().substring(0, start)
								+ "\t"
								+ $this.val().substring(end));

					// put caret at right position again
					this.selectionStart = this.selectionEnd = start + 1;

					// prevent the focus lose
					return false;
				}
			});

		},

		showFormResult: function(response, form)
		{
			$.form.resetForm(form);

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

					if (typeof response.id != 'undefined')
					{
						form.find("[name='id']").val( response.id );
						form.find('.close-button').text('Close');
					}

					
					$('.show-post-success').show();

					$('.hide-post-success').hide();
				}
				else
				{
					$.app.showNotification("danger", response.msg);

					if (typeof response.fields != 'undefined')
					{
						$.form.showFormErrorFields(form, response.fields);
					}
					else if (typeof response.errors != 'undefined')
					{
						$.form.showFormErrors(form, response.errors);
					}
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}

		},

		showFormAvatar: function(response, form)
		{
			try
			{
				if (response.url) {

					$('.form-avatar img').attr('src', response.url);

					$('.form-avatar').show();
				}
				else
				{
					$.app.showNotification("danger", response.msg);

					if (typeof response.fields != 'undefined')
					{
						$.form.showFormErrors(form, response.fields);
					}
				}
			}
			catch (e) {

				$.app.showNotification("danger", "An unknown error occured while processing your request.");
			}
		},

		showFormErrorFields: function(form, fields) {

			$.each(fields, function(key, value) {

				var field = form.find("[data-name='" + value + "']").parent();
				field.addClass('has-error');

				if (field.parent().hasClass('tab-pane'))
				{
					form.find("a[href='#" + field.parent().attr('id') + "']").addClass('has-error');
				}
			});

			form.find("[type='submit']").removeClass('btn-primary').addClass('btn-danger');
		},

		showFormErrors: function(form, errors) {

			$.each(errors, function(key, value) {

				var elem = form.find("[data-name='" + key + "']");
				var field = elem.parent();

				field.addClass('has-error');

				elem.attr('data-content', value);
				elem.attr('data-placement', 'top');
				elem.attr('data-trigger', 'focus');

				elem.popover();

				if (field.parent().parent().hasClass('tab-pane'))
				{
					form.find("a[href='#" + field.parent().parent().attr('id') + "']").parent().addClass('has-error');
				}

			});

			form.find("[type='submit']").removeClass('btn-primary').addClass('btn-danger');
		},

		resetForm: function(form)
		{
			form.find('.has-error').children().removeAttr('data-content').removeAttr('data-placement').removeAttr('data-trigger').popover('destroy');

			form.find('.has-error').removeClass('has-error');

			form.find("[type='submit']").removeClass('btn-danger').addClass('btn-primary');

			form.find(".nav-tabs li").removeClass('has-error');
		},


		showNotification: function(type, msg) {

			$('#alerts').html("<div class='alert alert-" + type + "'>" + msg + "</div>");
		},

		initCheck: function() {

			$('.i-checks').on('ifChecked', function() {
				$(this).prop('checked', true);
			});

			$('.i-checks').on('ifUnchecked', function() {
				$(this).prop('checked', false);
			});

			$('.js-show-on-select').hide();

			$('.js-select').on('ifChanged', function() {
				$.form.toggleCheck();
			});

			$('.gallery-thumb .js-select').on('ifChecked', function() {
				$(this).parent().parent().addClass('selected');
			});

			$('.gallery-thumb .js-select').on('ifUnchecked', function() {
				$(this).parent().parent().removeClass('selected');
			});

			$('.js-select-all').on('ifChecked', function() {
				$.form.toggleCheckAll(true);
			});

			$('.js-select-all').on('ifUnchecked', function() {
				$.form.toggleCheckAll(false);
			});

			$.form.toggleCheck();
		},

		toggleCheck: function() {

			var countChecked = $('.js-select:checked').length;
			var countUnchecked = $('.js-select').not(':checked').length;

			$('.js-show-on-select').toggle(countChecked > 0);

			if (countUnchecked > 0 && countChecked == 0)
			{
				$('.js-select-all').iCheck('determinate');
				$('.js-select-all').iCheck('uncheck');
			}
			else if (countUnchecked > 0 && countChecked > 0)
			{
				$('.js-select-all').iCheck('indeterminate');
			}
			else if (countChecked > 0 && countUnchecked == 0)
			{
				$('.js-select-all').iCheck('determinate');
				$('.js-select-all').iCheck('check');
			}
		},

		toggleCheckAll: function(on)
		{
			if (on)
			{
				$('.js-select').iCheck('check');
			}
			else
			{
				$('.js-select').iCheck('uncheck');
			}
		},

		searchDropdown: function(dropdown, search) {

			var data = $.form.getDataFromDropdown(dropdown);

			var fuse = new Fuse(data, {keys: ['title'], id: 'id', threshold:0.5});

			var result = $.form.maxArray(fuse.search(search), 10);

			dropdown.find('li').not('.dropdown-search-input').addClass('closed');

			if (result.length > 0)
			{
				for (key in result)
				{
					dropdown.find("a[data-value='" + result[key] + "']").parent().removeClass('closed');
				}
			}
			else
			{
				var count = 0;
				dropdown.find("li").not('.dropdown-search-input').each(function() {

					if (count < 10)
					{
						$(this).removeClass('closed');
					}

					count++;
				});

			}
		},

		getDataFromDropdown: function(dropdown)
		{
			var data = [];

			dropdown.find('a').each(function() {
				var id    = $(this).data('value');
				var title = $(this).text();
				data.push({id: id, title: title});
			});

			return data;
		},

		maxArray: function(data, num) {

			var count = 0;
			var array = [];

			for (key in data)
			{
				if (count < 10)
				{
					array.push(data[key]);
				}

				count++;
			}

			return array;
		},
	};


	$.form.init();
});