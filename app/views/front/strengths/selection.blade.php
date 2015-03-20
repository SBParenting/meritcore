@extends('front.survey.layout')

@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="parent-guide-block parent-guide-header col-md-12">
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

                    <h1 class="strength-selection">STRENGTH SELECTION</h1>


                </div>
            </div>
            <div class="parent-guide-block parent-guide-content ">
                <div class="form-inner parent-reflect-inner">


                    <div class="container-fluid map-container">

                        <p class=" col-md-5 col-md-offset-2 map-text"><i class=" fa fa-circle"><span
                                        class="number-1">1</span> </i> have a look at OUR JOURNEY map of your child's
                            strengths</p>

                        <a href="{{URL::to('journey/'.$child->id)}}" class="col-md-7 col-md-offset-2 journey-map">

                            <h1 class="col-md-6 col-md-offset-0">VISIT OUR JOURNEY MAP </h1>

                            <div class="col-md-3 col-md-offset-2 pic-container"><img class=" pull-right img-responsive "
                                                                                     src="{{ url('public/front/img/map-icon.png') }}"/>
                            </div>

                            <p class="col-md-8 col-md-offset-0" style="color:white"> Check out Our Journey Map to see the two recomended
                                focus areas to work on with your child. Click on <br>the strengths sections to reveal
                                the scroes and information.</p>

                        </a>


                    </div>

                    <div class="container-fluid selection-container">
                        <p class=" col-md-5 col-md-offset-2 map-text"><i class=" fa fa-circle"><span
                                        class="number-2">2</span> </i>pick one of the two reccomended focus areas to
                            work on with your child</p>

                        <div class="row col-md-12">
                            <div class="col-md-3 col-md-offset-3 big-group big-group-{{$scores[0]->strength->strengthGroup->id}}">
                                <h2>{{$scores[0]->strength->name}} </h2>

                                <p>{{$scores[0]->strength->strengthGroup->name}}</p>

                                <div class="big-group-icon big-group-icon-{{$scores[0]->strength->strengthGroup->id}}"><img src="{{ url('public/front/img/strength-icon-'.$scores[0]->strength->strengthGroup->id.'.png') }}"/>
                                </div>
                                <div class="strength-percent strength-percent-{{$scores[0]->strength->strengthGroup->id}}"><p class="text-center">{{$scores[0]->score}}%</p></div>
                                <a href="{{URL::route('parents.reflect',[$scores[0]->id,1])}}" class=" btn btn-lg btn-warning pull-right select-large"><span>SELECT</span>
                                </a>
                            </div>


                            <div class="col-md-3 left-5 big-group big-group-{{$scores[1]->strength->strengthGroup->id}}">
                                <h2>{{$scores[1]->strength->name}} </h2>

                                <p>{{$scores[1]->strength->strengthGroup->name}}</p>

                                <div class="big-group-icon big-group-icon-{{$scores[1]->strength->strengthGroup->id}}"><img src="{{ url('public/front/img/strength-icon-'.$scores[1]->strength->strengthGroup->id.'.png') }}"/>
                                </div>
                                <div class="strength-percent strength-percent-{{$scores[1]->strength->strengthGroup->id}}"><p class="text-center">{{$scores[1]->score}}%</p></div>
                                <a href="{{URL::route('parents.reflect',[$scores[1]->id,1])}}" class=" btn btn-lg btn-warning pull-right select-large"><span>SELECT</span>
                                </a>
                            </div>

                        </div>
                        <div class="row">
                            <p class=" col-md-5 col-md-offset-2 strength-text">or pick one of these alternate focus
                                areas to work with your child</p>

                            <div class="col-md-12">
                                <div class=" col-md-2 col-md-offset-2 pick-group pick-group-{{$scores[2]->strength->strengthGroup->id}}">
                                    <div class="col-md-12 journey-text">
                                        <img class=" pull-left" src="{{ url('public/front/img/strength-icon-'.$scores[2]->strength->strengthGroup->id.'.png') }}"/>
                                        <h4>{{$scores[2]->strength->name}} </h4>

                                        <p>{{$scores[2]->strength->strengthGroup->name}}</p>

                                    </div>
                                    <div class=" col-md-5 journey-percent"><p class="text-center">?</p></div>
                                    <button class="btn btn-lg btn-warning select-small pull-right">SELECT</button>
                                </div>
                                <div class=" col-md-2 pick-group pick-group-{{$scores[3]->strength->strengthGroup->id}}">
                                    <div class="col-md-12 journey-text">
                                        <img class=" pull-left" src="{{ url('public/front/img/strength-icon-'.$scores[3]->strength->strengthGroup->id.'.png') }}"/>
                                        <h4>{{$scores[3]->strength->name}} </h4>

                                        <p>{{$scores[3]->strength->strengthGroup->name}}</p>

                                    </div>
                                    <div class=" col-md-5 journey-percent"><p class="text-center">?</p></div>
                                    <button class="btn btn-lg btn-warning select-small pull-right">SELECT</button>
                                </div>
                                <div class=" col-md-2 pick-group pick-group-{{$scores[4]->strength->strengthGroup->id}}">
                                    <div class="col-md-12 journey-text">
                                        <img class=" pull-left" src="{{ url('public/front/img/strength-icon-'.$scores[4]->strength->strengthGroup->id.'.png') }}"/>
                                        <h4>{{$scores[4]->strength->name}} </h4>

                                        <p>{{$scores[4]->strength->strengthGroup->name}}</p>

                                    </div>
                                    <div class=" col-md-5 journey-percent"><p class="text-center">?</p></div>
                                    <button class="btn btn-lg btn-warning select-small pull-right">SELECT</button>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    {{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}
    {{ HTML::style("public/front/css/main.css") }}

@stop