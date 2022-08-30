<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresubscriberRequest;
use App\Http\Requests\UpdatesubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Str;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $topic)
    {
        [$code, $status, $message] = [404, 'failed', 'Topic not found'];

        $request->validate([
            'url' => 'required|url|max:255',
        ]);

        $targetTopic = Topic::find($topic);
        $subscriber = Subscriber::where(['url' => $request->url, 'topic_id' => $topic])->first();

        if ($targetTopic) { //Topic exist then subscribe

            if (!$subscriber) { // To avoid multiple subscription
                Subscriber::create([
                    'url' => $request->url,
                    'topic_id' => $topic,
                ]);
                [$code, $status, $message] = [200, 'success', 'Topic subscribed to successfully'];
            } else { // Already subscribed to
                [$code, $status, $message] = [422, 'failed', 'Topic subscribed to already'];
            }
        }
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $targetTopic ?? [],
        ], $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresubscriberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesubscriberRequest  $request
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesubscriberRequest $request, subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(subscriber $subscriber)
    {
        //
    }
}
