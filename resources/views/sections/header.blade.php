@php
  // Aseguramos que siempre busque en la página de Inicio
  $home_id = get_option('page_on_front');

  // Contacto y Botón (Top Bar)
  $phone    = get_field('header_phone', $home_id);
  $btn_text = get_field('header_btn_text', $home_id);
  $btn_url  = get_field('header_btn_url', $home_id) ?: '#';

  // Bucle DINÁMICO para los enlaces superiores (Top Bar) SIN llaves conflictivas
  $top_links = [];
  $t = 1;
  while (get_field('top_link_' . $t . '_text', $home_id)) {
      $top_links[] = [
          'text' => get_field('top_link_' . $t . '_text', $home_id),
          'url'  => get_field('top_link_' . $t . '_url', $home_id) ?: '#'
      ];
      $t++;
  }

  // Consulta para traer TODOS los tours automáticamente para el menú
  $args_menu = [
      'post_type'      => 'page',
      'posts_per_page' => -1,
      'meta_query'     => [
          [
              'key'   => '_wp_page_template',
              'value' => 'template-tour.blade.php'
          ]
      ]
  ];
  $tours_menu_query = new WP_Query($args_menu);
@endphp

<header class="absolute top-0 left-0 w-full z-50 bg-transparent text-white">
  <div class="max-w-7xl mx-auto px-6 pt-8">

    <!-- TOP BAR Y LOGO -->
    <div class="flex flex-col md:flex-row items-center justify-between py-4 gap-4">
      
      <a href="{{ home_url('/') }}" class="flex-shrink-0 mr-10" aria-label="Salkantay Trekking home">
        <img src="{{ get_template_directory_uri() }}/public/images/logo.png" alt="Salkantay Trekking" class="h-20 w-auto block">
      </a>

      <div class="flex flex-col items-center md:items-end gap-2">
        
        @if(!empty($top_links) || function_exists('pll_the_languages'))
          <ul class="flex flex-wrap items-center justify-center text-[12px] text-white/90 divide-x divide-white/30 m-0 p-0">
            
  <!-- ENLACES DE ACF (Travel Blog, Contact, etc.) -->
  @if(!empty($top_links))
    @foreach($top_links as $loop_link)
      
      <!-- Lógica para detectar si es el enlace de Reseñas -->
      @php 
        $is_review = stripos($loop_link['text'], 'review') !== false || stripos($loop_link['text'], 'reseña') !== false; 
      @endphp

      <li class="px-3 {{ $loop->first ? 'pl-0' : '' }}">
        <a href="{{ $loop_link['url'] }}" 
           {!! $is_review ? 'target="_blank" rel="noopener noreferrer"' : '' !!} 
           class="flex items-center gap-1.5 hover:text-[#db5f15] transition-colors">
          
          <!-- Imprime el texto tal cual lo pusiste en WordPress -->
          <span>{{ $loop_link['text'] }}</span>
          
          <!-- Si detecta que es una reseña, le pone la estrellita verde -->
          @if($is_review)

          @endif

        </a>
      </li>
    @endforeach
  @endif

<!-- SELECTOR DE IDIOMAS CON BANDERAS NATIVAS DE POLYLANG -->
@if(function_exists('pll_the_languages'))
  @php $idiomas = pll_the_languages(['raw' => 1]); @endphp
  @foreach($idiomas as $idioma)
    <li class="px-2 {{ $loop->last ? 'pr-0' : '' }}">
      <a href="{{ $idioma['url'] }}" 
         class="inline-flex items-center transition-opacity hover:opacity-80 {{ $idioma['current_lang'] ? 'opacity-100' : 'opacity-60' }}"
         title="{{ $idioma['name'] }}">
         
         @if(!empty($idioma['flag']))
           <img src="{{ $idioma['flag'] }}" alt="{{ $idioma['slug'] }}" style="width: 20px; height: auto; border-radius: 2px; display: inline-block; vertical-align: middle;">
         @else
           {{ $idioma['slug'] == 'es' ? 'Español' : 'Inglés' }}
         @endif

      </a>
    </li>
  @endforeach
@endif

</ul>
        @endif

        <div class="flex items-center gap-5 mt-1 md:mt-0">
          @if($phone)
            <span class="text-[13px] text-white font-medium whitespace-nowrap">{{ $phone }}</span>
          @endif
          
          @if($btn_text)
            <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[16px] px-5 py-2.5 rounded-md leading-none whitespace-nowrap transition-colors uppercase tracking-wide cursor-pointer">
              {{ $btn_text }}
            </a>
          @endif
        </div>

      </div>
    </div>

<!-- NAVEGACIÓN PRINCIPAL -->
<nav class="max-w-7xl mx-auto mt-4">
  <ul class="flex justify-center items-center gap-12">
    
    <!-- 1. ITEM DESPLEGABLE: RAINBOW MOUNTAIN (Tu código original) -->
    <li class="relative group">
      <a href="#" class="flex items-center gap-1 text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
        @if(function_exists('pll_current_language') && pll_current_language() == 'es')
          Tours Montaña de Colores
        @else
          Rainbow Mountain Tours
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
      </a>
      
      <!-- SUBMENÚ 100% TRANSPARENTE -->
      <ul class="absolute left-0 top-full mt-0 w-[280px] bg-transparent py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
        
        @if($tours_menu_query->have_posts())
          @while($tours_menu_query->have_posts()) 
            @php $tours_menu_query->the_post(); @endphp
            <li>
              <a href="{{ get_permalink() }}" class="block px-6 py-2.5 text-[14px] text-white font-medium hover:text-[#db5f15] transition-colors leading-tight drop-shadow-md">
                {!! get_the_title() !!}
              </a>
            </li>
          @endwhile
          @php wp_reset_postdata(); @endphp
        @else
          <li>
            <span class="block px-6 py-2.5 text-[14px] text-white/70 drop-shadow-md">No tours available yet.</span>
          </li>
        @endif
        
      </ul>
    </li>

    <!-- 2. TRAVEL GUIDE / GUÍA DE VIAJE - ENLACE NATIVO POLYLANG -->
    <li>
      @php
          // 1. Buscamos la página de la guía en inglés sin importar su ID exacto
          $guide_page = get_page_by_path('rainbow-mountain-guide');
          $guide_url = '#';

          if ($guide_page) {
              $guide_id = $guide_page->ID;

              // 2. Si Polylang está activo, obtenemos la página vinculada al idioma actual automáticamente
              if (function_exists('pll_get_post')) {
                  $translated_id = pll_get_post($guide_id);
                  if ($translated_id) {
                      $guide_id = $translated_id;
                  }
              }

              // 3. Generamos el enlace definitivo
              $guide_url = get_permalink($guide_id);
          }
      @endphp

      <a href="{{ $guide_url }}" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
        @if(function_exists('pll_current_language') && pll_current_language() == 'es')
          Guía de Viaje
        @else
          Travel Guide
        @endif
      </a>
    </li>

    <!-- 3. ABOUT US -->
    <li>
      <a href="{{ home_url(function_exists('pll_current_language') && pll_current_language() == 'es' ? '/es/sobre-nosotros/' : '/about-us/') }}" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
        @if(function_exists('pll_current_language') && pll_current_language() == 'es')
          Sobre Nosotros
        @else
          About Us
        @endif
      </a>
    </li>

    <!-- 4. CONTACT US (Botón Nuevo) -->
    <li>
      <a href="{{ get_permalink(pll_get_post(411)) }}" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
  @if(function_exists('pll_current_language') && pll_current_language() == 'es')
    Contacto
  @else
    Contact Us
  @endif
</a>
    </li>

  </ul>
</nav>
    
  </div>
  
</header>
