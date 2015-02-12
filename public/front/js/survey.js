jQuery(function() {


	$.survey = {

		current: 0,
		done: 0,
		total: 0,

		init: function() {
			$.survey.total = $.surveyQuestions.length;

			var found = false;

			$.each($.surveyQuestions, function(k, v){
				if (!found && v.done == true)
				{
					$.survey.current = k;
				}
				else
				{
					found = true;
				}
			});

			$.survey.current = 5 * Math.floor($.survey.current / 5);

			this.initNav();
			this.initQuestions();
		},

		initQuestions: function() {

			$('#questionsContainer').html("");
			$('#questionsMobileContainer').html("");

			for (var i = $.survey.current; i < ($.survey.current+5); i++)
			{
				if (typeof $.surveyQuestions[i] != 'undefined')
				{
					$.survey.appendQuestion($.surveyQuestions[i]);
				}
			}

			this.initSurvey();

			$.survey.updateTotals();

			$.survey.initSurveyButtons();
		},

		initSurvey: function()
		{
			$.survey.initSurveyButtons();

			$('.selector').off('click').on('click', function(e) {
				e.preventDefault();

				var cell = $($(this).data('indicator'));
				var row  = $($(this).data('question-row'));

				if (!cell.hasClass('selected'))
				{
					row.find('td.selected').removeClass('selected');
					cell.addClass('selected');

					var id = $(this).data('question-id');

					var question = $.survey.findQuestionByID(id);

					if (question)
					{
						question.value = $(this).data('value');
						question.done = true;
					}

				}
				else {
					cell.removeClass('selected');
				}

				if (row.find('td.selected').length > 0)
				{
					row.addClass('done');

					var token = $("input[name='_token']").val();

					var data = {
						'question_id': $(this).data('question-id'),
						'result': $(this).data('value'),
						'_token': token,
					};

					$.api.post($(this).data('url'), data);
				}
				else
				{
					row.removeClass('done');
					var id = $(this).data('question-id');

					var question = $.survey.findQuestionByID(id);

					if (question)
					{
						question.value = 0;
						question.done = false;
					}

					var token = $("input[name='_token']").val();

					var data = {
						'question_id': $(this).data('question-id'),
						'result': 0,
						'_token': token,
					};

					$.api.post($(this).data('url'), data);
				}

				$.survey.updateTotals();

				$.survey.initSurveyButtons();
			});

			$('#btnSurveyComplete').off('click').on('click', function(e) {
				e.preventDefault();

				var token = $("input[name='_token']").val();

				$.api.post($(this).data('url'), {'_token':token}, $.app.showPostResponse);
			});
		},

		initSurveyButtons: function()
		{
			if ($.survey.current == 0)
			{
				$('#btnSurveyBack').addClass('disabled');
			}
			else
			{
				$('#btnSurveyBack').removeClass('disabled');
			}

			if ($.survey.total <= ($.survey.current+5) )
			{
				$('#btnSurveyNext').addClass('disabled');
			}
			else
			{
				if ($('.survey-row.done').length == 5)
				{
					$('#btnSurveyNext').removeClass('disabled');
				}
				else
				{
					$('#btnSurveyNext').addClass('disabled');
				}
			}

			if ($.survey.total == $.survey.done)
			{
				$('#btnSurveyComplete').show();
			}
			else
			{
				$('#btnSurveyComplete').hide();
			}
		},

		initNav: function ()
		{
			$(".nav-li a").off('click').on('click', function (e) {
				e.preventDefault();
			});

			$(".scroll-this").mCustomScrollbar({theme: 'inset-2'});

			$('#btnSurveyBack').on('click', function(e) {
				e.preventDefault();

				$.survey.moveBack();
			});

			$('#btnSurveyNext').on('click', function(e) {
				e.preventDefault();

				$.survey.moveNext();
			});
		},

		moveBack: function() {
			$.survey.current = $.survey.current - 5;
			if ($.survey.current < 0) { $.survey.current = 0; }
			$.survey.initQuestions();
		},

		moveNext: function() {
			$.survey.current = $.survey.current + 5;
			if ($.survey.current > $.survey.total) { $.survey.current = 0; }
			$.survey.initQuestions();
		},

		updateTotals: function()
		{
			var done = 0;
			var total = $.survey.total;

			$.each($.surveyQuestions, function(k, v) {
				if (v.done === true)
				{
					done++;
				}
			});

			$.survey.done = done;

			var progress = $('#progressBar');

			if (total > 0)
			{
				progress.css({'width':(done/total*100)+'%'});
				
				if (done > 3)
				{
					progress.html(done + ' / ' + total)
				}
				else
				{
					progress.html(done)
				}
			}
		},

		appendQuestion: function(question)
		{
			var container = $('#questionsContainer');
			var questionT = $('#questionTemplate');
			container.append( $.api.template(questionT, question, {'value':'selected', 'done':'done'}));

			var mobile    = $('#questionsMobileContainer');
			var mobileT   = $('#questionMobileTemplate');
			mobile.append( $.api.template(mobileT, question, {'value':'selected', 'done':'done'}));
		},

		findQuestionByID: function (id)
		{
			var question;
			$.each($.surveyQuestions, function(k, v) {
				if (v.id == id)
				{
					question = v;
				}
			});

			return question;
		},

	};


	$.survey.init();
});