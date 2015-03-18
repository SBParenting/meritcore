jQuery(function() {

	$.manage = {

		sections: {1: 'btnManageStudents', 2: 'btnUpdateClassInfo', 3: 'btnImportStudents'},

		init: function() {

			this.initButtons();

			this.initImport();

			if (typeof activeSection != 'undefined' && typeof this.sections[activeSection] != 'undefined')
			{
				$('#' + this.sections[activeSection]).click();
			}
		},

		initButtons: function() {

			$('.show-panel').off('click').on('click', function (e) {
				e.preventDefault();

				if (!$(this).hasClass('active'))
				{
					$.manage.showPanel($(this));
				}
				else
				{
					$.manage.hidePanel($(this));
				}
			});

			$('.hide-panel').off('click').on('click', function (e) {
				e.preventDefault();

				$.manage.hidePanel($(this));
			});
		},

		initImport: function() {

			var token = $("input[name='_token']").val();
			var url = $('#startImport').data('url');

			$('#importFile').fileupload({
				dataType: 'json',
				add: function (e, data) {
		            var container = $("#importProgressContainer");
					container.fadeIn('fast');
					container.find('.title').html("Uploading " + data.files[0].name + "...");
		            data.submit();
		        },
				progressall: function (e, data) {				
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#importProgress').css('width', progress + '%');
				},
				error: function(XMLHttpRequest, status, error) {
					if (XMLHttpRequest.responseJSON)
					{
						$("#importProgressContainer").hide();
						$.app.showNotification("danger", "Invalid file format, please try again.");
					}
					else
					{
						$("#importProgressContainer").hide();
						$.app.showNotification("danger", 'There was an error processing your request: '+errorThrown);
					}
				},
				success: function (response) {
					if(response.result)
					{
						$("#importProgressContainer").hide();
						$("#btnImport").hide();
						$("#importProcess").fadeIn('fast');

						$.manage.processImport(response.filename);
					}
					else
					{
						$("#importProgressContainer").hide();
						$.app.showNotification("danger", response.msg);
					}
				}
			});

		},

		showPanel: function(button) {

			$('.btn.holding').each(function() {
				$(this).removeClass('active').html($(this).data('html')).blur();
			});

			var target = $(button.data('target'));

			var show = $(button.data('show'));

			var hide = $(button.data('hide'));

			$('.closable-panel').hide();

			show.show();

			hide.hide();

			target.fadeIn('fast');

			if (!button.hasClass('dont-activate'))
			{
				button.addClass('active');

				button.addClass('holding').data('html', button.html()).html("<i class='fa fa-arrow-left'></i> Go back");
			}
		},

		hidePanel: function(button) {

			if (typeof button.attr('data-hide') != 'undefined')
			{
				var hide = $(button.data('hide'));

				hide.show();
			}

			$('.closable-panel').not('.open').hide();

			$('.closable-panel.open').fadeIn('fast');

			$('.btn.holding').each(function() {
				$(this).removeClass('active').html($(this).data('html')).blur();
			});
		},

		processImport: function(filename) {
			$.api.post($("#importProcess").data('url'), {filename: filename}, $.manage.matchImportColumns, filename);
		},

		showImportProcess: function() {
			$("#importProcess").fadeIn('fast');
			$('#importMatch').hide();
			$("#importProcess .title").html("Importing students into database, please wait...");
		},

		showMatchColumns: function() {
			$("#importProcess").hide();
			$('#importMatch').fadeIn('fast');
		},

		matchImportColumns: function(response, filename) {
			$("#importProcess").hide();
			$('#importMatch').fadeIn('fast');
			var container = $("#importMatchConatiner");
			var template = $("#columnTemplate");
			$('#importMatch').find("input[name='filename']").val(filename);

			$.each(response.data.columns, function(k, v) {
				var html = template.html();
				html = html.replace(/\(data:key\)/g, v.key);
				if (v.matched)
				{
					html = html.replace(/\(data:matched\)/g, "Matched");
					html = html.replace(/\(data:matchclass\)/g, "success");
					html = html.replace(/\(data:value\)/g, v.matched);
				}
				else
				{
					html = html.replace(/\(data:matched\)/g, "Unmatched");
					html = html.replace(/\(data:matchclass\)/g, "danger");	
					html = html.replace(/\(data:value\)/g, "null");
				}

				$.each(response.data.rows, function(i, row) {
					html = html.replace("(data:row"+i+")", row[v.key]);
				});

				container.append(html);
			});

			$(".match-field input").on('change', function(e) {
				var val = $(this).val();
				var panel = $(this).parent().parent().parent();
				
				if (typeof val != 'undefined' && val != null && val != 'null' && val != '--' && val != "")
				{
					panel.removeClass('danger');
					panel.find(".match-label").removeClass('label-danger').addClass('label-success').html("Matched");
				}
				else
				{
					panel.addClass('danger');
					panel.find(".match-label").addClass('label-danger').removeClass('label-success').html("Unmatched");
				}
			});

			$.form.initControls();
		},

	};

	$.manage.init();
});