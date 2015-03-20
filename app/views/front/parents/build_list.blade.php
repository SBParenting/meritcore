@extends('front.parents.base')

@section('content')


    <div class="build-list-container">

        <div class="container-fluid list-content">

            <div class="container-fluid top-section">
                <h1 class="text-center">BUILD</h1>

                <p class="text-center">SELECT a strategy to work on with your child</p>
            </div>

            <div class="container-fluid content-container scrollbar-vista">
                @foreach($options as $option)
                <div class="build-question-container col-md-8 col-md-offset-2">
                    <div class="build-question-inner col-md-12">

                        <table class="col-md-12">
                            <tr>
                                <td class="{{!isset($answers[$option->id]) ? 'build-select-button' : ($answers[$option->id]['status'] == 'InProgress' ? 'build-working-button' : 'build-completed-button')}}">
                                    @if(!isset($answers[$option->id]))
                                        <a href="{{URL::to('parents/build/picked/'.$strengthScore->id.'/'.$explore_question_id.'/'.$option->id)}}"><p><img src="/public/front/img/select-icon.png">Select</p></a>
                                    @elseif($answers[$option->id]['status'] == 'InProgress')
                                        <p>Working On</p>
                                    @else
                                        <p>Completed</p>
                                    @endif
                                </td>
                                <td class="build-question-content-mid  col-md-5">
                                    <h2 class=" text-center">{{$option->option}}:</h2>

                                    <div class=" col-md-12 rating-content ">
                                        <center>
                                            <p class="text-center">how you rated it</p>

                                            <input class="rating" value="{{isset($answers[$option->id]) ? $answers[$option->id]['score'] : ""}}">
                                        </center>
                                    </div>
                                </td>
                                <td class="build-question-content-right  col-md-5">
                                    <p>{{ $option->description }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid"><a href="{{URL::to('parents/explore/'.$strengthScore->id)}}"
                                        class="pull-left btn btn-lg btn-primary list-back-btn"><i
                        class="glyphicon glyphicon-arrow-left"></i> Back</a></div>
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
        });

    </script>
@stop


@section('css' )
    {{HTML::style("public/front/libs/scrollbar/css/jquery.scrollbar.css")}}
    {{HTML::style("public/front/libs/bootstrap-star/css/star-rating.css")}}

@stop