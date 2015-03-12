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
		<tr>
			<td><b>Date of Report:</b></td>
			<td>{{ date("F j, Y") }}</td>
		</tr>
		<tr>
			<td><b>Questionnaires Start Date:</b></td>
			<td>{{ get_date($survey->start_date, "F j, Y") }}</td>
		</tr>
		<tr>
			<td><b>Questionnaires End Date:</b></td>
			<td>{{ get_date($survey->end_date, "F j, Y") }}</td>
		</tr>
	</table>

	<br />

	<p>The following report summarizes the aggregated (non-individual) results of HEROES® student's who completed the widely used self-assessment questionnaire.</p>

	<p>The second section of the report are some general comments intended to assist in the interpretation of the HEROES® Core Character Trait Questionnaire results and graphs.</p>

	<p>Prior to reviewing this information, please read the Limitations and Confidentiality statements in Appendix A.</p>

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

	<img src="{{ url('/public/front/img/report/charts/'.$chart) }}" class="width-100" />	

	<br /><br /><br />

	<p><b>The graph above shows the number of HEROES® students who demonstrated strength (as indicated by the green section of the bar) and vulnerability (as indicated by the red part of the bar) in each of the Core Character Traits.</b></p>
	
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