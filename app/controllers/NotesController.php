<?php

// don't know why i need this
require_once app_path() . '/models/Note.php';


class NotesController extends \BaseController {

    public function newPending()
    {
        $notes = array();

        foreach( Note::$typesByFlag[ NOTEFLAG_PENDINGINTAKE ] as $type )
        {
            if( $text = Input::get("pending-{$type}"))
            {
                $note = Note::makeNew($type,NOTEFLAG_PENDINGINTAKE,Input::get(NOTEFLAG_PENDINGINTAKE .'-person'),$text );
                $note->save();
            }
        }

        return Redirect::route('dashboard');
    }


    public function newIntake()
    {
        $resident = Resident::findOrFail(Input::get('residents'));
        $resident->status = RESIDENTSTATUS_INTAKE;
        $date = Carbon\Carbon::now();
        $bed = Bed::findOrFail(Input::get('bed'));
        $notes = array();

        foreach( Note::$typesByFlag[ NOTEFLAG_INTAKE ] as $type )
        {
            if( $text = Input::get("intake-{$type}"))
            {
                $notes[] = Note::makeNew($type,NOTEFLAG_INTAKE,$resident->display_name,$text,$resident );
            }
        }

        $residency = Residency::intake($resident, $date, $bed);

        foreach( $notes as $note )
        {
            $residency->notes()->attach($note);

            // only attach shift note to bed
            if( $note->type == NOTETYPE_SHIFT )
                $bed->notes()->attach($note);
        }


        return Redirect::route('intake-background', array( 'id' => $resident->id ));
    }


    public function newOuttake()
    {
        $resident = Resident::findOrFail(Input::get('residents'));


        $address = new CurrentAddress();

        foreach( array( 'street1', 'street2', 'city', 'postal', 'region' ) as $var )
            $address->$var = Input::get( $var );

        $address->start_date = Carbon\Carbon::now()->addDay();


        $notes = [];

        foreach( Note::$typesByFlag[ NOTEFLAG_INTAKE ] as $type )
        {
            if( $text = Input::get("outtake-{$type}"))
            {
                $notes[] = Note::makeNew($type,NOTEFLAG_OUTTAKE,null,$text,$resident );
            }
        }

        foreach( $notes as $note )
        {
            $resident->residency->notes()->attach($note);

            if( $note->type == NOTETYPE_SHIFT && $resident->bed )
                $resident->bed->notes()->attach($note);
        }

        $resident->residency->end();

        $resident->outtake($address);

        return Redirect::route('resident',$resident->id);
    }


    public function newGeneral()
    {
        $note = Note::makeNew(NOTETYPE_SHIFT, NOTEFLAG_GENERAL, null, Input::get(NOTEFLAG_GENERAL.'-'.NOTETYPE_SHIFT));
        $note->save();

        return Redirect::route('dashboard');
    }



    public function newIncident()
    {
        $residents = Resident::whereIn('id', preg_split('/,/',Input::get('residents')))->get();
//        dd(preg_split('/,/',Input::get('resident')));
//        dd($residents);

        foreach( Note::$typesByFlag[NOTEFLAG_INCIDENT] as $type )
        {
            if( $text = Input::get("incident-{$type}") )
                $notes[] = Note::makeNew($type, NOTEFLAG_INCIDENT, null, $text, $residents);
        }


        return Redirect::route('dashboard');
    }

    public function newObservation()
    {
        $residents = Resident::whereIn('id', preg_split('/,/',Input::get('residents')))->get();
//        dd(preg_split('/,/',Input::get('resident')));
//        dd($residents);

        foreach( Note::$typesByFlag[NOTEFLAG_OBSERVATION] as $type )
        {
            if( $text = Input::get("observation-{$type}") )
                $notes[] = Note::makeNew($type, NOTEFLAG_OBSERVATION, null, $text, $residents);
        }


        return Redirect::route('dashboard');
    }

    public function newCoaching()
    {
        $residents = Resident::whereIn('id', preg_split('/,/',Input::get('residents')))->get();
//        dd(preg_split('/,/',Input::get('resident')));
//        dd($residents);

        foreach( Note::$typesByFlag[NOTEFLAG_COACHING] as $type )
        {
            if( $text = Input::get("coaching-{$type}") )
                $notes[] = Note::makeNew($type, NOTEFLAG_COACHING, null, $text, $residents);
        }


        return Redirect::route('dashboard');
    }


    public function newWarning()
    {
        $resident = Resident::findOrFail(Input::get('residents'));


        foreach( Note::$typesByFlag[NOTEFLAG_WARNING] as $type )
        {
            if( $text = Input::get(NOTEFLAG_WARNING . '-' . $type) )
                $notes[$type] = Note::makeNew($type, NOTEFLAG_WARNING, null, $text, $resident);
        }

        Warning::makeNew(
            $resident,
            Input::get(NOTEFLAG_WARNING.'-reason'),
            $notes[NOTETYPE_SHIFT], $notes[NOTETYPE_DETAIL]
        );


        return Redirect::route('strikes');

    }

    public function newStrike()
    {
        $resident = Resident::findOrFail(Input::get('residents'));


        foreach( Note::$typesByFlag[NOTEFLAG_STRIKE] as $type )
        {
            if( $text = Input::get(NOTEFLAG_STRIKE . '-' . $type) )
                $notes[$type] = Note::makeNew($type, NOTEFLAG_STRIKE, null, $text, $resident);
        }

        Strike::makeNew(
                $resident,
                Input::get(NOTEFLAG_STRIKE.'-reason'),
                $notes[NOTETYPE_SHIFT], $notes[NOTETYPE_DETAIL],
                Input::get(NOTEFLAG_STRIKE.'-duration')
        );


        return Redirect::route('strikes');
    }


    public function newOWP()
    {
        $resident = Resident::findOrFail(Input::get('residents'));

        foreach( Note::$typesByFlag[NOTEFLAG_OWP] as $type )
        {
            if( $text = Input::get(NOTEFLAG_OWP . '-' . $type) )
                $notes[$type] = Note::makeNew($type, NOTEFLAG_OWP, null, $text, $resident);

        }

        $resident->send_owp();

        return Redirect::route('dashboard');
    }



    public function newOwpr()
    {
        $resident = Resident::findOrFail(Input::get('residents'));

        foreach( Note::$typesByFlag[NOTEFLAG_OWPR] as $type )
        {
            if( $text = Input::get(NOTEFLAG_OWPR . '-' . $type) )
                $notes[$type] = Note::makeNew($type, NOTEFLAG_OWPR, null, $text, $resident);

        }

        $resident->return_owp();

        return Redirect::route('dashboard');
    }



    public function newSuspension()
    {
        $resident = Resident::findOrFail(Input::get('residents'));


        foreach( Note::$typesByFlag[NOTEFLAG_SUSPENSION] as $type )
        {
            if( $text = Input::get(NOTEFLAG_SUSPENSION . '-' . $type) )
                $notes[$type] = Note::makeNew($type, NOTEFLAG_SUSPENSION, null, $text, $resident);
        }

        $suspension = Suspension::makeNew($resident,
            Input::get(NOTEFLAG_SUSPENSION.'-type'), Input::get(NOTEFLAG_SUSPENSION.'-duration'),
            $notes[NOTETYPE_SHIFT],$notes[NOTETYPE_DETAIL]);


        $resident->suspend();


        return Redirect::route('suspensions');

    }

}