$(document).ready(function()
{
	OurJourneyMap.init();
});

OurJourneyMap = {

	groupColors: {},

	init: function()
	{
		$('svg rect, svg polygon, svg path').attr('stroke-width', '2px');

		$('svg text')
			.attr('fill', '#fff')
			.attr('font-family', 'Myriad Pro Regular, Arial, sans-serif')
			.attr('font-size', '20px');

		this.groupColors = {
			'school-culture':                 '#1f5c2e',
			'family-support-and-expectation': '#257fb9',
			'peer-relationships':             '#fbb433',
			'commitment-to-learning':         '#29ac89',
			'community-cohesiveness':         '#e64c40',

			'cultural-sensitivity':           '#253d8c',
			'self-concept':                   '#ed4798',
			'social-sensitivity':             '#3bc0ca',
			'empowerment':                    '#f47e20',
			'self-control':                   '#8d4198',
		};

		//this.test();

		this.setGroupColors(this.groupColors);

		this.initHoverActions();
	},

	test: function()
	{
		$('#caring-school-climate').data('active', 1);
		$('#caring-family').data('active', 1);
		$('#school-engagement').data('active', 1);
		$('#positive-peer-relationships').data('active', 1);

		$('svg image').attr('xlink:href', '/public/front/img/icons/experienced.png');

		this.setIcon('caring-school-climate', 'suggested');
	},

	setGroupColors: function(groupColors)
	{
		for (group in groupColors)
		{
			var color = groupColors[group];

			this.setGroupColor(group, color);
		}
	},

	setGroupColor: function(group, color)
	{
		var selector = 'svg g.'+group+' rect, svg g.'+group+' polygon, svg g.'+group+' path';

		$(selector).data('color', color).each(function()
		{
			if ($(this).data('active') || $(this).data('heading'))
				$(this).attr('fill', $(this).data('color'));
			else
				$(this).attr('fill', 'transparent');

			$(this).attr('stroke', $(this).data('color'));
		});
	},

	activateArea: function(area)
	{
		var element = $('#'+area);

		element
			.data('active', 1)
			.attr('fill', element.data('color'));
	},

	deactivateArea: function(area)
	{
		var element = $('#'+area);

		element
			.data('active', '')
			.attr('fill', 'transparent');
	},

	initHoverActions: function()
	{
		$('svg rect, svg polygon, svg path').off('mouseenter').on('mouseenter', function()
		{
			$(this).attr('fill', $(this).data('color'));

		}).off('mouseleave').on('mouseleave', function()
		{
			if (!$(this).data('active') && !$(this).data('heading'))
				$(this).attr('fill', 'transparent');
		});
	},

	setIcon: function(area, icon)
	{
		if ($.inArray(icon, ['experienced', 'in-progress', 'suggested']) >= 0)
		{
			var element = $('#'+area+'-icon');

			element.attr('xlink:href', '/public/front/img/icons/'+icon+'.png').show();

			return true;
		}

		return false;
	}

};