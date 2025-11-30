<?php

namespace Firsadev\FilamentResourceRole\Helpers;

use Firsadev\FilamentResourceRole\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;


class GetModel {

    public static function all():Collection
    {

        $modelClasses = [];
        $modelPath = app_path('Models'); // Adjust if your models are in a different directory
    
        if (File::exists($modelPath)) {
            $files = File::allFiles($modelPath);
    
            foreach ($files as $key=> $file) {
                // Get the file name without extension
                $fileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
    
                // Construct the fully qualified class name
                $className = 'App\\Models\\' . $fileName; // Adjust namespace if needed // Adjust namespace if needed

                // Check if the class exists and is an Eloquent model
                if (class_exists($className) && is_subclass_of($className, Model::class)) {
                    $modelClasses[$className]= $fileName;
                }
            }
         }
        return collect($modelClasses);
    }
}