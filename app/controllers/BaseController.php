<?php

abstract class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	public function __call($method,$args) 
	{
		try {
			return View::make($method);
		}
		catch (Exception $e) {
			App::abort(404);
		}
		
	}

}
