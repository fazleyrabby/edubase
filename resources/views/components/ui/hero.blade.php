@props([
    'title' => 'Discover Education in Bangladesh',
    'subtitle' => 'Comprehensive database of schools, madrasas, and colleges — compare fees, facilities, and admission information.',
    'searchAction' => '',
    'color' => 'rgba(52, 174, 97, 0.15)', // Primary brand green with soft glow
    'scale' => 100,
    'speed' => 90,
    'noiseOpacity' => 0.05,
    'noiseScale' => 1.2,
])

@php
    $id = 'shadowoverlay-' . Str::random(8);
    $displacementScale = 20 + (($scale - 1) / 99) * 80;
    $animationDuration = 1000 + (($speed - 1) / 99) * -950;
    $durationSec = ($animationDuration / 25) / 1000;

    $baseFreqX = 0.001 - ($scale / 100) * 0.0005;
    $baseFreqY = 0.004 - ($scale / 100) * 0.002;
@endphp

<div {{ $attributes->merge(['class' => 'relative w-full overflow-hidden bg-gray-900 text-white min-h-[500px] flex items-center justify-center']) }}>
    <!-- SVG Filter effect overlay -->
    <div class="absolute inset-0 pointer-events-none" style="margin: -{{ $displacementScale }}px; filter: url(#{{ $id }}) blur(4px);">
        <svg class="absolute w-0 h-0">
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
                        type="hueRotate"
                        values="0"
                    >
                        <animate attributeName="values" from="0" to="360" dur="{{ $durationSec }}s" repeatCount="indefinite" />
                    </feColorMatrix>
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
        
        <div class="w-full h-full"
             style="background-color: {{ $color }};
                    mask-image: url('https://framerusercontent.com/images/ceBGguIpUU8luwByxuQz79t7To.png');
                    -webkit-mask-image: url('https://framerusercontent.com/images/ceBGguIpUU8luwByxuQz79t7To.png');
                    mask-size: cover;
                    -webkit-mask-size: cover;
                    mask-repeat: no-repeat;
                    -webkit-mask-repeat: no-repeat;
                    mask-position: center;
                    -webkit-mask-position: center;">
        </div>
    </div>

    <!-- Noise Texture Overlay -->
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
</div>
