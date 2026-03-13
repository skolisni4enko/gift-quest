/**
 * Quest Logic & UI Interactions
 */

// State Management
let progress = JSON.parse(localStorage.getItem('quest_progress') || '{"step": 1}');

const ANSWERS = typeof window.ANSWERS !== 'undefined' ? window.ANSWERS : {
    age: "25",
    text: "СПОГАД",
    code: "ТОРТ"
};

// UI Elements
const startBtn = document.getElementById('start-btn');
const overlay = document.getElementById('start-overlay');
const music = document.getElementById('bg-music');
const navControls = document.getElementById('nav-controls');
const muteBtn = document.getElementById('mute-btn');
const muteIcon = document.getElementById('mute-icon');

// Confetti Utility
window.fireConfetti = function(isFinal = false) {
    if (typeof confetti === 'undefined') return;
    const count = isFinal ? 400 : 200;
    const defaults = {
        origin: { y: 0.7 },
        colors: isFinal ? ['#ff0000', '#ffd700', '#00ff00', '#0000ff', '#ff00ff'] : ['#e11d48', '#db2777', '#c026d3', '#9333ea']
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
};

// UI Update Logic
window.updateUI = function() {
    if (progress.step1_solved) {
        const form1 = document.getElementById('step-1-form');
        const success1 = document.getElementById('step-1-success');
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        if (form1) form1.classList.add('hidden');
        if (success1) success1.classList.remove('hidden');
        if (step1) step1.classList.add('glow-success');
        if (step2) {
            step2.classList.remove('card-locked');
            step2.classList.add('card-active');
        }
    }
    if (progress.step2_solved) {
        const form2 = document.getElementById('step-2-form');
        const success2 = document.getElementById('step-2-success');
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        if (form2) form2.classList.add('hidden');
        if (success2) success2.classList.remove('hidden');
        if (step2) step2.classList.add('glow-success');
        if (step3) {
            step3.classList.remove('card-locked');
            step3.classList.add('card-active');
        }
    }
    if (progress.step3_solved) {
        const form3 = document.getElementById('step-3-form');
        const step3 = document.getElementById('step-3');
        const reward = document.getElementById('reward');
        if (form3) form3.classList.add('hidden');
        if (step3) step3.classList.add('glow-success');
        if (reward) reward.classList.remove('hidden');
    }
};

// Step Validation
window.checkStep1 = function() {
    const input = document.getElementById('age-input');
    if (input.value === String(ANSWERS.age)) {
        fireConfetti();
        progress.step1_solved = true;
        progress.step = 2;
        saveProgress();
        updateUI();
        window.open('/secret', '_blank');
    } else {
        shake(input.parentElement);
    }
};

window.checkStep2 = function() {
    const input = document.getElementById('text-input');
    if (input.value.toUpperCase().trim() === ANSWERS.text) {
        fireConfetti();
        progress.step2_solved = true;
        progress.step = 3;
        saveProgress();
        updateUI();
    } else {
        shake(input.parentElement);
    }
};

window.checkStep3 = function() {
    const input = document.getElementById('code-input');
    if (input.value.toUpperCase().trim() === ANSWERS.code) {
        fireConfetti(true);
        progress.step3_solved = true;
        progress.step = 4;
        saveProgress();
        updateUI();
        document.getElementById('reward').scrollIntoView({ behavior: 'smooth' });
    } else {
        shake(input.parentElement);
    }
};

function shake(el) {
    if (!el) return;
    el.classList.add('shake');
    setTimeout(() => el.classList.remove('shake'), 500);
}

function saveProgress() {
    localStorage.setItem('quest_progress', JSON.stringify(progress));
}

// Lightbox Logic
window.openLightbox = function(src) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    if (!lightbox || !img) return;
    img.src = src;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
};

window.closeLightbox = function() {
    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
};

window.closeTab = function() {
    window.close();
};

// Music Engine
let currentTrackIndex = 0;
let tracks = [];

if (music) {
    music.volume = 0.3;
    try {
        tracks = JSON.parse(music.dataset.tracks || '[]');
    } catch (e) { console.error("Tracks error", e); }

    const playTrack = (index) => {
        if (index < tracks.length) {
            music.src = tracks[index];
            music.load();
            music.play().catch(e => {});
        } else {
            currentTrackIndex = 0;
            playTrack(currentTrackIndex);
        }
    };

    music.onended = () => {
        currentTrackIndex++;
        playTrack(currentTrackIndex);
    };
}

// Global Initialization
document.addEventListener('DOMContentLoaded', () => {
    updateUI();

    // Attach click listeners to timeline images if present
    document.querySelectorAll('.timeline-img').forEach(img => {
        img.addEventListener('click', (e) => openLightbox(e.target.src));
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });

    if (startBtn) {
        startBtn.addEventListener('click', () => {
            if (overlay) {
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
                    if (navControls) navControls.classList.remove('hidden');
                }, 700);
            }

            if (music && tracks.length > 0) {
                music.src = tracks[currentTrackIndex];
                music.play().catch(e => {});
            }

            fireConfetti();

            setInterval(() => {
                if (typeof confetti !== 'undefined') {
                    confetti({ particleCount: 40, angle: 60, spread: 55, origin: { x: 0 }, colors: ['#e11d48', '#db2777'] });
                    confetti({ particleCount: 40, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#c026d3', '#9333ea'] });
                }
            }, 3500);
        });
    }

    if (muteBtn) {
        muteBtn.addEventListener('click', () => {
            if (music) {
                music.muted = !music.muted;
                muteIcon.innerText = music.muted ? '🔇' : '🔊';
                if (!music.muted && music.paused) music.play().catch(e => {});
            }
        });
    }

    // Locale-specific reset (if on access page)
    if (window.location.pathname === '/') {
        localStorage.removeItem('quest_progress');
    }
});
