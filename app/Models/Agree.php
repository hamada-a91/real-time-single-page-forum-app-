<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Suggestment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function suggestment()
    {
        return $this->belongsTo(Suggestment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
