<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;
use App\Models\Category;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'category', 'category_id', 'user_id'];
    //protected $quarded = []; // ich kann ignoriere some mass assigment

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
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
