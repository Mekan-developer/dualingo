<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pronunciation extends Model
{
    use HasFactory;

    protected $fillable = ['audio','chapter_id','lesson_id','exercise_id','status','order'];

    protected $casts = [
        'audio' => 'array',
    ];

    public function Exercise(){
        return $this->belongsTo(Exercise::class);
    }

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function Chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getAudio($id){
        if(file_exists(public_path('/storage/uploads/pronunciation/'.$this->audio[$id])) && !is_null($this->audio[$id])){
            return asset('/storage/uploads/pronunciation/'.$this->audio[$id]);
        }else{
            return null;
        }
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
