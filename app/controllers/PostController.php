<?php


class PostController extends GenericRestfulController {

	protected $controller = 'PostController';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*
	public function index()
	{
		
		return View::make('post.index',array('posts'=>
				Post::orderBy('created_at','desc')
				->get()));
	}
	*/


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	protected function getRecords()
	{
		return Post::orderBy('created_at','desc')
				->get();
	}


}
