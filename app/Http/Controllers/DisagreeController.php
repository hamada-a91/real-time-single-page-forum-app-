<?php

namespace App\Http\Controllers;

use App\Models\disagree;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\DisAgreeResource;
use Illuminate\Http\Response;


class DisagreeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }


    public function index(Question $question)
    {
        return DisAgreeResource::collection($question->disagrees);
    }

    public function disagree(Question $question)
    {
        $disagree = $question->disagrees()->create([
            'user_id' => auth()->id()
        ]);
        return response(['disagree' => new DisAgreeResource($disagree)], Response::HTTP_CREATED);
    }

    public function undisagree(Question $question)
    {
        ///$reply->like()->where('user_id', '3')->first()->delete();
        $question->disagrees()->where('user_id', auth()->id())->first()->delete();
    }
}
