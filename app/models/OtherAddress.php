<?php


class OtherAddress extends Eloquent{



    // these attributes ought not to be set or edited
    protected $guarded = array('id', 'resident_id');

    protected $dates = ['start_date','end_date','current_created_at'];

    /** relationships */

    protected $touches = array( 'resident' );

    public function resident()
    {
        return $this->belongsTo('Resident');
    }



    /** calculated fields */

    public function getRegionAttribute($value)
    {
        return $value ? $value : ADDRESS_DEFAULT_REGION;
    }


    /* why??
    public function getStartDateAttribute($value)
    {
        return (int)($value) ? $value : date( 'Y-m-d', strtotime('1 year ago') );
    }
    */


    /** random function to limit year selection to 7 years :) */
    public static function startDateYears()
    {
        $y = date( 'Y' );
        $years = array();

        for( $i = 0; $i < 7; $i++ )
            $years[] = $y - $i;

        return $years;
    }


    public static function makeFromAddress( $address )
    {
        $otherAddress = new OtherAddress( array(
            'street1' => $address->street1,
            'street2' => $address->street2,
            'city'    => $address->city,
            'postal'  => $address->postal,
            'region' => $address->region,
            'start_date' => $address->start_date,
            'end_date' => $address->end_date,
            'current_created_by' => $address->created_by,
            'current_created_at' => $address->created_at,
            'latitude'    => $address->latitude,
            'longitude'  => $address->longitude,
        ));

        $otherAddress->resident()->associate($address->resident);
        $otherAddress->save();

        return $otherAddress;
    }
}




OtherAddress::creating(function($record){
    $record->created_by = Auth::user()->id;
});


OtherAddress::updating(function($record){
    $record->updated_by = Auth::user()->id;
});
