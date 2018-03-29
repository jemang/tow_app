@extends('auth.master_admin')

@section('header')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    @include('auth.view_shop')
@endsection
