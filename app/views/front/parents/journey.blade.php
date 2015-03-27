<?php

function svg($file)
{
    $path = 'front/img/svg/' . $file . '.svg';
    if (is_file($path))
        return file_get_contents($path);

    return "";
}

?>
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
                                {{--<div>|</div>--}}
                                {{--<div>zone view</div>--}}
                                <div class="col-md-offset-3 journey-icon"><img src="/public/front/img/icons/suggested.png"/> suggested</div>
                                <div class="journey-icon"><img src="/public/front/img/icons/in-progress.png"/> in progress</div>
                                <div class="journey-icon"><img src="/public/front/img/icons/experienced.png"/> experienced</div>
                        </div>
                    </nav>
                    <div id="our-journey-map">

                        <img src="/public/front/img/our-journey-bg.png" alt="BG" title="" class="bg"/>

                        <?=svg('our-journey')?>

                    </div>
                    <!-- /#our-journey-map -->
                </div>
            </div>
        </div>
    </div>

    {{ "<script> var status = '".$status."';</script>" }}


@endsection

@section('css')
    {{ HTML::style('public/front/css/our-journey.css') }}
@endsection

@section('script')
    {{ HTML::script('public/front/js/our-journey.js') }}

    <script type="text/javascript">

        var s = JSON.parse(status);

        $.each(s,function(i,item){
            $.each(item,function(x,strength){
                OurJourneyMap.setLink(i,x,strength['link']);
                OurJourneyMap.hoverPercentage(i,x,strength['percent']);

                if (strength['percent'] < 100) {
                    OurJourneyMap.incrementPercentageX(i,x,15);
                }

                if (strength['status'] != 0) {
                    OurJourneyMap.activateArea(i,x);
                }
                if (strength['status'] == 1) {
                    OurJourneyMap.setIcon(i,x,'in-progress');
                }
                if (strength['status'] == 2) {
                    OurJourneyMap.setIcon(i,x,'experienced');
                }
                if (strength['status'] == 3) {
                    OurJourneyMap.setIcon(i,x,'suggested');
                }
            });
        });
    </script>
@endsection