<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Access Credentials
    |--------------------------------------------------------------------------
    |
    | These are the primary credentials to enter the birthday quest.
    |
    */
    'auth' => [
        'login' => env('QUEST_LOGIN', 'friend@example.com'),
        'password' => env('QUEST_PASSWORD', 'birthday'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Music Playlist
    |--------------------------------------------------------------------------
    |
    | List of tracks to be played sequentially on the Quest page.
    | Files should be located in the public/music directory.
    |
    */
    'music' => [
        'music/drb9.mp3',
        'music/drb11.mp3',
    ],

    /*
    |--------------------------------------------------------------------------
    | Quest State & Answers
    |--------------------------------------------------------------------------
    |
    | Configuration for the interactive cards game.
    |
    */
    'answers' => [
        'age' => env('QUEST_AGE', '25'),
        'text' => env('QUEST_TEXT', 'MEMORY'),
        'code' => env('QUEST_CODE', 'CAKE'),
    ],
];
