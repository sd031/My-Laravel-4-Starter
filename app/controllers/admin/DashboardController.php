<?php namespace Admin;

class DashboardController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content = \View::make('admin.dashboard');
	}

}