<?php
	if(isset($post))
		$f = array_merge( $post->toArray(), Input::old() );
	else
		$f = array_merge( Input::old() );
?>

<?php
	$formoptions = [
		'action' => [
			0 => isset( $action ) ? $action : 'Admin\PostsController@store'
		],
		'method' => isset( $method ) ? $method : 'POST'
	];

	if (isset( $post )) {
		$formoptions['action']['id'] = $post->id;
	}
?>
{{
	Form::open($formoptions)
}}
	<fieldset>
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', array_get( $f,'title') ) }}

		<label class="checkbox">
			{{ Form::checkbox('display', 1, array_get( $f,'display') ) }}
			Show
		</label>

		{{ Form::label('slug', 'Slug (URL)') }}
		{{ Form::text('slug', array_get( $f,'slug') ) }}

		{{ Form::label('content', 'Content (Markdown)') }}
		{{ Form::textarea('content', array_get( $f,'content'), ['data-editor'] ) }}

		{{ Form::label('lean_content', 'Content preview') }}
		{{ Form::textarea('lean_content', array_get( $f,'lean_content') ) }}

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

			{{ Form::button('Save Post', ['type'=>'submit', 'class'=>'btn btn-primary'] ) }}

			@if ( isset($post) )
				{{ Html::linkAction( 'Admin\PostsController@destroy', 'Delete post', ['id'=>$post->id], ['data-method'=>'delete', 'class'=>'btn btn-danger'] ) }}
			@endif

			{{ Html::linkAction( 'Admin\PostsController@index', 'Cancel', [], ['class'=>'btn'] ) }}

		</div>
	</fieldset>
{{ Form::close() }}