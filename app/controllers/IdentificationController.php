<?php

class IdentificationController extends \BaseController {


    public function uploadResidentSin($resident_id, $idnumber)
    {
        $resident = Resident::findOrFail($resident_id);

        $identification = $resident->idSin ? $resident->idSin : new Identification;
        $identification->type = IDENTIFICATION_SIN;
        $identification->number = $idnumber;
        $resident->identifications()->save($identification);

        return $this->uploadFile($identification, IDENTIFICATION_SIN, $resident->path);
    }


    public function uploadResidentHealthCard($resident_id, $idnumber)
    {
        $resident = Resident::findOrFail($resident_id);
        $identification = $resident->idHealthCard ? $resident->idHealthCard : new Identification;
        $identification->type = IDENTIFICATION_HEALTH;
        $identification->number = $idnumber;
        $resident->identifications()->save($identification);

        return $this->uploadFile($identification, IDENTIFICATION_HEALTH, $resident->path);
    }


    public function uploadFile($identification, $type, $destPath)
    {
        $file = Input::file('file');

        if($file && $file->isValid())
        {


            $ext = $file->getClientOriginalExtension();
            $filename = str_replace(".{$ext}",'',$file->getClientOriginalName(),$count);

            $path = $destPath;

            Log::info("uploading $filename to " . storage_path() . "/{$path}");
            $success = $file->move( storage_path() . "/{$path}", $filename );


            if($success){

                $prefix = storage_path() ."/{$path}/{$filename}";
                Image::make($prefix)->resize(600,600)->save("{$prefix}.{$ext}");
                Image::make($prefix)->resize(300,300)->save("{$prefix} small.{$ext}");
                Image::make($prefix)->fit(160,160)->save("{$prefix} thumb.{$ext}");


                $photo = $identification->picture;
                if(!$photo)
                {
                    $photo = new Picture;

                    $photo->path = "{$path}/{$filename}.{$ext}";

                    $photo->save();
                    $identification->picture()->save($photo);
//                    Resident::findOrFail($identification->resident())->identifications()->save($identification);

                }
                else
                {
                    $identification->picture->path = "{$path}/{$filename}.{$ext}";
                    $identification->picture->push();
                }

                return Response::json('success', 200);

            }
            else
                return Response::json('error', 400);
        }
        else if($file)
        {
            Log::error($file->getErrorMessage());
        }

        return Response::json('error',400);

    }


}
