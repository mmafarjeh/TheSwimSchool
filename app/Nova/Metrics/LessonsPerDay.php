<?php

namespace App\Nova\Metrics;

use App\DaysOfTheWeek;
use App\Nova\Helpers\NovaHelpers;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class LessonsPerDay extends Partition
{
    use NovaHelpers;
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $groups = DaysOfTheWeek::withCount('lessons')->orderBy('lessons_count', 'desc')->get();

        return $this->makePartitionResult($groups, 'day', 'lessons_count');
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'lessons-per-day';
    }
}
