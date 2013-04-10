@section ('content')
	<p>
		<a href='{{ URL::action( 'Admin\PostsController@create' ) }}' class='btn btn-primary'>
			New Post
		</a>
	</p>

	<table class='table'>
		<thead>
			<tr>
				<th>Actions</th>
				<th>ID</th>
				<th>Post</th>
				<th>Slug</th>
				<th>Author</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $posts as $post )
				<tr>
					<td>
						{{ Html::linkAction( 'Admin\PostsController@edit', 'Edit', ['id'=>$post->id], 'class="btn btn-mini btn-info"' ) }}
						{{ Html::linkAction( 'Admin\PostsController@destroy', 'Delete', ['id'=>$post->id], ['data-method'=>'delete', 'class'=>'btn btn-mini btn-danger'] ) }}
					</td>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->slug }}</td>
					<td>{{ $post->author->username }}</td>
					<td>{{ $post->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $posts->links() }}
@stop