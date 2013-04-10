<a class="brand" href="{{ URL::to('admin') }}">Admin</a>

@if (! Auth::guest() )
	<div class="nav-collapse collapse">
		<ul class="nav">
			<li {{ (Request::is('admin/dashboard*')) ? 'class="active"' : '' }}>
				{{ Html::linkAction( 'Admin\DashboardController@index', 'Dashboard' ) }}
			</li>

			@if( Auth::user()->can("manage_posts") )
				<li {{ (Request::is('admin/post*')) ? 'class="active"' : '' }}>
					{{ Html::linkAction( 'Admin\PostsController@index', 'Posts' ) }}
				</li>
			@endif

			@if( Auth::user()->can("manage_users") )
				<li {{ (Request::is('admin/users*')) ? 'class="active"' : '' }}>
					{{ Html::linkAction( 'Admin\UsersController@index', 'Users' ) }}
				</li>
			@endif
		</ul>
		<ul class="nav pull-right">
			<li>
				{{ Html::linkAction( 'UserController@logout', 'Logout' ) }}
			</li>
		</ul>
	</div><!--/.nav-collapse -->
@endif