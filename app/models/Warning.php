<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;
use Culpa\Blameable;


define('WARNINGSTATUS_CURRENT', 'current');
define('WARNINGSTATUS_EXPIRED', 'expired');

// TODO configurable
define('WARNING_DURATION', 30);




class Warning extends Eloquent{

    use SoftDeletingTrait;
    use Culpa\CreatedBy, Culpa\UpdatedBy, Culpa\DeletedBy;


    public static $states = array(
        WARNINGSTATUS_CURRENT => WARNINGSTATUS_CURRENT,
        WARNINGSTATUS_EXPIRED => WARNINGSTATUS_EXPIRED
    );



    protected $fillable = ['reason'];

    protected $dates = ['created_at', 'updated_at', 'end_date', 'deleted_at'];

    protected $blameable = ['created', 'updated', 'deleted'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function resident()
    {
        return $this->belongsTo('Resident');
    }


    public function shiftNote()
    {
        return $this->belongsTo('Note', 'shift_note_id');
    }

    public function detailNote()
    {
        return $this->belongsTo('Note', 'detail_note_id');
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


    public function scopeCurrent($query)
    {
        return $query->whereStatus( WARNINGSTATUS_CURRENT );
    }

    public function scopeExpired($query)
    {
        return $query->whereStatus( WARNINGSTATUS_EXPIRED );
    }

    public function scopeForResident($query, $residentId )
    {
        return $query->whereResidentId( $residentId );
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




    /*
    |--------------------------------------------------------------------------
    | Construction
    |--------------------------------------------------------------------------
    */

    public static function makeNew( Resident & $resident, $reason, Note & $shiftNote, Note & $detailNote )
    {
        $warning = new Warning(['reason' => $reason]);

        $warning->duration = WARNING_DURATION;

        if($warning->duration)
            $warning->end_date = Carbon::now()->addDays($warning->duration);

        $warning->status = WARNINGSTATUS_CURRENT;
//        $warning->save();


        $warning->resident()->associate($resident);
        $warning->shiftNote()->associate($shiftNote);
        $warning->detailNote()->associate($detailNote);
        $warning->save();

        return $warning;
    }



    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */



    public function expire()
    {
        $this->end_date = Carbon::now();
        $this->status = WARNINGSTATUS_EXPIRED;
        $this->save();

        return $this;
    }
/*
    public function makeEnded()
    {
        $this->status = WARNINGSTATUS_EXPIRED;
        $this->save();

        return $this;
    }

    public function isEnded()
    {
        return $this->end_date->isPast();
    }
    */
}

/*


Warning::created( function($warning)
{


});


Warning::updating( function($warning)
{

});
*/

Warning::observe(new Culpa\BlameableObserver);