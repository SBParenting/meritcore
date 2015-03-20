<?php

function svg($file)
{
    $path = 'front/img/svg/'.$file.'.svg';
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
                    </div>
                </div>
            </div>

            <div class="parent-guide-block parent-guide-content ">
                <div id="our-journey-map">

                    <img src="/public/front/img/our-journey-bg.png" alt="BG" title="" class="bg" />

                    <?=svg('our-journey')?>

                </div><!-- /#our-journey-map -->
            </div>

        </div>
    </div>



@endsection

@section('css')
    {{ HTML::style('public/front/css/our-journey.css') }}
@endsection

@section('script')
    {{ HTML::script('public/front/js/our-journey.js') }}
@endsection