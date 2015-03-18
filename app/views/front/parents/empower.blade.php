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
                            <li class="nav-item border"><a
                                        href="{{URL::to('parents/explore/'.$strengthScore->id)}}"><img
                                            src="{{ url('public/front/img/build-icon.png')}}" height="32px"
                                            width="32px"/>BUILD</a></li>
                            <li class="nav-item"><a href="{{URL::to('parents/explore/'.$strengthScore->id)}}"><img
                                            src="{{ url('public/front/img/explore-icon.png')}}" height="32px"
                                            width="32px"/>EXPLORE</a></li>
                            <li class="nav-item border "><a
                                        href="{{URL::to('parents/reflect/'.$strengthScore->id.'/1')}}"><img
                                            src="{{ url('public/front/img/reflect-icon.png')}}" height="32px"
                                            width="32px"/>REFLECT</a></li>
                        </ul>
                    </div>


                    <div class="container-fluid section-top">
                        <div class=" col-md-8 dark-green col-md-offset-6">
                            <p> move the slider for each indicator to what is true or not for your child</p>
                        </div>
                    </div>
                    <div class="container-fluid light-green"></div>
                    <div class="container-fluid grey"><img class=" not-true "
                                                           src="{{ url('public/front/img/not-true.png')}}"/> <img
                                class=" true" src="{{ url('public/front/img/true.png')}}"/></div>

                    <div class="container-fluid slider-table">
                        <table>

                            @foreach($questions as $question)
                                <tr class="tr-{{$question->num % 2 ? "odd" : "even"}}">
                                    <td class=" number-column">
                                        <div class=" circle-green"><span
                                                    class="empower-number">{{$question->num}}</span></div>
                                    </td>
                                    <td class=" question-column">{{ $question->question }}</td>
                                    <td class="slider-column" data-empower-child-id="{{$empowerChild->id}}"
                                        data-empower-question-id="{{$question->id}}">
                                        <div class="slider"
                                             data-answer="{{ isset($answers[$question->id]) ? $answers[$question->id] : -1 }}">
                                            <div>
                                                <img src="/public/front/img/grey-circle.png" class="grey-circle"
                                                     height="18px" width="18px">
                                                <img src="/public/front/img/orange-circle.png" class="orange-circle"
                                                     height="18px" width="18px">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </table>

                        <div class="container-fluid btns-container">
                            @if($questions->getCurrentPage() < $questions->getLastPage())
                                <a href="{{ $questions->getUrl($questions->getCurrentPage()+1) }}"
                                   class="pull-right btn btn-lg btn-warning empower-next"><i
                                            class="glyphicon glyphicon-arrow-right"></i> Next </a>
                            @else
                                <a href="/parents/empower/feedback/{{$empowerChild->id}}"
                                   class="pull-right btn btn-lg btn-warning empower-next"><i
                                            class="glyphicon glyphicon-arrow-right"></i> Next </a>
                            @endif

                            <a href="#" class="pull-left btn btn-lg btn-primary empower-back"><i
                                        class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </div>


                    </div>


                </div>
            </div>

        </div>

    </div>

    </div>
    </div>
@stop
@section('script')

    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


    <script>

        $(".slider").slider({
            orientation: "horizontal",
            range: "min",
            min: 0,
            max: 100,
            value: 50,
            step: 1,
            animate: true,
            slide: function (e, ui) {

                $(this).find('.ui-slider-handle').css({
                    "background": " url('/public/front/img/white-circle.png')",
                    "text-align": "center",
                    padding: '12px 0 0 0',
                    width: '43px',
                    height: '47px',
                    top: "-22px"
                });

                $(this).find('.ui-slider-handle').html(ui.value);
            },

            change: function (e, ui) {
                var cid = $(this).parents('.slider-column').attr('data-empower-child-id'),
                        qid = $(this).parents('.slider-column').attr('data-empower-question-id');

                $.post("/parents/empower/save", {
                    "empower_child_id": cid,
                    "empower_question_id": qid,
                    answer: ui.value
                }, function (response) {

                });

                $(this).parents('tr').find('.circle-number').css({'color': 'rgba(255,255,255,0.4)'});
            }


        }).each(function () {

            $(this).find('.ui-slider-handle').css({
                borderRadius: "80px",
                top: "-28px",
                opacity: '4',
                border: "none",
                padding: "28px",
                "z-index": '4',
                "background": "url('/public/front/img/default-circle.png') ",
                "background-position": "center"
            });

            if ($(this).attr('data-answer') != "-1") {
                $(this).slider('value', $(this).attr('data-answer'));

                $(this).parents('tr').find('.circle-number').css({'color': 'rgba(255,255,255,0.4)'});
            }

            if ($(this).attr('data-answer') != "-1") {
                $(this).find('.ui-slider-handle').css({
                    "background": " url('/public/front/img/white-circle.png')",
                    "text-align": "center",
                    padding: '12px 0 0 0',
                    width: '43px',
                    height: '47px',
                    top: "-22px"
                }).html($(this).attr('data-answer'));


            }

            $('.question-strength , .answers').find('.list-item').css({'background-color': 'transparent'}).find('a').css({"color": '#777777'});
            var color = $(this).parents('.survey-row').css('background-color');

        });

        $('.ui-slider-horizontal').height(3);

        $('.slider .ui-slider-range').css({
            'background': "#bfbfbf"
        });

        $('.ui-widget-content').css({
            'background': "#fdb535"
        });

        var updateSliderValue = function (e, ui) {
            var slider = $(this).data().slider;
            slider.element.find(".ui-slider-handle").text(slider.value());
        };
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    {{ HTML::style("public/front/css/main.css") }}

@stop