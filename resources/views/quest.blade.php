<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('quest.quest.hero_title') }} | Birthday Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-screen bg-gradient-to-tr from-rose-100 via-pink-100 to-purple-100 text-gray-800 pb-20 overflow-x-hidden">

    <!-- Navbar Controls -->
    <div id="nav-controls" class="fixed top-6 left-6 right-6 z-50 flex justify-between items-center">
        <div class="flex items-center space-x-4">
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
    @if(!session('quest_started'))
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
    @endif

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto pt-24 px-6 space-y-16">
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

        <!-- Quest Steps -->
        <div class="grid gap-10">
            <!-- Card 1: Age Lock -->
            <section id="step-1" class="glass rounded-[3rem] p-10 shadow-2xl transition-all duration-500 relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="w-24 h-24 bg-rose-100 rounded-3xl flex items-center justify-center text-5xl shadow-inner shrink-0">🎂</div>
                    <div class="flex-1 text-center md:text-left space-y-4">
                        <h3 class="text-3xl font-bold">{{ __('quest.quest.cards.step1.title') }}</h3>
                        <p class="text-gray-600 text-lg">{{ __('quest.quest.cards.step1.description') }}</p>
                        
                        <div id="step-1-form" class="flex flex-col sm:flex-row gap-4 mt-6">
                            <input type="number" id="age-input" placeholder="{{ __('quest.quest.cards.step1.placeholder') }}" 
                                   class="px-8 py-4 rounded-2xl bg-white/50 border-none shadow-xl focus:ring-4 focus:ring-rose-300 text-2xl font-bold text-center w-full sm:w-32 outline-none">
                            <button onclick="checkStep1()" class="px-8 py-4 bg-rose-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:bg-rose-600 hover:scale-105 active:scale-95 transition-all">
                                {{ __('quest.quest.cards.step1.button') }}
                            </button>
                        </div>

                        <div id="step-1-success" class="hidden space-y-4 animate-in fade-in duration-700">
                            <p class="text-green-600 font-bold text-xl">✅ {{ __('quest.quest.cards.step1.success') }}</p>
                            <a href="/secret" target="_blank" class="inline-block px-8 py-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-2xl font-bold text-xl shadow-xl hover:scale-105 transition-all">
                                {{ __('quest.quest.cards.step1.link') }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Card 2: Secret Word -->
            <section id="step-2" class="glass rounded-[3rem] p-10 shadow-2xl transition-all duration-500 card-locked relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="w-24 h-24 bg-purple-100 rounded-3xl flex items-center justify-center text-5xl shadow-inner shrink-0">🔍</div>
                    <div class="flex-1 text-center md:text-left space-y-4">
                        <h3 class="text-3xl font-bold">{{ __('quest.quest.cards.step2.title') }}</h3>
                        <p class="text-gray-600 text-lg">{{ __('quest.quest.cards.step2.description') }}</p>
                        
                        <div id="step-2-form" class="flex flex-col sm:flex-row gap-4 mt-6">
                            <input type="text" id="text-input" placeholder="{{ __('quest.quest.cards.step2.placeholder') }}" 
                                   class="px-8 py-4 rounded-2xl bg-white/50 border-none shadow-xl focus:ring-4 focus:ring-purple-300 text-xl font-bold uppercase w-full sm:w-64 outline-none">
                            <button onclick="checkStep2()" class="px-8 py-4 bg-purple-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:bg-purple-600 hover:scale-105 active:scale-95 transition-all">
                                {{ __('quest.quest.cards.step2.button') }}
                            </button>
                        </div>
                        <div id="step-2-success" class="hidden space-y-4 animate-in fade-in duration-700">
                            <p class="text-green-600 font-bold text-xl">✅ Awesome! The final step is unlocked.</p>
                            <div class="bg-purple-50 p-6 rounded-2xl border-2 border-dashed border-purple-200">
                                <p class="text-purple-800 font-semibold italic text-lg">
                                    "Sweet and delicious, usually with candles..." 🕯️
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Card 3: Final Code -->
            <section id="step-3" class="glass rounded-[3rem] p-10 shadow-2xl transition-all duration-500 card-locked relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="w-24 h-24 bg-yellow-100 rounded-3xl flex items-center justify-center text-5xl shadow-inner shrink-0">🎁</div>
                    <div class="flex-1 text-center md:text-left space-y-4">
                        <h3 class="text-3xl font-bold">{{ __('quest.quest.cards.step3.title') }}</h3>
                        <p class="text-gray-600 text-lg">{{ __('quest.quest.cards.step3.description') }}</p>
                        
                        <div id="step-3-form" class="flex flex-col sm:flex-row gap-4 mt-6">
                            <input type="text" id="code-input" placeholder="{{ __('quest.quest.cards.step3.placeholder') }}" 
                                   class="px-8 py-4 rounded-2xl bg-white/50 border-none shadow-xl focus:ring-4 focus:ring-yellow-300 text-xl font-bold uppercase w-full sm:w-64 outline-none">
                            <button onclick="checkStep3()" class="px-8 py-4 bg-yellow-500 text-white rounded-2xl font-bold text-xl shadow-lg hover:bg-yellow-600 hover:scale-105 active:scale-95 transition-all">
                                {{ __('quest.quest.cards.step3.button') }}
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Reward Section (Initially Hidden) -->
        <section id="reward" class="hidden text-center space-y-8 py-20 animate-in zoom-in duration-1000">
            <div class="w-48 h-48 bg-white rounded-full flex items-center justify-center text-9xl shadow-2xl mx-auto float">🎀</div>
            <h2 class="text-5xl font-black text-rose-600">{{ __('quest.quest.present_title') }}</h2>
            <p class="text-2xl text-gray-700 max-w-2xl mx-auto">
                {{ __('quest.quest.present_desc') }}
            </p>
            <div class="p-10 glass rounded-[4rem] text-4xl font-bold text-gray-800 shadow-inner inline-block">
                📍 UNDER THE BED!
            </div>
        </section>
    </main>

    <!-- Background Music -->
    <audio id="bg-music" data-tracks="{{ $tracks->toJson() }}"></audio>

    <script>
        window.ANSWERS = @json($answers);
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
