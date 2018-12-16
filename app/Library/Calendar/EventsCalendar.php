<?php

namespace App\Library\Calendar;


use App\PoolSession;
use MaddHatter\LaravelFullcalendar\Calendar;


class EventsCalendar
{
    public function testing()
    {
        $sessions = PoolSession::all();

        foreach($sessions as $session){
            $color = $this->getEventColor($session->model);
            $event[] = \Calendar::event(
                $session->model->title(),
                false,
                $session->start_time,
                $session->end_time,
                null,
                [
                    'url' => $session->model->path(),
                    'backgroundColor' => $color,
                    'borderColor' => $color
                ]
            );
        }

        //dd($event);

        $event[] = \Calendar::event(
            "Valentine's Day", //event title
            false, //full day event?
            '2018-12-14T0800', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
            '2015-12-14T0900', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
            1, //optional event ID
            [
                'url' => '/lesson/213'
            ]
        );


        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);

        return view('test', compact('calendar'));
    }

    public static function getEventColor($model) : string
    {
        foreach (config('calendar.colors') as $modelName => $color){
            if($modelName === class_basename($model)){
                return $color;
                break;
            }
        }
    }
}