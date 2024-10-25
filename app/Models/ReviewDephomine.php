<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewDephomine extends Model
{
    use HasFactory;

    protected $fillable = [
        'dopamine1', 'dopamine2', 'dopamine3', 'audio'
    ];


    public function getImage1(){
        if(file_exists(public_path('/storage/uploads/exercises/dephomine/'.$this->dopamine1)) && !is_null($this->dopamine1))
            return asset('storage/uploads/exercises/dephomine/'.$this->dopamine1);
        else
            return null;
    }

    public function getImage2(){
        if(file_exists(public_path('/storage/uploads/exercises/dephomine/'.$this->dopamine2)) && !is_null($this->dopamine2))
            return asset('storage/uploads/exercises/dephomine/'.$this->dopamine2);
        else
            return null;
    }

    public function getImage3(){
        if(file_exists(public_path('/storage/uploads/exercises/dephomine/'.$this->dopamine3)) && !is_null($this->dopamine3))
            return asset('storage/uploads/exercises/dephomine/'.$this->dopamine3);
        else
            return null;
    }

    public function getAudio(){
        if(file_exists(public_path('/storage/uploads/exercises/audio/'.$this->audio)) && !is_null($this->audio))
            return asset('storage/uploads/exercises/audio/'.$this->audio);
        else
            return null;
    }

}
