<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Root Shell</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #0f0;
            font-family: 'Courier New', monospace;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="black"/><path d="M10,10L90,90M90,10L10,90" stroke="rgba(255,0,0,0.1)" stroke-width="1"/></svg>');
        }
        
        .ascii-title {
            font-size: 10px;
            line-height: 1;
            white-space: pre;
            text-align: center;
            margin-bottom: 50px;
            color: #0f0;
            text-shadow: 0 0 5px #0f0;
        }
        
        .skull-container {
            position: relative;
            width: 250px;
            height: 250px;
            perspective: 800px;
        }
        
        .skull {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
            animation: float 3s ease-in-out infinite alternate, rotate 20s linear infinite;
        }
        
        .skull-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 15px #ff0000);
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        .spinner {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            animation: spin 8s linear infinite;
            transform-style: preserve-3d;
        }
        
        .spinner-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            box-shadow: 0 0 20px, inset 0 0 20px;
        }
        
        .spinner-inner:nth-child(1) {
            border: 4px solid transparent;
            border-top-color: #ff0000;
            box-shadow: 0 0 20px #ff0000, inset 0 0 10px #ff0000;
            animation: spin 3s linear infinite, pulse 2s ease-in-out infinite alternate;
        }
        
        .spinner-inner:nth-child(2) {
            border: 4px solid transparent;
            border-right-color: #ff3300;
            box-shadow: 0 0 20px #ff3300, inset 0 0 10px #ff3300;
            animation: spin 4s linear infinite reverse, pulse 3s ease-in-out infinite alternate;
        }
        
        .spinner-inner:nth-child(3) {
            border: 4px solid transparent;
            border-bottom-color: #ff0066;
            box-shadow: 0 0 20px #ff0066, inset 0 0 10px #ff0066;
            animation: spin 5s linear infinite, pulse 2.5s ease-in-out infinite alternate;
        }
        
        .spinner-inner:nth-child(4) {
            border: 4px solid transparent;
            border-left-color: #ff5500;
            box-shadow: 0 0 20px #ff5500, inset 0 0 10px #ff5500;
            animation: spin 6s linear infinite reverse, pulse 3.5s ease-in-out infinite alternate;
        }
        
        /* Korkutucu semboller */
        .evil-symbols {
            position: absolute;
            width: 100%;
            height: 100%;
            animation: rotate-symbols 20s linear infinite;
        }
        
        .symbol {
            position: absolute;
            color: #ff0000;
            font-size: 24px;
            opacity: 0.7;
            text-shadow: 0 0 10px #ff0000;
            animation: flicker 3s infinite alternate;
        }
        
        .symbol:nth-child(1) { top: 0; left: 50%; transform: translateX(-50%); }
        .symbol:nth-child(2) { top: 50%; right: 0; transform: translateY(-50%); }
        .symbol:nth-child(3) { bottom: 0; left: 50%; transform: translateX(-50%); }
        .symbol:nth-child(4) { top: 50%; left: 0; transform: translateY(-50%); }
        .symbol:nth-child(5) { top: 15%; right: 15%; }
        .symbol:nth-child(6) { bottom: 15%; right: 15%; }
        .symbol:nth-child(7) { bottom: 15%; left: 15%; }
        .symbol:nth-child(8) { top: 15%; left: 15%; }
        
        /* Kan damlası efekti */
        .blood-drop {
            position: absolute;
            background-color: #ff0000;
            width: 10px;
            height: 10px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(45deg);
            animation: blood-drip 4s linear infinite;
            opacity: 0;
        }
        
        @keyframes blood-drip {
            0% {
                top: 0;
                opacity: 1;
            }
            100% {
                top: 100%;
                opacity: 0.7;
                transform: rotate(45deg) scale(1.5);
            }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0% { opacity: 0.7; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1.05); }
        }
        
        @keyframes float {
            0% { transform: translate(-50%, -50%) scale(1); }
            100% { transform: translate(-50%, -50%) scale(1.1); }
        }
        
        @keyframes rotate {
            0% { transform: translate(-50%, -50%) rotateY(0deg); }
            100% { transform: translate(-50%, -50%) rotateY(360deg); }
        }
        
        @keyframes glow {
            0% { filter: drop-shadow(0 0 15px #ff0000); }
            100% { filter: drop-shadow(0 0 25px #ff0000); }
        }
        
        @keyframes rotate-symbols {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes flicker {
            0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
                opacity: 0.9;
                text-shadow: 0 0 10px #ff0000;
            }
            20%, 24%, 55% {
                opacity: 0.3;
                text-shadow: 0 0 5px #ff0000;
            }
        }
        
        .glitch {
            animation: glitch 1s linear infinite;
        }
        
        @keyframes glitch {
            2%, 8%, 14%, 20%, 26%, 32%, 38% {
                opacity: 0.8;
                transform: translate(0);
            }
            4%, 10%, 16%, 22%, 28%, 34%, 40% {
                opacity: 0.9;
                transform: translate(-2px, 2px);
            }
            6%, 12%, 18%, 24%, 30%, 36%, 42% {
                opacity: 0.9;
                transform: translate(2px, -2px);
            }
            44%, 100% {
                opacity: 1;
                transform: translate(0);
            }
        }
        
        .terminal-text {
            position: fixed;
            bottom: 20px;
            left: 20px;
            font-size: 14px;
            color: #0f0;
            opacity: 0.7;
        }
        
        .blink {
            animation: blink 1s step-end infinite;
        }
        
        @keyframes blink {
            50% { opacity: 0; }
        }
        
        /* Arka planda kayan kırmızı kod efekti */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
            overflow: hidden;
        }
        
        .matrix-column {
            position: absolute;
            top: -100%;
            width: 20px;
            color: #ff0000;
            font-size: 16px;
            text-align: center;
            animation: matrix-fall linear infinite;
        }
        
        /* Kalp atışı efekti */
        .heartbeat {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: transparent;
            border: 2px solid #ff0000;
            opacity: 0;
            animation: heartbeat 1.5s ease-in-out infinite;
        }
        
        @keyframes heartbeat {
            0% {
                transform: translate(-50%, -50%) scale(0.75);
                opacity: 0.3;
            }
            20% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.5;
            }
            40% {
                transform: translate(-50%, -50%) scale(0.75);
                opacity: 0.3;
            }
            60% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.5;
            }
            100% {
                transform: translate(-50%, -50%) scale(0.75);
                opacity: 0;
            }
        }
        
        /* Statik gürültü efekti */
        .noise {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/png;base64,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');
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="noise"></div>
    <div class="matrix-bg" id="matrix-bg"></div>
    
    <div class="ascii-title glitch">
  _____     ___     ___    _               _____   _              _   _                                
 |  __ \   / _ \   / _ \  | |             / ____| | |            | | | |                               
 | |__) | | | | | | | | | | |_   ______  | (___   | |__     ___  | | | |       ___    ___    _ __ ___  
 |  _  /  | | | | | | | | | __| |______|  \___ \  | '_ \   / _ \ | | | |      / __|  / _ \  | '_ ` _ \ 
 | | \ \  | |_| | | |_| | | |_            ____) | | | | | |  __/ | | | |  _  | (__  | (_) | | | | | | |
 |_|  \_\  \___/   \___/   \__|          |_____/  |_| |_|  \___| |_| |_| (_)  \___|  \___/  |_| |_| |_|
    </div>
    
    <div class="skull-container">
        <div class="spinner">
            <div class="spinner-inner"></div>
            <div class="spinner-inner"></div>
            <div class="spinner-inner"></div>
            <div class="spinner-inner"></div>
        </div>
        
        <div class="heartbeat"></div>
        
        <div class="skull">
            <svg class="skull-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <!-- Kuru kafa çizimi -->
                <path fill="#ff0000" d="M50,10 C30,10 15,25 15,45 C15,55 20,65 30,70 L30,85 L40,85 L40,90 L60,90 L60,85 L70,85 L70,70 C80,65 85,55 85,45 C85,25 70,10 50,10 Z" />
                <path fill="#000000" d="M35,50 C30,50 25,45 25,40 C25,35 30,30 35,30 C40,30 45,35 45,40 C45,45 40,50 35,50 Z" />
                <path fill="#000000" d="M65,50 C60,50 55,45 55,40 C55,35 60,30 65,30 C70,30 75,35 75,40 C75,45 70,50 65,50 Z" />
                <path fill="#000000" d="M50,60 L40,70 L50,75 L60,70 Z" />
                <path fill="#000000" d="M40,85 L40,90 L60,90 L60,85 Z" />
                <path fill="#000000" d="M30,70 L30,85 L40,85 L40,75 Z" />
                <path fill="#000000" d="M70,70 L70,85 L60,85 L60,75 Z" />
            </svg>
        </div>
        
        <div class="evil-symbols">
            <div class="symbol">†</div>
            <div class="symbol">Ψ</div>
            <div class="symbol">Ω</div>
            <div class="symbol">⚠</div>
            <div class="symbol">☣</div>
            <div class="symbol">☠</div>
            <div class="symbol">⚡</div>
            <div class="symbol">⊗</div>
        </div>
        
        <div id="blood-container"></div>
    </div>
    
    <div class="terminal-text">
        root@system:~# <span class="blink">_</span>
    </div>
    
    <script>
        // Rastgele glitch efekti
        setInterval(() => {
            const title = document.querySelector('.ascii-title');
            title.classList.toggle('glitch');
            setTimeout(() => {
                title.classList.toggle('glitch');
            }, 200);
        }, 3000);
        
        // Matrix benzeri arka plan efekti
        const matrixBg = document.getElementById('matrix-bg');
        const characters = "01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン";
        const columnCount = 30;
        
        for (let i = 0; i < columnCount; i++) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.left = `${Math.floor(Math.random() * 100)}%`;
            column.style.animationDuration = `${Math.random() * 10 + 5}s`;
            
            const columnHeight = Math.floor(Math.random() * 20) + 10;
            for (let j = 0; j < columnHeight; j++) {
                const char = document.createElement('div');
                char.textContent = characters.charAt(Math.floor(Math.random() * characters.length));
                char.style.opacity = j === 0 ? '1' : `${1 - j / columnHeight}`;
                column.appendChild(char);
            }
            
            matrixBg.appendChild(column);
        }
        
        // Kan damlası efekti
        const bloodContainer = document.getElementById('blood-container');
        
        function createBloodDrop() {
            const drop = document.createElement('div');
            drop.className = 'blood-drop';
            drop.style.left = `${Math.random() * 100}%`;
            drop.style.animationDuration = `${Math.random() * 3 + 2}s`;
            bloodContainer.appendChild(drop);
            
            setTimeout(() => {
                bloodContainer.removeChild(drop);
            }, 5000);
        }
        
        setInterval(createBloodDrop, 300);
        
        // Matrix animasyonu için CSS ekleme
        const style = document.createElement('style');
        style.textContent = `
            @keyframes matrix-fall {
                0% { transform: translateY(-100%); }
                100% { transform: translateY(${window.innerHeight}px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
