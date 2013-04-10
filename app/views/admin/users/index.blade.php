@section ('content')
	<p>
		<a href='{{ URL::action( 'Admin\UsersController@create' ) }}' class='btn btn-primary'>
			New User
		</a>
	</p>

	<table class='table'>
		<thead>
			<tr>
				<th>Actions</th>
				<th>ID</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Confirmed</th>
				<th>Role</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $users as $user )
				<tr>
					<td>
						{{ Html::linkAction( 'Admin\UsersController@edit', 'Edit', ['id'=>$user->id], 'class="btn btn-mini btn-info"' ) }}
						{{ Html::linkAction( 'Admin\UsersController@destroy', 'Delete', ['id'=>$user->id], ['data-method'=>'delete', 'class'=>'btn btn-mini btn-danger'] ) }}
					</td>
					<td>{{ $user->id }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->firstname . ' ' . $user->lastname }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->confirmed }}</td>
					<td>{{ $user->roles->first()->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $users->links() }}
@stop