<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;


class dispatchMessageToSubscriber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private  $payload;
    private  $subscriber;

    public function __construct($subscriber, $payload)
    {

        $this->payload = $payload;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     *
     * @return void
     * Job to handle single subscriber message
     */

    public function handle()
    {
        // guzzle http cient post request to subscriber server 

        try {
            $response = Http::post($this->subscriber->url . '/messageWebhook', [
                'topic' => $this->payload->topic,
                'message' => $this->payload->message,
            ]);

            if ($response->status != 200) static::dispatch(
                $this->subscriber,
                $this->payload
            );
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