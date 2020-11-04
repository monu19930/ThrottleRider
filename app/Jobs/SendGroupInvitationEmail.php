<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendGroupInvitationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   // public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data)
    {
        //$email = $data['email'];
        
        Mail::to('test@gmail.com')->send(new InvitationMail());
    }
}
