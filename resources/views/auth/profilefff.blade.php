@extends('master')

@section('title', 'Profile')

@section('sidebar')
    @parent
@endsection
@section('content')
	@if($data['act'] == 'admin')
		@include('auth.adminOption')
	@else
		@include('auth.panel')
	@endif
<div class="float-right span74">
		@if($data['act'] == 'update')
			<form class="update-timeline-form" method="post" action="/profile/update">
		@elseif($data['act'] == 'admin')
			<form class="update-timeline-form" method="post" action="/profile/update/{{$data['id']}}">
		@else
			<form class="update-timeline-form" method="get" action="/profile/update">
		@endif
		{!! csrf_field() !!}
        <div class="form-container">
            <div class="form-header">
			@if($data['act'] == 'update' || $data['act'] == 'admin')
				Update Profile Detail            </div>
				@if (count($errors) > 0)
			<div class="success-message" style="text-align: center;display: block;">
            @foreach ($errors->all() as $error)
					{{ $error }}<br />
            @endforeach
			</div>
					@endif

			@foreach ($data as $key => $value)
				@if($key != 'act' && $key != 'id')
            <div class="form-input-wrapper">
                <label class="float-left span15">
				{{ucfirst($key)}}:
                </label>
                <div class="input float-left span70">
                    <input type="text" name="{{$key}}" value="{{$value}}">
                </div>
                <div class="float-clear"></div>
            </div>
			@endif
			@endforeach
            <div class="form-input-wrapper">
                <center><button class="active">
                    Save Change                </button></center>
            </div>
			@else
                Profile Detail            </div>
			
				@if (count($errors) > 0)
					<div class="success-message" style="text-align: center;display: block;">
				@foreach ($errors->all() as $error)
					{{ $error }}<br />
				@endforeach
				</div>
				@endif
            @foreach ($data as $key => $value)
				@if($key != 'act' && $key != 'id')
            <div class="form-input-wrapper">
                <label class="float-left span15">
				{{ucfirst($key)}}:
                </label>
                <label class="float-left span70">
				{{$value}}
                </label>
                <div class="float-clear"></div>
            </div>
			@endif
			@endforeach
            <div class="form-input-wrapper">
                <center><button class="active">
                    Update Profile                </button></center>
            </div>
			@endif
        </div>
    </form>
</div>
@endsection