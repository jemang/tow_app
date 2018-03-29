@extends('master')

@section('title', 'Reset Password')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="float-right span35">
            <form class="welcome-form forgotpass-form" method="post" action="/password/email">
			{!! csrf_field() !!}
        <div class="form-header">
            <div class="float-left">
                Forgot Password?
            </div>
            <div class="float-right">
                <a href="/">Log In</a>
            </div>
            <div class="float-clear"></div>
        </div>
		@if (count($errors) > 0)
			<div style="display: block;" class="post-message hidden">
            @foreach ($errors->all() as $error)
					{{ $error }}<br />
            @endforeach
			</div>
		@endif
        <div class="form-content">
            <div class="input-wrapper">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="E-mail">
            </div>
            <button class="submit-btn active">
                <i class="icon-inbox progress-icon"></i> Send Password Reset Link            </button>
        </div>
    </form>
</div>
@endsection