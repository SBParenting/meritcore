@extends('common.layout.report')

@section('title')
	
	Report
	
@stop

@section('content')

	<div class="blue-box">
		<h1>Youth Core Competency of Character</h1>

		<hr />

		<h2>Summary Report</h2>

	</div>

	<img src="{{ url("/public/front/img/report-image-1.jpg") }}" />

	<p>
		<em>Our students won't value what we have to offer if they don't value themselves. If we show that we value them, they'll value what we have to offer.<br />
		<span>~ Dr. Wayne Hammond</span></em>
	</p>

	<hr />

	<div class="grey">
		<b>School Name:</b> {{ $school->name }}<br />
		<b>Date of Report:</b>  {{ date("F j, Y") }}<br />
		<b>Questionnaires Start Date:</b>  {{ get_date($survey->start_date) }}<br />
		<b>Questionnaires End Date:</b> {{ get_date($survey->end_date) }}<br />
	</div>

	<br />

	<p>The following report summarizes the aggregated (non-individual) results of HEROES® student's who completed the widely used self-assessment questionnaire.</p>

	<p>The second section of the report are some general comments intended to assist in the interpretation of the HEROES® Core Character Trait Questionnaire results and graphs.</p>

	<p>Prior to reviewing this information, please read the Limitations and Confidentiality statements in Appendix A.</p>

	<img src="{{ url('/m/surveys/'.$survey->id.'/chart') }}.png" />

	<p><b>The graph above shows the number of HEROES® students who demonstrated strength (as indicated by the green section of the bar) and vulnerability (as indicated by the red part of the bar) in each of the Core Character Traits.</b></p>
	
	<p>The Core Character Traits questionnaire provides a balanced, evidence based assessment of the foundational attitudes, skills and knowledge that are directly related to resiliency, well-being and success:</p>

	<ol>
		<li><b>Strengths-Based Aptitude</b> (self-esteem) - A positive view of the future with a clear understanding of strengths and how to use them in purposeful ways.</li>
		<li><b>Emotional Competence</b> (emotional awareness) - Ability to identify, understand & express emotions in constructive ways.</li>
		<li><b>Social Connectedness</b> (social skills and relationships) - Capacity to develop and maintain supportive & healthy relationships.</li>
		<li><b>Moral Directedness</b> (values) – Understanding of “right” and “wrong” that guides decision making and coping behaviour.</li>
		<li><b>Adaptability</b> (problem solving skills) - Good problem solving skills and an awareness that mistakes are opportunities to learn.</li>
		<li><b>Managing Ambiguity</b> (coping skills) - An ability to cope with stressful and/or uncertain situations in positive ways.</li>
		<li><b>Agency and Responsibility</b> (belonging and community conscientiousness) – Capacity to be responsible and committed in positive ways when part of a group or social situation.</li>
		<li><b>Persistence</b> (positive hardiness) - The steadfastness, courage and motivation to do the hard, strategic work of overcoming challenging or stressful situations to achieve goals.</li>
		<li><b>Passion</b> (positive spark) - An intense and compelling enthusiasm for one or more interests, activities, causes or subjects.</li>
		<li><b>Spiritual Eagerness</b> (positive spiritual awareness) - Is engaged in a curious exploration of their spiritual sense of self and its implications for ones purpose and meaning in life.</li>
	</ol>

	<script>

	/*
		Morris.Bar({
			element: 'bar-chart',
			data: [
				@foreach ($survey->stats as $stat)
					{ y: '{{ shorten($stat->grouping->title, 30) }}', a: {{ $stat->vulnerable_count }}, b: {{ $stat->strong_count }} },
				@endforeach
			],
			barColors: ['#953525', '#5d9b21'],
			stacked: true,
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Series A', 'Series B'],
			resize: true,
			xLabelAngle: -65,
      		padding: 0,

		});

	*/

	</script>

@stop