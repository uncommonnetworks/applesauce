<?php

use Culpa\Blameable;


define( 'LOCKERSTATUS_OCCUPIED', 'occupied' );
define( 'LOCKERSTATUS_DIRTY', 'dirty' );
define( 'LOCKERSTATUS_VACANT', 'empty' );
define( 'LOCKERSTATUS_OOO', 'ooo' );


class Locker extends Eloquent
{
    use Culpa\UpdatedBy;


    public static $states = array(
        LOCKERSTATUS_OCCUPIED => 'occupied',
        LOCKERSTATUS_DIRTY => 'needs cleaning',
        LOCKERSTATUS_VACANT => 'empty',
        LOCKERSTATUS_OOO => 'out of order'
    );

    public static $stateBackgroundClass = array(
        LOCKERSTATUS_OCCUPIED => 'bg-info',
        LOCKERSTATUS_DIRTY => 'bg-warning',
        LOCKERSTATUS_VACANT => 'bg-panel',
        LOCKERSTATUS_OOO => 'bg-dark-gray'
    );


    // no dates or mods
    public $dates = ['updated_at'];
    public $blameable = ['updated'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function resident()
    {
        return $this->belongsTo('Resident');
    }

    public function lock()
    {
        return $this->hasOne('Lock');
    }

    public function room()
    {
        return $this->belongsTo('Lockerroom', 'room_id', 'id');
    }




    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */


    public function scopeActive($query)
    {
        return $query->where('status', '<>', LOCKERSTATUS_OOO);
    }

    public function scopeVacant($query)
    {
        return $query->where('status', '=', LOCKERSTATUS_VACANT);
    }

    public function scopeOccupied($query)
    {
        return $query->where('status', '=', LOCKERSTATUS_OCCUPIED);
    }

    public function scopeDirty($query)
    {
        return $query->where('status', '=', LOCKERSTATUS_DIRTY);
    }



    public function scopeInRoom($query,$room)
    {
        return $query->where('room_id',$room);
    }

    public function scopeInRow($query,$row)
    {
        return $query->where('row',$row);
    }


    /*
    |--------------------------------------------------------------------------
    | Computed Fields
    |--------------------------------------------------------------------------
    */




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




    public function __toString()
    {
        return "{$this->room->name} :: {$this->name}";
    }



    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */


    // assign locker to resident
    // also assing randomly selected locker
    public function helloResident( Resident $resident)
    {

        $this->resident()->associate($resident);
        $this->status = LOCKERSTATUS_OCCUPIED;
        $this->save();

        if( $lock = Lock::available()->orderBy(DB::raw('RAND()'))->first() )
            $lock->helloLocker($this);
        else
            Log::error('couldnt assign random lock when assigning locker');

        return $this;
    }


    // when a resident leaves, the locker needs to be cleaned
    public function goodbyeResident()
    {
// AF/1.0: Lockers retain resident until locker is cleaned
//        if( $this->lock )
//            $this->lock->goodbyeLocker();
//
//        $this->resident_id = null;
        $this->status = LOCKERSTATUS_DIRTY;
        $this->save();
    }


    public function clean()
    {
        if( $this->lock )
            $this->lock->goodbyeLocker();

        $this->resident_id = null;

        $this->status = LOCKERSTATUS_VACANT;
        $this->save();


        return $this;
    }

}




/*
Locker::created( function($note)
{




});


Locker::updating( function($note)
{


});
*/

Locker::observe(new Culpa\BlameableObserver());