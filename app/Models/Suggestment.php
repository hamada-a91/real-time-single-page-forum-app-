<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestment extends Model
{
    protected $guarded = [];

    use HasFactory;
    protected static function boot()
    {
        parent::boot();  // damit man user_id kriegen kann
        static::creating(function ($reply) {
            $reply->user_id = auth()->id();
        });
    }


    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agrees()
    {
        return $this->hasMany(Agree::class)->orderBy('id');
    }
    public function disagrees()
    {
        return $this->hasMany(Disagree::class)->orderBy('id');
    }
}