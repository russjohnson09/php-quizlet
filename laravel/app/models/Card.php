<?php

class Card extends Eloquent {

    public function reviews()
    {
        return $this->hasMany('CardReview');
    }

}