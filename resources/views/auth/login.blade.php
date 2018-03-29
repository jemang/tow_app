<div class="float-right span35">
            <form class="welcome-form login-form" action="/login" method="post">
			{!! csrf_field() !!}
        <div class="form-header">
            <div class="float-left">
                Log In            </div>
            <div class="float-right">
                <a href="/password/email">Forgot Password?</a>
            </div>
            <div class="float-clear"></div>
        </div>
		@if (count($errors) > 0 && (old('action') != 'register'))
			<div style="display: block;text-align: center;" class="post-message hidden">
            @foreach ($errors->all() as $error)
					{{ $error }}<br />
            @endforeach
			</div>
		@endif
        <div class="form-content">
            <div class="input-wrapper">
                <input type="text" name="email" placeholder="Username or e-mail" value="{{ old('email') }}" autocomplete="on">
            </div>
            
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
            
            <div class="input-wrapper">
                <input type="checkbox"  name="remember" value="1"> Remember Me
            </div>
            
            <button class="submit-btn active"><i class="icon-signin progress-icon"></i> Log In</button>
        </div>
    </form>
        <form class="welcome-form signup-form" action="/register" method="post">
		{!! csrf_field() !!}
		<input type="hidden" name="action" value="register">
        <div class="form-header">Sign Up</div>
		@if (count($errors) > 0 && (old('action') == 'register'))
			<div style="display: block;text-align: center;" class="post-message hidden">
            @foreach ($errors->all() as $error)
					{{ $error }}<br />
            @endforeach
			</div>
		@endif
        <div class="form-content">
            <div class="input-wrapper">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="off">
            </div>
			
			<div class="input-wrapper">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="E-mail" autocomplete="off">
            </div>
            
            <div class="input-wrapper">
                <input type="password" name="password" placeholder="Password" autocomplete="off">
            </div>
			
			<div class="input-wrapper">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="off">
            </div>
                        
            <button class="submit-btn active"><i class="icon-angle-right progress-icon"></i> Sign Up</button>
        </div>
    </form>
</div>