<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Augnito Ambient - Focus & Relax</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .sound-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .sound-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .sound-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .sound-card.active {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.02);
        }

        .sound-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .sound-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .sound-description {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 1.5rem;
        }

        .volume-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .volume-slider {
            flex: 1;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
            outline: none;
            -webkit-appearance: none;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .volume-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out;
        }

        .control-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .timer-display {
            text-align: center;
            font-size: 2rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeIn 1.2s ease-out;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .play-pause-icon {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .container { padding: 1rem; }
            .header h1 { font-size: 2rem; }
            .sound-grid { grid-template-columns: 1fr; gap: 1rem; }
            .controls { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <div class="floating-particles" id="particles"></div>
    
    <div class="container">
        <div class="header">
            <h1>Augnito Ambient</h1>
            <p>Create your perfect ambient soundscape for focus and relaxation</p>
        </div>

        <div class="timer-display" id="timer">00:00</div>

        <div class="controls">
            <button class="control-btn" id="playAllBtn">
                <span class="play-pause-icon">▶️</span>
                Play All
            </button>
            <button class="control-btn" id="stopAllBtn">🛑 Stop All</button>
            <button class="control-btn" id="timerBtn">⏱️ Set Timer</button>
        </div>

        <div class="sound-grid" id="soundGrid">
            <!-- Sound cards will be generated by JavaScript -->
        </div>
    </div>

    <script>
        class AmbientSoundApp {
            constructor() {
                this.sounds = [
                    { id: 'rain', icon: '🌧️', title: 'Rain', description: 'Gentle rainfall for deep focus', url: this.generateWhiteNoise(0.3, 'rain') },
                    { id: 'forest', icon: '🌲', title: 'Forest', description: 'Birds chirping in nature', url: this.generateWhiteNoise(0.4, 'forest') },
                    { id: 'ocean', icon: '🌊', title: 'Ocean Waves', description: 'Calming ocean sounds', url: this.generateWhiteNoise(0.2, 'ocean') },
                    { id: 'fire', icon: '🔥', title: 'Fireplace', description: 'Crackling fireplace warmth', url: this.generateWhiteNoise(0.5, 'fire') },
                    { id: 'coffee', icon: '☕', title: 'Coffee Shop', description: 'Ambient café atmosphere', url: this.generateWhiteNoise(0.3, 'coffee') },
                    { id: 'wind', icon: '💨', title: 'Wind', description: 'Gentle breeze through trees', url: this.generateWhiteNoise(0.25, 'wind') },
                    { id: 'thunder', icon: '⛈️', title: 'Thunderstorm', description: 'Distant thunder and rain', url: this.generateWhiteNoise(0.4, 'thunder') },
                    { id: 'stream', icon: '🏞️', title: 'Stream', description: 'Babbling brook sounds', url: this.generateWhiteNoise(0.35, 'stream') }
                ];

                this.audioElements = {};
                this.isPlaying = false;
                this.startTime = null;
                this.timerInterval = null;
                this.timerDuration = null;

                this.init();
            }

            generateWhiteNoise(frequency, type) {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const duration = 10; // 10 seconds loop
                const sampleRate = audioContext.sampleRate;
                const frameCount = sampleRate * duration;
                const buffer = audioContext.createBuffer(1, frameCount, sampleRate);
                const data = buffer.getChannelData(0);

                // Generate different types of noise patterns
                for (let i = 0; i < frameCount; i++) {
                    let noise = Math.random() * 2 - 1;
                    
                    switch(type) {
                        case 'rain':
                            noise *= Math.sin(i * frequency * 0.01) * 0.7;
                            break;
                        case 'ocean':
                            noise *= Math.sin(i * frequency * 0.005) * 0.8;
                            break;
                        case 'fire':
                            noise *= Math.random() * 0.6;
                            break;
                        case 'forest':
                            noise *= (Math.sin(i * frequency * 0.02) + Math.random() * 0.3) * 0.5;
                            break;
                        default:
                            noise *= frequency;
                    }
                    
                    data[i] = noise * 0.3; // Overall volume control
                }

                const source = audioContext.createBufferSource();
                source.buffer = buffer;
                source.loop = true;
                
                const gainNode = audioContext.createGain();
                gainNode.gain.value = 0.5;
                
                source.connect(gainNode);
                gainNode.connect(audioContext.destination);

                return { source, gainNode, audioContext };
            }

            init() {
                this.createSoundCards();
                this.createParticles();
                this.bindEvents();
                this.updateTimer();
            }

            createSoundCards() {
                const grid = document.getElementById('soundGrid');
                
                this.sounds.forEach(sound => {
                    const card = document.createElement('div');
                    card.className = 'sound-card';
                    card.dataset.soundId = sound.id;
                    
                    card.innerHTML = `
                        <span class="sound-icon">${sound.icon}</span>
                        <h3 class="sound-title">${sound.title}</h3>
                        <p class="sound-description">${sound.description}</p>
                        <div class="volume-control">
                            <span>🔈</span>
                            <input type="range" class="volume-slider" min="0" max="100" value="50" data-sound="${sound.id}">
                            <span>🔊</span>
                        </div>
                    `;
                    
                    grid.appendChild(card);
                    
                    // Initialize audio element
                    this.audioElements[sound.id] = {
                        ...sound.url,
                        isPlaying: false,
                        volume: 0.5
                    };
                });
            }

            createParticles() {
                const particlesContainer = document.getElementById('particles');
                
                for (let i = 0; i < 15; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    particle.style.width = particle.style.height = (Math.random() * 20 + 5) + 'px';
                    particle.style.animationDelay = Math.random() * 8 + 's';
                    particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                    particlesContainer.appendChild(particle);
                }
            }

            bindEvents() {
                // Sound card clicks
                document.addEventListener('click', (e) => {
                    const card = e.target.closest('.sound-card');
                    if (card && !e.target.classList.contains('volume-slider')) {
                        this.toggleSound(card.dataset.soundId);
                    }
                });

                // Volume sliders
                document.addEventListener('input', (e) => {
                    if (e.target.classList.contains('volume-slider')) {
                        const soundId = e.target.dataset.sound;
                        const volume = e.target.value / 100;
                        this.setVolume(soundId, volume);
                    }
                });

                // Control buttons
                document.getElementById('playAllBtn').addEventListener('click', () => this.toggleAllSounds());
                document.getElementById('stopAllBtn').addEventListener('click', () => this.stopAllSounds());
                document.getElementById('timerBtn').addEventListener('click', () => this.setTimer());
            }

            async toggleSound(soundId) {
                const audio = this.audioElements[soundId];
                const card = document.querySelector(`[data-sound-id="${soundId}"]`);

                if (audio.isPlaying) {
                    audio.source.stop();
                    audio.isPlaying = false;
                    card.classList.remove('active');
                } else {
                    try {
                        if (audio.audioContext.state === 'suspended') {
                            await audio.audioContext.resume();
                        }
                        
                        // Create new source for each play
                        const newAudio = this.generateWhiteNoise(0.3, soundId);
                        this.audioElements[soundId] = { ...newAudio, isPlaying: true, volume: audio.volume };
                        
                        newAudio.gainNode.gain.value = audio.volume;
                        newAudio.source.start();
                        card.classList.add('active');
                        
                        if (!this.isPlaying) {
                            this.startTimer();
                        }
                    } catch (error) {
                        console.error('Error playing sound:', error);
                    }
                }
            }

            setVolume(soundId, volume) {
                const audio = this.audioElements[soundId];
                audio.volume = volume;
                if (audio.gainNode) {
                    audio.gainNode.gain.value = volume;
                }
            }

            async toggleAllSounds() {
                const playBtn = document.getElementById('playAllBtn');
                const activeCards = document.querySelectorAll('.sound-card.active');
                
                if (activeCards.length > 0) {
                    this.stopAllSounds();
                    playBtn.innerHTML = '<span class="play-pause-icon">▶️</span>Play All';
                } else {
                    // Play all sounds
                    for (const sound of this.sounds) {
                        if (!this.audioElements[sound.id].isPlaying) {
                            await this.toggleSound(sound.id);
                        }
                    }
                    playBtn.innerHTML = '<span class="play-pause-icon">⏸️</span>Pause All';
                }
            }

            stopAllSounds() {
                Object.keys(this.audioElements).forEach(soundId => {
                    const audio = this.audioElements[soundId];
                    if (audio.isPlaying && audio.source) {
                        audio.source.stop();
                        audio.isPlaying = false;
                    }
                });
                
                document.querySelectorAll('.sound-card').forEach(card => {
                    card.classList.remove('active');
                });
                
                this.stopTimer();
                document.getElementById('playAllBtn').innerHTML = '<span class="play-pause-icon">▶️</span>Play All';
            }

            setTimer() {
                const minutes = prompt('Set timer (minutes):', '25');
                if (minutes && !isNaN(minutes) && minutes > 0) {
                    this.timerDuration = parseInt(minutes) * 60;
                    this.startTime = Date.now();
                    this.updateTimer();
                }
            }

            startTimer() {
                if (!this.startTime) {
                    this.startTime = Date.now();
                }
                this.isPlaying = true;
                
                if (!this.timerInterval) {
                    this.timerInterval = setInterval(() => this.updateTimer(), 1000);
                }
            }

            stopTimer() {
                this.isPlaying = false;
                this.startTime = null;
                
                if (this.timerInterval) {
                    clearInterval(this.timerInterval);
                    this.timerInterval = null;
                }
            }

            updateTimer() {
                const timerDisplay = document.getElementById('timer');
                
                if (this.startTime) {
                    const elapsed = Math.floor((Date.now() - this.startTime) / 1000);
                    
                    if (this.timerDuration && elapsed >= this.timerDuration) {
                        this.stopAllSounds();
                        alert('Timer finished!');
                        this.timerDuration = null;
                        return;
                    }
                    
                    const minutes = Math.floor(elapsed / 60);
                    const seconds = elapsed % 60;
                    timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                } else {
                    timerDisplay.textContent = '00:00';
                }
            }
        }

        // Initialize the app when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            new AmbientSoundApp();
        });
    </script>
</body>
</html>