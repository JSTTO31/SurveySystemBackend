<?php

namespace App\Http\Controllers;

use App\Models\Disccussion;
use Illuminate\Http\Request;

class DisccussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disccussions = collect(Disccussion::all());
        // $minute = $
        return [...$discussions];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'paragraph' => 'required']);
        $disccussion = Disccussion::create($request->only(['title', 'paragraph']));

        return $disccussion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disccussion  $disccussion
     * @return \Illuminate\Http\Response
     */
    public function show(Disccussion $disccussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disccussion  $disccussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disccussion $disccussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disccussion  $disccussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disccussion $disccussion)
    {
        //
    }
}
