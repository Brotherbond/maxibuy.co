<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class dispatchMessageToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private  $targetTopic;
    private  $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($targetTopic, $payload)
    {
        $this->targetTopic = $targetTopic;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            foreach ($this->targetTopic->subscribers as $subscriber) {
                // Dispatch to each subscriber
                dispatchMessageToSubscriber::dispatch($subscriber, $this->payload);
            }
        } catch (\Throwable $exception) {
            if ($this->attempts() > 3) {
                // Now throw error after 3 attempts
                throw $exception;
            }
            // reschedule this job to be executed after 1hour=>3600
            $this->release(3600);
            return;
        }
    }
}
