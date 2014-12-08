<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Culpa\Blameable;


define( 'NOTETYPE_SHIFT', 'shift-note' );
define( 'NOTETYPE_DETAIL', 'detail-note' );
//define( 'NOTETYPE_GOVT', 'govt-note' );


define( 'NOTEFLAG_INTAKE', 'intake' );
define( 'NOTEFLAG_PENDINGINTAKE', 'pending');
define( 'NOTEFLAG_OUTTAKE', 'outtake' );
define( 'NOTEFLAG_GENERAL', 'general' );
define( 'NOTEFLAG_COACHING', 'coaching' );
define( 'NOTEFLAG_STRIKE', 'strike' );
define( 'NOTEFLAG_WARNING', 'warning' );
define( 'NOTEFLAG_INCIDENT', 'incident' );
define( 'NOTEFLAG_OBSERVATION', 'observation' );
define( 'NOTEFLAG_SUSPENSION', 'suspension' );
define( 'NOTEFLAG_OWP', 'owp' );
define( 'NOTEFLAG_OWPR', 'owpr' );
define( 'NOTEFLAG_MANAGEMENT', 'management' );

// TODO config
define( 'NOTE_DATEFORMAT', 'M d, H:i');


class Note extends Eloquent
{
    use SoftDeletingTrait;
    use Culpa\UpdatedBy, Culpa\DeletedBy;



    public static $types = array(
        NOTETYPE_SHIFT => 'Shift Note',
        NOTETYPE_DETAIL => 'Detail Note'
//        NOTETYPE_GOVT => 'Government Note'
    );

    public static $flags = array(
        NOTEFLAG_INTAKE => 'Intake',
        NOTEFLAG_PENDINGINTAKE => 'Potential Intake',
        NOTEFLAG_OUTTAKE => 'Outtake',
        NOTEFLAG_GENERAL => 'General',
        NOTEFLAG_WARNING => 'Warning',
        NOTEFLAG_STRIKE => 'Strike',
        NOTEFLAG_SUSPENSION => 'Suspension',
        NOTEFLAG_INCIDENT => 'Incident',
        NOTEFLAG_OBSERVATION =>'Behavioural/Observation',
        NOTEFLAG_COACHING => 'Coaching',
        NOTEFLAG_OWP => 'OWP',
        NOTEFLAG_OWPR => 'OWP Return'
    );

    public static $flagIcon = array(
        NOTEFLAG_INTAKE => 'fa-sign-in',
        NOTEFLAG_PENDINGINTAKE => 'fa-clock',
        NOTEFLAG_GENERAL => 'fa-pencil',
        NOTEFLAG_WARNING => 'fa-warning',
        NOTEFLAG_STRIKE => 'fa-thumbs-down',
        NOTEFLAG_SUSPENSION => 'fa-minus-circle',
        NOTEFLAG_INCIDENT => 'fa-exclamation-circle',
        NOTEFLAG_OBSERVATION =>'fa-quote-left',
        NOTEFLAG_COACHING => 'fa-heart-o',
        NOTEFLAG_OWP => 'fa-suitcase',
        NOTEFLAG_OWPR => 'fa-suitcase',
        NOTEFLAG_OUTTAKE => 'fa-exit'
    );

    public static $typeIcon = array(
        NOTETYPE_SHIFT => 'fa-gears',
        NOTETYPE_DETAIL => 'fa-comment-o'
//        NOTETYPE_GOVT => 'fa-institution'
    );

    public static $flagClass = array(
        NOTEFLAG_INTAKE => 'primary',
        NOTEFLAG_PENDINGINTAKE => 'primary',
        NOTEFLAG_GENERAL => 'info',
        NOTEFLAG_WARNING => 'warning',
        NOTEFLAG_STRIKE => 'danger',
        NOTEFLAG_INCIDENT => 'warning',
        NOTEFLAG_SUSPENSION => 'danger',
        NOTEFLAG_OBSERVATION =>'warning',
        NOTEFLAG_COACHING => 'success',
        NOTEFLAG_OWP => 'primary',
        NOTEFLAG_OWPR => 'primary',
        NOTEFLAG_OUTTAKE => 'info'
    );

    public static $typesByFlag = array(
        NOTEFLAG_INTAKE => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_PENDINGINTAKE => [ NOTETYPE_SHIFT ],
        NOTEFLAG_OUTTAKE => array( NOTETYPE_DETAIL ),
        NOTEFLAG_GENERAL => array( NOTETYPE_SHIFT ),
        NOTEFLAG_WARNING => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_STRIKE => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_INCIDENT => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_SUSPENSION => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_OBSERVATION => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_COACHING => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_OWP => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT ),
        NOTEFLAG_OWPR => array( NOTETYPE_DETAIL, NOTETYPE_SHIFT )

    );

    public static $residentsByFlag = array(
        NOTEFLAG_INTAKE => 1,
        NOTEFLAG_PENDINGINTAKE => 0,
        NOTEFLAG_OUTTAKE => 1,
        NOTEFLAG_GENERAL => 0,
        NOTEFLAG_WARNING => 1,
        NOTEFLAG_STRIKE => 1,
        NOTEFLAG_INCIDENT => 2,
        NOTEFLAG_SUSPENSION => 1,
        NOTEFLAG_OBSERVATION => 1,
        NOTEFLAG_COACHING => 1,
        NOTEFLAG_OWP => 1,
        NOTEFLAG_OWPR => 1
    );

    public static $residentScopeByFlag = array(
        NOTEFLAG_INTAKE => 'former',
        NOTEFLAG_OUTTAKE => 'current',
        NOTEFLAG_OBSERVATION => 'living',
        NOTEFLAG_WARNING => 'current',
        NOTEFLAG_STRIKE => 'current',
        NOTEFLAG_SUSPENSION => 'living',
        NOTEFLAG_COACHING => 'current',
        NOTEFLAG_INCIDENT => 'living',
        NOTEFLAG_OWP => 'current',
        NOTEFLAG_OWPR => 'owp'
    );

    public static $bedsByFlag = array(
        NOTEFLAG_INTAKE => 1,
        NOTEFLAG_PENDINGINTAKE => 0,
        NOTEFLAG_OUTTAKE => 0,
        NOTEFLAG_GENERAL => 0,
        NOTEFLAG_WARNING => 0,
        NOTEFLAG_STRIKE => 0,
        NOTEFLAG_SUSPENSION => 0,
        NOTEFLAG_INCIDENT => 0,
        NOTEFLAG_OBSERVATION => 0,
        NOTEFLAG_COACHING => 0,
        NOTEFLAG_OWP => 0,
        NOTEFLAG_OWPR => 0
    );


    protected $fillable = ['type', 'flag', 'title', 'text'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $blameable = ['updated', 'deleted'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function residents()
    {
        return $this->morphedByMany('Resident', 'noted');
    }

    public function beds()
    {
        return $this->morphedByMany('Bed', 'noted');
    }

    public function residencies()
    {
        return $this->morphedByMany('Residency', 'noted');
    }

    public function users()
    {
        return $this->morphedByMany('User', 'noted');
    }


    public function author()
    {
        return $this->belongsTo('User', 'author_id', 'id');
    }



    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeOfType($query, $type)
    {
        return $query->whereType( $type )
            ->orderBy('important', 'DESC')
            ->orderBy('created_at','DESC');
    }

    public function scopeWithFlag($query, $flag)
    {
        return $query->whereFlag( $flag )
            ->orderBy('important', 'DESC')
            ->orderBy('created_at','DESC');
    }

    public function scopeImportant($query)
    {
        return $query->whereImportant( true );
    }

    public function scopeNotImportant($query)
    {
        return $query->whereImportant( false );
    }

    public function scopeToday($query)
    {
        return $query->where('created_at', '>=', Carbon\Carbon::today())
            ->orderBy('important', 'DESC')
            ->orderBy('created_at','DESC');
    }

    public function scopeYesterday($query)
    {
        return $query->where('created_at', '>=', Carbon\Carbon::yesterday())
            ->where('created_at', '<', Carbon\Carbon::today())
            ->orderBy('important', 'DESC')
            ->orderBy('created_at','DESC');
    }



    /*
    |--------------------------------------------------------------------------
    | Computed Fields
    |--------------------------------------------------------------------------
    */
/*
    public function getOneResidentAttribute()
    {
        if( $this->residents )
            return $this->residents->first();

        return false;
    }
*/

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */


    public function setImportant($boolean)
    {
        $this->attributes['important'] = $boolean;
    }


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function __toString()
    {
        return $this->text;
    }



    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public static function makeNew( $type, $flag, $title, $text, $residents=null )
    {
        $note = new Note( array( 'type' => $type, 'flag' => $flag, 'title' => $title, 'text' => $text ) );

        $note->save();


        if( get_class($residents) == 'Illuminate\Database\Eloquent\Collection' )
        {
            Log::info($residents->modelKeys());
            $note->residents()->attach( $residents->modelKeys() );
        }
        else if( get_class($residents) == 'Resident' )
            $note->residents()->attach( $residents->id );

        return $note;
    }


    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */

    /** which note flags could apply to a given resident?
     *
     */
    public static function flagsAvailableForResident( Resident $resident )
    {
        // always available
        $flags = [NOTEFLAG_OBSERVATION];

        switch($resident->status)
        {
            case RESIDENTSTATUS_CURRENT:
                $flags = array_merge($flags, [NOTEFLAG_OUTTAKE, NOTEFLAG_WARNING, NOTEFLAG_STRIKE, NOTEFLAG_SUSPENSION, NOTEFLAG_INCIDENT, NOTEFLAG_COACHING, NOTEFLAG_OWP]);
                break;

            case RESIDENTSTATUS_FORMER:
                $flags = array_merge($flags, [NOTEFLAG_INTAKE, NOTEFLAG_SUSPENSION, NOTEFLAG_INCIDENT]);
                break;

            case RESIDENTSTATUS_OWP:
                $flags = array_merge($flags, [NOTEFLAG_OUTTAKE, NOTEFLAG_SUSPENSION, NOTEFLAG_INCIDENT, NOTEFLAG_OWPR]);
                break;

            case RESIDENTSTATUS_SUSPENDED:
            case RESIDENTSTATUS_INTAKE:
            case RESIDENTSTATUS_DELETED:
            case RESIDENTSTATUS_DECEASED:
                $flags[] = NOTEFLAG_INCIDENT;
        }

        $flagsWithNames = [];

        foreach( $flags as $flag )
            $flagsWithNames[ $flag ] = Note::$flags[ $flag ];

        return $flagsWithNames;
    }


    public static function flagsFoundForResident( Resident $resident, $type )
    {
        $flagsWithCounts = [];

        foreach( $resident->notes()->ofType($type)->get() as $note )
        {
            if(isset($flagsWithCounts[ $note->flag ]))
                $flagsWithCounts[ $note->flag ]++;
            else
                $flagsWithCounts[ $note->flag ] = 1;
        }

//       foreach( Note::$flags as $flag => $name )
//           if(!isset($flagsWithCounts[$flag]))
//               $flagsWithCounts[$flag] = 0;

        return $flagsWithCounts;
    }


}





Note::creating( function($note)
{
    $note->author_id = Auth::user()->id;
});


Note::updating( function($note)
{

});
