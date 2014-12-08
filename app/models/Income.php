<?php

use Culpa\Blameable;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

define( 'INCOMETYPE_OW', 'OW' );
define( 'INCOMETYPE_ODSP', 'ODSP' );
define( 'INCOMETYPE_OTHER', 'Other' );




class Income extends Eloquent
{
    use Culpa\UpdatedBy;
    use SoftDeletingTrait;

    public static $types = array(
        INCOMETYPE_ODSP => INCOMETYPE_ODSP,
        INCOMETYPE_OW => INCOMETYPE_OW,
        INCOMETYPE_OTHER => INCOMETYPE_OTHER
    );




    public $dates = ['created_at', 'updated_at', 'deleted_at'];
    public $blameable = ['created','updated','deleted'];
    protected $fillable = ['amount'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function residency()
    {
        return $this->belongsTo('Residency');
    }

    public function source()
    {
        return $this->belongsTo('IncomeSource', 'income_source_id');
    }




    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */


    public function scopeOfType($type, $query)
    {
        return $query->whereType($type);
    }

    public function scopeOfResidency(Residency $residency, $query)
    {
        return $query->where('residency_id', '=', $residency->id);
    }

    public function scopeOfResident(Resident $resident, $query)
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


    public function setTypeAttribute( $type )
    {
        if( in_array( $type, Income::$types ) )
            $this->attributes['type'] = $type;

        else
            $this->attributes['type'] = INCOMETYPE_OTHER;
    }



    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */




    public function __toString()
    {
        return "{$this->source}: \${$this->amount}";
    }



    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function saveToResidency( Residency & $residency, $type, IncomeSource $source, $amount )
    {
        $income = Income::create( ['amount' => $amount] );
        $income->type = $type;
        $income->source()->associate($source);

        $residency->incomes()->save($income);
        $residency->totalIncome += $income->amount;
        $residency->save();

        return $income;
    }





    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    */

}




Income::observe(new Culpa\BlameableObserver());