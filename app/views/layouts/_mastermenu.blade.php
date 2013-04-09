<a class="brand" href="{{ URL::to('/') }}">Simple Blog</a>

<div class="nav-collapse collapse">
	<ul class="nav">
		<li {{ (Request::is('/') or Request::is('post*')) ? 'class="active"' : '' }}>
			{{ Html::linkAction( 'PostsController@index', 'Posts' ) }}
		</li>
	</ul>
	<ul class="nav pull-right">
		<li class="dropdown {{ (Request::is('user*') or Request::is('admin*')) ? 'active' : '' }}">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li>{{ Html::linkAction( 'UserController@login', 'Login' ) }}</li>
				<li>{{ Html::linkAction( 'UserController@create', 'Create' ) }}</li>
			</ul>
		</li>
	</ul>
</div><!--/.nav-collapse -->