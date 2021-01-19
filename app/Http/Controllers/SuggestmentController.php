<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Suggestment;
use Illuminate\Http\Request;
use App\Http\Resources\SuggestmentResource;
use Illuminate\Http\Response;

class SuggestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return SuggestmentResource::collection($question->suggestments);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $suggestment = $question->suggestments()->create($request->all());

        return response(['suggestment' => new SuggestmentResource($suggestment)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suggestment  $suggestment
     * @return \Illuminate\Http\Response
     */
    public function show(Suggestment $suggestment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suggestment  $suggestment
     * @return \Illuminate\Http\Response
     */
    public function edit(Suggestment $suggestment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suggestment  $suggestment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Suggestment $suggestment)
    {
        $suggestment->update($request->all());
        return response('UPDATED', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggestment  $suggestment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Suggestment $suggestment)
    {
        $suggestment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
