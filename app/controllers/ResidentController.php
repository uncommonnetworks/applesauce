<?php

use Carbon\Carbon;

class ResidentController extends Controller {


    public function uploadPhoto($id)
    {
        $resident = Resident::findOrFail($id);

        $file = Input::file('file');

        if($file)
        {
            $destPath = $resident->path;

            $ext = $file->getClientOriginalExtension();
            $filename = str_replace(".{$ext}",'',$file->getClientOriginalName(),$count);

//            $filename = Resident::getImageFilename( $resident->first_name, $resident->last_name );

            $success = $file->move( storage_path() . "/{$destPath}", $filename );


            if($success){

                $prefix = storage_path() . "/{$destPath}/{$filename}";
                Image::make($prefix)->fit(600,600)->save("{$prefix}.{$ext}");
                Image::make($prefix)->resize(300,300)->save("$prefix small.{$ext}");
                Image::make($prefix)->fit(160,160)->save("$prefix thumb.{$ext}");


                $photo = $resident->picture;
                if(!$photo)
                {
                    $photo = new Picture;

                    $photo->path = "{$destPath}/{$filename}.{$ext}";
                    $photo->save();
                    $resident->picture()->save($photo);
                }
                else
                {
                    $resident->picture->path = "{$destPath}/{$filename}.{$ext}";
                    $resident->picture->push();
                }

                return Response::json('success', 200);

            }
            else
                return Response::json('error', 400);
        }

        return Response::json('error',400);

    }

    public function editForm($id)
    {
        $resident = Resident::findOrFail($id);

        foreach( [
            'first_name', 'middle_name', 'last_name', 'goes_by_name', 'marital_status', 'sin', 'health_card_number',
            'contact_name', 'contact_relationship', 'contact_street1', 'contact_street2', 'contact_city', 'contact_phone',
            'doctor_name', 'doctor_phone']
            as $field )
        {
            if($value = Input::get($field) /* && $value != $resident->$field*/)
                $resident->$field = $value;

//            return Response::json('success', 200);
        }

        $resident->allergies = Input::get('resallergies');
        $resident->save();
        return Redirect::route('resident', $id);
//        return Response::json('error', 400);


    }
}
?>