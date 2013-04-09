<?php namespace Admin;

use Post, Input, Confide, Redirect;

class PostsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::with('author')->paginate(8);

		$this->layout->content = \View::make('admin.posts.index')
			->with( 'posts', $posts );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = \View::make('admin.posts.create')
			->with( 'action', 'Admin\PostsController@store')
			->with( 'method', 'POST');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$post = new Post;

		$post->title = Input::get( 'title' );
		$post->slug = Input::get( 'slug' );
		$post->content = Input::get( 'content' );
		$post->lean_content = Input::get( 'lean_content' );
		$post->author_id = Confide::user()->id;
		$post->display = (Input::get( 'display' ) != null ? 1 : 0);

		// Save if valid
		if ( $post->save() )
		{
			return Redirect::action('Admin\PostsController@index')
				->with( 'flashsuccess', 'Post is saved!' );
		}
		else
		{
			// Get validation errors (see Ardent package)
			$error = $post->errors()->all();

			return Redirect::action('Admin\PostsController@create')
				->withInput()
				->with( 'flasherror', $error );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		if(! $post)
			return Redirect::action('Admin\PostsController@index');

		$this->layout->content = \View::make('admin.posts.edit')
			->with( 'post', $post )
			->with( 'action', 'Admin\PostsController@update')
			->with( 'method', 'PUT');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::find( $id );

		$post->title = Input::get( 'title' );
		$post->slug = Input::get( 'slug' );
		$post->content = Input::get( 'content' );
		$post->lean_content = Input::get( 'lean_content' );
		$post->display = (Input::get( 'display' ) != null ? 1 : 0);

		// Save if valid
		if ( $post->save() )
		{
			return Redirect::action('Admin\PostsController@index')
				->with( 'flashsuccess', 'Post updated' );
		}
		else
		{
			// Get validation errors (see Ardent package)
			$error = $post->errors()->all();

			return Redirect::action('Admin\PostsController@edit', ['id'=>$id])
				->withInput()
				->with( 'flasherror', $error );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);

		$post->delete();

		return Redirect::action('Admin\PostsController@index')
				->with( 'flashsuccess', 'Post deleted!' );
	}

}