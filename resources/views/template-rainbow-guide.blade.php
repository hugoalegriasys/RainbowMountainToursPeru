{{--
  Template Name: Travel Guide Template
--}}

@extends('layouts.app')

@section('content')

<section class="relative w-full h-[85vh] min-h-[700px] flex flex-col items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover scale-110" src="{{ get_field('hero_bg_image') }}" alt="">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/80"></div>
    <div class="absolute inset-0 bg-black/10 backdrop-blur-[2px]"></div>

    <div class="relative z-10 max-w-5xl px-4 mx-auto pt-20">
        <h1 class="text-6xl md:text-7xl font-black tracking-tight text-white leading-tight mb-6 drop-shadow-2xl">
            {{ get_field('hero_titulo') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-medium tracking-wide">
            {{ get_field('hero_subtitle') }}
        </p>

        @if(get_field('hero_boton_texto') && get_field('hero_boton_enlace'))
        <a href="{{ get_field('hero_boton_enlace') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] hover:scale-105 hover:shadow-[0_20px_40px_rgba(219,95,21,0.4)] transition-all duration-300 px-10 py-5 rounded-full font-bold tracking-widest text-white uppercase mb-12">
            {{ get_field('hero_boton_texto') }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        @endif

        <div class="flex flex-col items-center">
            <div class="flex items-center space-x-1 text-yellow-400 mb-4">
                @for ($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5 fill-current drop-shadow-md" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                @endfor
                <span class="text-white text-sm font-semibold ml-2 tracking-wide">{{ pll_current_language() == 'es' ? 'Valorado en 4.9/5 por más de 2,000 viajeros' : 'Rated 4.9/5 by 2,000+ travelers' }}</span>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-200 font-medium">
                @php
                    $is_es = (function_exists('pll_current_language') && pll_current_language() == 'es');
                    $trust_points = $is_es ? ['Guías Locales', 'Grupos Pequeños', 'Salidas Diarias', 'Cancelación Gratuita'] : ['Local Guides', 'Small Groups', 'Daily Departures', 'Free Cancellation'];
                @endphp
                @foreach($trust_points as $point)
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ $point }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="bg-gradient-to-b from-white via-slate-50 to-white w-full">
    <div class="max-w-7xl mx-auto px-4 py-28">

        <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl rounded-3xl p-8 md:p-12 mb-28">
            <h3 class="text-2xl font-black tracking-tight text-slate-900 mb-8">{{ pll_current_language() == 'es' ? 'Todo lo que necesitas saber' : 'Everything You Need To Know' }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-base font-semibold">

                @php
                    $nav_items = $is_es ? [
                        ['#what-is', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', '¿Qué es la Montaña de Colores?'],
                        ['#location', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z', 'Ubicación y Tours'],
                        ['#weather', 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'Clima y Mejor Época'],
                        ['#altitude', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'Mal de Altura'],
                        ['#packing', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'Lista de Equipaje y Dificultad'],
                        ['#tips', 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'Consejos Fotográficos y Seguridad']
                    ] : [
                        ['#what-is', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'What is Rainbow Mountain?'],
                        ['#location', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z', 'Location & Tours'],
                        ['#weather', 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'Weather & Best Time'],
                        ['#altitude', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'Altitude Sickness'],
                        ['#packing', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'Packing List & Difficulty'],
                        ['#tips', 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'Photo Tips & Safety']
                    ];
                @endphp

                @foreach($nav_items as $item)
                <a href="{{ $item[0] }}" class="flex items-center gap-4 text-slate-600 hover:text-[#db5f15] hover:translate-x-2 transition-all duration-300 group">
                    <div class="p-3 bg-slate-50 rounded-xl group-hover:bg-orange-50 group-hover:shadow-md transition-all duration-300">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item[1] }}"></path></svg>
                    </div>
                    {{ $item[2] }}
                </a>
                @endforeach
            </div>
        </div>

        <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 mb-6 text-center">{{ $is_es ? 'De Vistazo' : 'At a Glance' }}</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mx-auto mb-16"></div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-28">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M4 18l8-14 8 14M12 11l-3 4h6z"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Altitud' : 'Altitude' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">{{ get_field('glance_altitude') }}</span>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Ubicación' : 'Location' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">{{ get_field('glance_location') }}</span>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Dificultad' : 'Difficulty' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">{{ get_field('glance_difficulty') }}</span>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Tiempo de Caminata' : 'Hiking Time' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">
                    {!! str_replace('|||', '<span class="font-light text-slate-400 mx-1">-</span>', str_replace(['—', '–', '-'], '|||', get_field('glance_hiking_time'))) !!}
                </span>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Distancia' : 'Distance' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">{{ get_field('glance_distance') }}</span>
            </div>
            <div class="bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Mejores Meses' : 'Best Months' }}</span>
                <span class="text-[17px] font-semibold text-slate-800 mt-2 leading-snug">
                    {!! str_replace('|||', '<span class="font-light text-slate-400 mx-1">-</span>', str_replace(['—', '–', '-'], '|||', get_field('glance_best_months'))) !!}
                </span>
            </div>
            </div>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="what-is" class="mb-28">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? '¿Qué es la Montaña de Colores?' : 'What is Rainbow Mountain?' }}</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>

            @if(get_field('what_image'))
                <div class="overflow-hidden rounded-3xl shadow-2xl mb-12">
                    <img src="{{ get_field('what_image') }}" alt="Rainbow Mountain" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700">
                </div>
            @endif

            <div class="prose max-w-none text-slate-500 text-lg md:text-xl leading-relaxed mb-12 font-light">
                {!! get_field('what_content') !!}
            </div>

            @if(get_field('what_did_you_know'))
            <div class="bg-white/80 backdrop-blur-md border border-blue-100 shadow-xl p-8 rounded-3xl flex items-start gap-6 hover:-translate-y-1 transition-all duration-300">
                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-slate-900 mb-2">{{ $is_es ? '¿Sabías qué?' : 'Did you know?' }}</h4>
                    <p class="text-slate-600 text-lg whitespace-pre-line">{{ get_field('what_did_you_know') }}</p>
                </div>
            </div>
            @endif
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="location" class="mb-28">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Dónde está y Cómo llegar' : 'Where is it & How to Get There' }}</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-12"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20 items-center">
                <div class="rounded-3xl overflow-hidden shadow-2xl h-[400px] border border-white/50">
                    {!! get_field('location_map') !!}
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2h-2m-6 4h12a2 2 0 002-2v-4M4 12h16"></path></svg></div>
                        <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Tiempo de Auto' : 'Driving Time' }}</span>
                        <strong class="block text-xl font-black text-slate-900 mt-1">{{ get_field('loc_driving_time') }}</strong>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg></div>
                        <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Distancia' : 'Distance' }}</span>
                        <strong class="block text-xl font-black text-slate-900 mt-1">{{ get_field('loc_distance') }}</strong>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg></div>
                        <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Punto de Partida' : 'Starting Point' }}</span>
                        <strong class="block text-xl font-black text-slate-900 mt-1">{{ get_field('loc_start_point') }}</strong>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mx-auto mb-4"><svg class="w-6 h-6 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg></div>
                        <span class="text-[11px] text-slate-400 uppercase font-bold tracking-widest">{{ $is_es ? 'Pueblo Cercano' : 'Nearest Town' }}</span>
                        <strong class="block text-xl font-black text-slate-900 mt-1">{{ get_field('loc_nearest_town') }}</strong>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/90 backdrop-blur-md border border-slate-100 rounded-3xl p-8 shadow-xl hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4"><svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                        <h3 class="text-2xl font-black text-slate-900">{{ $is_es ? 'Tour en Grupo' : 'Group Tour' }}</h3>
                    </div>
                    <ul class="text-base text-slate-600 space-y-4 mb-6 flex-grow font-medium">
                        @php $group_items = explode("\n", get_field('tour_group_includes')); @endphp
                        @foreach($group_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white rounded-3xl p-8 shadow-2xl flex flex-col relative transform md:-translate-y-6 ring-2 ring-[#db5f15] hover:-translate-y-8 hover:shadow-[0_30px_60px_rgba(219,95,21,0.3)] transition-all duration-500 ease-out z-10">
                    <div class="absolute top-0 right-0 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] text-white text-xs font-black px-4 py-2 rounded-bl-2xl rounded-tr-3xl uppercase tracking-widest shadow-lg">{{ $is_es ? 'Mejor Opción' : 'Top Choice' }}</div>
                    <div class="text-center mb-6 pt-4">
                        <div class="w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mx-auto mb-4"><svg class="w-8 h-8 text-yellow-400 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg></div>
                        <h3 class="text-3xl font-black text-white">{{ $is_es ? 'Tour Privado' : 'Private Tour' }}</h3>
                    </div>
                    <ul class="text-base text-slate-300 space-y-4 mb-6 flex-grow font-medium">
                        @php $private_items = explode("\n", get_field('tour_private_includes')); @endphp
                        @foreach($private_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#ff7b2e] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white/90 backdrop-blur-md border border-slate-100 rounded-3xl p-8 shadow-xl hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 ease-out flex flex-col opacity-90">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4"><svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                        <h3 class="text-2xl font-black text-slate-900">{{ $is_es ? 'Auto Própio' : 'Self Drive' }}</h3>
                    </div>
                    <p class="text-base text-slate-500 mb-6 text-center flex-grow font-medium leading-relaxed">{{ $is_es ? 'No recomendado debido a las carreteras difíciles de la montaña, falta de señal y riesgos de altitud. Solo para conductores andinos altamente experimentados.' : 'Not recommended due to rough mountain roads, lack of signal, and altitude risks. Only for highly experienced Andean drivers.' }}</p>
                </div>
            </div>
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="weather" class="mb-28">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Mejor Época y Clima' : 'Best Time & Weather' }}</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>

            <div class="prose max-w-none text-slate-500 text-lg leading-relaxed mb-12 font-light">
                {!! get_field('weather_content') !!}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                <div class="bg-white/90 backdrop-blur-md shadow-xl border-t-4 border-yellow-400 p-8 rounded-b-3xl hover:-translate-y-2 transition-all duration-500 ease-out">
                    <h3 class="text-2xl font-black text-slate-900 flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center"><svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                        {{ $is_es ? 'Temporada Seca' : 'Dry Season' }}
                    </h3>
                    <span class="inline-block bg-slate-100 text-slate-800 text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-md mb-2">{{ get_field('weather_dry_temp') }}</span>
                    <ul class="mt-4 space-y-3 text-base text-slate-600 font-medium">
                        @php $dry_items = explode("\n", get_field('weather_dry_list')); @endphp
                        @foreach($dry_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white/90 backdrop-blur-md shadow-xl border-t-4 border-blue-400 p-8 rounded-b-3xl hover:-translate-y-2 transition-all duration-500 ease-out">
                    <h3 class="text-2xl font-black text-slate-900 flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center"><svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg></div>
                        {{ $is_es ? 'Temporada de Lluvias' : 'Rainy Season' }}
                    </h3>
                    <span class="inline-block bg-slate-100 text-slate-800 text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-md mb-2">{{ get_field('weather_rain_temp') }}</span>
                    <ul class="mt-4 space-y-3 text-base text-slate-600 font-medium">
                        @php $rain_items = explode("\n", get_field('weather_rain_list')); @endphp
                        @foreach($rain_items as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ $item }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <h2 class="text-3xl font-black tracking-tight text-slate-900 mb-8">{{ $is_es ? 'Perfil de Altitud' : 'Altitude Profile' }}</h2>
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between text-white shadow-2xl relative overflow-hidden border border-slate-700">
                <div class="text-center z-10 w-full md:w-auto">
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-4 backdrop-blur-sm"><svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                    <span class="font-black text-xl block tracking-wide">{{ $is_es ? 'Cusco' : 'Cusco' }}</span>
                    <span class="text-slate-400 text-sm font-medium">{{ get_field('alt_cusco') }}</span>
                </div>
                <div class="hidden md:block w-full border-t-2 border-dashed border-slate-600 mx-6 relative z-10"></div>
                <div class="text-center z-10 w-full md:w-auto my-8 md:my-0">
                    <div class="w-16 h-16 rounded-full bg-orange-500/20 flex items-center justify-center mx-auto mb-4 backdrop-blur-sm ring-1 ring-[#db5f15]"><svg class="w-8 h-8 text-[#ff7b2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
                    <span class="font-black text-xl block tracking-wide">{{ $is_es ? 'Inicio de Caminata' : 'Trailhead' }}</span>
                    <span class="text-[#ff7b2e] font-bold text-sm">{{ get_field('alt_trailhead') }}</span>
                </div>
                <div class="hidden md:block w-full border-t-2 border-dashed border-[#db5f15] mx-6 relative z-10"></div>
                <div class="text-center z-10 w-full md:w-auto">
                    <div class="w-16 h-16 rounded-full bg-red-500/20 flex items-center justify-center mx-auto mb-4 backdrop-blur-sm ring-1 ring-red-500"><svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M4 18l8-14 8 14M12 11l-3 4h6z"></path></svg></div>
                    <span class="font-black text-xl block tracking-wide">{{ $is_es ? 'Montaña de Colores' : 'Rainbow Mountain' }}</span>
                    <span class="text-red-400 font-bold text-sm">{{ get_field('alt_mountain') }}</span>
                </div>
            </div>
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="altitude" class="mb-28">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Mal de Altura' : 'Altitude Sickness' }}</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>

            <div class="prose max-w-none text-slate-500 text-lg leading-relaxed mb-12 font-light">{!! get_field('sickness_content') !!}</div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center"><svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></div>
                        {{ $is_es ? 'Síntomas' : 'Symptoms' }}
                    </h3>
                    <ul class="space-y-3 text-base text-slate-600 font-medium">
                        @php $symptoms = explode("\n", get_field('sickness_symptoms')); @endphp
                        @foreach($symptoms as $item) @if(trim($item)) <li class="flex items-start gap-3"><div class="w-2 h-2 rounded-full bg-orange-400 mt-2 flex-shrink-0"></div> {{ $item }}</li> @endif @endforeach
                    </ul>
                </div>
                <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center"><svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                        {{ $is_es ? 'Prevención' : 'Prevention' }}
                    </h3>
                    <ul class="space-y-3 text-base text-slate-600 font-medium">
                        @php $prevention = explode("\n", get_field('sickness_prevention')); @endphp
                        @foreach($prevention as $item) @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            {{ $item }}
                        </li>
                        @endif @endforeach
                    </ul>
                </div>
                <div class="bg-red-50/80 backdrop-blur-md border border-red-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                    <h3 class="text-2xl font-black text-red-900 mb-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center"><svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                        {{ $is_es ? 'Emergencia' : 'Emergency' }}
                    </h3>
                    <ul class="space-y-3 text-base text-red-800 font-medium">
                        @php $emergency = explode("\n", get_field('sickness_emergency')); @endphp
                        @foreach($emergency as $item) @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01"></path></svg>
                            {{ $item }}
                        </li>
                        @endif @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="packing" class="mb-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

                <div>
                    <h2 class="text-4xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Lista de Equipaje' : 'Packing List' }}</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>
                    <div class="grid grid-cols-2 gap-4">
                        @php $packing_items = explode("\n", get_field('packing_list_items')); @endphp
                        @foreach($packing_items as $item)
                            @if(trim($item))
                            <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-4 rounded-xl flex items-center gap-3 text-base font-semibold text-slate-700 shadow-md hover:-translate-y-1 transition-all duration-300">
                                <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-[#db5f15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg></div>
                                {{ $item }}
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div>
                    <h2 class="text-4xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Nivel de Dificultad' : 'Difficulty Level' }}</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>
                    <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-10 rounded-3xl shadow-xl">
                        <div class="mb-10">
                            <div class="flex justify-between text-sm font-black text-slate-400 mb-3 uppercase tracking-widest">
                                <span>{{ $is_es ? 'Fácil' : 'Easy' }}</span><span class="text-[#db5f15]">{{ $is_es ? 'Moderado' : 'Moderate' }}</span><span>{{ $is_es ? 'Difícil' : 'Hard' }}</span>
                            </div>
                            <div class="flex gap-1.5 h-6">
                                <div class="w-1/10 bg-green-400 rounded-l-full"></div><div class="w-1/10 bg-green-400"></div><div class="w-1/10 bg-green-400"></div>
                                <div class="w-1/10 bg-yellow-400"></div><div class="w-1/10 bg-yellow-400"></div><div class="w-1/10 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] shadow-[0_0_15px_rgba(219,95,21,0.5)]"></div><div class="w-1/10 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e]"></div>
                                <div class="w-1/10 bg-slate-200"></div><div class="w-1/10 bg-slate-200"></div><div class="w-1/10 bg-slate-200 rounded-r-full"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6 text-center divide-x divide-slate-200">
                            <div><strong class="block text-2xl font-black text-slate-900 mb-1">{{ get_field('diff_overall') }}</strong><span class="text-[11px] text-slate-400 uppercase tracking-widest font-bold">{{ $is_es ? 'General' : 'Overall' }}</span></div>
                            <div><strong class="block text-2xl font-black text-slate-900 mb-1">{{ get_field('diff_fitness') }}</strong><span class="text-[11px] text-slate-400 uppercase tracking-widest font-bold">{{ $is_es ? 'Condición' : 'Fitness' }}</span></div>
                            <div><strong class="block text-2xl font-black text-red-500 mb-1">{{ get_field('diff_altitude_impact') }}</strong><span class="text-[11px] text-slate-400 uppercase tracking-widest font-bold">{{ $is_es ? 'Altitud' : 'Altitude' }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section class="mb-28 grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <h2 class="text-4xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Valle Rojo' : 'Red Valley' }}</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>
                <div class="prose text-slate-500 text-lg leading-relaxed font-light">{!! get_field('red_valley_content') !!}</div>
            </div>
            <div>
                <h2 class="text-4xl font-black tracking-tight text-slate-900 mb-6">{{ $is_es ? 'Flora y Fauna' : 'Wildlife & Flora' }}</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] rounded-full mb-10"></div>
                <div class="prose text-slate-500 text-lg leading-relaxed font-light">{!! get_field('wildlife_content') !!}</div>
            </div>
        </section>

        <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-28"></div>

        <section id="tips" class="mb-28 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-yellow-50/80 backdrop-blur-md border border-yellow-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                <h3 class="text-2xl font-black text-yellow-900 mb-8 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-yellow-200/50 flex items-center justify-center"><svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                    {{ $is_es ? 'Consejos de Fotografía' : 'Photo Tips' }}
                </h3>
                <ul class="space-y-5">
                    <li class="flex justify-between border-b border-yellow-200/60 pb-3"><span class="text-yellow-800 font-semibold">{{ $is_es ? 'Mejor Hora' : 'Best Time' }}</span><strong class="text-yellow-900 font-black">{{ get_field('photo_tips_time') }}</strong></li>
                    <li class="flex justify-between border-b border-yellow-200/60 pb-3"><span class="text-yellow-800 font-semibold">{{ $is_es ? 'Mejor Lente' : 'Best Lens' }}</span><strong class="text-yellow-900 font-black">{{ get_field('photo_tips_lens') }}</strong></li>
                    <li class="flex justify-between border-b border-yellow-200/60 pb-3"><span class="text-yellow-800 font-semibold">{{ $is_es ? 'Drone' : 'Drone' }}</span><strong class="text-yellow-900 font-black text-right">{{ get_field('photo_tips_drone') }}</strong></li>
                </ul>
            </div>

            <div class="bg-white/90 backdrop-blur-md border border-slate-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center"><svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
                    {{ $is_es ? 'Consejos de Seguridad' : 'Safety Tips' }}
                </h3>
                <ul class="space-y-4 text-slate-600 font-medium">
                    @php $safety_items = explode("\n", get_field('safety_tips_list')); @endphp
                    @foreach($safety_items as $item)
                        @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            {{ $item }}
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="bg-green-50/80 backdrop-blur-md border border-green-100 p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 ease-out">
                <h3 class="text-2xl font-black text-green-900 mb-8 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-200/50 flex items-center justify-center"><svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16A12 12 0 0116 4h4v4a12 12 0 01-12 12H4v-4z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l6-6"></path></svg></div>
                    {{ $is_es ? 'Normas Eco' : 'Eco Rules' }}
                </h3>
                <ul class="space-y-4 text-green-800 font-medium">
                    @php $eco_items = explode("\n", get_field('responsible_tourism_list')); @endphp
                    @foreach($eco_items as $item)
                        @if(trim($item))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            {{ $item }}
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="relative rounded-[40px] overflow-hidden shadow-[0_35px_60px_rgba(0,0,0,0.35)] mt-10">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="{{ get_field('cta_bg_image') }}" alt="">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/60 to-slate-900/40"></div>
            <div class="absolute inset-0 backdrop-blur-sm"></div>

            <div class="relative z-10 p-16 md:p-24 text-center">
                <h2 class="text-5xl md:text-6xl font-black tracking-tight text-white mb-6 drop-shadow-lg">{{ get_field('cta_title') }}</h2>
                <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto mb-12 whitespace-pre-line font-light leading-relaxed">
                    {{ get_field('cta_description') }}
                </p>

                @if(get_field('cta_button_text') && get_field('cta_button_link'))
                <a href="{{ get_field('cta_button_link') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-[#db5f15] to-[#ff7b2e] hover:scale-105 hover:shadow-[0_20px_40px_rgba(219,95,21,0.5)] transition-all duration-300 px-12 py-6 rounded-full font-black tracking-widest text-white text-lg uppercase">
                    {{ get_field('cta_button_text') }}
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                @endif
            </div>
        </section>

    </div> <!-- Fin contenedor max-w -->
</div> <!-- Fin fondo gris -->

@endsection
