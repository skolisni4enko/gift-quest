<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('quest.access.title') }} | Birthday Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-animate min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full glass rounded-[2.5rem] p-10 shadow-2xl float-large text-center">
        <div class="mb-10">
            <div class="inline-block p-4 bg-white/50 rounded-full mb-4 shadow-inner">
                <span class="text-5xl">🎁</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ __('quest.access.title') }}</h1>
            <p class="text-gray-600">{{ __('quest.access.subtitle') }}</p>
        </div>

        <form method="POST" action="/enter" class="space-y-6 text-left">
            @csrf

            <div class="space-y-2">
                <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">{{ __('quest.access.title') }}</label>
                <input type="text" name="login" required autofocus
                       placeholder="{{ __('quest.access.login_placeholder') }}"
                       class="w-full px-6 py-4 rounded-2xl border-none shadow-xl focus:ring-4 focus:ring-rose-300 focus:outline-none transition-all duration-300 text-lg bg-white/80 placeholder:text-gray-400">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">Password</label>
                <input type="password" name="password" required
                       placeholder="{{ __('quest.access.password_placeholder') }}"
                       class="w-full px-6 py-4 rounded-2xl border-none shadow-xl focus:ring-4 focus:ring-rose-300 focus:outline-none transition-all duration-300 text-lg bg-white/80 placeholder:text-gray-400">
            </div>

            <button type="submit"
                    class="w-full py-4 bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xl rounded-2xl shadow-xl hover:shadow-rose-400/50 hover:scale-[1.02] active:scale-95 transition-all duration-300 font-bold uppercase tracking-widest">
                {{ __('quest.access.button') }}
            </button>

            @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-3 text-center">
                <p class="text-red-500 text-sm font-semibold">{{ __('quest.access.error') }}</p>
            </div>
            @endif
        </form>

        <p class="text-center text-gray-400 text-xs mt-10">
            {{ __('quest.access.hint') }}
        </p>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
