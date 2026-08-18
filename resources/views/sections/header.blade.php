@php
  $home_id = get_option('page_on_front');

  $phone    = get_field('header_phone', $home_id);
  $btn_text = get_field('header_btn_text', $home_id);
  $btn_url  = get_field('header_btn_url', $home_id) ?: '#';

  $top_links = [];
  $t = 1;
  while (get_field('top_link_' . $t . '_text', $home_id)) {
    $top_links[] = [
      'text' => get_field('top_link_' . $t . '_text', $home_id),
      'url'  => get_field('top_link_' . $t . '_url', $home_id) ?: '#',
    ];
    $t++;
  }

  // 1. Buscamos la página de la guía
  $guide_page = get_page_by_path('rainbow-mountain-guide');
  $guide_url = '#';

  if ($guide_page) {
    $guide_id = $guide_page->ID;
    if (function_exists('pll_get_post')) {
      $translated_id = pll_get_post($guide_id);
      if ($translated_id) {
        $guide_id = $translated_id;
      }
    }
    $guide_url = get_permalink($guide_id);
  }
@endphp

<header id="main-header" class="absolute top-0 left-0 w-full z-50 bg-transparent text-white transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 md:px-6 pt-4 md:pt-6 relative">

    <!-- BARRA SUPERIOR (LOGO Y ELEMENTOS) -->
    <div class="flex flex-row items-center justify-between py-2 gap-4 pb-4 md:pb-6">
      
      <!-- Logo -->
      <a href="{{ home_url('/') }}" class="flex-shrink-0 md:mr-10 relative z-50" aria-label="Salkantay Trekking home">
        <img src="{{ get_template_directory_uri() }}/public/images/logo.png" alt="Salkantay Trekking" class="h-10 md:h-14 w-auto block">
      </a>

      <!-- Botón Menú Hamburguesa (Solo Móvil) -->
      <button id="mobile-menu-btn" class="md:hidden text-white p-2 z-50 focus:outline-none hover:text-[#db5f15] transition-colors">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>

      <!-- ELEMENTOS DE ESCRITORIO (Ocultos en Móvil) -->
      <div class="hidden md:flex flex-col items-end gap-3">
        @if(!empty($top_links) || function_exists('pll_the_languages'))
          <ul class="flex flex-wrap items-center justify-center text-[10px] uppercase tracking-widest font-bold text-white/80 divide-x divide-white/20 m-0 p-0">
            <!-- ENLACES DE ACF -->
            @if(!empty($top_links))
              @foreach($top_links as $loop_link)
                @php $is_review = stripos($loop_link['text'], 'review') !== false || stripos($loop_link['text'], 'reseña') !== false; @endphp
                <li class="px-4 {{ $loop->first ? 'pl-0' : '' }}">
                  <a href="{{ $loop_link['url'] }}" {!! $is_review ? 'target="_blank" rel="noopener noreferrer"' : '' !!} class="hover:text-[#db5f15] transition-colors">
                    <span>{{ $loop_link['text'] }}</span>
                  </a>
                </li>
              @endforeach
            @endif

            <!-- SELECTOR DE IDIOMAS (Polylang) -->
            @if(function_exists('pll_the_languages'))
              @php $idiomas = pll_the_languages(['raw' => 1]); @endphp
              @foreach($idiomas as $idioma)
                <li class="px-3 {{ $loop->last ? 'pr-0' : '' }}">
                  <a href="{{ $idioma['url'] }}" class="inline-flex items-center transition-opacity hover:opacity-80 {{ $idioma['current_lang'] ? 'opacity-100 ring-1 ring-white/50' : 'opacity-50' }}" title="{{ $idioma['name'] }}">
                    @if(!empty($idioma['flag']))
                      <img src="{{ $idioma['flag'] }}" alt="{{ $idioma['slug'] }}" class="w-4 h-auto block rounded-none">
                    @else
                      {{ $idioma['slug'] == 'es' ? 'ES' : 'EN' }}
                    @endif
                  </a>
                </li>
              @endforeach
            @endif
          </ul>
        @endif

        <div class="flex items-center gap-6 mt-1">
          @if($phone)
            <span class="text-[12px] text-white font-bold tracking-wider whitespace-nowrap">{{ $phone }}</span>
          @endif
          @if($btn_text)
            <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[11px] px-6 py-3 leading-none whitespace-nowrap transition-colors uppercase tracking-[0.15em] cursor-pointer">
              {{ $btn_text }}
            </a>
          @endif
        </div>
      </div>
    </div>

    <!-- NAVEGACIÓN PRINCIPAL DE ESCRITORIO -->
    <nav class="hidden md:block w-full mt-4">
      <ul class="flex justify-center items-center gap-10">
        
        <!-- Enlace Simple a Tours (Sin Dropdown) -->
        <li>
          <a href="{{ home_url(function_exists('pll_current_language') && pll_current_language() == 'es' ? '/es/tours-montana-de-colores/' : '/rainbow-mountain-tours/') }}" class="text-white text-[12px] uppercase tracking-[0.15em] hover:text-[#db5f15] transition-colors whitespace-nowrap font-bold py-2">
            @if(function_exists('pll_current_language') && pll_current_language() == 'es') Tours Montaña de Colores @else Rainbow Mountain Tours @endif
          </a>
        </li>

        <li>
          <a href="{{ $guide_url }}" class="text-white text-[12px] uppercase tracking-[0.15em] hover:text-[#db5f15] transition-colors whitespace-nowrap font-bold py-2">
            @if(function_exists('pll_current_language') && pll_current_language() == 'es') Guía de Viaje @else Travel Guide @endif
          </a>
        </li>
        <li>
          <a href="{{ home_url(function_exists('pll_current_language') && pll_current_language() == 'es' ? '/es/sobre-nosotros/' : '/about-us/') }}" class="text-white text-[12px] uppercase tracking-[0.15em] hover:text-[#db5f15] transition-colors whitespace-nowrap font-bold py-2">
            @if(function_exists('pll_current_language') && pll_current_language() == 'es') Sobre Nosotros @else About Us @endif
          </a>
        </li>
        <li>
          <a href="{{ get_permalink(pll_get_post(411)) }}" class="text-white text-[12px] uppercase tracking-[0.15em] hover:text-[#db5f15] transition-colors whitespace-nowrap font-bold py-2">
            @if(function_exists('pll_current_language') && pll_current_language() == 'es') Contacto @else Contact Us @endif
          </a>
        </li>
      </ul>
    </nav>

    <!-- MENÚ MÓVIL -->
    <div id="mobile-menu" class="hidden md:hidden w-full absolute top-full left-0 bg-white flex-col border-t border-gray-200 z-40 max-h-[85vh] overflow-y-auto">
      
      <nav class="flex flex-col text-gray-900 border-b border-gray-100">
        
        <!-- Enlace Simple a Tours Móvil (Sin Acordeón) -->
        <a href="{{ home_url(function_exists('pll_current_language') && pll_current_language() == 'es' ? '/es/tours-montana-de-colores/' : '/rainbow-mountain-tours/') }}" class="block px-6 py-5 border-b border-gray-100 font-bold uppercase tracking-[0.15em] text-[11px] hover:text-[#db5f15]">
          @if(function_exists('pll_current_language') && pll_current_language() == 'es') Tours Montaña de Colores @else Rainbow Mountain Tours @endif
        </a>

        <a href="{{ $guide_url }}" class="block px-6 py-5 border-b border-gray-100 font-bold uppercase tracking-[0.15em] text-[11px] hover:text-[#db5f15]">
          @if(function_exists('pll_current_language') && pll_current_language() == 'es') Guía de Viaje @else Travel Guide @endif
        </a>
        <a href="{{ home_url(function_exists('pll_current_language') && pll_current_language() == 'es' ? '/es/sobre-nosotros/' : '/about-us/') }}" class="block px-6 py-5 border-b border-gray-100 font-bold uppercase tracking-[0.15em] text-[11px] hover:text-[#db5f15]">
          @if(function_exists('pll_current_language') && pll_current_language() == 'es') Sobre Nosotros @else About Us @endif
        </a>
        <a href="{{ get_permalink(pll_get_post(411)) }}" class="block px-6 py-5 font-bold uppercase tracking-[0.15em] text-[11px] hover:text-[#db5f15]">
          @if(function_exists('pll_current_language') && pll_current_language() == 'es') Contacto @else Contact Us @endif
        </a>
      </nav>

      <!-- Extras Móvil -->
      <div class="px-6 py-8 bg-gray-50 flex flex-col gap-6">
        @if(!empty($top_links))
          <ul class="flex flex-wrap items-center gap-x-6 gap-y-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">
            @foreach($top_links as $loop_link)
              @php $is_review = stripos($loop_link['text'], 'review') !== false || stripos($loop_link['text'], 'reseña') !== false; @endphp
              <li><a href="{{ $loop_link['url'] }}" {!! $is_review ? 'target="_blank" rel="noopener noreferrer"' : '' !!} class="hover:text-[#db5f15]">{{ $loop_link['text'] }}</a></li>
            @endforeach
          </ul>
        @endif

        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
          @if(function_exists('pll_the_languages'))
            <div class="flex gap-4">
              @php $idiomas = pll_the_languages(['raw' => 1]); @endphp
              @foreach($idiomas as $idioma)
                <a href="{{ $idioma['url'] }}" class="inline-flex items-center transition-opacity {{ $idioma['current_lang'] ? 'opacity-100 ring-1 ring-gray-400 p-0.5' : 'opacity-40 hover:opacity-80' }}">
                  @if(!empty($idioma['flag']))
                    <img src="{{ $idioma['flag'] }}" alt="{{ $idioma['slug'] }}" class="w-5 h-auto rounded-none">
                  @endif
                </a>
              @endforeach
            </div>
          @endif
          @if($phone)
            <span class="text-[12px] font-bold text-gray-900 tracking-wider">{{ $phone }}</span>
          @endif
        </div>

        @if($btn_text)
          <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden'); document.getElementById('mobile-menu-btn').click();" class="block text-center bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[11px] px-6 py-4 mt-2 uppercase tracking-[0.15em]">
            {{ $btn_text }}
          </a>
        @endif
      </div>
    </div>
  </div>
</header>

<!-- SCRIPT DEL MENÚ MÓVIL (Intacto) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const header = document.getElementById('main-header');

    btn.addEventListener('click', function () {
      const isHidden = menu.classList.contains('hidden');
      
      if (isHidden) {
        // Abrir Menú: Cambiar header a color oscuro sólido y mostrar menú
        menu.classList.remove('hidden');
        menu.classList.add('flex');
        header.classList.remove('bg-transparent');
        header.classList.add('bg-[#0a0a0a]');
        // Cambiar icono a "X"
        btn.innerHTML = '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>';
      } else {
        // Cerrar Menú: Volver a fondo transparente
        menu.classList.add('hidden');
        menu.classList.remove('flex');
        header.classList.add('bg-transparent');
        header.classList.remove('bg-[#0a0a0a]');
        // Cambiar icono a Hamburguesa
        btn.innerHTML = '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
      }
    });
  });
</script>