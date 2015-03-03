@extends('front.survey.layout')

@section('content')

	<div class="container-page">
		
		<div class="wrapper">
			<div class="survey-block survey-header">
			    <a href="/" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}" /></a>
				<div class="container">
				    <a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
                    @if(!$children->isEmpty())
					<a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>
					 @endif
					<div class="col-md-6" style="float: right;">
					    <div class="logo child-selected"></div>
                        <h1 class="logo">Child Selection</h1>
                    </div>
				</div>
			</div>

			<div class="survey-block general-content page-signup">
                <div class="form-inner add-child-form">
		            <div class="purchase-app-btn">
		                <button class="btn btn-orange btn-lg">Purchase App </button>
                    </div>
					<div class="row col-md-11 select-child">
					 
                        <div id="Carousel">
		                    <ul class="flip-items">
                                @foreach($children as $child)
	    	 	                    <li>
                                        <a href="{{URL::to('children/'.$child->id)}}"><span>{{$child->first_name}}</span>
                                            @if($child->avatar)
                                                <img src="{{ url('/public/uploads/children/squared-'.$child->avatar) }}" />
                                            @else
                                                <img src="{{ url('/public/front/img/'.$child->sex.'.png') }}" style="background-color: white;" />
                                            @endif
                                        </a>

                                        <span class="survey">@if(!isset($survey[$child->id]) || $survey[$child->id] != "Completed")<a href="/survey/{{ $child->id }}">Start Survey</a>@else <a class="disabled">Survey Completed</a>@endif</span>
                                    </li>
                                @endforeach
                                    <li><a href="{{URL::to('children/add')}}"><img src="{{ url('public/front/img/add-child.png') }}" /></a></li>
		                    </ul>
                		</div>
					</div>
				</div>
			</div>

		</div>
	</div>
@stop
@section('script')

<script type="text/javascript">

	$( document ).ready(function(){

		$("#Carousel").flipster({
			start: 0,
			enableNavButtons: true,
            onItemSwitch: function() {
                var image = new Image();
                image.src = $('#Carousel').find('.flip-current').find('img').attr('src');
                $('.child-selected').html(image);
            }
		});

        $('.flipto-prev').addClass('fa fa-arrow-left');
        $('.flipto-next').addClass('fa fa-arrow-right');
    });


</script>

@stop

@section('css')

{{HTML::style("public/front/css/main.css") }}
{{HTML::style("public/front/libs/flipster/src/css/jquery.flipster.css")}}

    <style type="text/css">
        .flip-items li span {
            display: block;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: white;
        }

        .flip-items li a {
            text-decoration: none;
        }

        .flipto-prev, .flipto-prev:hover, .flipto-next, .flipto-next:hover {
            color:transparent!important;
            text-decoration: none!important;
        }

        .flipto-prev:before,.flipto-next:before {
            color:black;
            font-size:35px;
        }

        .flipto-next {
            float:right;
        }

        .flip-item .survey {
            display:none;
        }

        .flip-current .survey {
            display:block;
            border: 1px solid black;
            padding: 20px inherit;
            margin-top: 20px;
        }
    </style>

@stop


