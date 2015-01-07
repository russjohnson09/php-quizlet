<?php

class Show extends Eloquent {

    public function episodes()
    {
        return $this->hasMany('Episode');
    }
	
}