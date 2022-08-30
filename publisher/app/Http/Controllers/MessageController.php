<?php

namespace App\Http\Controllers;

use App\Jobs\dispatchMessageToSubscribers;
use App\Http\Requests\StoremessageRequest;
use App\Http\Requests\UpdatemessageRequest;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Topic;

class MessageController extends Controller
{

    public function publish(Request $request, $topic)
    {
        [$code, $status, $message] = [404, 'failed', 'Topic not found'];

        $request->validate([
            'message' => 'required|string',
        ]);

        $targetTopic = Topic::find($topic);
        if (!$targetTopic) { // topic not found
            [$code, $status, $message] = [404, 'failed', 'Topic not found'];
        } else {
            // prepare message  for notification
            $payload = ([
                'topic' => $targetTopic->topic,
                'message' => $request->message,
            ]);
            // cast payload to object then save and publish to topic subscribers
            [$code, $status, $message] = $this->sendMessage($targetTopic, (object) $payload);
        }
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $targetTopic ?? [],
        ], $code);
    }

    private  function sendMessage($targetTopic, $payload) // method to save the message and publish to subscribers
    {
        try {
            $MessageToTopic = Message::create([
                'message' => $payload->message,
                'topic_id' => $targetTopic->id
            ]);

            if ($MessageToTopic) {
                $AllSubscribers = $targetTopic->subscribers->count(); // count number of subscribers subscribed to the topic / Target audience

                // 0 subscribers for the topic
                if ($AllSubscribers == 0) {
                    return [200, 'success', 'Message added successfully but the topic has no subscribers'];
                }

                // Dispatch using database queue as a scalable approach
                try {
                    dispatchMessageToSubscribers::dispatch($targetTopic, $payload);
                } catch (\Exception $err) {
                    return [501, 'error', $err];
                }
            } else {
                return [501, 'error', 'Message was not created'];
            }
        } catch (\Exception $err) { // catch and return unhandled exceptions
            return [500, 'error', $err];
        }
    }
}
