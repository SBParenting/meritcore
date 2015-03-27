@extends('common.layout.report')

@section('title')
	
	Report
	
@stop

@section('content')

	<img src="{{ url('public/front/img/report/header.jpg') }}" class="width-100" />

	<p>
		<em>Our students won't value what we have to offer if they don't value themselves. If we show that we value them, they'll value what we have to offer.<br />
	</p>

	<p class="text-right"><em>~ Dr. Wayne Hammond</em></p>

	<img src="{{ url('public/front/img/report/line.jpg') }}" class="width-100" />

	<br />

	<table class="grey">
		<tr>
			<td><b>School Name:</b></td>
			<td>{{ $school->name }}</td>
		</tr>
		@if ($survey->classroom)
			<tr>
				<td><b>Classroom:</b></td>
				<td>{{ $survey->classroom->title }}</td>
			</tr>
		@endif
		<tr>
			<td><b>Date of Report:</b></td>
			<td>{{ date("F j, Y") }}</td>
		</tr>
		<tr>
			<td><b>Questionnaires Date Range:</b></td>
			<td>{{ get_date($survey->start_date, "M j/y") }} - {{ get_date($survey->end_date, "M j/y") }}</td>
		</tr>
	</table>

	<br />

	<p>The following report summarizes the aggregated (non-individual) results of HEROES® student's who completed the widely used self-assessment questionnaire.</p>

	<p>The following link provides a document with general comments intended to assist the interpretation and exploration of the Core 
Character Trait Questionnaire results and graphs.</p>

	<p>Prior to reviewing this information, please read the Limitations and Confidentiality statements in Appendix A.</p>

	<p class="small">Limitations and Confidentiality: </p>
	<ul class="small">
		<li>As with all self-assessment questionnaires, the results are limited by insight and honesty and require further exploration of the respondent's context. </li>
		<li>The questionnaire administered was designed to assess developmentally important character traits research has identified as essential for success in life and is not intended to be used for a more formal diagnosis (i.e. mental illness, health and/or wellness). </li>
		<li>All contents of this report are CONFIDENTIAL and only reported in an aggregated/non-identifiable format to be used for the purposes agreed upon by the respondent and/or their parents/guardians and/or caregivers. </li>
	</ul>

	<div class="footer">
		<img src="{{ url('public/front/img/report/footer.jpg') }}" class="width-100" />
		<div class="content">
			<a href="https://twitter.com/StrongAtSchool" class="twitter">@StrongAtSchool</a>
			<a href="http://strengthsbasededucation.com/" class="web">StrengthsBasedEducation.com</a>
			<div class="contact">
				PHONE:<br />
				866-948-7706<br /><br />
				EMAIL:<br />
				<a href="mailto:info@resil.ca">info@resil.ca</a><br />
			</div>
		</div>
	</div>

	<div class="page-break"></div>

	<img src="{{ url('public/front/img/report/header2.jpg') }}" class="width-100" />

	<br /><br />

	<img src="{{ url('/public/front/img/report/charts/'.$chart) }}?t={{time()}}" class="width-100" />	

	<table class="legend">
		<tr>
			<td class="heading green">Optimal Strength<br />51 - 100</td>
			<td class="description green">
				Scores of 51% or greater suggest that your child understands the strength and is able to actively draw upon it in multiple situations and settings.
			</td>
			<td class="heading red">Potential Strength<br />0 - 50</td>
			<td class="description red">
				Scores of 50% or lower suggest that this is an area that needs purposeful, strategic exploration and is an opportunity to build this strength within your child.
			</td>
		</tr>
	</table>

	<p><b>The graph above shows the number of HEROES® students who demonstrated strength (as indicated by the green section of the bar) and potential strength (as indicated by the red part of the bar) in each of the Core Character Traits.</b></p>
	
	<p>The Core Character Traits questionnaire provides a balanced, evidence based assessment of the foundational attitudes, skills and knowledge that are directly related to resiliency, well-being and success:</p>


	<ol class="small">
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



@stop