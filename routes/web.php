<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (session('quest_access')) {
        return redirect('/quest');
    }
    return view('access');
});

Route::post('/enter', function (Request $request) {
    $login = $request->input('login');
    $password = $request->input('password');

    $config = config('quest.auth');

    if ($login === $config['login'] && $password === $config['password']) {
        session(['quest_access' => true]);
        return redirect('/quest');
    }

    return back()->withErrors(['auth' => 'Invalid credentials']);
})->middleware('throttle:5,1');

Route::post('/logout', function (Request $request) {
    session()->forget('quest_access');
    return redirect('/');
});

Route::get('/quest', function () {
    if (!session('quest_access')) {
        return redirect('/');
    }
    return view('quest');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru', 'uk'])) {
        session(['locale' => $locale]);
    }
    return back();
});
