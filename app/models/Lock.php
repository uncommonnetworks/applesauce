<?php

use Culpa\Blameable;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


define('LOCKSTATUS_AVAILABLE', 'available');
define('LOCKSTATUS_INUSE', 'in-use');
define('LOCKSTATUS_OOO', 'out-of-order');



class Lock extends Eloquent
{
    use Culpa\UpdatedBy;
    use SoftDeletingTrait;

    public static $states = [
        LOCKSTATUS_AVAILABLE => LOCKSTATUS_AVAILABLE,
        LOCKSTATUS_INUSE => LOCKSTATUS_INUSE,
        LOCKSTATUS_OOO => LOCKSTATUS_OOO
    ];

    protected $fillable = ['combination'];
    protected $dates = ['updated_at', 'deleted_at'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function locker()
    {
        return $this->belongsTo('Locker');
    }




    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeAvailable($query)
    {
        return $query->whereStatus( LOCKSTATUS_AVAILABLE );
    }

    public function scopeGrabOne($query)
    {
        return $query->available()->orderBy(DB::raw('RAND()'))->take(1);
    }

    public function scopeOnLocker($query, $lockerId)
    {
        return $query->where('locker_id', '=', $lockerId);
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
        return "Lock {$this->id}: {$this->combination}";
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

    public function helloLocker(Locker $locker)
    {
        $this->locker()->associate($locker);
        $this->status = LOCKSTATUS_INUSE;
        $this->save();

        return $this;
    }

    public function goodbyeLocker()
    {
        $this->locker_id = null;
        $this->status = LOCKSTATUS_AVAILABLE;
        $this->save();

        return $this;
    }

}





Lock::observe(new Culpa\BlameableObserver());