@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="parent-guide-block parent-guide-header ">
                <a href="{{URL::to('children/select')}}" class="logo col-md-1 sbp-logo"><img
                            src="{{ url('public/front/img/logo-sbp.png') }}"/></a>

                <div class="container">
                    <a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
                    <a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>

                    <div class="child-image">
                        <a href="#" class="logo">
                            <div class="logo child-thumbnail child-{{$child->sex}}">{{!empty($child->avatar) ? "<img src='".url('/public/uploads/children/squared-'.$child->avatar)."' />" : ""}}</div>
                            <p class="child-name">{{ $child->first_name }}</p></a>
                    </div>

                    <h1 class="parent-guide">PARENT GUIDE</h1>

                    <div id="header-content">

                        <div class="track">
                            <p class="col-md-8 pull-right">{{$strengthScore->strength->name}}
                                <span>{{$strengthScore->strength->strengthGroup->name}}</span>
                            </p>
                        </div>

                        <div class="col-md-2">
                            <div class="track-percent"><span class="percent"><p>{{$strengthScore->score}}%</p></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parent-guide-block parent-guide-content ">
                <div class="form-inner parent-reflect-inner">

                    <nav id="parent-guide-nav" class=" container-fluid" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle pull-left" data-toggle="collapse"
                                    data-target=".parent-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class=" toggle-nav fa fa-bars"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse parent-nav">
                            <ul class="nav">
                                <li class="nav-item"><a href="{{URL::to('parents/empower/'.$strengthScore->id)}}"><img src="{{ url('public/front/img/empower-icon.png')}}"
                                                             height="32px" width="32px"/>EMPOWER</a></li>
                                <li class="nav-item border"><a class="selected-item"><img
                                                src="{{ url('public/front/img/build-icon.png')}}" height="32px"
                                                width="32px"/>BUILD</a></li>
                                <li class="nav-item"><a class="selected-item"><img
                                                src="{{ url('public/front/img/explore-icon.png')}}" height="32px"
                                                width="32px"/>EXPLORE</a></li>
                                <li class="nav-item border "><a
                                            href="{{URL::route('parents.reflect',[$strengthScore->id,1])}}"><img
                                                src="{{ url('public/front/img/reflect-icon.png')}}" height="32px"
                                                width="32px"/>REFLECT</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="explore-build-content container-fluid">
                        <div class="explore-container container-fluid" class="col-md-11">
                            <div class="explore-inner col-md-9 col-xs-9 col-md-offset-2 col-xs-offset-2">
                                <span class="title-text-exp ">EXPLORE </span>
                                `
                                @if (isset($explore[0]))
                                    @include('front.parents.sections.question', ['question' => $explore[0]])
                                @else
                                    <a href="{{URL::to('parents/explore/pick/'.$strengthScore->id)}}">
                                        @include('front.parents.sections.click', ['line' => 'explore'])
                                    </a>
                                @endif

                                @if (isset($explore[1]))
                                    @include('front.parents.sections.question', ['question' => $explore[1]])
                                @else
                                    <a href="{{URL::to('parents/explore/pick/'.$strengthScore->id)}}">
                                        @include('front.parents.sections.click', ['line' => 'explore'])
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="build-container container-fluid" class="col-md-11">
                            <div class="build-inner col-md-9 col-xs-9 col-xs-offset-2 col-md-offset-2">
                                <span class="title-text-build ">BUILD</span>
                                `
                                @if (isset($explore[0]) && count($explore[0]->buildOption))
                                    @include('front.parents.sections.pick',['question' => $explore[0], 'sid' => $strengthScore->id])
                                @else
                                    <a href="{{isset($explore[0]) ? URL::to('parents/build/pick/'.$strengthScore->id.'/'.$explore[0]->exploreQuestion->id) : '#' }}">
                                        @include('front.parents.sections.click',['line'=>'build'])
                                    </a>
                                @endif

                                @if (isset($explore[1]) && count($explore[1]->buildOption))
                                    @include('front.parents.sections.pick',['question' => $explore[1], 'sid' => $strengthScore->id])
                                @else
                                    <a href="{{isset($explore[1]) ? URL::to('parents/build/pick/'.$strengthScore->id.'/'.$explore[1]->exploreQuestion->id) : '#' }}" class="{{!isset($explore[1]) ? "disabled" : ""}}">
                                        @include('front.parents.sections.click',['line'=>'build'])
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluid btns-container">
                            <a href="{{URL::to('parents/empower/'.$strengthScore->id)}}" class="{{$enableEmpower ? "" : "disabled"}} pull-right btn btn-lg btn-warning next-btn"><i
                                        class="glyphicon glyphicon-arrow-right"></i> Next </a>
                            <a href="#" class="pull-left btn btn-lg btn-primary back-btn"><i
                                        class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    {{HTML::script("public/front/libs/bootstrap-star/js/star-rating.js")}}
    <script>
        $(".rating").rating({
            min: 0,
            max: 10,
            step: 1,
            size: 'lg',
            showCaption: false
        }).on('rating.change',function(e,val){
            $.post("/parents/explore/setRating",{
                score:val,
                answer_id:$(this).attr('data-answer-id')
            },function() {
            });
        });
    </script>
@stop

@section('css')
    {{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}
    {{ HTML::style("public/front/css/main.css") }}

@stop