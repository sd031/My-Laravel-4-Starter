<?php

use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

	protected $table = 'posts';

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
		'title'      => 'required|min:4',
		'slug'       => 'required|alpha_dash|min:4',
		'content'    => 'required|min:10',
		'author_id'  => 'required|numeric',
	);

	/**
	 * Belongs to user
	 */
	public function author()
	{
		return $this->belongsTo( 'User', 'author_id' );
	}

	/**
	 * Post date
	 *
	 * @return string
	 */
	public function postedAt()
	{
		$date_obj = $this->created_at;

		if (is_string($this->created_at))
			$date_obj = DateTime::createFromFormat('Y-m-d H:i:s', $date_obj);

		return $date_obj->format('d/m/Y');
	}
}