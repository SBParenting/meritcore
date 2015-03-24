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

	activateArea: function(group,area)
	{
		var element = $('.'+group).find('#'+area);

		element
			.data('active', 1)
			.attr('fill', element.data('color'));
	},

	deactivateArea: function(group,area)
	{
		var element = $('.'+group).find('#'+area);

		element
			.data('active', '')
			.attr('fill', 'transparent');
	},

	initHoverActions: function()
	{
		$('svg rect, svg polygon, svg path').off('mouseenter').on('mouseenter', function()
		{
			$(this).attr('fill', $(this).data('color'));

            if ($(this).attr('id').indexOf('heading') == -1) {
                $(this).siblings('.'+$(this).attr('id')+'-text').hide();
                $(this).siblings('.'+$(this).attr('id')+'-percent').show();
            }

		}).off('mouseleave').on('mouseleave', function()
		{
			if (!$(this).data('active') && !$(this).data('heading')) {
                $(this).attr('fill', 'transparent');
            }

            if ($(this).attr('id').indexOf('heading') == -1) {
                $(this).siblings('.'+$(this).attr('id')+'-text').show();
                $(this).siblings('.'+$(this).attr('id')+'-percent').hide();
            }
		});
	},

	setIcon: function(group, area, icon)
	{
		if ($.inArray(icon, ['experienced', 'in-progress', 'suggested']) >= 0)
		{
			var element = $('.'+group).find('#'+area+'-icon');

			element.attr('xlink:href', '/public/front/img/icons/'+icon+'.png').show();

			return true;
		}

		return false;
	},

    setLink: function(group, area, link)
    {
        $('.'+group).find('#'+area).on('click',function(){
            location.href = link;
        });
    },

    hoverPercentage: function(group,area,value)
    {
        $('.'+group).find('.'+area+'-percent').text(value+'%');
    },

    incrementPercentageX: function(group,area,x)
    {
        $('.'+group).find('.'+area+'-percent').attr('x',parseInt($('.'+group).find('.'+area+'-percent').attr('x'))+x);
    }

};