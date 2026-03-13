<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline of Memories | Birthday Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-rose-50 text-gray-800 pb-20 font-['Outfit']">

    <!-- Header -->
    <header class="py-16 text-center space-y-4">
        <h1 class="text-5xl font-black bg-clip-text text-transparent bg-gradient-to-r from-rose-600 to-purple-600">
            Our Shared Memories
        </h1>
        <p class="text-gray-500 max-w-md mx-auto text-lg">
            Scroll through history and collect the secret word from the highlighted letters...
        </p>
    </header>

    <!-- Timeline Container -->
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="timeline-line hidden md:block"></div>

        <div class="space-y-24">
            @foreach($memories as $index => $memory)
                <div class="relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
                    <!-- DOT -->
                    <div class="absolute left-1/2 -translate-x-1/2 w-6 h-6 bg-rose-500 rounded-full border-4 border-white shadow-lg z-10 hidden md:block"></div>

                    @if($memory['side'] === 'left')
                        <!-- LEFT SIDE CONTENT -->
                        <div class="w-full md:w-1/2 md:pr-16 md:text-right" data-aos="fade-right">
                            <div class="glass p-4 rounded-[2rem] shadow-xl overflow-hidden hover:scale-105 transition-transform">
                                <img src="{{ asset('photo/' . $memory['photo']) }}" alt="Memory" class="w-full h-72 object-cover rounded-[1.5rem] mb-4 zoom-cursor timeline-img">
                                <p class="text-xl font-medium text-gray-700"> {!! $memory['caption'] !!} </p>
                            </div>
                        </div>
                        <div class="md:w-1/2"></div>
                    @else
                        <!-- RIGHT SIDE CONTENT -->
                        <div class="md:w-1/2"></div>
                        <div class="w-full md:w-1/2 md:pl-16" data-aos="fade-left">
                            <div class="glass p-4 rounded-[2rem] shadow-xl overflow-hidden hover:scale-105 transition-transform">
                                <img src="{{ asset('photo/' . $memory['photo']) }}" alt="Memory" class="w-full h-72 object-cover rounded-[1.5rem] mb-4 zoom-cursor timeline-img">
                                <p class="text-xl font-medium text-gray-700"> {!! $memory['caption'] !!} </p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer Action -->
    <div class="mt-20 text-center">
        <button onclick="closeTab()"
                class="inline-flex items-center space-x-2 px-8 py-4 bg-white/70 hover:bg-white rounded-full shadow-lg transition-all border border-gray-100 font-bold text-rose-500">
            <span>✖ Close Tab</span>
        </button>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" onclick="closeLightbox()">
        <span class="close-lightbox">&times;</span>
        <img id="lightbox-img" src="" alt="Enlarged Memory">
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>
