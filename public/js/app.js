const startBtn = document.getElementById('start-btn');
const overlay = document.getElementById('start-overlay');
const music = document.getElementById('bg-music');
const navControls = document.getElementById('nav-controls');
const muteBtn = document.getElementById('mute-btn');
const muteIcon = document.getElementById('mute-icon');

let currentTrackIndex = 0;
let tracks = [];

if (music) {
    music.volume = 0.3;
    // Load tracks from data attribute
    try {
        tracks = JSON.parse(music.dataset.tracks);
    } catch (e) {
        console.error("Failed to parse tracks", e);
    }

    // Function to play next track
    const playTrack = (index) => {
        if (index < tracks.length) {
            music.src = tracks[index];
            music.load();
            music.play().catch(e => {});
        } else {
            // Loop back to first track if finished
            currentTrackIndex = 0;
            playTrack(currentTrackIndex);
        }
    };

    // When current track ends, play next
    music.onended = () => {
        currentTrackIndex++;
        playTrack(currentTrackIndex);
    };
}

function fireConfetti() {
    if (typeof confetti === 'undefined') return;
    const count = 200;
    const defaults = {
        origin: { y: 0.7 },
        colors: ['#e11d48', '#db2777', '#c026d3', '#9333ea']
    };

    function fire(particleRatio, opts) {
        confetti({
            ...defaults,
            ...opts,
            particleCount: Math.floor(count * particleRatio)
        });
    }

    fire(0.25, { spread: 26, startVelocity: 55 });
    fire(0.2, { spread: 60 });
    fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
    fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
    fire(0.1, { spread: 120, startVelocity: 45 });
}

if (startBtn) {
    startBtn.addEventListener('click', () => {
        overlay.classList.add('opacity-0');
        setTimeout(() => {
            overlay.remove();
            if (navControls) navControls.classList.remove('hidden');
        }, 700);

        if (music && tracks.length > 0) {
            music.src = tracks[currentTrackIndex];
            music.play().catch(e => {});
        }

        fireConfetti();

        setInterval(() => {
            if (typeof confetti !== 'undefined') {
                confetti({
                    particleCount: 40,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 },
                    colors: ['#e11d48', '#db2777']
                });
                confetti({
                    particleCount: 40,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                    colors: ['#c026d3', '#9333ea']
                });
            }
        }, 6000);
    });
}

if (muteBtn) {
    muteBtn.addEventListener('click', () => {
        if (music) {
            music.muted = !music.muted;
            muteIcon.innerText = music.muted ? '🔇' : '🔊';
        }
    });
}
