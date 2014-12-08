<?php

class Bedroom extends Eloquent {

    // no dates or mods
    public $dates = [];
    public $timestamps = [];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function beds()
    {
        return $this->hasMany('Bed', 'room_id', 'id')->orderBy('order');
    }





    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query; //->whereActive(true);
        // TODO: add active field to database
    }

    public function scopeMale($query)
    {
        return $query->where('gender', '=', 'male');
    }

    public function scopeFemale($query)
    {
        return $query->where('gender', '=', 'female');
    }


    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }


    /*
    |--------------------------------------------------------------------------
    | Computed Fields
    |--------------------------------------------------------------------------
    */

    public function getOccupiedAttribute()
    {
        return Bed::occupied()->inRoom($this->id)->get();
    }

    public function getNotreadyAttribute()
    {
        return Bed::notready()->inRoom($this->id)->get();
    }

    public function getVacantAttribute()
    {
        return Bed::vacant()->inRoom($this->id)->get();
    }


    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function row($row)
    {
        return Bed::inRoom($this->id)->inRow($row)->get();
    }


    public function __toString()
    {
        return $this->name;
    }


    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

}