<?php

namespace App\Http\Controllers;

use App\Events\AgreeEvent;
use App\Models\agree;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\AgreeResource;
use Illuminate\Http\Response;


class AgreeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function agree(Question $question)
    {
        $agree = $question->agrees()->create([
            'user_id' => auth()->id()
        ]);
        broadcast(new AgreeEvent($question->id, 1))->toOthers();

        return response(['agree' => new AgreeResource($agree)], Response::HTTP_CREATED);
    }

    public function index(Question $question)
    {
        return AgreeResource::collection($question->agrees);
    }

    public function unagree(Question $question)
    {
        ///$reply->like()->where('user_id', '3')->first()->delete();
        $question->agrees()->where('user_id', auth()->id())->first()->delete();
        broadcast(new AgreeEvent($question->id, 0))->toOthers();
    }
}
