@extends('master')

@section('title', 'Home')

@section('sidebar')
    @parent
@endsection

@section('content')
	@if(Auth::check())
		
	@else
		@include('auth.login')
	@endif
@endsection