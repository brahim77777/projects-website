<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\SendMail as MailSendMail;
use Illuminate\Support\Facades\Mail;

class SendMail extends Component
{

    public function sendMail($html)
    {
        $limit = 25;
        \App\Jobs\LaunchEmailJob::dispatch($limit, $html);
    }
    public function render()
    {
        return view('livewire.send-mail');
    }
}
