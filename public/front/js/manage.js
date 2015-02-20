jQuery(function() {

	$.manage = {

		sections: {1: 'btnManageStudents', 2: 'btnUpdateClassInfo'},

		init: function() {

			this.initButtons();

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
					$.manage.hidePanel();
				}
			});

			$('.hide-panel').off('click').on('click', function (e) {
				e.preventDefault();

				$.manage.hidePanel();
			});
		},

		showPanel: function(button) {

			var target = $(button.data('target'));

			var show = $(button.data('show'));

			$('.closable-panel').hide();

			show.show();

			target.fadeIn('fast');

			if (!button.hasClass('dont-activate'))
			{
				button.addClass('active');

				button.addClass('holding').data('html', button.html()).html("<i class='fa fa-arrow-left'></i> Go back");
			}
		},

		hidePanel: function() {

			$('.closable-panel').not('.open').hide();

			$('.closable-panel.open').fadeIn('fast');

			$('.btn.holding').each(function() {
				$(this).removeClass('active').html($(this).data('html')).blur();
			});
		},

	};

	$.manage.init();
});