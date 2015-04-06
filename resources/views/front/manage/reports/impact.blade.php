@extends('common.layout.report')

@section('title')
	
	Report
	
@stop

@section('page1')
	
	<img src="{{ url('public/front/img/report/page1.png') }}" class="width-100"/>
	
	<div class="page-break"></div>
@stop

@section('content')
	
	<div class="heading" style="display:block;">
		Summary Report Details
	</div>
	
	<table class="content white width-100" style="padding-left:1cm;">
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
	
	<div class="content">
	<p>The following report summarizes the aggregated (non-individual) results of HEROES® student's who completed the widely used self-assessment questionnaire.</p>

	<p>The following link provides a document with general comments intended to assist the interpretation and exploration of the Core 
Character Trait Questionnaire results and graphs.</p>

	<p>Prior to reviewing this information, please read the Limitations and Confidentiality statements in Appendix A.</p>

	<p>Limitations and Confidentiality: </p>
	<ul>
		<li>As with all self-assessment questionnaires, the results are limited by insight and honesty and require further exploration of the respondent's context. </li>
		<li>The questionnaire administered was designed to assess developmentally important character traits research has identified as essential for success in life and is not intended to be used for a more formal diagnosis (i.e. mental illness, health and/or wellness). </li>
		<li>All contents of this report are CONFIDENTIAL and only reported in an aggregated/non-identifiable format to be used for the purposes agreed upon by the respondent and/or their parents/guardians and/or caregivers. </li>
	</ul>
</div>
	<center><img src="{{ url('public/front/img/report/impact_soc.jpg') }}" width="88px" height="125px" style="margin-top:2cm;"/></center>
	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer1.png') }}" class="width-100" />
	</div>

	<div class="page-break"></div>

	<div class="no-margin heading">
		10 Core Competencies of Character
	</div>
	<div style="padding:2cm;">
		<p>
			<b>The graph below shows the number of HEROES® students who demonstrated strength (as indicated by the Green bar) and potential strength (as indicated by the Yellow bar) in each of the Core Character Traits detailed on the following page.</b>
		</p>

		
		<table class="legend" style="margin-top:2cm;">
			<tr >
				<td rowspan="2" class="legend1"></td>
				<td class="headings">Optimal Strength</td>
				<td rowspan="2" class="legend2"></td>
				<td class="headings">Potential Strength</td>
			</tr>
			<tr>
				<td class="description">
					Scores of 51 or greater suggest that your child understands the strength and are able to actively draw upon it in multiple situations and settings.
				</td>
				
				<td class="description">
					Scores of 50 or lower suggest that this is an area that needs purposeful, strategic exploration and is an opportunity to build this strength within your students.
				</td>
			</tr>
		</table>


		
		<img src="{{ url('/public/front/img/report/charts/'.$chart) }}?t={{time()}}" class="width-100" style="margin-top:4cm;margin-left:-1cm;"/>
	</div>

	
	

	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100" />
	</div>

	<div class="page-break"></div>

	<div class="no-margin heading" style="margin-bottom:1cm;">
		10 Core Competencies of Character (cont.)
	</div>
	<br>
	<div class="competencies content">
		<p>
			The Core Character Traits questionnaire provides a balanced, evidence assessment of the foundational attitudes, skills and knowledge that are directly related to resiliency, well-being and success:
		</p>
		<br>
	<ol>
		<li>
			<b>Strengths-Based Aptitude (self-esteem) </b>
			<br>
			A positive view of the future with a clear understanding of strengths and how to use them in purposeful ways.
		</li>
		<li>
			<b>Emotional Competence (emotional awareness) </b>
			<br>
			Ability to identify, understand & express emotions in constructive ways.
		</li>
		<li>
			<b>Social Connectedness (social skills and relationships) </b>
			<br>
			Capacity to develop and maintain supportive & healthy relationships.</li>
		<li>
			<b>Moral Directedness (values) </b>
			<br>
			 Understanding of “right” and “wrong” that guides decision making and coping behaviour.</li>
		<li>
			
			<b>Adaptability (problem solving skills) </b>
			<br>
			 Good problem solving skills and an awareness that mistakes are opportunities to learn.</li>
		<li>
			<b>Managing Ambiguity (coping skills) </b>
			<br>
		 An ability to cope with stressful and/or uncertain situations in positive ways.</li>
		<li>
			<b>Agency and Responsibility (belonging and community conscientiousness) </b>
			<br>
			Capacity to be responsible and committed in positive ways when part of a group or social situation.</li>
		<li>
			<b>Persistence (positive hardiness) </b>
			<br>
		 The steadfastness, courage and motivation to do the hard, strategic work of overcoming challenging or stressful situations to achieve goals.</li>
		<li>
			<b>Passion (positive spark) </b>
			<br>
		 An intense and compelling enthusiasm for one or more interests, activities, causes or subjects.</li>
		<li>
			<b>Spiritual Eagerness (positive spiritual awareness) </b>
			<br>
		 Is engaged in a curious exploration of their spiritual sense of self and its implications for ones purpose and meaning in life.</li>
	</ol>
</div>

	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer3.jpg') }}" class="width-100" />
	</div>
@stop
