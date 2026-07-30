<?php /* Template Name: Plantilla - About Us */ ?>

@extends('layouts.app') {{-- Ajusta esto a tu layout principal --}}

@section('content')

<!-- ==========================================
     1. HERO SECTION
=========================================== -->
<section class="relative w-full h-[70vh] min-h-[500px] flex flex-col items-center justify-center text-center bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url('{{ get_field('fondo_img') }}');">
    <div class="relative z-10 max-w-4xl px-4 mx-auto pt-16">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 uppercase tracking-wider drop-shadow-lg">
            {{ get_field('hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto font-light">
            {{ get_field('hero_subtitle') }}
        </p>
        
        @if(get_field('hero_btn_text') && get_field('hero_btn_link'))
        <a href="{{ get_field('hero_btn_link') }}" class="inline-block bg-[#db5f15] hover:bg-[#c25411] text-white font-bold py-4 px-8 rounded-lg shadow-xl transition-all uppercase tracking-wider">
            {{ get_field('hero_btn_text') }}
        </a>
        @endif
    </div>
</section>

<!-- Contenedor principal con fondo gris muy sutil -->
<div class="bg-gray-50 w-full">
    <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 space-y-24">

        <!-- ==========================================
             2. DISCOVER PERU
        =========================================== -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">{{ get_field('about_titulo') }}</h2>
                <div class="prose prose-lg text-gray-600">
                    {!! get_field('about_descripcion') !!}
                </div>
            </div>
            @if(get_field('about_imagen'))
            <div class="relative">
                <div class="absolute inset-0 bg-[#db5f15] rounded-2xl transform translate-x-4 translate-y-4 opacity-20"></div>
                <img src="{{ get_field('about_imagen') }}" alt="{{ get_field('about_titulo') }}" class="relative w-full h-[500px] object-cover rounded-2xl shadow-xl">
            </div>
            @endif
        </section>

        <!-- ==========================================
             3. WHY CHOOSE US
        =========================================== -->
        <section>
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? 'Por qué elegirnos' : __('Why Choose Us', 'quechuas') }}
                </h2>
                <div class="w-24 h-1 bg-[#db5f15] mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    // Array de SVGs profesionales estáticos para cada tarjeta
                    $icons = [
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>', // Pin
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>', // Users
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>', // Shield
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>', // Star
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16A12 12 0 0116 4h4v4a12 12 0 01-12 12H4v-4z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l6-6"></path>', // Leaf
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>' // Support
                    ];
                @endphp
                
                @for($i = 1; $i <= 6; $i++)
                    @if(get_field('why_choose_'.$i.'_title'))
                    <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-6 text-[#db5f15]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$i-1] !!}</svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ get_field('why_choose_'.$i.'_title') }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ get_field('why_choose_'.$i.'_text') }}</p>
                    </div>
                    @endif
                @endfor
            </div>
        </section>

        <!-- ==========================================
             4. OUR STORY
        =========================================== -->
        <section class="bg-white rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">{{ get_field('story_title') }}</h2>
                    <div class="prose text-gray-600 mb-8">
                        {!! get_field('story_content') !!}
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? '¿Qué nos hace diferentes?' : __('What Makes Us Different?', 'quechuas') }}
                    </h3>
                    <ul class="space-y-3">
                        @php $differences = explode("\n", get_field('different_list')); @endphp
                        @foreach($differences as $diff)
                            @if(trim($diff))
                            <li class="flex items-center gap-3 text-gray-700 font-medium">
                                <svg class="w-5 h-5 text-[#db5f15] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ trim($diff) }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @if(get_field('different_img'))
                <div class="h-full">
                    <img src="{{ get_field('different_img') }}" alt="Our Story" class="w-full h-full min-h-[400px] object-cover rounded-2xl shadow-md">
                </div>
                @endif
            </div>
        </section>

        <!-- ==========================================
             5. OUR VALUES
        =========================================== -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Mission -->
            <div class="bg-gray-900 text-white rounded-2xl p-8 shadow-xl text-center">
                <svg class="w-12 h-12 mx-auto text-[#db5f15] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <h3 class="text-2xl font-bold mb-4">{{ get_field('mission_title') }}</h3>
                <p class="text-gray-300">{{ get_field('mission_text') }}</p>
            </div>
            <!-- Vision -->
            <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-md text-center">
                <svg class="w-12 h-12 mx-auto text-[#db5f15] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ get_field('vision_title') }}</h3>
                <p class="text-gray-600">{{ get_field('vision_text') }}</p>
            </div>
            <!-- Commitment -->
            <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-md text-center">
                <svg class="w-12 h-12 mx-auto text-[#db5f15] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ get_field('commitment_title') }}</h3>
                <p class="text-gray-600">{{ get_field('commitment_text') }}</p>
            </div>
        </section>

        <!-- ==========================================
             6. BY THE NUMBERS
        =========================================== -->
        <section class="bg-[#db5f15] rounded-3xl p-8 md:p-16 shadow-2xl text-white">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 text-center border-white/20 divide-x divide-white/20">
                @for($i = 1; $i <= 6; $i++)
                    @if(get_field('stat'.$i.'_number'))
                    <div class="px-2">
                        <span class="block text-4xl md:text-5xl font-extrabold mb-2">{{ get_field('stat'.$i.'_number') }}</span>
                        <span class="text-sm md:text-base font-medium text-orange-100">{{ get_field('stat'.$i.'_title') }}</span>
                    </div>
                    @endif
                @endfor
            </div>
        </section>

        <!-- ==========================================
             7. AWARDS & CERTIFICATIONS
        =========================================== -->
        @if(get_field('award_1') || get_field('award_2'))
        <section class="text-center">
            <h3 class="text-xl font-bold text-gray-400 uppercase tracking-widest mb-8">
                {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? 'Reconocido y certificado por' : __('Recognized & Certified By', 'quechuas') }}
            </h3>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition duration-300">
                @for($i = 1; $i <= 4; $i++)
                    @if(get_field('award_'.$i))
                        <img src="{{ get_field('award_'.$i) }}" alt="Award" class="h-16 md:h-20 object-contain">
                    @endif
                @endfor
            </div>
        </section>
        @endif

        <!-- ==========================================
             8. OUR DESTINATIONS (ACF FIELDS DESDE OTRA PÁGINA)
        =========================================== -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? 'Explora nuestros destinos' : __('Explore Our Destinations', 'quechuas') }}
                    </h2>
                    <p class="text-gray-600 mt-2">
                        {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? 'Descubre la magia de los Andes con nuestros expertos locales.' : __('Discover the magic of the Andes with our local experts.', 'quechuas') }}
                    </p>
                </div>
            </div>

            @php
                // ⚠️ CAMBIA ESTE NÚMERO por el ID de la página donde realmente llenaste los campos (ej. Portada o Destinations)
                $origen_id = 6; 

                // Soporte para Polylang: Si el usuario está en la versión en español, busca el ID de la página en español
                if (function_exists('pll_get_post')) {
                    $translated_id = pll_get_post($origen_id);
                    if ($translated_id) {
                        $origen_id = $translated_id;
                    }
                }
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @for($i = 1; $i <= 6; $i++)
                    @php
                        // Al agregar $origen_id, ACF roba los datos de esa página específica, no de About Us
                        $dest_img   = get_field('dest_'.$i.'_imagen', $origen_id);
                        $dest_title = get_field('dest_'.$i.'_titulo', $origen_id);
                        $dest_sub   = get_field('dest_'.$i.'_subtitulo', $origen_id);
                        $dest_link  = get_field('dest_'.$i.'_enlace', $origen_id);
                    @endphp

                    @if($dest_title)
                    <a href="{{ $dest_link ? $dest_link : '#' }}" class="group relative h-72 md:h-80 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition block">
                        
                        @if($dest_img)
                            <img src="{{ $dest_img }}" alt="{{ $dest_title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-800"></div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-5 text-white z-10">
                            <h3 class="text-lg md:text-xl font-bold mb-1 drop-shadow-md uppercase tracking-wide">{{ $dest_title }}</h3>
                            <span class="text-xs text-gray-300">{{ $dest_sub }}</span>
                        </div>
                    </a>
                    @endif
                @endfor
            </div>
        </section>

        <!-- ==========================================
             9. SEO CONTENT
        =========================================== -->
        @if(get_field('seo_content'))
        <section class="bg-white border border-gray-100 rounded-2xl p-8 md:p-12 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                {{ function_exists('pll_current_language') && pll_current_language() == 'es' ? '¿Por qué visitar Perú con expertos locales?' : __('Why Visit Peru With Local Experts?', 'quechuas') }}
            </h2>
            <div class="prose max-w-none text-gray-600">
                {!! get_field('seo_content') !!}
            </div>
        </section>
        @endif

        <!-- ==========================================
             10. FINAL CTA
        =========================================== -->
        <section class="bg-gray-900 text-white rounded-3xl p-10 md:p-20 text-center shadow-2xl bg-cover bg-center bg-blend-overlay" style="background-image: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('{{ get_field('cta_bg') }}');">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow-md">{{ get_field('cta_title') }}</h2>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                {{ get_field('cta_desc') }}
          </p>
            
            @if(get_field('cta_btn_text') && get_field('cta_btn_link'))
            <a href="{{ get_field('cta_btn_link') }}" class="inline-block bg-[#db5f15] hover:bg-white hover:text-gray-900 text-white text-lg font-bold py-4 px-10 rounded-xl shadow-lg transition-all uppercase tracking-widest">
                {{ get_field('cta_btn_text') }}
            </a>
            @endif
        </section>

    </div>
</div>

@endsection