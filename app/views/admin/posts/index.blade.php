@section ('content')
	<p>
		<a href='{{ URL::action( 'Admin\PostsController@create' ) }}' class='btn btn-primary'>
			New Post
		</a>
	</p>

	<table class='table'>
		<thead>
			<tr>
				<th>Post</th>
				<th>Author</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $posts as $post )
				<tr>
					<td>
						{{ Html::linkAction( 'Admin\PostsController@edit', $post->title, ['id'=>$post->id] ) }}
					</td>
					<td>{{ $post->author->username }}</td>
					<td>{{ $post->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $posts->links() }}
@stop