<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agree;
use App\Models\Reply;
use App\Models\Category;
use App\Models\Disagree;
use App\Models\Suggestment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'askdate', 'asktime', 'location', 'category', 'category_id', 'user_id'];
    //protected $quarded = []; // ich kann ignoriere some mass assigment

    protected $with = ['replies'];  // für retrieve relationship




    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
            // $question->slug = Hash::make('slug');
            // $question->slug = bcrypt('slug');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }
    public function suggestments()
    {
        return $this->hasMany(Suggestment::class)->latest();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getPathAttribute()
    {

        return "/question/$this->slug";
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
