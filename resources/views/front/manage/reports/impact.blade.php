<?php set_time_limit(300); ?>

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
	
	<table class="content white width-100" style>
		<tr>
			<td class="lable"><b>School Name:</b></td>
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
			<td>{{ get_date($survey->start_date, "M j/y") }} - {{ get_date($survey->end_date, "M j/y") }} </td>
		</tr>
	</table>

	<br />
	
	<div class="content">
	<p>The following report summarizes the aggregated (non-individual) results of HEROES® student's who completed the widely used self-assessment questionnaire.</p>

	<p>The following link provides a document with general comments intended to assist the interpretation and exploration of the Core 
Character Trait Questionnaire results and graphs.</p>

	<p>Prior to reviewing this information, please read the Limitations and Confidentiality statements below.</p>

	<p><b>Limitations and Confidentiality: </b></p>
	<ul>
		<li>As with all self-assessment questionnaires, the results are limited by insight and honesty and require further exploration of the respondent's context. </li>
		<li>The questionnaire administered was designed to assess developmentally important character traits research has identified as essential for success in life and is not intended to be used for a more formal diagnosis (i.e. mental illness, health and/or wellness). </li>
		<li>All contents of this report are CONFIDENTIAL and only reported in an aggregated/non-identifiable format to be used for the purposes agreed upon by the respondent and/or their parents/guardians and/or caregivers. </li>
	</ul>
</div>
	<center><img src="{{ url('public/front/img/report/impact_soc.jpg') }}" style="margin-top:2cm;" width="80px" height="105px"/><img src="{{ url('public/front/img/report/'.\App\Models\Survey::getImage($survey->survey_id).'Logo.png') }}" style="margin-top:2cm;margin-left:20px;margin-bottom:15px;" width="180px" height="50px"/></center>
	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer1.png') }}" class="width-100" />
	</div>
@if(isset($gdata_2))
<div class="page-break"></div>
	
	<div class="no-margin heading" style="margin-bottom:1cm;">
		Engagement
	</div>
	<br>
	<div class="content">
		<p>
			Research is clear that an individual develops positive character traits primarily based upon imitating the character qualities of significant people they are engaged with in their lives. It is about purposefully engaging children and youth and modeling the desired character traits by showing them what kind of person they should be, by being that kind of person yourself. Young people do not develop their values and character by being told how to think and act, rather it is through their desire to be like and imitate the qualities of someone they value and respect. Providing knowledge and skill building opportunities is important, but a person's purposeful use of knowledge and skill acquisition is based on the quality of a supporting relationship, the meaningfulness of the interactions and activities that occur and the overall approach that is used. People talk about the many ways of instilling or fostering good character traits, but the most basic and powerful method of them all is by demonstrating those traits in yourself as a teacher, administrator, coach, mentor, parent, etc.
		</p>
		<p>
			The following results show the degree to which students felt engaged in meaningful activities and relationship with their instructor:
		</p>
		<br />
		<?php $i = 0; ?>
		@foreach($gdata_2 as $data)
			<?php $i++; ?>
			<table width="100%" class="table table-striped">
				<tr>
					<td width="5%"> {{ $i }} </td>
					<td> {{ $data[0] }} </td>
					<td width="20%" align="center"> Count </td>
					<td width="20%" align="center"> Total % </td>
				</tr>
				<tr>
					<td></td>
					<td><div style="width:{!! (($data[1] + $data[2]) == 0) ? 0 : ($data[1]*100)/($data[1]+$data[2]) !!}%;background:#9fc24d;color:white;{!! ($data[1] == 0) ? '' : 'padding:3px 10px;' !!} text-align:left;">Yes</div></td>
					<td align="center"> {{ $data[1] }}</td>
					<td align="center">{{ (($data[1] + $data[2]) == 0) ? 0 : round(($data[1]*100)/($data[1]+$data[2])) }}%</td>
				</tr>
				<tr>
					<td></td>
					<td><div style="width:{!! (($data[1] + $data[2]) == 0) ? 0 : ($data[2]*100)/($data[1]+$data[2]) !!}%;background:#e0b049;color:white;{!! ($data[2] == 0) ? '' : 'padding:3px 10px;' !!}text-align:left;">No</div></td>
					<td align="center"> {{ $data[2] }}</td>
					<td align="center">{{ (($data[1] + $data[2]) == 0) ? 0 : round(($data[2]*100)/($data[1]+$data[2])) }}%</td>
				</tr>
			</table>
		@endforeach
		
	</div>
	
	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100" />
	</div>
	@endif
	@if(isset($gdata_3))
		<div class="page-break"></div>
	
	<div class="no-margin heading" style="margin-bottom:1cm;">
		Impact
	</div>
	<br>
	<div class="content">
		<p>
			The data below shows the percentage of participants who reported a positive impact by the program in the following areas:
		</p>
		<br />
		<?php $i = 0; ?>
		@foreach($gdata_3 as $data)
			<?php $i++; ?>
			@if($i == 8)
					</div>
					<div class="page-break"></div>
					<div class="no-margin heading">
						Class Results of Core Character Trails 
					</div>
					<br>
					<div class="content">
					
				@endif
			<table width="100%" class="table table-striped">

				<tr>
					<td width="5%"> {{ $i }} </td>
					<td> {{ $data[0] }} </td>
					<td width="20%" align="center"> Count </td>
					<td width="20%" align="center"> Total % </td>
				</tr>
				<tr>
					<td></td>
					<td><div style="width:{!! (($data[1] + $data[2]) == 0) ? 0 : ($data[1]*100)/($data[1]+$data[2]) !!}%;background:#9fc24d;color:white;{!! ($data[1] == 0) ? '' : 'padding:3px 10px;' !!} text-align:left;">Yes</div></td>
					<td align="center"> {{ $data[1] }}</td>
					<td align="center">{{ (($data[1] + $data[2]) == 0) ? 0 : round(($data[1]*100)/($data[1]+$data[2])) }}%</td>
				</tr>
				<tr>
					<td></td>
					<td><div style="width:{!! (($data[1] + $data[2]) == 0) ? 0 : ($data[2]*100)/($data[1]+$data[2]) !!}%;background:#e0b049;color:white;{!! ($data[2] == 0) ? '' : 'padding:3px 10px;' !!}text-align:left;">No</div></td>
					<td align="center"> {{ $data[2] }}</td>
					<td align="center">{{ (($data[1] + $data[2]) == 0) ? 0 : round(($data[2]*100)/($data[1]+$data[2])) }}%</td>
				</tr>
			</table>
		@endforeach
		
		
	</div>
	
	@endif
	@if(isset($improve))
		<div class="page-break"></div>
	
	<div class="no-margin heading">
		Class Results of Core Character Trails 
	</div>
	<br>
	<div class="content">
		<p>
			The following report summarizes the aggregated (non-individual) results of HEROES2® student's who completed the widely used self-assessment questionnaire. *Prior to reviewing this information, please read the <strong>Limitations and Confidentiality</strong> statements in Appendix A.
		</p>
		<br>
		<br>
		<br>
		<p><strong>Chart 1: Number of Students Who Improved</strong></p>
		<br>
		<p>The chart below shows the number of HEROES® students who demonstrated an increase in each of the Core
Character Traits upon completion of the program.</p>
		<div style="height:500px;max-height:500px;overflow:hidden;" class="width-100">
			<img src="{{ url('/public/front/img/report/charts/'.$improve) }}?t={{time()}}" height="100%" class="width-100"/>
		</div>
	</div>
	@endif

	@if(isset($improve))
		<div class="page-break"></div>
	
	<div class="no-margin heading">
		Class Results of Core Character Trails (Cont..)
	</div>
		<br>
		<div class="content">
		<p><strong>Chart 2: Number of Students who Now Demonstrate Strength</strong></p>
		<br>
		<p>The following chart shows the number of HEROES2® students who demonstrated moving from vulnerability to strength
in each of the Core Character Traits upon completion of the program.</p>
		<div style="height:500px;max-height:500px;overflow:hidden;" class="width-100">
			<img src="{{ url('/public/front/img/report/charts/'.$demonstrate) }}?t={{time()}}" height="100%" class="width-100"/>
		</div>
		
	</div>
	
	@endif
<div class="page-break"></div>

	<div class="no-margin heading">
		10 Core Competencies of Character
	</div>
		
	<div style="padding:2cm;">
		<p>
			<b>The graph below shows the number of HEROES® students who demonstrated strength (as indicated by the Green bar) and potential strength (as indicated by the Yellow bar) in each of the Core Character Traits detailed on the following page.</b>
		</p>

		<table class="legend" style="margin-top:0.5cm;margin-bottom:1cm;">
			<tr>
				<td rowspan="2" class="legend1"></td>
				<td class="headings">Optimal Strengths</td>
				<td></td>
				<td rowspan="2" class="legend2"></td>
				<td class="headings">Potential Strengths</td>
			</tr>
			<tr>
				<td class="description">
					Scores of 51 or greater suggest that your child understands the strength and are able to actively draw upon it in multiple situations and settings.
				</td>
				<td></td>
				<td class="description">
					Scores of 50 or lower suggest that this is an area that needs purposeful, strategic exploration and is an opportunity to build this strength within your students.
				</td>
			</tr>
		</table>
		<div style="transform:rotate(-90deg);display: -webkit-inline-box;float:left;margin-left:-80px;margin-top:-170px;font-size:x-large;border:2px solid red;">
											Number of Students
										</div>
		<img src="{{ url('/public/front/img/report/charts/'.$ccc) }}?t={{time()}}" class="width-100" style="margin-left:-1cm;float:right;"/>
	</div>
	
	<div class="footer no-margin">
		<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100"/>
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
	<ol  style="marker-offset:4px;list-style:outside;">
		<li class="first">
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
