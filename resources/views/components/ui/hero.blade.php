@props([
    'title' => 'Discover Education in Bangladesh',
    'subtitle' => 'Comprehensive database of schools, madrasas, and colleges — compare fees, facilities, and admission information.',
    'searchAction' => '',
    'color' => 'rgba(128, 128, 128, 0.2)', // Soft, subtle glowing background color
    'scale' => 30, // Reduced scale for smooth, large wave transitions instead of jittery shaking
    'speed' => 15,
    'noiseOpacity' => 0.4, // Subtle textured paper background overlay
    'noiseScale' => 1.2,
])

@php
    $id = 'shadowoverlay-' . Str::random(8);
    $displacementScale = 20 + (($scale - 1) / 99) * 80; // maps scale to displacement offset
    $animationDuration = 1000 + (($speed - 1) / 99) * -950;
    $durationMs = $animationDuration / 25;

    // Extremely low frequency values to guarantee slow, organic fluid motion without high-frequency jitter
    $baseFreqX = 0.0001;
    $baseFreqY = 0.0003;
@endphp

<div {{ $attributes->merge(['class' => 'relative w-full overflow-hidden bg-gray-950 text-white min-h-[550px] flex items-center justify-center']) }}>
    
    <!-- SVG Definition placed outside the filtered element to prevent rendering issues -->
    <svg style="position: absolute; width: 0; height: 0;">
        <defs>
            <filter id="{{ $id }}">
                <feTurbulence
                    result="undulation"
                    numOctaves="2"
                    baseFrequency="{{ $baseFreqX }},{{ $baseFreqY }}"
                    seed="0"
                    type="turbulence"
                />
                <feColorMatrix
                    id="matrix-{{ $id }}"
                    in="undulation"
                    type="hueRotate"
                    values="180"
                />
                <feColorMatrix
                    in="dist"
                    result="circulation"
                    type="matrix"
                    values="4 0 0 0 1  4 0 0 0 1  4 0 0 0 1  1 0 0 0 0"
                />
                <feDisplacementMap
                    in="SourceGraphic"
                    in2="circulation"
                    scale="{{ $displacementScale }}"
                    result="dist"
                />
                <feDisplacementMap
                    in="dist"
                    in2="undulation"
                    scale="{{ $displacementScale }}"
                    result="output"
                />
            </filter>
        </defs>
    </svg>

    <!-- SVG Filter effect overlay matching exactly inset: -displacementScale -->
    <div style="position: absolute; top: -{{ $displacementScale }}px; left: -{{ $displacementScale }}px; right: -{{ $displacementScale }}px; bottom: -{{ $displacementScale }}px; pointer-events: none; filter: url(#{{ $id }}) blur(4px);">
        <div style="background-color: {{ $color }};
                    mask-image: url('https://framerusercontent.com/images/ceBGguIpUU8luwByxuQz79t7To.png');
                    -webkit-mask-image: url('https://framerusercontent.com/images/ceBGguIpUU8luwByxuQz79t7To.png');
                    mask-size: cover;
                    -webkit-mask-size: cover;
                    mask-repeat: no-repeat;
                    -webkit-mask-repeat: no-repeat;
                    mask-position: center;
                    -webkit-mask-position: center;
                    width: 100%;
                    height: 100%;">
        </div>
    </div>

    <!-- Noise Texture Overlay matching demo.tsx noise parameters -->
    @if($noiseOpacity > 0)
        <div class="absolute inset-0 pointer-events-none"
             style="background-image: url('https://framerusercontent.com/images/g0QcWrxr87K0ufOxIUFBakwYA8.png');
                    background-size: {{ $noiseScale * 200 }}px;
                    background-repeat: repeat;
                    opacity: {{ $noiseOpacity }};">
        </div>
    @endif

    <!-- Content Card overlay -->
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-24 text-center">
        <h1 class="text-5xl font-extrabold mb-4 tracking-tight leading-tight">{{ $title }}</h1>
        <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto font-medium">{{ $subtitle }}</p>
        <div class="max-w-xl mx-auto">
            <form method="GET" action="{{ $searchAction }}" class="flex gap-3">
                <input type="text" name="q" placeholder="Search by name, location..." 
                       class="flex-1 rounded-lg px-4 py-3 bg-white text-gray-900 shadow-lg text-sm border-0 focus:ring-2 focus:ring-indigo-500 placeholder-gray-500 font-medium" autofocus>
                <button type="submit" 
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold text-sm shadow-lg hover:bg-indigo-700 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript requestAnimationFrame step function to guarantee 1-to-1 smooth frame rotation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const matrix = document.getElementById('matrix-{{ $id }}');
            if (!matrix) return;

            const duration = {{ $durationMs }};
            let start = null;

            function animateHue(timestamp) {
                if (!start) start = timestamp;
                const elapsed = timestamp - start;
                const value = ((elapsed % duration) / duration) * 360;
                matrix.setAttribute('values', String(value));
                requestAnimationFrame(animateHue);
            }
            requestAnimationFrame(animateHue);
        });
    </script>
</div>
