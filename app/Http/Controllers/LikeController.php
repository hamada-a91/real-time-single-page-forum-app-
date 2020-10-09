<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeit(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => auth()->id()
        ]);
    }

    public function unlikeit(Reply $reply)
    {
        ///$reply->like()->where('user_id', '3')->first()->delete();
        $reply->like()->where('user_id', auth()->id())->first()->delete();
    }
}
