<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index()
    {
        if (!session('quest_access')) {
            return redirect('/');
        }

        $tracks = collect(config('quest.music'))->map(fn($t) => asset($t));
        $answers = [
            'age' => config('quest.answers.age'),
            'text' => strtoupper(config('quest.answers.text')),
            'code' => strtoupper(config('quest.answers.code')),
        ];

        return view('quest', compact('tracks', 'answers'));
    }

    public function secret()
    {
        if (!session('quest_access')) {
            return redirect('/');
        }

        $memories = [
            [
                'photo' => 'banff-8329971_1920.jpg',
                'caption' => '<span class="highlight-letter">M</span>ajestic mountains in Banff.',
                'side' => 'left'
            ],
            [
                'photo' => 'cat-10061282_1280.jpg',
                'caption' => '<span class="highlight-letter">E</span>ndless curiosity in those eyes.',
                'side' => 'right'
            ],
            [
                'photo' => 'cat-10082073_1280.jpg',
                'caption' => '<span class="highlight-letter">M</span>oments of peace with a furry friend.',
                'side' => 'left'
            ],
            [
                'photo' => 'fisherman-10086224_1280.jpg',
                'caption' => '<span class="highlight-letter">O</span>cean of tranquility.',
                'side' => 'right'
            ],
            [
                'photo' => 'dog-9830812_1280.jpg',
                'caption' => '<span class="highlight-letter">R</span>adiant energy every single day.',
                'side' => 'left'
            ],
            [
                'photo' => 'maranhao-sheets-9000416_1920.jpg',
                'caption' => '<span class="highlight-letter">Y</span>esterday\'s dreams are tomorrow\'s adventures.',
                'side' => 'right'
            ],
        ];

        return view('secret', compact('memories'));
    }
}
