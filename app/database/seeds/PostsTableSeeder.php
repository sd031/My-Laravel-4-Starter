<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('posts')->delete();

		$posts = array(
			[
				'id'           => 1,
				'title'        => 'First post',
				'slug'         => 'first-post',
				'lean_content' => 'Some preview text of post 1',
				'content'      => 'This is the full text of post 1',
				'author_id'    => 1,
				'display'      => 1,
			],
			[
				'id'           => 2,
				'title'        => 'Second post',
				'slug'         => 'second-post',
				'lean_content' => 'Some preview text of post 2',
				'content'      => 'This is the full text of post 2',
				'author_id'    => 1,
				'display'      => 1,
			],
			[
				'id'           => 3,
				'title'        => 'Third post',
				'slug'         => 'third-post',
				'lean_content' => 'Some preview text of post 3',
				'content'      => 'This is the full text of post 3',
				'author_id'    => 2,
				'display'      => 1,
			],
		);

		// Uncomment the below to run the seeder
		DB::table('posts')->insert($posts);
	}

}
