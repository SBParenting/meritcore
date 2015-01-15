@extends('front.layout.base')


@section('content')

	<h1>{{ $page->title }}</h1>

	<hr />

	{{ $page->content }}	

@stop