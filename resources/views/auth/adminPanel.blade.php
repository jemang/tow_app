@extends('master')

@section('title', 'Admin Panel')

@section('sidebar')
    @parent
@endsection
@section('content')
	@include('auth.adminOption')
	@if($tab == 'user')
		@include('auth.adminPanel_User')
	@elseif($tab == 'users')
	
	@else
	
	@endif
@endsection