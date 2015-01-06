<?php

class CardController extends \BaseController {

	const TITLE = 'Cards';
	
	private $data = array('title' => self::TITLE);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['cards'] = $cards = Card::orderBy('updated_at','desc')->get();
		return View::make('card.index',$this->data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('card.create',$this->data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'front'       => 'required',
		);
        $validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::action('CardController@create')
				->withErrors($validator);
        }
		$card = new Card();
		$card->front = Input::get('front');
		$card->save();
		return Redirect::action('CardController@show', array('card' => $card));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $card
	 * @return Response
	 */
	public function show($card)
	{
		$this->data['card'] = $card;
		return  View::make('card.show',$this->data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($card)
	{
		$this->data['card'] = $card;
		return  View::make('card.edit',$this->data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers
	 */
	public function update($card)
	{
		$rules = array(
			'front'       => 'required',
		);
        $validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::action('CardController@edit', array('card' => $card))
				->withErrors($validator);
            //return Redirect::to('cards/' . $id . '/edit')
             //   ->withErrors($validator)
            //    ->withInput(Input::except('password'));
        } else {
            // store
            $card->front       = Input::get('front');
            $card->save();

            // redirect
            //Session::flash('message', 'Successfully updated nerd!');
            return Redirect::action('CardController@show', array('card' => $card));
        }
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


}
