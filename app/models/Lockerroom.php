<?php

class Lockerroom extends Eloquent {

    // no dates or mods
    public function getDates() { return array(); }
    public $timestamps = false;


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function lockers()
    {
        return $this->hasMany('Locker', 'room_id', 'id');
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
        return Locker::occupied()->inRoom($this->id)->get();
    }


    public function getDirtyAttribute()
    {
        return Locker::dirty()->inRoom($this->id)->get();
    }

    public function getVacantAttribute()
    {
        return Locker::vacant()->inRoom($this->id)->get();
    }

//    public function getRowsAttribute()
//    {
//        $rows = array();
//        foreach( $this->rows)
//    }


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
        return Locker::inRoom($this->id)->inRow($row)->get();
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