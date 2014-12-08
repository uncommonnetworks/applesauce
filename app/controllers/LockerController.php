<?php



class LockerController extends Controller {

    public static function cleanLocker()
    {
        $locker = Locker::findOrFail(Input::get('lockerId'));

        $locker->clean();

        return Redirect::to(route('lockers') . "#lockerrom{$locker->room_id}");
    }


    public static function assignLocker()
    {
        $locker = Locker::findOrFail(Input::get('lockerId'));
        $resident = Resident::findOrFail(Input::get('residentId'));

        $locker->helloResident($resident);

        return Redirect::to(route('lockers') . "#lockerroom{$locker->room_id}");
    }

}
