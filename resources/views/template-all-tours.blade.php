{{--
  Template Name: Plantilla - Todos los Tours
--}}

@extends('layouts.app')

@section('content')

@php
  // Detectar idioma
  $is_es = (function_exists('pll_current_language') && pll_current_language() == 'es');

  // Campos ACF para el Hero
  $hero_bg       = get_field('hero_bg_image') ?: 'https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=1920&auto=format&fit=crop';
  $hero_title    = get_field('hero_titulo') ?: ($is_es ? 'Tours Montaña de Colores' : 'Rainbow Mountain Tours');
  $hero_subtitle = get_field('hero_subtitle') ?: ($is_es ? 'Descubre nuestra selección de aventuras.' : 'Discover our selection of adventures.');

  // Campos ACF para la Introducción
  $intro_title   = get_field('intro_title');
  $intro_img_acf = get_field('intro_image');
  $intro_image   = is_array($intro_img_acf) ? $intro_img_acf['url'] : $intro_img_acf; // A prueba de balas
  $intro_text    = get_field('intro_text');

  // Campos ACF para el Encabezado de la Cuadrícula
  $grid_title    = get_field('grid_title');
  $grid_subtitle = get_field('grid_subtitle');

  // Consulta para traer TODOS los tours (que usan la plantilla template-tour)
  // Consulta para traer TODOS los tours (desde el nuevo CPT)
  $args_tours = [
    'post_type'      => 'tour', // Cambiamos 'page' por 'tour'
    'posts_per_page' => -1,
    'orderby'        => 'menu_order', 
    'order'          => 'ASC',
    // Ya no necesitamos el meta_query de la plantilla porque todos los post_type 'tour' son tours
  ];
  $tours_query = new WP_Query($args_tours);
@endphp

<!-- HERO SECTION -->
<section class="relative w-full h-[70vh] min-h-[500px] md:min-h-[600px] flex flex-col items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ $hero_bg }}" alt="Rainbow Mountain Tours">
    </div>
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-5xl px-6 mx-auto flex flex-col items-center justify-center mt-16 md:mt-20">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold uppercase tracking-[0.1em] text-white leading-tight mb-6">
            {{ $hero_title }}
        </h1>
        <p class="text-base md:text-lg lg:text-xl font-light tracking-wide leading-relaxed text-gray-200 max-w-3xl mx-auto">
            {{ $hero_subtitle }}
        </p>
    </div>
</section>

<!-- INTRO SECTION (Nueva) -->
@if($intro_title || $intro_text)
<section class="w-full py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row gap-10 lg:gap-16 items-center">
            
            <!-- Columna Imagen -->
            @if($intro_image)
            <div class="w-full md:w-1/2">
                <img src="{{ $intro_image }}" alt="{{ $intro_title }}" class="w-full h-auto rounded-lg shadow-xl object-cover">
            </div>
            @endif

            <!-- Columna Texto -->
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                @if($intro_title)
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                    {{ $intro_title }}
                </h2>
                @endif
                
                @if($intro_text)
                <!-- Usamos space-y-4 para que los párrafos del WYSIWYG tengan separación natural -->
                <div class="text-gray-600 font-light leading-relaxed space-y-4 text-[15px] md:text-base">
                    {!! $intro_text !!}
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endif

<!-- TOURS GRID SECTION -->
<div class="bg-gray-50 w-full py-16 md:py-24 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- ENCABEZADO DE LA CUADRÍCULA (Nuevo) -->
        @if($grid_title || $grid_subtitle)
        <div class="text-center max-w-4xl mx-auto mb-12 md:mb-16">
            @if($grid_title)
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                {{ $grid_title }}
            </h2>
            @endif
            @if($grid_subtitle)
            <p class="text-gray-500 font-light text-base md:text-lg">
                {{ $grid_subtitle }}
            </p>
            @endif
        </div>
        @endif

        <!-- Cuadrícula de Tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @if($tours_query->have_posts())
                @while($tours_query->have_posts()) @php $tours_query->the_post(); @endphp
                    
                    @php
                        // Obtenemos TODOS los datos necesarios para la tarjeta avanzada
                        $tour_id       = get_the_ID();
                        
                        // Lógica a prueba de balas para la imagen
                        $tour_img_acf  = get_field('tour_bg', $tour_id);
                        $tour_img      = is_array($tour_img_acf) ? $tour_img_acf['url'] : $tour_img_acf;
                        if (!$tour_img) {
                            $tour_img = get_the_post_thumbnail_url($tour_id, 'large');
                        }

                        $tour_duration = get_field('tour_duration', $tour_id) ?: '1 Day';
                        $tour_diff     = get_field('fact_4', $tour_id) ?: 'Moderate';
                        $tour_acc      = get_field('fact_1', $tour_id) ?: 'N/A';
                        $tour_group    = get_field('fact_2', $tour_id) ?: 'Group Service';
                        $tour_price    = get_field('tour_price', $tour_id) ?: '0.00';
                        $tour_route    = get_field('tour_route', $tour_id);
                        
                        // Extraemos un resumen de la descripción (quitamos HTML y cortamos a 18 palabras)
                        $tour_desc_raw = get_field('tour_description', $tour_id);
                        $tour_desc     = wp_trim_words(strip_tags($tour_desc_raw), 18, '...');
                    @endphp

                    <!-- TARJETA DEL TOUR (Estilo Ficha Técnica) -->
                    <div class="bg-white border border-gray-200 group flex flex-col hover:shadow-xl transition-shadow duration-500 h-full relative">
                        
                        <!-- 1. Contenedor de Imagen -->
                        <div class="relative h-56 bg-gray-100 overflow-hidden flex-shrink-0">
                            @if($tour_img)
                                <a href="{{ get_permalink() }}">
                                    <img src="{{ $tour_img }}" alt="{!! get_the_title() !!}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </a>
                            @else
                                <div class="flex items-center justify-center w-full h-full text-gray-400 text-[11px] uppercase tracking-widest font-bold">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- 2. Contenido Principal -->
                        <div class="p-6 md:p-8 flex flex-col flex-grow">
                            
                            <!-- Metadatos Superiores (Duración y Dificultad) -->
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-4 text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                                <span>{{ $tour_duration }}</span>
                                <span>{{ $tour_diff }}</span>
                            </div>

                            <!-- Título -->
                            <h3 class="text-xl font-extrabold text-gray-900 uppercase leading-snug mb-2 group-hover:text-[#db5f15] transition-colors duration-300">
                                <a href="{{ get_permalink() }}">
                                    {!! get_the_title() !!}
                                </a>
                            </h3>

                            <!-- Ruta -->
                            @if($tour_route)
                                <div class="text-[10px] font-bold text-[#db5f15] uppercase tracking-widest mb-4">
                                    {{ $tour_route }}
                                </div>
                            @endif

                            <!-- Descripción Corta -->
                            <div class="text-[13px] text-gray-500 leading-relaxed font-light mb-6 flex-grow">
                                {{ $tour_desc }}
                            </div>

                            <!-- Metadatos Inferiores (Alojamiento y Grupo) -->
                            <div class="flex justify-between items-center border-t border-gray-100 pt-4 mt-auto text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                                <span>{{ $tour_acc }}</span>
                                <span>{{ $tour_group }}</span>
                            </div>
                        </div>

                        <!-- 3. Footer de la Tarjeta (Precio y Botón) -->
                        <div class="px-6 md:px-8 pb-6 md:pb-8 flex justify-between items-end mt-auto">
                            <!-- Bloque de Precio -->
                            <div class="flex flex-col">
                                <span class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mb-1">
                                    {{ $is_es ? 'Desde' : 'Starting From' }}
                                </span>
                                <div class="text-gray-900">
                                    <span class="text-2xl font-extrabold">${{ $tour_price }}</span> 
                                    <span class="text-[11px] font-bold uppercase tracking-widest text-gray-500">USD</span>
                                </div>
                            </div>

                            <!-- Botón delineado -->
                            <a href="{{ get_permalink() }}" class="border border-[#db5f15] text-[#db5f15] hover:bg-[#db5f15] hover:text-white transition-colors duration-300 px-4 py-2 text-[10px] font-bold uppercase tracking-widest">
                                {{ $is_es ? 'Ver Itinerario' : 'View Itinerary' }}
                            </a>
                        </div>

                    </div>

                @endwhile
                @php wp_reset_postdata(); @endphp
            @else
                <!-- Mensaje cuando no hay tours -->
                <div class="col-span-full text-center py-20 text-gray-500 font-light">
                    {{ $is_es ? 'Actualmente no hay tours disponibles.' : 'No tours available currently.' }}
                </div>
            @endif

        </div>
    </div>
</div>

@endsection