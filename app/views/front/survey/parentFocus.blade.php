@extends('front.survey.layout')


@section('content')

    <div class="container-page">

        <div class="wrapper">
            <div class="survey-block survey-header">
                <a href="#" class="logo"><img src="{{ url('public/front/img/sbp-logo.png') }}"/></a>

                <div class="container">
                    <a href="#" id="showPage" class="header-link"><i class="icon-help"></i> help</a>
                    <a href="#" id="showMenu" class="header-link"><i class="icon-menu"></i> menu</a>

                    <div class="child-image">
                        <a href="#" class="logo">
                            <div class="logo child-thumbnail child-{{$child->sex}}"></div>
                            <p class="child-name">{{ $child->first_name }}</p></a>
                    </div>
                    <h1 class="parent-focus">PARENT FOCUS</h1>
                    <span class="show-name">Childs name</span>

                    <div class="bar-container">
                        <span class="progress-label-1">PARENT FOCUS</span>

                        <div class="progress ng-isolate-scope progress-bar-container" max="max" value="dynamic">

                            <div class="progress-bar progress-blue" ng-class="type &amp;&amp; 'progress-bar-' + type"
                                 role="progressbar" aria-valuenow="91" aria-valuemin="0" aria-valuemax="200"
                                 ng-style="{width: percent + '%'}" aria-valuetext="46%" ng-transclude=""
                                 style="width: {{ 100 * (count($answers)/$questions->getTotal()) }}%;"><span
                                        class="ng-binding ng-scope"><span id="answer-count">{{ count($answers) }}</span>/{{ $questions->getTotal() }}</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="survey-block survey-content">
                <div class="answers list-row">
                    <div class="container">
                        <table>
                            <tr>
                                <td class="rating-text">Rate how concerned you are with <br/> your child in the
                                    following areas
                                    below:
                                </td>
                                <td class="list-item" id="not-at-all"><a>not at all</a></td>
                                <td class="list-item" id="not-so-much"><a>not so much</a></td>
                                <td class="list-item" id="not-sure"><a>not sure</a></td>
                                <td class="list-item" id="somewhat-concern"><a>somewhat<br/> a concern</a></td>
                                <td class="list-item" id="major-concern"><a>major<br/> concern</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="survey-inner">

                    @include('front.survey.sections.questions')

                </div>
            </div>

            <div class="survey-block survey-footer">
                <div class="container btn-container">

                    <a href="{{ ($questions->getCurrentPage() > 1) ? $questions->getUrl($questions->getCurrentPage()-1) : "#" }}"
                       class="pull-left btn btn-primary btn-left {{ ($questions->getCurrentPage() == 1) ? "disabled" : "" }}"><i
                                class="glyphicon glyphicon-arrow-left"></i> BACK</a>

                    @if($questions->getCurrentPage() < $questions->getLastPage())
                        <a href="{{ $questions->getUrl($questions->getCurrentPage()+1) }}"
                           class="pull-right btn btn-primary btn-right">NEXT <i
                                    class="glyphicon glyphicon-arrow-right"></i></a>
                    @else
                        <a href="/survey/finish/{{$child->id}}/1"
                           class="pull-right btn btn-primary btn-right">FINISH</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop