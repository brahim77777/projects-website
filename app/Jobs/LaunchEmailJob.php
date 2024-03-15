<?php

namespace App\Jobs;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LaunchEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $limit, public $mailBody)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // SendTestEmails::dispatch(["brahim@gmail.com", "ahmed@gmail.com"]);
        $users = Subscriber::all();
        for ($page = 1; $page * $this->limit <= $users->count(); $page++) {
            $userGroup = $users->forPage($page, $this->limit);
            SendEmails::dispatch($this->mailBody, $userGroup);
        }
    }
}
