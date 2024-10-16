<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],
        'exercises_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/exercises/audio'),
            'url' => env('APP_URL') . '/storage/uploads/exercises/audio',
            'visibility' => 'public',
        ],

        'vocabulary_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/vocabulary/audio'),
            'url' => env('APP_URL') . '/storage/uploads/vocabulary/audio',
            'visibility' => 'public',
        ],
        'video' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/video'),
            'url' => env('APP_URL') . '/storage/uploads/video',
            'visibility' => 'public',
        ],

        'question_word_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/question_word_audio'),
            'url' => env('APP_URL') . '/storage/uploads/question_word_audio',
            'visibility' => 'public',
        ],

        'audio_translation_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/audio_translation_audio'),
            'url' => env('APP_URL') . '/storage/uploads/audio_translation_audio',
            'visibility' => 'public',
        ],

        'question_image' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/question_image/audio'),
            'url' => env('APP_URL') . '/storage/uploads/question_image/audio',
            'visibility' => 'public',
        ],

        'pronunciation' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/pronunciation'),
            'url' => env('APP_URL') . '/storage/uploads/pronunciation',
            'visibility' => 'public',
        ],
        'test_audio_image' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/test_audio_image/audio'),
            'url' => env('APP_URL') . '/storage/uploads/test_audio_image/audio',
            'visibility' => 'public',
        ],
        'test_word_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/test_word_audio'),
            'url' => env('APP_URL') . '/storage/uploads/test_word_audio',
            'visibility' => 'public',
        ],
        'spelling_audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/spelling/audio'),
            'url' => env('APP_URL') . '/storage/uploads/spelling/audio',
            'visibility' => 'public',
        ],
        'listening' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/listening'),
            'url' => env('APP_URL') . '/storage/uploads/listening',
            'visibility' => 'public',
        ],
        'grammars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/grammars'),
            'url' => env('APP_URL') . '/storage/uploads/grammars',
            'visibility' => 'public',
        ],
        'json' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/exercises/dephomine'),
            'url' => env('APP_URL') . '/storage/uploads/exercises/dephomine',
            'visibility' => 'public',
        ]


    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
