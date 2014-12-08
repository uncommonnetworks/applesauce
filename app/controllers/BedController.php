<?php



class BedController extends Controller {

    public static function cleanBed()
    {
        $bed = Bed::findOrFail(Input::get('bedId'));

        $bed->clean();

        return Redirect::to(route('bedding') . "#bedroom{$bed->room_id}");
    }

}
