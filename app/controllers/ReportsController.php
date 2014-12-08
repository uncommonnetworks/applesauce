<?php

use Carbon\Carbon;


class ReportsController extends BaseController
{

    public static function getMealsChecklist()
    {
        Excel::load( storage_path('reports') . '/meals-checklist.xls', function($reader)
        {

           $reader->sheet(function($sheet){

               // todays' date
               $today = Carbon::now();
               $tenpm = new Carbon('10pm');
               if( $tenpm->gt($today) )
                   $today->addDay();



               $sheet->cell('B3', function($cell) use($today){
                   $cell->setValue("Meals Checklist - " . $today->format(Config::get('format.date')));
               });


               $row = 5;

               foreach( Resident::current()->get() as $resident )
               {
                    $sheet->cell("B{$row}", function($cell) use($resident){
                        $cell->setValue($resident->display_name);
                    });

                   $row++;
               }


           });

        })->download('xls');
    }



    public static function getSignInSheet()
    {
        Excel::load( storage_path('reports') . '/sign-in-sheet.xls', function($reader)
        {

            $reader->sheet(function($sheet){

                // todays' date
                $today = Carbon::now();
                $tenpm = new Carbon('10pm');
                if( $tenpm->gt($today) )
                    $today->addDay();



                $sheet->cell('B2', function($cell) use($today){
                    $cell->setValue("Meals Checklist - " . $today->format(Config::get('format.date')));
                });


                $row = 4;

                foreach( Resident::current()->get() as $resident )
                {
                    $sheet->cell("B{$row}", function($cell) use($resident){
                        $cell->setValue($resident->display_name);
                    });

                    $row++;
                }


            });

        })->download('xls');
    }


    public static function postOwWeekly()
    {
        Excel::load( storage_path('reports') . '/ow-weekly.xls', function($reader)
        {

            $reader->sheet(function($sheet){

                $row = 2;

                foreach( Resident::current()->get() as $current )
                    $sheet->appendRow($row++, ['', $current->sin, $current->display_name, $current->residency->start_date->format(Config::get('format.date'))]);

                $row += 3;

                foreach( Resident::former()->get() as $former )
                    $sheet->prependRow($row++, ['', $former->sin, $former->display_name, $former->status_updated_at->format(Config::get('format.date'))]);

                $row += 3;

                foreach( Resident::current()->recent()->get() as $current )
                    $sheet->prependRow($row++, ['', $current->sin, $current->display_name, $current->residency->start_date->format(Config::get('format.date'))]);


            });

        })->download('xls');
    }
}