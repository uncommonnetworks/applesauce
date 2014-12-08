<?php

class CurrentAddress extends Eloquent{



    // these attributes ought not to be set or edited
    protected $guarded = array('id', 'resident_id');

    // don't need to track
    //protected $timestamps = false;


    /** relationships */

    protected $touches = array('resident');

    public function resident()
    {
        return $this->belongsTo('Resident');
    }


    /** TODO: get this from config */
    public static function moveInAddress()
    {
        $address = new CurrentAddress;
        $address->street1 = '201 Glenridge Ave';
        $address->street2 = 'Southridge';
        $address->city = 'St. Catharines';
        $address->postal = 'L2T 3J6';
        $address->region = 'Niagara';
        $address->start_date = date( 'Y-m-d' );

        return $address;
    }

}




CurrentAddress::creating(function($record){
    $record->created_by = Auth::user()->id;
});


CurrentAddress::updating(function($record){
    $record->updated_by = Auth::user()->id;
});
