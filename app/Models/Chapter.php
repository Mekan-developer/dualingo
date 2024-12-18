<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Chapter extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title','order','name'];
    public $translatable  = ['title'];

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lessonsForReview()
    {
        return $this->hasMany(Lesson::class)->where('review',1);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Find the current highest order number
            $maxOrder = static::max('order');

            // Set the order field to be the highest order number + 1
            $model->order = $maxOrder + 1;
        });
    }
}
