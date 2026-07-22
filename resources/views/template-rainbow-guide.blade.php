{{--
  Template Name: Rainbow Mountain Guide
--}}

@extends('layouts.app')

@section('content')

  <!-- 1. HERO SECTION DINÁMICO CON ACF -->
  @php
    $bg_image   = get_field('hero_bg_image') ?: get_template_directory_uri() . '/public/images/rainbow-mountain-hero.jpg';
    $titulo     = get_field('hero_titulo') ?: 'Rainbow Mountain Peru Complete Travel Guide';
    $subtitle   = get_field('hero_subtitle') ?: 'Everything you need to know before visiting Rainbow Mountain, including altitude, weather, packing list, best time to visit, hiking tips, transportation, and frequently asked questions.';
    $btn_text   = get_field('hero_boton_texto') ?: 'Book a Rainbow Mountain Tour';
    $btn_link   = get_field('hero_boton_enlace');
  @endphp

  <section class="relative w-full h-[70vh] min-h-[600px] flex items-center justify-center text-center">
    
    <!-- Imagen de Fondo conectada a ACF -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ is_array($bg_image) ? $bg_image['url'] : $bg_image }}');"></div>
    
    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Contenido del Hero -->
    <div class="relative z-10 max-w-4xl px-4 mx-auto flex flex-col items-center pt-28">
      
      <!-- Título principal conectado a ACF -->
      <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 uppercase tracking-wider drop-shadow-lg">
        {!! $titulo !!}
      </h1>
      
      <!-- Subtítulo conectado a ACF -->
      <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-3xl leading-relaxed drop-shadow-md">
        {{ $subtitle }}
      </p>

      <!-- Botón de CTA (Modal o Enlace externo) -->
      <a href="{{ $btn_link ? $btn_link : 'javascript:void(0);' }}" 
         @if(!$btn_link) onclick="document.getElementById('modal-enquire').classList.remove('hidden')" @endif
         class="bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[16px] md:text-[18px] px-10 py-4 rounded-md transition-all uppercase tracking-wide shadow-xl transform hover:-translate-y-1">
        {{ $btn_text }}
      </a>
    </div>
  </section>

  <!-- ESTILOS FORZADOS PARA LA GUÍA -->
  <style>
    /* Forzar el fondo gris claro (Tailwind gray-100) en toda la página */
    body {
      background-color: #f3f4f6 !important; 
    }
    .guia-content h2 {
      color: #db5f15;
      font-size: 1.75rem;
      font-weight: 800;
      margin-top: 2.5rem;
      margin-bottom: 1rem;
      border-bottom: 2px solid #f3f4f6;
      padding-bottom: 0.5rem;
    }
    .guia-content p {
      margin-bottom: 1.25rem;
    }
    .guia-content ul {
      list-style-type: disc;
      padding-left: 1.5rem;
      margin-bottom: 1.5rem;
    }
    .guia-content li {
      margin-bottom: 0.5rem;
    }
    .guia-content strong {
      font-weight: 700;
      color: #374151;
    }
    .guia-content table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      border-radius: 0.5rem;
      overflow: hidden;
    }
    .guia-content th {
      background-color: #f9fafb;
      text-align: left;
      padding: 1rem;
      font-weight: 700;
      color: #111827;
      border-bottom: 2px solid #e5e7eb;
    }
    .guia-content td {
      padding: 1rem;
      border-bottom: 1px solid #e5e7eb;
      color: #4b5563;
    }
    .guia-content tr:hover td {
      background-color: #f9fafb;
    }
  </style>

  <!-- CONTENEDOR PRINCIPAL DE LA GUÍA -->
  <main class="max-w-6xl mx-auto px-8 md:px-16 py-12 bg-white shadow-2xl rounded-2xl relative z-20 mt-12 mb-24 border border-gray-100">
    
    <!-- Contenido dinámico del editor de WordPress -->
    <div class="guia-content text-gray-700 leading-relaxed text-[17px]">
      @while(have_posts()) 
        @php 
          the_post();
          the_content(); 
        @endphp
      @endwhile
    </div>

  </main>

@endsection