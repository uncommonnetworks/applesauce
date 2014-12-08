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

    public static function getOwWeekly()
    {
        return View::make('reports.ow-weekly');
    }

    public static function postOwWeekly()
    {
        $untilDate = new Carbon(Input::get('untilDate'));
        $fromDate = new Carbon(Input::get('untilDate'));
        $fromDate = $fromDate->subDays(7);

        Excel::load( storage_path('reports') . '/ow-weekly.xls', function($reader) use($fromDate,$untilDate)
        {

            $reader->sheet(function($sheet) use($fromDate,$untilDate){

                $row = 2;

                foreach( Resident::current()->get() as $current )
                {
                    $sheet->prependRow($row++, ['', $current->sin, $current->display_name, $current->residency->start_date->format('M d')]);
                }


                $row += 3;

                foreach( Residency::movedOut($fromDate, $untilDate)->get() as $movedOut )
                    $sheet->prependRow($row++, ['', $movedOut->resident->sin, $movedOut->resident->display_name,
                        $movedOut->start_date->format('M d'),
                        $movedOut->end_date->format('M d')]);

                $row += 3;

                foreach( Residency::movedIn($fromDate, $untilDate)->get() as $movedIn )
                    $sheet->prependRow($row++, ['', $movedIn->resident->sin, $movedIn->resident->display_name,
                        $movedIn->start_date->format('M d'),
                        $movedIn->end_date ? $movedIn->end_date->format('M d') : '']);


            });

        })->download('xls');
    }
}