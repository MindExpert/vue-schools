<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class BatchUpdates implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    public $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }

    public function handle(): void
    {
        foreach ($this->batch['subscribers'] as $key => $subscriber) {

            $logMessage = "[{$key}] email: {$subscriber['email']}, ";
            if (isset($subscriber['name'])) {
                $logMessage .= "name: {$subscriber['name']}, ";
            }

            if (isset($subscriber['time_zone'])) {
                $logMessage .= "timezone: '{$subscriber['time_zone']}'";
            }

            Log::info($logMessage);
        }
    }
}
