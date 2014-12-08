<?php


use Culpa\Blameable;


define( 'BEDSTATUS_OCCUPIED', 'occupied' );
define( 'BEDSTATUS_NOTREADY', 'unmade' );
define( 'BEDSTATUS_VACANT', 'vacant' );
define( 'BEDSTATUS_OOO', 'out-of-order' );

class Bed extends Eloquent {

    use Culpa\UpdatedBy;


    public static $states = array(
        BEDSTATUS_OCCUPIED => 'occupied',
        BEDSTATUS_NOTREADY => 'needs stripping',
        BEDSTATUS_VACANT => 'vacant',
        BEDSTATUS_OOO => 'out of order'
    );

    public static $stateBadgeClass = array(
        BEDSTATUS_OCCUPIED => 'badge badge-success',
        BEDSTATUS_NOTREADY => 'badge badge-warning',
        BEDSTATUS_VACANT => 'badge badge-primary',
        BEDSTATUS_OOO => 'badge'
    );

    public static $stateBackgroundClass = array(
        BEDSTATUS_OCCUPIED => 'bg-info',
        BEDSTATUS_NOTREADY => 'bg-warning',
        BEDSTATUS_VACANT => 'bg-panel',
        BEDSTATUS_OOO => 'bg-dark-gray'
    );



    // no dates
    protected $dates = ['updated_at'];
    public $timestamps = false;

    // track updated by
    protected $blameable = ['updated'];







    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function bedHistory()
    {
        return $this->hasMany( 'BedHistory' );
    }

    public function bedroom()
    {
        return $this->belongsTo('Bedroom', 'room_id', 'id');
    }

    public function resident()
    {
        return $this->belongsTo('Resident');
    }


    public function notes()
    {
        return $this->morphToMany('Note', 'noted');
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

    public function scopeVacant($query)
    {
        return $query->where('status', '=', BEDSTATUS_VACANT);
    }

    public function scopeOccupied($query)
    {
        return $query->where('status', '=', BEDSTATUS_OCCUPIED);
    }

    public function scopeNotready($query)
    {
        return $query->where('status', '=', BEDSTATUS_NOTREADY);
    }

    public function scopeMen($query)
    {
        return $query->where('gender', 'M');
    }

    public function scopeWomen($query)
    {
        return $query->where('gender', 'F');
    }

    public function scopeInRoom($query,$room)
    {
        return $query->where('room_id',$room);
    }

    public function scopeInRow($query, $row)
    {
        return $query->whereRow($row);
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
        return "{$this->bedroom} :: {$this->name}";
    }




    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */


    // when a bed takes on a resident, it is occupied
    public function helloResident(Resident $resident)
    {
        $this->resident()->associate($resident);
        $this->status = BEDSTATUS_OCCUPIED;
        $this->save();
    }


    // when a resident leaves, the bed needs to be cleaned
    public function goodbyeResident()
    {
//        AF: resident stays until bed is cleaned
//        $this->resident_id = null;
        $this->status = BEDSTATUS_NOTREADY;
        $this->save();
    }



    public function clean()
    {
        $this->resident_id = null;
        $this->status = BEDSTATUS_VACANT;
        $this->save();


        return $this;
    }
}

/*
Bed::updated(function($bed)
{

});
*/

Bed::observe(new Culpa\BlameableObserver);