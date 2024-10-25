<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExerciseCopyFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Define source and destination directories
         $source1 = storage_path('app/public/uploads/copy_exercises/audio'); // Replace with your source folder path
         $destination1 = storage_path('app/public/uploads/exercises/audio'); // Replace with your destination folder path
         $source2 = storage_path('app/public/uploads/copy_exercises/dephomine'); // Replace with your source folder path
         $destination2 = storage_path('app/public/uploads/exercises/dephomine'); // Replace with your destination folder path
 
         // Ensure the destination directory exists
         if (!File::exists($destination1)) {
             File::makeDirectory($destination1, 0755, true);
         }
         if (!File::exists($destination2)) {
            File::makeDirectory($destination2, 0755, true);
        }
 
         // Get all files in the source directory
         $files1 = File::files($source1);
         $files2 = File::files($source2);
 
         // Loop through the files and copy each one to the destination
         foreach ($files1 as $file1) {
             $fileName = $file1->getFilename();
             File::copy($file1->getPathname(), $destination1 . '/' . $fileName);
         }
         foreach ($files2 as $file2) {
            $fileName = $file2->getFilename();
            File::copy($file2->getPathname(), $destination2 . '/' . $fileName);
        }
 
         $this->command->info('Files have been copied successfully!');
    }
}
