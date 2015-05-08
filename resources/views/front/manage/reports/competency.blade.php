<?php set_time_limit(300); ?>

@extends('common.layout.report')

@section('title')
	
	Report
	
@stop

@section('page1')
	
	<img src="{{ url('public/front/img/report/postPage1.png') }}" class="width-100"/>
	<div class="page-break"></div>
@stop

@section('content')
	
		<div class="heading" style="display:block;">
			Summary Report Details
		</div>
		
		<div class="content white width-100"> 
			<div id="left-content">
				<table>
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
						<td class="lable" rowspan="2"><b>Quesstionnaire Type:</b></td>
						<td>{{ ($preSurvey." - ".$preCampaign) }}</td>
					</tr>
					<tr>
						<td>{{ ($postSurvey." - ".$postCampaign) }}</td>
					</tr>
					<tr>
						<td><b>Date of Report:</b></td>
						<td>{{ date("F j, Y") }}</td>
					</tr>
					<tr>
						<td><b>Questionnaires Date Range:</b></td>
						<td>{{ get_date($survey->start_date, "F j, Y") }} - {{ get_date($survey->end_date, "F j, Y") }} </td>
					</tr>
				</table>
			</div>
			<div id="student-summary">
				<b>Overall No. of Student: </b>{{ $survey->count_total }}<br />
				<b>PRE = </b>{{ $student_pre }}<br />
				<b>POST = </b>{{ $student_post }}<br />
				<b>N = </b>{{ $student_both }}<br />
			</div>
		</div>

		<div class="content">
			<p><b>Table of Contents</b></p>
			<br/>
			<table class="width-100">
				<tr class="grey">
					<td align="center" width="10%"><b> Page No. </b></td>
					<td><b> Content </b></td>
				</tr>
				<tr class="light-grey">
					<td align="center">1</td>
					<td align="left">Introduction</td>
				</tr>
				<tr>
					<td align="center">2</td>
					<td align="left">10 Core Competencies of Character Report</td>
				</tr>
				<tr class="light-grey">
					<td align="center">3</td>
					<td align="left">Number of Student who improved</td>
				</tr>
				<tr>
					<td align="center">4</td>
					<td align="left">Number of Student who moved to 'Strength'</td>
				</tr>
				<tr class="light-grey">
					<td align="center">5</td>
					<td align="left">Student Engagement</td>
				</tr>
				<tr>
					<td align="center">7</td>
					<td align="left">Program Impact</td>
				</tr>
				<tr class="light-grey">
					<td align="center">9</td>
					<td align="left">Appendix A</td>
				</tr>
				<tr>
					<td align="center">10</td>
					<td align="left">Appendix B</td>
				</tr>
			</table>
			<br/>
			<p>For many young people, the transition through early childhood toward the teenage years can be challenging with increased involvement in what have been called risk behaviours including school failure, truancy at school, substance abuse, violence and negative peer involvement. As a result, there has been a focus on understanding "what goes wrong". However, a risk-focused approach tends to neglect the fact that childhood and adolescent years are a critical period of time where young people start to develop the ability to navigate and negotiate life's challenges through exploring their unique talents, strengths, skills and interests. This emphasis on these positive and adaptive aspects are often referred to as "positive youth development" where healthy development is not identified as the absence of risk or challenges. Rather, it is the presence of positive core social and emotional character traits that enable young people to reach their full potential and successfully transition through the teenage years toward adulthood.</p>

			<center>
				<img src="{{ url('public/front/img/report/impact_soc.jpg') }}" style="margin-top:0.5cm" width="40px" height="50px"/>
				<img src="{{ url('public/front/img/report/'.\App\Models\Survey::getImage($survey->survey_id).'Logo.png') }}" style="margin-top:0.5cm;margin-left:20px;margin-bottom:15px;" width="90px" height="25px"/>
			</center>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer1.png') }}" class="width-100" />
		</div>

	<div class="page-break"></div>

		<div class="no-margin heading" style="margin-bottom:1cm;">
			10 Core Competencies of Character
		</div>
		<br>
		<div class="competencies content">
			<p>
				The 10 Core Competencies of Character Survey (CCCS) provides a balanced, evidence assessment of the foundational attitudes, skills and knowledge that are directly related to resiliency, well-being and success:
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
			<img src="{{ url('public/front/img/report/pageFooter.jpg') }}" class="width-100" />
			<div class="page-number">2</div>
			
		</div>
		<!-- <div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100" />
		</div> -->

	@if(isset($improve))
	<div class="page-break"></div>
		<div class="no-margin heading">
			Class Results of Core Competencies of Character 
		</div>
		<br>
		<div class="content">
			<p>
				The following report summarizes the aggregated (non-identified) results of {{ ucwords(substr($preSurvey, 0,11)) }} student's who completed the CCCS. *Prior to reviewing this information, please read the <strong>Limitations and Confidentiality</strong> statements in Appendix A.
			</p>
			<br>
			<br>
			<br>
			<p><strong>Chart 1: Number of Students Who Improved</strong></p>
			<br>
			<p>The chart below shows the number of {{ ucwords(substr($preSurvey, 0,11)) }} students who demonstrated an increase in their ability to understand and draw upon each of the Core Competencies of Character upon completion of the program.</p>
			<div style="height:500px;max-height:500px;overflow:hidden;" class="width-100">
				<img src="{{ url('/public/front/img/report/charts/'.$improve) }}?t={{time()}}" height="100%" class="width-100"/>
			</div>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer3.jpg') }}" class="width-100" />
		</div>
	@endif

	@if(isset($demonstrate))
	<div class="page-break"></div>
		
		<div class="no-margin heading">
			Class Results of Core Competencies of Character (Cont..)
		</div>
			<br>
			<div class="content">
			<p><strong>Chart 2: Number of Students who Now Demonstrate Strength</strong></p>
			<br>
			<p>The following chart shows the number of {{ ucwords(substr($preSurvey, 0,11)) }} students who demonstrated moving from vulnerability to strength
	in each of the Core Competencies of Character upon completion of the program.</p>
			<div style="height:500px;max-height:500px;overflow:hidden;" class="width-100">
				<img src="{{ url('/public/front/img/report/charts/'.$demonstrate) }}?t={{time()}}" height="100%" class="width-100"/>
			</div>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer4.png') }}" class="width-100" />
		</div>
	@endif

	@if(isset($gdata_2))
	<div class="page-break"></div>
		
		<div class="no-margin heading">
			Student Engagement
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
				<table width="100%" class="table table-striped" style="border-top: 0.5px solid black;margin-bottom:0.25cm;">
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
			<img src="{{ url('public/front/img/report/footer5.png') }}" class="width-100" />
		</div>
	@endif

	@if(isset($gdata_3))
	<div class="page-break"></div>
	
		<div class="no-margin heading">
			Program Impact
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
						<div class="footer no-margin">
							<img src="{{ url('public/front/img/report/footer6.png') }}" class="width-100" />
						</div>
						<div class="page-break"></div>
						<div class="no-margin heading">
							Program Impact (cont.) 
						</div>
						<br>
						<div class="content">
						
					@endif
				<table width="100%" class="table table-striped" style="border-top: 0.5px solid black;margin-bottom:0.25cm;">

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
			<img src="{{ url('public/front/img/report/footer7.png') }}" class="width-100" />
		</div>
	@endif

	<!-- <div class="page-break"></div>

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
					<td width="10%"></td>
					<td rowspan="2" class="legend2"></td>
					<td class="headings">Potential Strengths</td>
				</tr>
				<tr>
					<td class="description">
						Scores of 51 or greater suggest that your child understands the strength and are able to actively draw upon it in multiple situations and settings.
					</td>
					<td width="10%"></td>
					<td class="description">
						Scores of 50 or lower suggest that this is an area that needs purposeful, strategic exploration and is an opportunity to build this strength within your students.
					</td>
				</tr>
			</table>
			<img src="{{ url('/public/front/img/report/charts/'.$ccc) }}?t={{time()}}" class="width-100" style="margin-left:-1cm;float:right;"/>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer8.png') }}" class="width-100"/>
		</div>
 -->
	<div class="page-break"></div>

		<div class="no-margin heading">
			Appendix A
		</div>
			
		<div class="content">
			<p><b>Limitations and Confidentiality: </b></p>
			<ul>
				<li>As with all self-assessment questionnaires, the results are limited by insight and honesty and require further exploration of the respondent's context. </li>
				<li>The questionnaire administered was designed to assess developmentally important character traits research has identified as essential for success in life and is not intended to be used for a more formal diagnosis (i.e. mental illness, health and/or wellness). </li>
				<li>All contents of this report are CONFIDENTIAL and only reported in an aggregated/non-identifiable format to be used for the purposes agreed upon by the respondent and/or their parents/guardians and/or caregivers. </li>
			</ul>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer8.png') }}" class="width-100"/>
		</div>


	<div class="page-break"></div>

		<div class="no-margin heading">
			Appendix B
		</div>
				
		<div class="content">
			<center><strong>Core Character Competencies and Positive Youth Development</strong></center>
			<center><blockquote><p>"Modeling isn't one way of influencing people. It's the only way"</p><footer><cite id="author" title="Source Title">- Albert Einstein</cite></footer></blockquote></center>
			<br/>
			<p>For many children, the transition through early childhood towards the teenage years can be challenging with increased involvement in what have been called risk behaviours or problem behaviours, including school failure, truancy at school, substance abuse, violence and negative peer involvement. As a result, the tendency of community interventions has been a focus on trying to understand "what goes wrong" in so called troubled children and the development of problem- specific programs. But a risk-focused approach tends to neglect the fact that childhood years are a critical period of time where a child starts to develop the ability to navigate and negotiate life's challenges through exploring their unique talents, strengths, skills and interests. This emphasis on the positive and adaptive aspects of child and youth development is often referred to as "positive youth development". From this perspective, positive childhood health is not identified as the absence of risk or challenges. Rather, it is the presence of positive core social and emotional character traits that enable a child to reach their full potential and successfully transition through the teenage years towards adulthood.</p>
			<br/>
			<p>
				Although there is not a universally agreed-on list of key character traits of positive childhood development, the following is Resiliency Initiatives' Core Competencies of Character framework. These Core Competencies of Character are the foundational attitudes, skills and knowledge that are directly related to social capacity, well-being and success:
			</p>

			<ol>
				<li>
					Social Connectedness (Positive Social Skills) - Knows how to develop and maintain strong, supportive, and healthy relationships.
				</li>
				<li>
					Ambiguity (Positive Coping Skills) - An ability to cope with stressful situations or experiences in positive ways.
				</li>
				<li>
					Adaptability (Positive Adaptability) - Has good problem solving skills and knows that making mistakes is part of life and a way to learn.
				</li>
				<li>
					Sense of Agency (Positive Group Membership Skills) - Knows the importance of being responsible and committed in positive ways when part of a group or social situation (e.g. member of a school, family or group of friends, etc.).
				</li>
				<li>
					Moral Directedness (Positive Values and Principles) - Knows that there are basic values of "right" and "wrong" and uses them in their decisions making and coping behaviour.
				</li>
				<li>
					Strengths-Based Aptitude (Positive Self-Esteem) - Has a positive view of the future and a clear understanding of what their strengths are as well as how to use them in purposeful ways.
				</li>
				<li>
					Emotional Connectedness (Positive Emotional Awareness) - Knows how to accurately identify, understand and express emotions in constructive ways.
				</li>
				<li>
					Persistence (positive hardiness) - The steadfastness, courage and motivation to do the hard, strategic work of overcoming challenging or stressful situations to achieve goals.
				</li>
				<li>
					Passion (positive spark) - An intense and compelling enthusiasm for one or more interests, activities, causes or subjects.
				</li>
				<li>
					Spiritual Eagerness (positive spiritual awareness) - Is engaged in a curious exploration of their spiritual sense of self and its implications for ones purpose and meaning in life.
				</li>
			</ol>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer9.png') }}" class="width-100"/>
		</div>

	<div class="page-break"></div>

		<div class="no-margin heading">
			Appendix B (cont.)
		</div>

		<div class="content">

			<p>
				If character is a key aspect to healthy development in children and youth, one must ask what are the essential traits to focus on and how are they best developed. Research is clear that an individual develops positive character traits primarily based upon imitating the character qualities of the significant relational influences in their lives. It is about purposefully modeling the desired character traits by showing a child or youth what kind of person they should be, by being that kind of person yourself. Children do not develop their values and character by being told how to think and act, rather it is through their desire to be like and imitate the qualities of someone they value and respect. Providing knowledge and skill building opportunities is important, but a person's purposeful use of knowledge and skill acquisition is based on the quality of a supporting relationship, the meaningfulness of the interactions and activities that occur and the overall approach that is used. People talk about the many ways of instilling or fostering good character traits, but the most basic and powerful method of them all is by demonstrating those traits in yourself as a coach, mentor, parent, etc.
			</p>
			<br/>
			<p>
				Essential traits of significant adults who nurture those Core Competency of Character in children are:
			</p>

			<ul>
				<li>
					They are empathetic
				</li>
				<li>
					Communicate effectively and listen actively
				</li>
				<li>
					Understand the need to change "negative scripts"
				</li>
				<li>
					Care in ways that youth feel special and appreciated
				</li>
				<li>
					Accept youth for who they are and help them to set realistic expectations and goals
				</li>
				<li>
					Help youth experience success by identifying and reinforcing their "islands of competence"
				</li>
				<li>
					Help youth realize that mistakes are experiences from which to learn
				</li>
				<li>
					Support the development of responsibility, compassion and a social conscience by providing youth with opportunities to contribute
				</li>
				<li>
					Teach youth to solve problems and make decisions
				</li>
				<li>
					Set boundaries and expectations in ways that promotes self-discipline and self-worth
				</li>
			</ul>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer10.png') }}" class="width-100"/>
		</div>

	<!-- <div class="page-break"></div>

		<div class="no-margin heading">
			Appendix C
		</div>

		<div class="content">
			<table class="table table-striped" border="2" width="100%">
				<tr>
					<td width="50%"><strong> Strength-Based Concepts </strong> </td>
					<td width="50%"><strong> Deficit-Based Concepts</strong> </td>
				</tr>
				<tr>
					<td> At-Potential </td>
					<td> At-Risk </td>
				</tr>
				<tr>
					<td> Strengths </td>
					<td> Problems </td>
				</tr>
				<tr>
					<td> Engage </td>
					<td> Intervene </td>
				</tr>
				<tr>
					<td> Persistent </td>
					<td> Resistant </td>
				</tr>
				<tr>
					<td> Understand </td>
					<td> Diagnose </td>
				</tr>
				<tr>
					<td> Opportunity </td>
					<td> Crisis </td>
				</tr>
				<tr>
					<td> Celebrate (i.e. successes) </td>
					<td> Punish (i.e. non-compliance) </td>
				</tr>
				<tr>
					<td> Time in </td>
					<td> Time out </td>
				</tr>
				<tr>
					<td> Adopt-to </td>
					<td> Reform </td>
				</tr>
				<tr>
					<td> Empower </td>
					<td> Control </td>
				</tr>
				<tr>
					<td> Process-focuseda </td>
					<td> Behaviour-focuseda </td>
				</tr>
				<tr>
					<td> Dynamic </td>
					<td> Static </td>
				</tr>
				<tr>
					<td> Movement </td>
					<td> Epidemic </td>
				</tr>
				<tr>
					<td> Unique </td>
					<td> Deviant </td>
				</tr>
				<tr>
					<td> Avoids-imposition </td>
					<td> Dominant knowledge </td>
				</tr>
				<tr>
					<td> Process oriented </td>
					<td> Mandate oriented </td>
				</tr>
			</table>
		</div>
		<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100"/>
		</div>-->

	<!-- <div class="page-break"></div>

		<div class="no-margin heading">
			Appendix D
		</div>

		<div class="content">
			<p><strong>Recommended Readings</strong></p>
			<p>Goleman, D. (1995). <i>Emotional intelligence. New York: Bantam Books.</i></p>
			<p>Hammond, W. (2012). <i>Embracing a Strength-Based Perspective and Practice in Education.</i></p>
			<p>Henderson, N., Benard, B., & Sharp-Light, N. (2000) <i>Mentoring for resiliency: Setting up programs for moving youth from "stressed to success."</i> San Diego, CA: Resiliency in Action.</p>
			<p>Henderson, N., & Milstein, M. M., (2003) <i>Resiliency in Schools: Making it happen for students and educators.</i> Thousand Oaks, CA: Corwin Press.</p>
			<p>Henderson, N., & Sharp-Light, N., & Benard, B. eds. (1999) <i>Schoolwide approaches for fostering resiliency.</i> San Diego, CA: Resiliency in Action, Inc.</p>
			<p>Sanchez, H. (2003) <i>The mentors guide to promoting resiliency.</i> Xlibris Corp.</p>
			<p>Seligman, M. L. P. (1998) <i>Learned optimism: How to change your mind and your life.</i> New York: Simon and Shuster.</p>
			<p>Seligman, M. L. P. (2007). <i>The optimistic child: A proven program to safeguard children against depression and build lifelong resilience.</i> New York: Houghton Mifflin Harcourt.</p>
			<p>Ungar, M. (2002) <i>Playing at being bad: The hidden resilience of troubled teens.</i> Halifax: Nimbus.</p>
			<p>Ungar, M. (2007) <i>Too safe for their own good: How risk and responsibility help teens thrive.</i> Toronto: McClelland and
			Stewart.</p>
			<p>Waxman, H.C., Padron, Y., & Gray, J.P. (2004). <i>E</i>ducational resiliency: Student, teacher and school perspectives.</i> Greenwich: Information Age Publishing.</p>

		</div> -->
		<!--<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100"/>
		</div>-->

	<!-- <div class="page-break"></div>

		<div class="no-margin heading">
			Appendix E
		</div>

		<div class="content">
			<table width="100%" class="table table-striped" style="border-top: 0.5px solid black;margin-bottom:0.25cm;">
									<tr>
						<td width="2%"> 1. </td>
						<td width="60%"> What Grade are you in? </td>
						<td width="8%" align="right"> Answer </td>
						<td width="15%" align="right"> Count </td>
						<td width="15%" align="right"> Total % </td>
					</tr>
			</table>
			@foreach($grade as $data)
			<table width="100%" class="table table-striped" style="border-bottom: 0.5px solid black;">
					<tr>
						<td width="2%"></td>
						<td width="60%"><div style="width:{!! (($totalStudents) == 0) ? 0 : ($data[1]*100)/($totalStudents) !!}%;min-height:5px;background:#9fc24d;color:white;{!! ($data[1] == 0) ? '' : 'padding:3px 10px;' !!} text-align:left;">{{ ($data[1]==0)?'':$data[1] }}</div></td>
						<td width="8%" align="right"> {{ $data[0] }}</td>
						<td width="15%" align="right"> {{ $data[1] }}</td>
						<td width="15%" align="right">{{ (($totalStudents) == 0) ? 0 : round(($data[1]*100)/($totalStudents)) }}%</td>
					</tr>
			@endforeach
			</table>
		</div> -->
		<!--<div class="footer no-margin">
			<img src="{{ url('public/front/img/report/footer2.png') }}" class="width-100"/>
		</div>-->

@stop
