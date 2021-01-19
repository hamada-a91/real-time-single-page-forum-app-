<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisagreeRequest;
use App\Models\disagree;
use App\Models\Question;
use App\Models\Suggestment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DisAgreeResource;


class DisagreeController extends Controller
{

    public function __construct()
    {
        //  $this->middleware('JWT');
    }


    public function index(Question $question)
    {
        return DisAgreeResource::collection($question->disagrees->first());
    }

    public function disagree(Suggestment $suggestment, DisagreeRequest $request)
    {
        $disagree = Disagree::create([
            'user_id' => $request->user_id,
            'suggestment_id' => $request->suggestment_id,
            'disagreeName' => $request->disagreeName,


        ]);
        return response(['disagree' => new DisAgreeResource($disagree)], Response::HTTP_CREATED);
    }

    public function undisagree($disagreeName)
    {
        ///$reply->like()->where('user_id', '3')->first()->delete();
        Disagree::where('disagreeName', $disagreeName)->delete();
        return response(['delteit'], Response::HTTP_NO_CONTENT);
    }
}
