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
];
