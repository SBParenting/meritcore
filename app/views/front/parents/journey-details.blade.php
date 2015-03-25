@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="parent-guide-block parent-guide-header row">
                <a href="{{URL::to('children/select')}}" class="logo col-md-1"><img src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                <div class="container">
                    <a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
                    <a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>

                    <div class="child-image">
                        <a href="#" class="logo">
                            <div class="logo child-thumbnail child-{{$child->sex}}">{{!empty($child->avatar) ? "<img src='".url('/public/uploads/children/squared-'.$child->avatar)."' />" : ""}}</div>
                            <p class="child-name">{{ $child->first_name }}</p>
                        </a>
                    </div>

                    <h1 class="parent-guide header-content purple">OUR JOURNEY</h1>
                </div>
            </div>

            <div class="parent-guide-block parent-guide-content">
                <div class="form-inner parent-journey-inner">
                    <nav class="container-fluid" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".parent-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class=" toggle-nav fa fa-bars"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse parent-nav">
                                <div class="active">standard view</div>
                                <div>|</div>
                                <div>zone view</div>
                        </div>
                    </nav>
                    <div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-10">
                                    <h2>Family Communications</h2>
                                    <h4>FAMILY SUPPORT & EXPECTATIONS</h4>
                                </div>
                                <div class="col-xs-2">
                                    <img src="/public/front/img/icons/in-progress.png" />
                                    your progress
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /#our-journey-map -->
                </div>
            </div>
        </div>
    </div>



@endsection

@section('css')
    {{ HTML::style('public/front/css/our-journey.css') }}
@endsection