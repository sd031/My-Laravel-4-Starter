@if ( Session::get('flasherror') )
	<div class="alert alert-error">
		@if ( is_array(Session::get('flasherror')) )
			@foreach(Session::get('flasherror') as $error)
				{{ $error }}<br />
			@endforeach
		@else
			{{ Session::get('flasherror') }}
		@endif
	</div>
@endif

@if ( Session::get('flashinfo') )
	<div class="alert alert-info">{{ Session::get('flashinfo') }}</div>
@endif

@if ( Session::get('flashsuccess') )
	<div class="alert alert-success">{{ Session::get('flashsuccess') }}</div>
@endif