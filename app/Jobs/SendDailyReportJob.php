<?php

namespace App\Jobs;

use App\Models\Sell;
use App\Models\User;
use App\Notifications\SendDailyReportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDailyReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $total = Sell::whereDate('created_at', now())->sum('amount')->get();
        $user = new User();
        $user->email = 'email@email.com';
        $user->notify(new SendDailyReportNotification($total));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
