<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




Route::get('/', function()
{
	return Redirect::to(route('dashboard'));
});


// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::get('login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');


/** The rest you have to log in first! */

Route::group(array('before' => 'auth'), function()
{

    // user profile
    Route::get('user/img/{id}', function($id){
        $user = User::findOrFail($id);
        return $user->initialImg->response();
    });


    Route::get('/dash', array( 'as' => 'dashboard', function(){
        return View::make('dashboard/staff');
    }));


    /** /search/name searches for name */

    Route::get('search/{q?}', function($q=null)
    {
        return View::make('search')
            ->with( 'q',$q )
            ->with( 'residents', Resident::search($q) );
    });


    /** /search can be POSTed to without URL name parameter */

    Route::post('search', array( 'as' => 'search', function()
    {
        return View::make('search')
            ->with( 'q', Input::get('q') )
            ->with( 'residents', Resident::search(Input::get('q')) );
    }));



    /** /profile/slug loads a resident profile *

    Route::get('/profile/{slug}', function($slug)
    {
        return View::make('profile')
            ->with( 'resident', Resident::where('slug', '=', $slug)->firstOrFail() );
    //        ->with( 'referer', $_REQUEST['HTTP_REFERER'] );
    });


    /** /resident/id loads a resident profile */
    Route::get('/resident/{id}', array('as' => 'resident', function($id)
    {
        return View::make('resident.profile')
            ->with( 'resident', Resident::findOrFail($id) );
    }));



    /*
    |--------------------------------------------------------------------------
    | Intake a former or new resident
    |--------------------------------------------------------------------------
    */

    Route::get('intake/{id?}', array( 'as' => 'intake-begin', function($id=null)
    {
        return View::make('intake.begin')
            ->with( 'resident', is_null($id) ? Resident::makeNew() : Resident::findOrFail($id) );
    }));

    Route::post('intake', 'IntakeController@intakeBegin');


    Route::get('intake-background/{id}', array('as' => 'intake-background', function($id)
    {
        return View::make('intake.background')
            ->with( 'resident', Resident::findOrFail($id) );
    }));

    Route::post('intake-background', 'IntakeController@intakeBackground');


    Route::get('intake-bed/{id}', array('as' => 'intake-bed', function($id)
    {
        return View::make('intake.bed')
            ->with( 'resident', Resident::findOrFail($id) );
    }));

    Route::post('intake-bed', 'IntakeController@intakeBed');


    Route::get('intake-contacts/{id}', array('as' => 'intake-contacts', function($id)
    {
        return View::make('intake.contacts')
            ->with( 'resident', Resident::findOrFail($id) )
            ->with( 'allergies', Allergy::lists('name', 'id') );
    }));

    Route::post('intake-contacts', 'IntakeController@intakeContacts');


    Route::get('intake-money/{id}', array('as' => 'intake-money', function($id)
    {
        return View::make('intake.money')
            ->with( 'resident', Resident::findOrFail($id) );
    }));

    Route::post('intake-money', 'IntakeController@intakeMoney');


    Route::get('intake-notes/{id}', array('as' => 'intake-notes', function($id)
    {
        require_once app_path() . '/models/Note.php';
        return View::make('intake.notes')
            ->with( 'resident', Resident::findOrFail($id) );
    }));

    Route::post('intake-notes', 'IntakeController@intakeNotes');


    Route::get('intake-finish/{id}', array('as' => 'intake-finish', function($id)
    {
        return View::make('intake.finish')
            ->with( 'resident', Resident::findOrFail($id) );
    }));

    Route::post('intake-finish', 'IntakeController@intakeFinish');



    /*
    |--------------------------------------------------------------------------
    | Resident.photo handling
    |--------------------------------------------------------------------------
    */


    Route::post('upload-resident-photo/{id}', 'ResidentController@uploadPhoto');
    Route::post('upload-resident-sin/{id}/{number}', 'IdentificationController@uploadResidentSin');
    Route::post('upload-resident-healthcard/{id}/{number}', 'IdentificationController@uploadResidentHealthCard');


    Route::get('resident-image/{id}/{size?}', function($id, $size='')
    {
        $resident = Resident::findOrFail($id);

        if( $resident->picture )
        {
            $image = Image::make(storage_path() . '/' . $resident->picture->getPath($size));
            if($image) return $image->response();

        }

        Log::warning("could not find image for resident($resident->id}");
//        App::abort(404);
    });


    Route::get('identification-image/{id}/{size?}', function($id, $size='')
    {

        $identification = Identification::findOrFail($id);

        $image = Image::make(storage_path() . trim("/{$identification->picture->path}"));
        return $image->response();
    });



    /*
    |--------------------------------------------------------------------------
    | Resident listing via JSON
    |--------------------------------------------------------------------------
    */

    Route::get('api/residents/all', function()
    {
        return Resident::all();
    });

    Route::get('api/residents/current', function()
    {
        return Resident::current()->get();
    });

    Route::any('api/residents/search', function()
    {
        return Resident::search(Input::get('q'),Input::get('scope'));
    });

    Route::any('api/residents/search/nolocker', function()
    {
        return Resident::search(Input::get('q'), array(RESIDENTSTATUS_CURRENT, 'noLocker'));
    });


    Route::get('api/resident', function()
    {
        return Resident::findOrFail(Input::get('id'));
    });


    Route::any('api/beds/vacant', function()
    {
        $q = Bed::vacant();

        if($gender = Input::get('gender'))
        {
            $q = $q->whereGender($gender);
        }

        return $q->get();
    });

    /*
    |--------------------------------------------------------------------------
    | Resident edit forms
    |--------------------------------------------------------------------------
    */

    Route::get('resident/edit/{id}', ['as' => 'resident-edit', function($id)
    {
        return View::make('resident.edit')
            ->with( 'resident', Resident::findOrFail($id) );

    }]);

    Route::post('resident/edit/form/{id}', 'ResidentController@editForm');


    /*
    |--------------------------------------------------------------------------
    | Image is a resource ??
    |--------------------------------------------------------------------------
    */

    //Route::resource('image', 'ImageController');


    /*
    |--------------------------------------------------------------------------
    | Notes are a RESTful Resource ??
    |--------------------------------------------------------------------------
    */

//    Route::resource('note', 'NoteController');


    /*
    |--------------------------------------------------------------------------
    | Notes Module
    |--------------------------------------------------------------------------
    */

    Route::get('notes', array( 'as' => 'notes', function()
    {
        return View::make('notes');
    }));


    Route::get('notes/resident/{id}', function($id){
        return View::make('notes/resident')
            ->with( 'resident', Resident::findOrFail($id) );
    });


    // partial views loaded with ajax
    Route::get('notes/recent', function(){
        return View::make('notes/recent');
    });

    Route::get('notes/dashboard', function(){
        return View::make('notes/dashboard');
//            ->with('notes', Note::ofType(NOTETYPE_SHIFT)->get());
    });


    Route::get('note-new/{flag}/{id?}', array( 'as' => 'note-new', function($flag, $id=null)
    {
        return View::make('notes.new')
            ->with( 'flag', $flag )
            ->with( 'resident', Resident::find($id) );
    }));

    foreach( Note::$flags as $flag => $flagName )
        Route::post("note-new/{$flag}",  'NotesController@new' . ucfirst($flag));
//    Route::post('note-new/general', 'NotesController@newGeneral');
//    Route::post('note-new/incident', 'NotesController@newIncident');
//    Route::post('note-new/observation', 'NotesController@newObservation');
//    Route::post('note-new/coaching', 'NotesController@newCoaching');


    // make important
    Route::get('note/important/{id}', ['as' => 'note-important', function($id)
    {
        $note = Note::findOrFail($id);
        $note->important = true;
        $note->save();

        return Redirect::back();
    }]);

    Route::get('note/unimportant/{id}', ['as' => 'note-unimportant', function($id)
    {
        $note = Note::findOrFail($id);
        $note->important = false;
        $note->save();

        return Redirect::back();
    }]);


    /*
    |--------------------------------------------------------------------------
    | Strikes Module
    |--------------------------------------------------------------------------
    */

    Route::get('strikes', array( 'as' => 'strikes', function()
    {
        return View::make('strikes/current');
    }));


    Route::get('warning/delete/{id}',
        array( 'as' => 'warning-delete',
               'uses' => 'StrikeController@deleteWarning'
    ));



    /*
    |--------------------------------------------------------------------------
    | Suspensions Module
    |--------------------------------------------------------------------------
    */

    Route::get('suspensions', array( 'as' => 'suspensions', function()
    {
        return View::make('suspensions/current');
    }));


    Route::get('suspension/edit/{id}', [ 'as' => 'suspension-edit', function($id)
    {
        return View::make('suspensions/edit')->with( 'suspension', Suspension::findOrFail($id) );
    }]);

    Route::post('suspension/edit/{id}', ['as' => 'suspension-edit', function($id){
        $suspension = Suspension::findOrFail($id);

        $suspension->modify( Input::get('suspension-type'),
                             Input::get('suspension-duration'),
                             Input::get('suspension-enddate')
        );

        if( $note = Input::get(NOTEFLAG_SUSPENSION .'-'. NOTETYPE_DETAIL) )
            Note::makeNew(NOTETYPE_DETAIL, NOTEFLAG_SUSPENSION, $suspension->resident->display_name, $note, $suspension->resident);

        return Redirect::route('suspensions');
    }
    ]);



    Route::get('suspension/delete/{id}', [ 'as' => 'suspension-delete', function($id)
    {
        $suspension = Suspension::findOrFail($id);

        $suspension->expire();
        $residency = $suspension->resident->unsuspend();
        $note = Note::makeNew(NOTETYPE_SHIFT,NOTEFLAG_INTAKE,$resident->display_name,Note::auto(NOTE_SUSPENSIONCANCEL,$resident->display_name),$resident );
        $residency->notes()->attach($note);

        return Redirect::route('profile', $suspension->resident->id);

    }]);




    /*
    |--------------------------------------------------------------------------
    | Bedding Module
    |--------------------------------------------------------------------------
    */

    Route::get('bedding', array( 'as' => 'bedding', function()
    {
        return View::make('bedding.rooms');
    }));


    Route::post('beds/clean',
        array( 'as' => 'bed-clean',
               'uses' => 'BedController@cleanBed'
    ));



    /*
    |--------------------------------------------------------------------------
    | Lockers Module
    |--------------------------------------------------------------------------
    */

    Route::get('lockers', array( 'as' => 'lockers', function()
    {
        return View::make('lockers.all');
    }));


    Route::post('lockers/clean',
        array( 'as' => 'locker-clean',
               'uses' => 'LockerController@cleanLocker'
    ));


    Route::post('lockers/assign',
        array( 'as' => 'locker-assign',
               'uses' => 'LockerController@assignLocker'
    ));




    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::controller('report', 'ReportsController');


});//
