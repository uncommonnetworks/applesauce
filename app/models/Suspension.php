<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;


define('SUSPENSION_SHELTER', 'shelter-ban');
define('SUSPENSION_PROGRAM', 'programs-only');
define('SUSPENSION_OVERNIGHT', 'overnight');

define('SUSPENSIONSTATUS_CURRENT', 'current');
define('SUSPENSIONSTATUS_FUTURE', 'pending');
define('SUSPENSIONSTATUS_PAST', 'complete');

define('SUSPENSION_3DAY', 3);
define('SUSPENSION_7DAY', 7);
define('SUSPENSION_30DAY', 30);
define('SUSPENSION_90DAY', 90);
define('SUSPENSION_INDEFINITE', 0);


class Suspension extends Eloquent{

    use SoftDeletingTrait;
    use Culpa\CreatedBy, Culpa\UpdatedBy, Culpa\DeletedBy;


    public static $types = array(
        SUSPENSION_SHELTER => 'Shelter Ban',
        SUSPENSION_OVERNIGHT => 'Overnight',
        SUSPENSION_PROGRAM => 'Programs Only'
    );

    public static $states = array(
        SUSPENSIONSTATUS_PAST => SUSPENSIONSTATUS_PAST,
        SUSPENSIONSTATUS_CURRENT => SUSPENSIONSTATUS_CURRENT,
        SUSPENSIONSTATUS_FUTURE => SUSPENSIONSTATUS_FUTURE
    );

    public static $durations = array(
        SUSPENSION_3DAY => '3 Days',
        SUSPENSION_7DAY => '7 Days',
        SUSPENSION_30DAY => '30 Days',
        SUSPENSION_90DAY => '90 Days',
        SUSPENSION_INDEFINITE => 'Indefinite'
    );

    protected $fillable = ['type', 'duration'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'start_date', 'end_date'];

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


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeCurrent($query)
    {
        return $query->where('status', '<>', SUSPENSIONSTATUS_PAST);
    }

    public function scopeType($query, $type)
    {
        return $query->whereType($type);
    }

    public function scopeForResident($query, Resident $resident)
    {
        return $query->where('resident_id', '=', $resident->id);
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

    public static function makeNew( Resident & $resident, $type, $duration, Note & $shiftNote, Note & $detailNote )
    {
        $suspension = new Suspension( array('type' => $type, 'duration' => $duration) );
        $suspension->status = SUSPENSIONSTATUS_FUTURE;
        $suspension->resident()->associate($resident);
        $suspension->shiftNote()->associate($shiftNote);
        $suspension->detailNote()->associate($detailNote);
        $suspension->save();

        // notify
        $suspension->makeActive();


        return $suspension;
    }



    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */

    /**
     * A suspension is created first, then activated when the resident is informed.
     * The $start_date is when the suspension is made , then $duration
     */

    public function makeActive()
    {
        $this->start_date = Carbon::now();

        if($this->duration)
            $this->end_date = Carbon::now()->addDays($this->duration);

        $this->status = SUSPENSIONSTATUS_CURRENT;
        $this->save();

        return $this;
    }


    public function modify( $type, $duration, $endDate )
    {
        $this->type = $type;
        $this->duration = $duration;
        $this->end_date = new Carbon($endDate);
        $this->save();
    }


    public function expire()
    {
        $this->status = SUSPENSIONSTATUS_PAST;
        $this->end_date = Carbon::now();
        $this->save();

        return $this;
    }


    /**
     * what end date options are available when editing this suspension?
     */

    public function isEnded()
    {
        if( $this->status != SUSPENSIONSTATUS_CURRENT || $this->duration == SUSPENSION_INDEFINITE )
            return false;


        // indirectly, if the status is current, and the duration is not indefinite, then end date must be set
        return $this->end_date->isPast();

    }
}





Suspension::created( function($suspension)
{




});


Suspension::updating( function($suspension)
{


});


Suspension::observe(new Culpa\BlameableObserver);