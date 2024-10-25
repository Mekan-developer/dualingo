<?php

namespace Database\Seeders;

use App\Models\ReviewDephomine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReviewDephomine::create([
            'dopamine1' => 'name1.json',
            'dopamine2' => 'name2.json',
            'dopamine3' => 'name3.json',
            'audio' => 'name.mp3',
        ]);

    }
}
