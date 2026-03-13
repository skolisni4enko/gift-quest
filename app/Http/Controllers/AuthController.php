<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): RedirectResponse|View
    {
        if (session('quest_access')) {
            return redirect('/quest');
        }
        return view('access');
    }

    public function enter(Request $request): RedirectResponse
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $config = config('quest.auth');

        if ($login === $config['login'] && $password === $config['password']) {
            session(['quest_access' => true]);
            return redirect('/quest');
        }

        return back()->withErrors(['auth' => 'Invalid credentials']);
    }

    public function logout(Request $request): View
    {
        session()->forget('quest_access');
        return view('logout_redirect');
    }
}
