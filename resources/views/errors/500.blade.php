@extends('common.layout.front')

@section('title')
    Something's wrong with server
@stop

@section('content')
    
    <section data-ng-view="" id="content" class="animate-fade-up ng-scope">
        <div class="page-err">
            <div class="text-center">
                <div class="err-status">
                     <h1>500</h1>
                </div>
                <div class="err-message">
                    <h2>Something's wrong with server.</h2>
                </div>
                <div class="err-body">
                    <a href="{{ url('/') }}" class="btn btn-lg btn-goback">
                        <span class="glyphicon glyphicon-home"></span>
                        <span class="space"></span>
                        Go Back to Home Page
                    </a>
                </div>
            </div>
        </div>
    </section>
    
@stop