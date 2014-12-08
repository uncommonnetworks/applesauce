<?php

//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use RunMyBusiness\Initialcon\Initialcon;


class User extends Eloquent implements ConfideUserInterface {

    use SoftDeletingTrait;
    use ConfideUser;
    use HasRole;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


	protected $hidden = ['password'];



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function notes()
    {
        return $this->hasMany('Note', 'author_id', 'id');
    }




    /*
    |--------------------------------------------------------------------------
    | Computed Fields
    |--------------------------------------------------------------------------
    */

    public function getInitialImgAttribute()
    {
        $initialcon = new Initialcon();

        return $initialcon->getImageObject($this->initials, $this->email, 32);
    }

    public function getInitialUrlAttribute()
    {
        return "user/img/{$this->id}";
    }

}
