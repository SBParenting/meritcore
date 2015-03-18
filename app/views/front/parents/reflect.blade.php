@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="parent-guide-block parent-guide-header row">
                <a href="{{URL::to('children/select')}}" class="logo col-md-1"><img
                            src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                <div class="container">
                    <a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
                    <a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>

                    <div class="child-image">
                        <a href="#" class="logo">
                            <div class="logo child-thumbnail child-{{$child->sex}}">{{!empty($child->avatar) ? "<img src='".url('/public/uploads/children/squared-'.$child->avatar)."' />" : ""}}</div>
                            <p class="child-name">{{ $child->first_name }}</p></a>
                    </div>

                    <h1 class="parent-guide header-content">PARENT GUIDE</h1>

                    <div id="header-content">

                        <div class="track">
                            <p class="col-md-8 pull-right">{{$strengthScore->strength->name}}
                                <span>{{$strengthScore->strength->strengthGroup->name}}</span></p>
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
                    <div id="parent-guide-nav" class="col-md-12 collapse navbar-collapse">

                        <ul class="nav">
                            <li class="nav-item"><a href="{{URL::to('parents/empower/'.$strengthScore->id)}}"><img src="{{ url('public/front/img/empower-icon.png')}}"
                                                         height="32px" width="32px"/>EMPOWER</a></li>
                            <li class="nav-item border">
                                <a href="{{URL::to('parents/explore/'.$strengthScore->id)}}">
                                    <img
                                            src="{{ url('public/front/img/build-icon.png')}}" height="32px"
                                            width="32px"/>BUILD</a></li>
                            <li class="nav-item">
                                <a href="{{URL::to('parents/explore/'.$strengthScore->id)}}">
                                    <img src="{{ url('public/front/img/explore-icon.png')}}" height="32px"
                                         width="32px"/>
                                    EXPLORE
                                </a>
                            </li>
                            <li class="nav-item border ">
                                <a class="selected-item" href="{{URL::to('parents/reflect')}}">
                                    <img src="{{ url('public/front/img/reflect-icon.png')}}" height="32px"
                                         width="32px"/>
                                    REFLECT
                                </a>
                            </li>
                        </ul>
                    </div>
                    @if(isset($answer))
                        {{ Form::model($answer, ['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}
                    @else
                        {{ Form::open(['role' => 'form', 'novalidate', 'autocomplete' => 'Off', 'class' => 'submit-on-enter']) }}
                    @endif

                    <div class=" container-fluid first-step">
                        <p class="col-md-12 col-md-offset-1">
                            <strong>First:</strong><span> Reflect on the question below</span>
                        </p>
                    </div>
                    <div class="container-fluid questions-container">
                        <div class="col-md-12 col-md-offset-1 question-display">
                            <div class=" circle pull-left"><span class="question-number">{{$question->id}}</span>

                                <p class="question-amount">{{$question->id}} out of {{$total}} </p>
                            </div>
                            <p class="col-md-6 col-md-offset-1 question text-center">{{$question->question}}</p>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <label class="pull-left second-label">
                            <span>Second: </span>Click on what statement reflects you the best
                        </label>
                        <label class="pull-right third-label">
                            <span>Third:</span> Input your thoughts and reflections
                        </label>
                    </div>
                    <div class="container-fluid">

                        <div class="col-md-12 user-input">

                            <div class="col-md-4 col-md-offset-1 answer-selection">

                                <ul class=" col-md-12 answer-list">
                                    @foreach($question->reflectStatements as $statement)
                                        <li class="{{($statement->id - $statement->reflect_question_id) % 2 ? 'even' : 'odd'}}"
                                            data-id="{{ $statement->id }}">
                                            <a>{{$statement->statement}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                {{ Form::hidden('reflect_statement_id') }}

                            </div>
                            <div class="col-md-4 col-md-offset-1 user-feedback">
                                <div class="mic-button col-md-2 ">
                                    <img src="{{ url('public/front/img/mic-icon.png')}}" class="img-responsive">
                                </div>

                                {{ Form::textarea('thoughts') }}
                            </div>
                        </div>
                    </div>
                    {{ Form::hidden('total',$total) }}
                    <div class="container-fluid btns-container">
                        <button type="submit" class="pull-right btn btn-lg btn-warning btn-next"><i
                                    class="glyphicon glyphicon-arrow-right"></i> {{$question->id == $total ? "Next" : "Next Reflection"}}
                        </button>
                        <a href="{{URL::to('parents/reflect/'.$strengthScore->id.'/'.($question->id-1))}}"
                           class="{{$question->id == 1 ? "disabled" : ""}} pull-left btn btn-lg btn-primary btn-back "><i
                                    class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>

    </div>

    </div>
    </div>
@stop

@section('css')

    {{ HTML::style("public/front/css/main.css") }}

@stop

@section('script')
    <script>
        $(function () {
            $('.answer-list').find('li[data-id=' + $('input[name=reflect_statement_id]').val() + ']').addClass('active');
        });
        $('.answer-list').find('li').on('click', function () {
            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');

            $('input[name=reflect_statement_id]').val($(this).attr('data-id'));
        });
    </script>
@stop