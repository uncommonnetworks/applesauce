<?php


class Wanted extends Eloquent{

    protected $fillable = array('name');


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function resident()
    {
        return $this->belongsTo('Resident');
    }

    public function staff()
    {
        return $this->belongsTo('Staff');
    }

    public function updated_by()
    {
        return $this->hasOne('Staff', 'id', 'updated_by');
    }

    public function shiftNote()
    {
        return $this->hasOne('Note', 'id', 'shift_note_id');
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

    public static function makeNew( Staff & $staff, Note & $shiftNote, $name )
    {
        $wanted = new Wanted( array('name' => $name) );
        $wanted->staff()->associate($staff);
        $wanted->shiftNote()->associate($shiftNote);

        $wanted->save();

        return $wanted;
    }



    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */

    public function attachResident( Resident & $resident )
    {
        $this->resident()->associate($resident);
        $this->save();
    }

    public function detachResident()
    {
        $this->resident()->detach();
    }
}





Strike::created( function($strike)
{




});


Strike::updating( function($strike)
{

    
});
