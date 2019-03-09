<?php

namespace App\Http\Controllers;

use App\Library\Helpers\SeasonHelpers;
use App\Swimmer;
use App\Lesson;
use App\Season;
use App\Location;
use App\Group;
use App\Contact;
use App\DaysOfTheWeek;
use Carbon\Carbon;
use App\PrivateLessonLead;
use App\Tryout;
use Charts;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $swimmers = Swimmer::where('paid', '=', '1')->orderBy('created_at', 'desc')->limit(10)->get();
        $seasons = Season::all();
        $groups = Group::all();
        $locations = Location::all();
        $daysOfTheWeek = DaysOfTheWeek::all();
        $lessons = Lesson::latest()->with('group')->paginate(10, ['*'], 'lessons');
        $leads = Contact::latest()->paginate(10, ['*'], 'leads');
        $privateLessonLeads = PrivateLessonLead::latest()->paginate(10, ['*'], 'private-lesson-leads');
        $todaysLessons = $this->getTodaysLessons();
        $tryouts = Tryout::latest()->paginate(10, ['*'], 'tryouts');
        return view('pages.dashboard', compact('swimmers', 'todaysLessons', 'seasons', 'groups', 'locations', 'daysOfTheWeek', 'lessons', 'leads', 'privateLessonLeads', 'tryouts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function analytics()
    {
        $swimmerRegistrations = Charts::database(Swimmer::where('paid', '=', '1')->get(), 'area', 'highcharts')->dateFormat('m/d')
            ->elementLabel("Swimmers")
            ->title("Swimmer Registrations Per Day")
            ->responsive(true)
            ->lastByDay(28, true);

        $days = collect(Swimmer::where('paid', '=', '1')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('l');
        }));

        $count = collect();

        foreach ($days as $day) {
            $count->push($day->count());
        }

        $swimmerRegistrationDays = Charts::create('area', 'highcharts')
            ->labels($days->keys())
            ->elementLabel("Swimmers")
            ->title("Swimmer Registrations Per Day Of The Week")
            ->values($count)
            ->responsive(true);


        return view('pages.analytics', [
            'swimmerRegistrations' => $swimmerRegistrations,
            'swimmerRegistrationDays' => $swimmerRegistrationDays
        ]);
    }

    /**
     * @return mixed
     */
    public function swimmersForCurrentSeason()
    {
        $season = SeasonHelpers::currentSeason();
        return Swimmer::whereHas('lesson', function ($query) use ($season) {
            $query->where('season_id', '=', $season->id);
        })->get();
    }

    /**
     * @return mixed
     */
    private function getTodaysLessons()
    {
        return Lesson::whereHas('DaysOfTheWeek', function ($query) {
            $query->where([
                ['days_of_the_weeks.id', '=', (Carbon::now()->subDay(1)->dayOfWeek + 1)],
                ['class_start_date', '<=', Carbon::now()],
                ['class_end_date', '>=',Carbon::now()]
            ]);
        })->with('group')->get();
    }
}
