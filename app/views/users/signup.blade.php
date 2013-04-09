@section ('content')

	<form method="POST" action="{{ (URL::action('UserController@store')) ?: URL::to('user')  }}" accept-charset="UTF-8">
		<input type="hidden" name="csrf_token" value="{{ Session::getToken() }}">
		<fieldset>
			<label for="username">{{ Lang::get('confide.username') }}</label>
			<input placeholder="{{ Lang::get('confide.username') }}" type="text" name="username" id="username" value="{{ Input::old('username') }}">

			<label for="firstname">{{ Lang::get('confide.firstname') }}</label>
			<input placeholder="{{ Lang::get('confide.firstname') }}" type="text" name="firstname" id="firstname" value="{{ Input::old('firstname') }}">

			<label for="lastname">{{ Lang::get('confide.lastname') }}</label>
			<input placeholder="{{ Lang::get('confide.lastname') }}" type="text" name="lastname" id="lastname" value="{{ Input::old('lastname') }}">

			<label for="email">{{ Lang::get('confide.e_mail') }} <small>{{ Lang::get('confide.signup.confirmation_required') }}</small></label>
			<input placeholder="{{ Lang::get('confide.e_mail') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">

			<label for="password">{{ Lang::get('confide.password') }}</label>
			<input placeholder="{{ Lang::get('confide.password') }}" type="password" name="password" id="password">

			<label for="password_confirmation">{{ Lang::get('confide.password_confirmation') }}</label>
			<input placeholder="{{ Lang::get('confide.password_confirmation') }}" type="password" name="password_confirmation" id="password_confirmation">

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">{{ Lang::get('confide.signup.submit') }}</button>
			</div>

		</fieldset>
	</form>

@stop