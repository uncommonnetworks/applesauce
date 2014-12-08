<?php

class SuspensionsController extends BaseController {

    public static function expireSuspension()
    {
        $suspension = Suspension::findOrFail(Input::get('suspensions'))
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