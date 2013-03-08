@if (Session::has('success'))
<div class="alert alert-success">
	<button class="close" data-dismiss="alert">×</button>
	{{ trans(Session::get('success')) }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-error">
	<button class="close" data-dismiss="alert">×</button>	
	@if (is_array(Session::get('reason')))
		@foreach (Session::get('reason') as $reason)
		{{ trans($reason) }}
		@endforeach
	@else
		{{ trans(Session::get('reason')) }}
	@endif
</div>
@endif