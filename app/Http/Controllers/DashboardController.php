<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swimmer;
use App\Lesson;
use Carbon\Carbon;
use App\Http\Controllers\GetSeason;

class DashboardController extends Controller
{
    public function index()
    {
        $swimmers = Swimmer::orderBy('created_at', 'desc')->limit(10)->get();

        $todaysLessons = Lesson::whereHas('DaysOfTheWeek', function ($query) {
            $query->where('days_of_the_weeks.id', '=', Carbon::now()->dayOfWeek + 1);
        })
            ->where('class_start_date', '<=', Carbon::now())
            ->where('class_end_date', '>=', Carbon::now())
            ->get();

        return view('pages.dashboard', compact('swimmers', 'todaysLessons'));
    }

    public function swimmersForCurrentSeason()
    {
        $season = GetSeason::getCurrentSeason();
        return Swimmer::whereHas('lesson', function ($query) use ($season) {
            $query->where('season_id', '=', $season->id);
        })->get();
    }
}
