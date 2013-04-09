<?php
	if(isset($user))
		$f = array_merge( $user->toArray(), Input::old() );
	else
		$f = array_merge( Input::old() );
?>

<?php
	$formoptions = [
		'action' => [
			0 => isset( $action ) ? $action : 'Admin\UsersController@store'
		],
		'method' => isset( $method ) ? $method : 'POST'
	];

	if (isset( $user )) {
		$formoptions['action']['id'] = $user->id;
	}
?>
{{
	Form::open($formoptions)
}}
<input type="hidden" name="csrf_token" value="{{ Session::getToken() }}">
	<fieldset>
		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', array_get( $f,'username') ) }}

		{{ Form::label('firstname', 'Firstname') }}
		{{ Form::text('firstname', array_get( $f,'firstname') ) }}

		{{ Form::label('lastname', 'Lastname') }}
		{{ Form::text('lastname', array_get( $f,'lastname') ) }}

		{{ Form::label('email', 'Email') }}
		{{ Form::text('email', array_get( $f,'email') ) }}

		@if ( !isset($user) )
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', array_get( $f,'password') ) }}

			{{ Form::label('password_confirmation', 'Confirm password') }}
			{{ Form::password('password_confirmation', array_get( $f,'password_confirmation') ) }}
		@endif

		<label class="checkbox">
			{{ Form::checkbox('confirmed', 1, array_get( $f,'confirmed') ) }}
			Confirmed
		</label>

		@if ( Session::get('error') )
			<div class="alert alert-error">
				@if ( is_array(Session::get('error')) )
					{{ Session::get('error')[0] }}
				@else
					{{ Session::get('error') }}
				@endif
			</div>
		@endif

		<div class='form-actions'>

			{{ Form::button('Save User', ['type'=>'submit', 'class'=>'btn btn-primary'] ) }}

			@if ( isset($user) )
				{{ Html::linkAction( 'Admin\UsersController@destroy', 'Delete user', ['id'=>$user->id], ['data-method'=>'delete', 'class'=>'btn btn-danger'] ) }}
			@endif

			{{ Html::linkAction( 'Admin\UsersController@index', 'Cancel', [], ['class'=>'btn'] ) }}

		</div>
	</fieldset>
{{ Form::close() }}