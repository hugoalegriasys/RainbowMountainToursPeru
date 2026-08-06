{{--
  Template Name: Travel Guide Template
--}}

@extends('layouts.app')

@section('content')

@php
    // Definimos el idioma aquí arriba para que toda la página pueda traducirse sin errores
    $is_es = (function_exists('pll_current_language') && pll_current_language() == 'es');
@endphp

<!-- HERO SECTION -->
<section class="relative w-full h-[70vh] min-h-[500px] md:min-h-[600px] flex flex-col items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ get_field('hero_bg_image') }}" alt="">
    </div>
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-4xl px-6 mx-auto pt-20 flex flex-col items-center">
        
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold uppercase tracking-[0.1em] text-white leading-tight mb-6">
            {{ get_field('hero_titulo') }}
        </h1>
        
        <p class="text-base md:text-lg font-light tracking-wide leading-relaxed text-gray-200 max-w-2xl mx-auto mb-8">
            {{ get_field('hero_subtitle') }}
        </p>

        @if(get_field('hero_boton_texto') && get_field('hero_boton_enlace'))
        <a href="{{ get_field('hero_boton_enlace') }}" class="inline-flex items-center justify-center gap-3 bg-[#db5f15] hover:bg-[#c25411] transition-colors duration-300 px-8 md:px-10 py-4 font-bold tracking-[0.2em] text-white text-xs md:text-sm uppercase mb-10 w-full sm:w-auto">
            {{ get_field('hero_boton_texto') }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        @endif
        
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="bg-white w-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20">

        <!-- NAV -->
        <div class="border border-gray-200 bg-white p-6 md:p-12 mb-16 md:mb-20">
            <h3 class="text-lg md:text-xl font-bold tracking-tight text-gray-900 mb-6 md:mb-8 uppercase text-center md:text-left">{{ $is_es ? 'Índice de Guía' : 'Guide Index' }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8 text-sm font-medium">
                @php
                    $nav_items = $is_es ? [
                        ['#what-is', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', '¿Qué es la Montaña?'],
                        ['#location', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z', 'Ubicación y Tours'],
                        ['#weather', 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'Clima y Época'],
                        ['#altitude', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'Mal de Altura'],
                        ['#packing', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'Lista de Equipaje'],
                        ['#tips', 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'Fotografía y Eco']
                    ] : [
                        ['#what-is', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'What is Rainbow Mtn?'],
                        ['#location', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z', 'Location & Tours'],
                        ['#weather', 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'Weather & Time'],
                        ['#altitude', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'Altitude Sickness'],
                        ['#packing', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'Packing List'],
                        ['#tips', 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'Photo & Eco Tips']
                    ];
                @endphp

                @foreach($nav_items as $item)
                <a href="{{ $item[0] }}" class="flex items-center gap-3 text-gray-600 hover:text-[#db5f15] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#db5f15] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item[1] }}"></path></svg>
                    {{ $item[2] }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- AT A GLANCE: Adaptable a 2 columnas en móvil -->
        <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4 text-center">{{ $is_es ? 'De un Vistazo' : 'At a Glance' }}</h2>
        <div class="w-12 h-[2px] bg-[#db5f15] mx-auto mb-10"></div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-y-8 md:gap-y-10 border-y border-gray-200 py-8 mb-16 md:mb-24">
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M4 18l8-14 8 14M12 11l-3 4h6z"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Altitud' : 'Altitude' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">{{ get_field('glance_altitude') }}</span>
            </div>
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Ubicación' : 'Location' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">{{ get_field('glance_location') }}</span>
            </div>
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Dificultad' : 'Difficulty' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">{{ get_field('glance_difficulty') }}</span>
            </div>
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Tiempo' : 'Hiking Time' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">
                    {!! str_replace('|||', '<span class="font-light text-gray-300 mx-1">-</span>', str_replace(['—', '–', '-'], '|||', get_field('glance_hiking_time'))) !!}
                </span>
            </div>
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Distancia' : 'Distance' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">{{ get_field('glance_distance') }}</span>
            </div>
            <div class="flex flex-col items-center text-center px-2">
                <svg class="w-6 h-6 text-[#db5f15] mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Temporada' : 'Best Months' }}</span>
                <span class="text-xs md:text-sm font-semibold text-gray-900 mt-1">
                    {!! str_replace('|||', '<span class="font-light text-gray-300 mx-1">-</span>', str_replace(['—', '–', '-'], '|||', get_field('glance_best_months'))) !!}
                </span>
            </div>
        </div>

        <section id="what-is" class="mb-16 md:mb-24">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? '¿Qué es la Montaña de Colores?' : 'What is Rainbow Mountain?' }}</h2>
            <div class="w-12 h-[2px] bg-[#db5f15] mb-8"></div>

            @if(get_field('what_image'))
                <div class="mb-8 md:mb-12">
                    <img src="{{ get_field('what_image') }}" alt="Rainbow Mountain" class="w-full h-[300px] md:h-[450px] object-cover">
                </div>
            @endif

            <div class="prose max-w-none text-gray-600 text-base md:text-lg leading-relaxed mb-10 md:mb-12 font-light">
                {!! get_field('what_content') !!}
            </div>

            @if(get_field('what_did_you_know'))
            <div class="bg-gray-50 border-l-2 border-[#db5f15] p-6 md:p-8 flex flex-col md:flex-row items-start gap-4 md:gap-6">
                <svg class="w-6 h-6 text-[#db5f15] flex-shrink-0 mt-1 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#db5f15] md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $is_es ? '¿Sabías qué?' : 'Did you know?' }}
                    </h4>
                    <p class="text-gray-600 text-sm md:text-base whitespace-pre-line">{{ get_field('what_did_you_know') }}</p>
                </div>
            </div>
            @endif
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <!-- MAPA Y UBICACIÓN -->
        <section id="location" class="mb-16 md:mb-24">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Dónde está y Cómo llegar' : 'Where is it & How to Get There' }}</h2>
            <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-12"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 mb-12 md:mb-16 items-center">
                <div class="border border-gray-200 h-[350px] md:h-[400px] bg-gray-50 p-2 [&>iframe]:w-full [&>iframe]:h-full overflow-hidden">
                    {!! get_field('location_map') !!}
                </div>
                
                <!-- Cuadrícula 1 columna en móvil, 2 en PC -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-px bg-gray-200 border border-gray-200">
                    <div class="bg-white p-6 flex flex-col items-center text-center">
                        <svg class="w-6 h-6 text-[#db5f15] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2h-2m-6 4h12a2 2 0 002-2v-4M4 12h16"></path></svg>
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Tiempo Auto' : 'Driving Time' }}</span>
                        <strong class="block text-base md:text-lg font-semibold text-gray-900 mt-1">{{ get_field('loc_driving_time') }}</strong>
                    </div>
                    <div class="bg-white p-6 flex flex-col items-center text-center">
                        <svg class="w-6 h-6 text-[#db5f15] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Distancia' : 'Distance' }}</span>
                        <strong class="block text-base md:text-lg font-semibold text-gray-900 mt-1">{{ get_field('loc_distance') }}</strong>
                    </div>
                    <div class="bg-white p-6 flex flex-col items-center text-center">
                        <svg class="w-6 h-6 text-[#db5f15] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Punto Partida' : 'Starting Point' }}</span>
                        <strong class="block text-base md:text-lg font-semibold text-gray-900 mt-1">{{ get_field('loc_start_point') }}</strong>
                    </div>
                    <div class="bg-white p-6 flex flex-col items-center text-center">
                        <svg class="w-6 h-6 text-[#db5f15] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Pueblo Cercano' : 'Nearest Town' }}</span>
                        <strong class="block text-base md:text-lg font-semibold text-gray-900 mt-1">{{ get_field('loc_nearest_town') }}</strong>
                    </div>
                </div>
            </div>

            <!-- Tipos de Tours: Colapsa seguro en móvil -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                <div class="border border-gray-200 bg-white p-6 md:p-8 flex flex-col">
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-6 text-center pb-4 border-b border-gray-100">{{ $is_es ? 'Tour en Grupo' : 'Group Tour' }}</h3>
                    <ul class="text-sm text-gray-600 space-y-4 flex-grow font-light">
                        @php $group_items = explode("\n", get_field('tour_group_includes')); @endphp
                        @foreach($group_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="bg-gray-900 border border-gray-800 text-white p-6 md:p-8 flex flex-col relative transform mt-4 lg:mt-0 lg:-translate-y-4 shadow-lg">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#db5f15] text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest whitespace-nowrap">{{ $is_es ? 'Opción Recomendada' : 'Top Choice' }}</div>
                    <h3 class="text-lg md:text-xl font-bold text-white mb-6 text-center pb-4 border-b border-gray-700">{{ $is_es ? 'Tour Privado' : 'Private Tour' }}</h3>
                    <ul class="text-sm text-gray-300 space-y-4 flex-grow font-light">
                        @php $private_items = explode("\n", get_field('tour_private_includes')); @endphp
                        @foreach($private_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="border border-gray-200 bg-gray-50 p-6 md:p-8 flex flex-col mt-4 lg:mt-0">
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-6 text-center pb-4 border-b border-gray-200">{{ $is_es ? 'Auto Propio' : 'Self Drive' }}</h3>
                    <p class="text-sm text-gray-500 text-center flex-grow font-light leading-relaxed">{{ $is_es ? 'No recomendado debido a las carreteras difíciles, falta de señal y riesgos de altitud. Solo para conductores andinos altamente experimentados.' : 'Not recommended due to rough mountain roads, lack of signal, and altitude risks. Only for highly experienced Andean drivers.' }}</p>
                </div>
            </div>
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <section id="weather" class="mb-16 md:mb-24">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Mejor Época y Clima' : 'Best Time & Weather' }}</h2>
            <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>

            <div class="prose max-w-none text-gray-600 text-base md:text-lg leading-relaxed mb-10 md:mb-12 font-light">
                {!! get_field('weather_content') !!}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-gray-200 border border-gray-200 mb-12 md:mb-16">
                <div class="bg-white p-6 md:p-10 flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <h3 class="text-base md:text-lg font-bold text-gray-900">{{ $is_es ? 'Temporada Seca' : 'Dry Season' }}</h3>
                    </div>
                    <span class="inline-block border border-gray-200 text-gray-600 text-[10px] md:text-xs font-bold uppercase tracking-widest px-3 py-1.5 w-max mb-6">{{ get_field('weather_dry_temp') }}</span>
                    <ul class="space-y-4 text-sm text-gray-600 font-light">
                        @php $dry_items = explode("\n", get_field('weather_dry_list')); @endphp
                        @foreach($dry_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 md:p-10 flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                        <h3 class="text-base md:text-lg font-bold text-gray-900">{{ $is_es ? 'Temporada de Lluvias' : 'Rainy Season' }}</h3>
                    </div>
                    <span class="inline-block border border-gray-200 text-gray-600 text-[10px] md:text-xs font-bold uppercase tracking-widest px-3 py-1.5 w-max mb-6">{{ get_field('weather_rain_temp') }}</span>
                    <ul class="space-y-4 text-sm text-gray-600 font-light">
                        @php $rain_items = explode("\n", get_field('weather_rain_list')); @endphp
                        @foreach($rain_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Altitude Profile: Móvil flex-col -->
            <h3 class="text-xl font-bold tracking-tight text-gray-900 mb-6">{{ $is_es ? 'Perfil de Altitud' : 'Altitude Profile' }}</h3>
            <div class="border border-gray-200 bg-gray-50 p-6 md:p-10 flex flex-col md:flex-row items-center justify-between text-gray-900 relative">
                <div class="text-center z-10 w-full md:w-auto">
                    <div class="w-12 h-12 border border-gray-300 bg-white flex items-center justify-center mx-auto mb-3 md:mb-4"><svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                    <span class="font-bold text-xs md:text-sm block uppercase tracking-widest">{{ $is_es ? 'Cusco' : 'Cusco' }}</span>
                    <span class="text-gray-500 text-xs font-light mt-1 block">{{ get_field('alt_cusco') }}</span>
                </div>
                <div class="w-px h-8 border-l border-dashed border-gray-300 my-2 md:hidden"></div>
                <div class="hidden md:block w-full border-t border-dashed border-gray-300 mx-4 lg:mx-6 relative z-10"></div>
                <div class="text-center z-10 w-full md:w-auto">
                    <div class="w-12 h-12 border border-[#db5f15] bg-white flex items-center justify-center mx-auto mb-3 md:mb-4"><svg class="w-5 h-5 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
                    <span class="font-bold text-xs md:text-sm block uppercase tracking-widest">{{ $is_es ? 'Inicio de Caminata' : 'Trailhead' }}</span>
                    <span class="text-gray-500 text-xs font-light mt-1 block">{{ get_field('alt_trailhead') }}</span>
                </div>
                <div class="w-px h-8 border-l border-dashed border-gray-300 my-2 md:hidden"></div>
                <div class="hidden md:block w-full border-t border-dashed border-gray-300 mx-4 lg:mx-6 relative z-10"></div>
                <div class="text-center z-10 w-full md:w-auto">
                    <div class="w-12 h-12 border border-gray-900 bg-gray-900 flex items-center justify-center mx-auto mb-3 md:mb-4"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M4 18l8-14 8 14M12 11l-3 4h6z"></path></svg></div>
                    <span class="font-bold text-xs md:text-sm block uppercase tracking-widest">{{ $is_es ? 'Montaña Colores' : 'Rainbow Mtn' }}</span>
                    <span class="text-gray-500 text-xs font-light mt-1 block">{{ get_field('alt_mountain') }}</span>
                </div>
            </div>
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <section id="altitude" class="mb-16 md:mb-24">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Mal de Altura' : 'Altitude Sickness' }}</h2>
            <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>

            <div class="prose max-w-none text-gray-600 text-base md:text-lg leading-relaxed mb-10 md:mb-12 font-light">{!! get_field('sickness_content') !!}</div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-px bg-gray-200 border border-gray-200">
                <div class="bg-white p-6 md:p-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">{{ $is_es ? 'Síntomas' : 'Symptoms' }}</h3>
                    <ul class="space-y-4 text-sm text-gray-600 font-light">
                        @php $symptoms = explode("\n", get_field('sickness_symptoms')); @endphp
                        @foreach($symptoms as $item) @if(trim($item)) 
                        <li class="flex items-start gap-3">
                            <span class="w-1 h-1 rounded-full bg-gray-400 mt-2 flex-shrink-0"></span> 
                            {{ $item }}
                        </li> 
                        @endif @endforeach
                    </ul>
                </div>
                <div class="bg-white p-6 md:p-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">{{ $is_es ? 'Prevención' : 'Prevention' }}</h3>
                    <ul class="space-y-4 text-sm text-gray-600 font-light">
                        @php $prevention = explode("\n", get_field('sickness_prevention')); @endphp
                        @foreach($prevention as $item) @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                            {{ $item }}
                        </li>
                        @endif @endforeach
                    </ul>
                </div>
                <div class="bg-gray-50 p-6 md:p-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-4">{{ $is_es ? 'Emergencia' : 'Emergency' }}</h3>
                    <ul class="space-y-4 text-sm text-gray-600 font-light">
                        @php $emergency = explode("\n", get_field('sickness_emergency')); @endphp
                        @foreach($emergency as $item) @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01"></path></svg>
                            {{ $item }}
                        </li>
                        @endif @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <!-- PACKING LIST & DIFFICULTY -->
        <section id="packing" class="mb-16 md:mb-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Lista de Equipaje' : 'Packing List' }}</h2>
                    <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                        @php $packing_items = explode("\n", get_field('packing_list_items')); @endphp
                        @foreach($packing_items as $item)
                            @if(trim($item))
                            <div class="flex items-start gap-3 border-b border-gray-100 pb-2 text-sm text-gray-600 font-light">
                                <svg class="w-4 h-4 text-[#db5f15] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Nivel de Dificultad' : 'Difficulty Level' }}</h2>
                    <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>
                    
                    <div class="border border-gray-200 bg-white p-6 md:p-10">
                        <div class="mb-8 md:mb-10">
                            <div class="flex justify-between text-[10px] md:text-xs font-bold text-gray-400 mb-3 uppercase tracking-widest">
                                <span>{{ $is_es ? 'Fácil' : 'Easy' }}</span><span class="text-gray-900">{{ $is_es ? 'Moderado' : 'Moderate' }}</span><span>{{ $is_es ? 'Difícil' : 'Hard' }}</span>
                            </div>
                            <div class="flex h-3 bg-gray-100 overflow-hidden">
                                <div class="w-1/10 bg-gray-300"></div><div class="w-1/10 bg-gray-300"></div><div class="w-1/10 bg-gray-300"></div>
                                <div class="w-1/10 bg-gray-500"></div><div class="w-1/10 bg-gray-500"></div><div class="w-1/10 bg-[#db5f15]"></div><div class="w-1/10 bg-[#db5f15]"></div>
                                <div class="w-1/10 bg-transparent"></div><div class="w-1/10 bg-transparent"></div><div class="w-1/10 bg-transparent"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2 md:gap-6 text-center divide-x divide-gray-200">
                            <div><strong class="block text-lg md:text-xl font-bold text-gray-900 mb-1">{{ get_field('diff_overall') }}</strong><span class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-widest font-bold">{{ $is_es ? 'General' : 'Overall' }}</span></div>
                            <div><strong class="block text-lg md:text-xl font-bold text-gray-900 mb-1">{{ get_field('diff_fitness') }}</strong><span class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-widest font-bold">{{ $is_es ? 'Condición' : 'Fitness' }}</span></div>
                            <div><strong class="block text-lg md:text-xl font-bold text-gray-900 mb-1">{{ get_field('diff_altitude_impact') }}</strong><span class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-widest font-bold">{{ $is_es ? 'Altitud' : 'Altitude' }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <section class="mb-16 md:mb-24 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Valle Rojo' : 'Red Valley' }}</h2>
                <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>
                <div class="prose text-gray-600 text-base md:text-lg leading-relaxed font-light">{!! get_field('red_valley_content') !!}</div>
            </div>
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $is_es ? 'Flora y Fauna' : 'Wildlife & Flora' }}</h2>
                <div class="w-12 h-[2px] bg-[#db5f15] mb-8 md:mb-10"></div>
                <div class="prose text-gray-600 text-base md:text-lg leading-relaxed font-light">{!! get_field('wildlife_content') !!}</div>
            </div>
        </section>

        <hr class="border-t border-gray-200 my-16 md:my-20">

        <!-- CONSEJOS EXTRA -->
        <section id="tips" class="mb-16 md:mb-24 grid grid-cols-1 md:grid-cols-3 gap-px bg-gray-200 border border-gray-200">
            <div class="bg-white p-6 md:p-8">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">{{ $is_es ? 'Fotografía' : 'Photo Tips' }}</h3>
                <ul class="space-y-4">
                    <li class="flex flex-col"><span class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $is_es ? 'Mejor Hora' : 'Best Time' }}</span><span class="text-sm text-gray-700 font-light">{{ get_field('photo_tips_time') }}</span></li>
                    <li class="flex flex-col"><span class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $is_es ? 'Mejor Lente' : 'Best Lens' }}</span><span class="text-sm text-gray-700 font-light">{{ get_field('photo_tips_lens') }}</span></li>
                    <li class="flex flex-col"><span class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $is_es ? 'Drone' : 'Drone' }}</span><span class="text-sm text-gray-700 font-light">{{ get_field('photo_tips_drone') }}</span></li>
                </ul>
            </div>

            <div class="bg-white p-6 md:p-8">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">{{ $is_es ? 'Seguridad' : 'Safety Tips' }}</h3>
                <ul class="space-y-4 text-sm text-gray-600 font-light">
                    @php $safety_items = explode("\n", get_field('safety_tips_list')); @endphp
                    @foreach($safety_items as $item)
                        @if(trim($item))
                        <li class="flex items-start gap-3">
                            <span class="w-1 h-1 rounded-full bg-[#db5f15] mt-2 flex-shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-6 md:p-8">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">{{ $is_es ? 'Normas Eco' : 'Eco Rules' }}</h3>
                <ul class="space-y-4 text-sm text-gray-600 font-light">
                    @php $eco_items = explode("\n", get_field('responsible_tourism_list')); @endphp
                    @foreach($eco_items as $item)
                        @if(trim($item))
                        <li class="flex items-start gap-3">
                            <span class="w-1 h-1 rounded-full bg-gray-400 mt-2 flex-shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- CTA FINAL -->
        <section class="relative overflow-hidden mt-10">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="{{ get_field('cta_bg_image') }}" alt="">
            </div>
            <div class="absolute inset-0 bg-gray-900/80"></div>

            <div class="relative z-10 p-10 md:p-16 lg:p-24 text-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-4 md:mb-6">{{ get_field('cta_title') }}</h2>
                <p class="text-base md:text-lg lg:text-xl text-gray-300 max-w-3xl mx-auto mb-8 md:mb-12 whitespace-pre-line font-light leading-relaxed">
                    {{ get_field('cta_description') }}
                </p>

                @if(get_field('cta_button_text') && get_field('cta_button_link'))
                <a href="{{ get_field('cta_button_link') }}" class="inline-flex justify-center items-center gap-3 bg-[#db5f15] hover:bg-[#c25411] transition-colors duration-300 px-8 md:px-12 py-4 md:py-5 font-bold tracking-[2px] text-white text-xs md:text-sm uppercase w-full sm:w-auto">
                    {{ get_field('cta_button_text') }}
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                @endif
            </div>
        </section>

    </div>
</div>

@endsection