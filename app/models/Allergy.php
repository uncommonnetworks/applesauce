<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Allergy extends Eloquent {


//    use SoftDeletingTrait;
    protected $guarded = array( 'id' );
    public $timestamps = false;

    /** relationships */

    public function residents()
    {
        return $this->belongsToMany('Resident')
            ->withTimestamps();
    }

    public function __toString()
    {
        return $this->name;
    }

}