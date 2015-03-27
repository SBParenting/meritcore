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
                    <div id="parent-guide-nav" class="col-md-12 collapse navbar-collapse">

                        <ul class="nav">
                            <li class="nav-item"><a class="empower-selected"><img
                                            src="{{ url('public/front/img/empower-icon.png')}}" height="32px"
                                            width="32px"/>EMPOWER</a></li>
                            <li class="nav-item border"><a href="{{URL::to('parents/explore')}}"><img
                                            src="{{ url('public/front/img/build-icon.png')}}" height="32px"
                                            width="32px"/>BUILD</a></li>
                            <li class="nav-item"><a href="{{URL::to('parents/explore')}}"><img
                                            src="{{ url('public/front/img/explore-icon.png')}}" height="32px"
                                            width="32px"/>EXPLORE</a></li>
                            <li class="nav-item border "><a href="{{URL::to('parents/reflect')}}"><img
                                            src="{{ url('public/front/img/reflect-icon.png')}}" height="32px"
                                            width="32px"/>REFLECT</a></li>
                        </ul>
                    </div>


                    <div class="container-fluid step-back-section-top table-display">
                        <div class=" col-md-12 step-back-dark-green table-row">
                            <div class="step-back text-center table-cell">
                                <h2 class="text-center">step back</h2>

                                <p class="text-center">(there has been a slight difference between you and your
                                    child's<br>view of the development in this strength) </p>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid step-back-light-green table-display">
                        <div class=" light-green-content table-row">
                            <h3 class="text-center table-cell">{{$strengthScore->strength->name}}</h3>
                        </div>
                    </div>

                    <div class="container-fluid step-back-list-container">
                        <div class=" col-md-6 col-md-offset-3">
                            <ol>
                                <li>Take a few minutes to talk with your child about how strong he or she feels in this
                                    area and why.
                                </li>
                                <li>Share how strong you see them as well while avoiding arguing over who is "right". If
                                    you agree, greate but if not, it's OK to "agree to disagree".
                                </li>
                                <li>if one or both of you feels that this area needs to be strengthend, consider taking
                                    a step back by clicking on "EXPLORE and BUILD at the top to try other questions and
                                    strategies.
                                </li>

                            </ol>
                        </div>
                    </div>


                    <div class="container-fluid btns-container">
                        <a href="{{URL::to('journey/'.$strengthScore->child_id)}}"
                           class="pull-right btn btn-lg btn-warning empower-next"><i
                                    class="glyphicon glyphicon-arrow-right"></i> Next </a>
                        <a href="{{URL::to('parents/explore/'.$strengthScore->id)}}"
                           class="pull-left btn btn-lg btn-primary empower-back"><i
                                    class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </div>


                </div>


            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    {{ HTML::style("public/front/css/main.css") }}

@stop