<?php

use Carbon\Carbon;

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
		$this->data['card'] = new Card();
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
            $card->front = Input::get('front');
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
	
	public function review($card)
	{
		$review = new CardReview();
		if(Input::has('correct')) {
			$review->correct = true;
			$pastReview = CardReview::where('card_id',$card->id)->orderBy('created_at','desc')->first();
			if (empty($pastReview)) {
				$due_date = Carbon::now()->addDays(2);
			}
			else {
				$min = Carbon::now()->addDays(2);
				$due2 = Carbon::now()
						->addMinutes(
							($pastReview->created_at->diffInMinutes(Carbon::now())) * 2
						);
				$due_date = $min->max($due2);
			}
		}
		else {
			$review->correct = false;
			$due_date = Carbon::now()->addDay();
		}
		
		$review->due_date = $due_date;
		$review->card_id = $card->id;
		$review->save();
	
		
		return Redirect::action('CardController@edit', array('card' => $card->id));
	}
	
	private function getDueDate($card)
	{
		$responses = Response::get(2)->orderBy('created_at','desc');
		if (count($responses) < 1) {
			
		}
		
	}
	
	private function isDue($card)
	{
		$dueDate = $this->getDueDate($card);
		return $dueDate < Carbon::now();
	}


}
