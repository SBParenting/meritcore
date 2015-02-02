jQuery(function() {


	$.survey = {

		init: function() {

			this.initNav();
			
		},

		initNav: function ()
		{
			$(".nav-li a").off('click').on('click', function (e) {
				e.preventDefault();
			});

			$(".scroll-this").mCustomScrollbar({theme: 'inset-2'});

			$('.selector').off('click').on('click', function(e) {
				e.preventDefault();

				var cell = $(this).parent().parent();
				var row  = cell.parent();

				if (!cell.hasClass('selected'))
				{
					row.find('td.selected').removeClass('selected');
					cell.addClass('selected');
				}
				else {
					cell.removeClass('selected');	
				}

				if (row.find('td.selected').length == 1)
				{
					row.addClass('done');
				}
				else
				{
					row.removeClass('done');
				}
			});
		}

	};


	$.survey.init();
});