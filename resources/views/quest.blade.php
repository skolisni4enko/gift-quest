<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Quest | Celebration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-screen bg-gradient-to-tr from-rose-100 via-pink-100 to-purple-100 text-gray-800 pb-20">

    <!-- Navbar Controls -->
    <div id="nav-controls" class="fixed top-6 left-6 right-6 z-50 hidden flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <a href="/lang/en" class="px-2 py-1 rounded-md text-[10px] font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-rose-500 text-white shadow-sm' : 'bg-white/50 text-gray-500 hover:bg-white' }}">EN</a>
                <a href="/lang/uk" class="px-2 py-1 rounded-md text-[10px] font-bold transition-all {{ app()->getLocale() === 'uk' ? 'bg-rose-500 text-white shadow-sm' : 'bg-white/50 text-gray-500 hover:bg-white' }}">UA</a>
                <a href="/lang/ru" class="px-2 py-1 rounded-md text-[10px] font-bold transition-all {{ app()->getLocale() === 'ru' ? 'bg-rose-500 text-white shadow-sm' : 'bg-white/50 text-gray-500 hover:bg-white' }}">RU</a>
            </div>
            <!-- Logout Button -->
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="glass px-4 py-2 rounded-full shadow-lg text-sm font-bold text-gray-500 hover:text-rose-500 hover:bg-white/60 transition-all duration-300">
                    {{ __('quest.quest.logout') }}
                </button>
            </form>
        </div>
        <button id="mute-btn" class="glass p-3 rounded-full shadow-lg hover:bg-white/60 transition-all duration-300 group">
            <span id="mute-icon" class="text-2xl group-hover:scale-110 block">🔊</span>
        </button>
    </div>

    <!-- Start Overlay -->
    <div id="start-overlay" class="fixed inset-0 z-[100] glass flex items-center justify-center text-center p-6 transition-opacity duration-1000">
        <div class="max-w-md">
            <span class="text-7xl block mb-6 animate-bounce">🎈</span>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ __('quest.quest.ready_title') }}</h2>
            <p class="text-gray-600 mb-8 text-lg">{{ __('quest.quest.ready_subtitle') }}</p>
            <button id="start-btn"
                    class="px-10 py-5 bg-gradient-to-r from-rose-500 to-pink-500 text-white text-2xl rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 font-bold uppercase tracking-widest">
                {{ __('quest.quest.start_button') }}
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto pt-24 px-6 space-y-10">
        <!-- Hero Section -->
        <section class="text-center space-y-4">
            <h1 class="text-5xl md:text-7xl font-extrabold pb-2">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-rose-600 to-purple-600 inline-block float">{{ __('quest.quest.hero_title') }}</span>
                <span class="inline-block float">🎂</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-lg mx-auto leading-relaxed">
                {{ __('quest.quest.hero_subtitle') }}
            </p>
        </section>

        <!-- Placeholder for the Quest Game -->
        <section class="glass rounded-[3rem] p-1 shadow-2xl overflow-hidden aspect-video md:aspect-[16/9] relative">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-white/30 backdrop-blur-sm">
                <span class="text-6xl mb-4">🎮</span>
                <p class="text-gray-600 font-medium text-lg">{{ __('quest.quest.game_placeholder') }}</p>
                <p class="text-gray-400 text-sm italic">{{ __('quest.quest.game_hint') }}</p>
            </div>
        </section>

        <!-- Content Cards -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass rounded-[2rem] p-10 shadow-xl space-y-4">
                <div class="w-16 h-16 bg-rose-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">📸</div>
                <h3 class="text-2xl font-bold">{{ __('quest.quest.moments_title') }}</h3>
                <p class="text-gray-600 leading-relaxed text-lg">{{ __('quest.quest.moments_desc') }}</p>
            </div>
            <div class="glass rounded-[2rem] p-10 shadow-xl space-y-4">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner">🎁</div>
                <h3 class="text-2xl font-bold">{{ __('quest.quest.present_title') }}</h3>
                <p class="text-gray-600 leading-relaxed text-lg">{{ __('quest.quest.present_desc') }}</p>
            </div>
        </div>
    </main>

    <!-- Background Music -->
    @php
        $tracks = collect(config('quest.music'))->map(fn($t) => asset($t))->toJson();
    @endphp
    <audio id="bg-music" data-tracks='{{ $tracks }}'></audio>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
