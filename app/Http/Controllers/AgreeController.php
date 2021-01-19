<?php

namespace App\Http\Controllers;

use App\Events\AgreeEvent;
use App\Http\Requests\AgreeRequest;
use App\Models\agree;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\AgreeResource;
use App\Models\Suggestment;
use Illuminate\Http\Response;


class AgreeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('JWT');
    }

    public function agree(Suggestment $suggestment, AgreeRequest $request)
    {
        //return dd($request);
        // $agree = $suggestment->agrees()->create(
        //     $request->all()
        // );

        $agree = Agree::create([
            'user_id' => $request->user_id,
            'suggestment_id' => $request->suggestment_id,
            'agreeName' => $request->agreeName,


        ]);

        //broadcast(new AgreeEvent($question->id, 1))->toOthers();

        return response(['agree' => new AgreeResource($agree)], Response::HTTP_CREATED);
    }

    public function index(Suggestment $suggestment)
    {
        return AgreeResource::collection($suggestment->agrees);
    }

    public function unagree($agreeName)
    {

        ///$reply->like()->where('user_id', '3')->first()->delete();
        Agree::where('agreeName', $agreeName)->delete();
        // broadcast(new AgreeEvent($question->id, 0))->toOthers();
        return response(['delteit'], Response::HTTP_NO_CONTENT);
    }
}
