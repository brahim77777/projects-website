<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $mailBody, public $userGroup)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach ($this->userGroup as $user) {
            Mail::to($user->email)->send(new SendMail($this->mailBody));
        }
    }
}
