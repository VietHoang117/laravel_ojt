<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendProposalFeedbackEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $user,
        public $data
    ) {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new FeedbackMail($this->data));
        } catch (\Exception $e) {
            Log::error('Error sending feedback email to ' . $this->user->email . '. Error: ' . $e->getMessage());
        }
    }
}
