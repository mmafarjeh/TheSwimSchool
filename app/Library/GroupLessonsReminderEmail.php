<?php

namespace App\Library;

use App\Lesson;
use App\Swimmer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\GroupLessonReminder;

class GroupLessonsReminderEmail
{
    public function sendReminderEmails()
    {
        $lessons = $this->getLessonsStartingTomorrow();
        if(count($lessons)){
            foreach ($lessons as $lesson){
                foreach($lesson->swimmers as $swimmer){
                    if($swimmer->email){
                        try{
                            Log::info("Sending group lesson reminder email to $swimmer->email for lesson ID: $lesson->id");
                            Mail::to($swimmer->email)->send(new GroupLessonReminder($lesson));
                        } catch (\Exception $e) {
                            Log::warning("Email error: $e");
                        }
                    }
                }
            }
        } else {
            Log::info("No lessons start tomorrow.");
        }
    }

    //TODO: Add ability to send reminder email to single swimmer from the UI
    public function sendReminderEmailToSingleSwimmer(Swimmer $swimmer)
    {
        $lesson = Lesson::find($swimmer->getAttribute('lesson_id'));
        if(count($lesson)){
            try{
                Log::info("Sending group lesson reminder email to $swimmer->email for lesson ID: $lesson->id");
                Mail::to($swimmer->email)->send(new GroupLessonReminder($lesson));
            } catch (\Exception $e) {
                Log::warning("Email error: $e");
            }
        }
    }

    private function getLessonsStartingTomorrow()
    {
        return Lesson::where('class_start_date', Carbon::tomorrow())->with('Swimmers', 'Group', 'Location', 'DaysOfTheWeek')->get();
    }
}