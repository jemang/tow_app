<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="max-age=0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 11:00:00 GMT">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="Last-Modified" content="01 Jan 1970 00:00:00 GMT" /> 
		<meta http-equiv="If-Modified-Since" content="01 Jan 1970 00:00:00 GMT" />
        <title>App Name - @yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" href="/favicon.ico" />
		<link href="/themes/grape/css/style.css" rel="stylesheet">
		<link href="/themes/grape/css/style-1.1.css" rel="stylesheet">
		<link href="/themes/grape/css/style-1.2.css" rel="stylesheet">
		<link href="/themes/grape/css/welcome.css" rel="stylesheet">
		<link href="/themes/grape/css/font-awesome/font-awesome.css" rel="stylesheet">
		<!--[if IE 7]>
        <link href="/themes/grape/css/font-awesome/font-awesome-ie7.css" rel="stylesheet">
		<![endif]-->
		<script src="/themes/grape/javascript/jquery.1.10.2.min.js"></script>
		<script src="/themes/grape/javascript/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="/themes/grape/javascript/jquery.ui.touch-punch.min.js"></script>
		<script src="/themes/grape/javascript/jquery-timeago.js"></script>
		<script src="/themes/grape/javascript/jquery.form.min.js"></script>
		<script src="/themes/grape/javascript/welcome.js"></script>
		<script>function SK_moreToggle() {
					$('.dropdown-more-container').toggle();
				}
		</script>
	</head>
	<body>
        @section('sidebar')
		<div class="header-wrapper" name="top">
			<div class="header-content">
				<div class="float-left">
            <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="header-site-logo" align="left" valign="top">
                    <a href="/" style="margin-left: 10px;">
                        <font size="4" style="bold" face="arial">MyPhoto</font>
                    </a>
                </td>
            </tr>
            </table>
        </div>
			@if(Auth::check())
			<div class="float-right">
                        <div class="header-user-info float-left cursor-hand" style="position: relative;">
                <a class="header-user-link" href="#">
                    <img class="header-user-avatar" src="/themes/grape/images/default-male-avatar.png" alt="" width="24px">
                    <strong>{{Auth::user()->name}}</strong>
                </a>
                <i class="icon-caret-down dropdown-icon"></i>
                <span class="dropdown-overlay-wrap" onclick="SK_moreToggle();"></span>
            </div>
            </div>
		        <div class="float-clear"></div>
		
			</div>
		</div>
		<div class="dropdown-more-container">
		<div class="dropdown-more-wrapper">
        <div class="dropdown-more-content float-right">
            <div class="more-list-wrapper">
                <a class="more-list" href="/profile">
                    <i class="icon icon-user"></i> My Profile                </a>

                <a class="more-list" href="/">
                    <i class="icon icon-picture"></i> My Photo               </a>
                
				@if(Auth::user()->usr_right > 1)
				<a class="more-list" href="/admin">
                    <i class="icon icon-gear"></i> Admin Panel                </a>
				@endif
                <a class="more-list" href="/logout">
                    <i class="icon icon-signout"></i> Log Out                </a>
            </div>
        
        
        <div class="float-clear"></div>
		</div>
		@endif
		</div>
		</div>
		<div class="float-clear"></div>
<div class="page-wrapper">
        <div class="page-margin"></div>
        @show
		@yield('content')
		<div class="float-clear"></div>
    </div>
    </body>
</html>