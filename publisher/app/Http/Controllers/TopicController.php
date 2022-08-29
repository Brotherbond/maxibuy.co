<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoretopicRequest;
use App\Http\Requests\UpdatetopicRequest;
use App\Models\topic;

class TopicController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretopicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetopicRequest  $request
     * @param  \App\Models\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetopicRequest $request, topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(topic $topic)
    {
        //
    }
}
