<?php


namespace App\Library;


use App\EmailList;
use App\Mail\GoldDaisyAward;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MarketingEmails
{
    public function sendGoldDaisyAwardEmails()
    {
        foreach($this->getSubscribedEmails() as $email)
        {
            try{
                Log::info("Sending Gold Daisy Award Email email to $email");
                Mail::to($email)->send(new GoldDaisyAward($email));
            } catch (\Exception $e) {
                Log::warning("Email error: $e");
            }
        }
    }

    public function getSubscribedEmails(): Array
    {
        return EmailList::where('subscribe', '=', true)->pluck('email')->all();
    }
}