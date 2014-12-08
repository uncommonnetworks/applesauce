<?php

/** Types of ID */
define( 'IDENTIFICATION_SIN', 'sin' );
define( 'IDENTIFICATION_HEALTH', 'healthcard' );

/** Sizes */
define( 'IDENTIFICATION_THUMB', 'idthumb' );
define( 'IDENTIFICATION_BIG', 'idbig' );

/** Storage space */
define( 'IDENTIFICATION_PATH', 'data/identification/' );


class Identification extends Eloquent {

    public static $types = array(
        IDENTIFICATION_SIN => IDENTIFICATION_SIN,
        IDENTIFICATION_HEALTH => IDENTIFICATION_HEALTH
    );

    public static $typeNames = array(
        IDENTIFICATION_SIN => 'SIN Card',
        IDENTIFICATION_HEALTH => 'Health Card'
    );

    public static $sizes = array(
        IDENTIFICATION_THUMB => 100,
        IDENTIFICATION_BIG => 560
    );


    // these attributes ought not to be set or edited
//    protected $guarded = array('id');



    /** relationships **/

    public function resident()
    {
        return $this->belongsTo('Resident');
    }


    public function picture()
    {
        return $this->morphOne('Picture', 'pictureable');
    }


    /** Identification::ofType(sin) ... */

    public function scopeOfType($query, $type)
    {
        return $query->whereType($type);
    }




    /** computed fields */

    public function getPictureUrlAttribute()
    {
        return "/identification-image/{$this->id}";
    }

    public function getThumbUrlAttribute()
    {
        return "/identification-image/{$this->id}/thumb";
    }



    /** setters */





    /** ID images on demand */

    public function getPictureImg( $attributes, $size='small' )
    {
        $url = $this->pictureUrl;
        if( $url )
            return "<img src=\"{$url}\" alt=\"{$this->name}\" {$attributes} />";
    }




    /** start new identification record *
    public static function makeNew( Resident &$resident, $type, $number, $image=false )
    {
        $identification = new Identification;

        $identification->type = $type;
        $identification->number = $number;
        $identification->image = processImage($image);


        /* TODO: set created-by field to current user id *

        $identification = $resident->identifications()->save($identification);
        return $identification;
    }
*/

}




Identification::creating(function($record){
    $record->created_by = Auth::user()->id;
});


Identification::updating(function($record){
    $record->updated_by = Auth::user()->id;
});
