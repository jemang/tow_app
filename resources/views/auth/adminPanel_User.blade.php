<div class="float-right span74">
        <form class="update-timeline-form" method="post">
    <div class="form-container">
        <div class="form-header">
            User List        </div>
		@if (count($errors) > 0)
			<div class="success-message" style="text-align: center;display: block;">
			@foreach ($errors->all() as $error)
					{{ $error }}
            @endforeach
		</div>
		@endif
        <div class="form-input-wrapper">
            <div class="float-left span10">
                <Strong>ID</Strong>
            </div>
			<div class="float-left span30">
                <Strong>Name</Strong>
            </div>
			<div class="float-left span40">
                <Strong>Email</Strong>
            </div>
			<div class="float-left span20"  align="center">
                <Strong>Option</Strong>
            </div>
            <div class="float-clear"></div>
        </div>
		@for($a=0;$a<sizeof($users);$a++)
		<div class="form-input-wrapper">
            <div class="float-left span10">
				{{$users[$a]->id}}
            </div>
			<div class="float-left span30">
                {{$users[$a]->name}}
            </div>
			<div class="float-left span40">
                {{$users[$a]->email}}
            </div>
			<div class="float-left span20" align="center">
                <a href="/profile/update/{{$users[$a]->id}}">Edit</a> - 
				<a href="/profile/delete/{{$users[$a]->id}}" class="con">Delete</a>
            </div>
            <div class="float-clear"></div>
        </div>
		@endfor
    </div>
    </form>
</div>
<script>
	$('.con').on('click',function(){
		return confirm('Are you sure to delete this user?')
	});
</script>