@section ('content')
	<h1>{{ $post->title }}</h1>

	<span class='date'>Posted at {{ $post->postedAt() }}</span>

	<div class='page_content'>
		{{ $post->content }}
	</div>

	{{ Html::linkAction( 'PostsController@index', 'Back' ) }}
@stop

@section ('extra_js')
	
@stop