<?php

namespace App\Library\Calendar;


use App\PoolSession;
use Illuminate\Support\Collection;
use MaddHatter\LaravelFullcalendar\Calendar;


class EventsCalendar
{
    public function createCalendarFromModels(array $models)
    {
        $sessions = collect([]);
        foreach ($models as $model){
            $sessions->push($this->getSessionsFromModel($model));
        }

        $calendar = $this->buildCalendar($this->buildEvents($sessions->flatten(1)));

        return $calendar;
    }

    public function getSessionsFromModel(string $model) : Collection
    {
        return PoolSession::where('model_type', '=', $model)->get();
    }

    public function buildEvents(Collection $sessions)
    {
        $events = [];

        foreach($sessions as $session){
            $color = $this->getEventColor($session->model);
            $events[] = Calendar::event(
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
        return $events;
    }

    /**
     * @param array $events
     * @return Calendar
     */
    public function buildCalendar(array $events)
    {
        return \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);
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