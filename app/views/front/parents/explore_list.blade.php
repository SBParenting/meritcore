@extends('front.parents.base')

@section('content')


    <div class="exp-list-container">

        <div class="container-fluid list-content">

            <div class="container-fluid top-section">
                <h1 class="text-center">EXPLORE </h1>

                <p class="text-center">SELECT a question to explore with your child <span
                            class="pull-right setup-guide"><i
                                class="glyphicon glyphicon-cog"></i>setup parent guide</span></p>
            </div>

            @foreach($questions as $question)
            <div class="container-fluid content-container scrollbar-vista">
                <div class="question-container col-md-8 col-md-offset-2">
                    <div class="question-inner col-md-12">
                        <table class="col-md-12  ">
                            <tr>
                                <td class="{{!isset($answers[$question->id])?'select-button':($answers[$question->id] == 'InProgress'?'question-in-progress':'completed-question')}}">
                                    @if(!isset($answers[$question->id]))
                                        <a href="{{URL::to('parents/explore/picked/'.$strengthScore->id.'/'.$question->id)}}"><p><img src="/public/front/img/select-icon.png">Select</p></a>
                                    @elseif($answers[$question->id] == 'InProgress')
                                        <p>Working On</p>
                                    @else
                                        <p>Completed</p>
                                    @endif

                                </td>

                                <td class="question-content-mid col-md-4">
                                    <p>{{$question->question}}</p>
                                </td>

                                <td class="question-content-right  table-container">
                                    <p class="text-center">SEND REMINDER TO:</p>

                                    <div>
                                        <table class="col-md-12">
                                            <tr>
                                                <td>
                                                    <div class="email ">
                                                        <label class="switch switch-success">
                                                            <input type="checkbox" checked>
                                                            <i></i>
                                                        </label>
                                                        <span><i class="glyphicon glyphicon-envelope"> </i> Email </span>
                                                        <span>emailfromresetup@sampleintheslidder.com </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="calender ">
                                                        <label class="switch switch-success">
                                                            <input type="checkbox" checked>
                                                            <i></i>
                                                        </label>
                                                        <span><i class="glyphicon glyphicon-time"> </i> Calender </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text">
                                                        <label class="switch switch-success">
                                                            <input type="checkbox" checked>
                                                            <i></i>
                                                        </label>
                                                        <span><i class="glyphicon glyphicon-phone"> </i> Text Message </span>
                                                        <span>1 403 555-0000 </span>
                                                    </div>
                                                </td>
                                                <td class="date">
                                                    <p class=" text-center">Tuesday, November 23, 2015 at 12:30pm</p>
                                                    <br>

                                                    <p class="text-center"><span>CHANGE</span></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="container-fluid"><a href="{{URL::to('parents/explore/'.$strengthScore->id)}}"
                                            class="pull-left btn btn-lg btn-primary list-back-btn"><i
                            class="glyphicon glyphicon-arrow-left"></i> Back</a></div>
        </div>
    </div>
@stop
@section('script')
    {{HTML::script("public/front/libs/scrollbar/js/jquery.scrollbar.js")}}
    <script>
        jQuery(document).ready(function () {
            jQuery('.scrollbar-vista').scrollbar({
                "showArrows": true,
                "type": "advanced"
            });
        });
    </script>
@stop


@section('css' )
    {{HTML::style("public/front/libs/scrollbar/css/jquery.scrollbar.css")}}
@stop