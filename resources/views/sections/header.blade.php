@php
  // Aseguramos que siempre busque en la página de Inicio
  $home_id = get_option('page_on_front');

  // Contacto y Botón
  $phone    = get_field('header_phone', $home_id);
  $btn_text = get_field('header_btn_text', $home_id);
  $btn_url  = get_field('header_btn_url', $home_id) ?: '#';

  // Bucle DINÁMICO para los enlaces superiores (Top Bar)
  $top_links = [];
  $t = 1;
  while (get_field("top_link_{$t}_text", $home_id)) {
      $top_links[] = [
          'text' => get_field("top_link_{$t}_text", $home_id),
          'url'  => get_field("top_link_{$t}_url", $home_id) ?: '#'
      ];
      $t++;
  }

  // Bucle DINÁMICO para la Navegación Principal
  $nav_links = [];
  $n = 1;
  while (get_field("nav_link_{$n}_text", $home_id)) {
      $nav_links[] = [
          'text' => get_field("nav_link_{$n}_text", $home_id),
          'url'  => get_field("nav_link_{$n}_url", $home_id) ?: '#'
      ];
      $n++;
  }
@endphp

<header class="absolute top-0 left-0 w-full z-50 bg-transparent text-white">
  <div class="max-w-7xl mx-auto px-6 pt-8">

    <div class="flex flex-col md:flex-row items-center justify-between py-4 gap-4">
      
      <a href="{{ home_url('/') }}" class="flex-shrink-0 mr-10" aria-label="Salkantay Trekking home">
        <img src="{{ get_template_directory_uri() }}/public/images/logo.png" alt="Salkantay Trekking" class="h-20 w-auto block">
      </a>

      <div class="flex flex-col items-center md:items-end gap-2">
        
        @if(!empty($top_links))
          <ul class="flex flex-wrap items-center justify-center text-[12px] text-white/90 divide-x divide-white/30 m-0 p-0">
            @foreach($top_links as $loop_link)
              <li class="px-3 {{ $loop->first ? 'first:pl-0' : '' }} {{ $loop->last ? 'last:pr-0' : '' }}">
                <a href="{{ $loop_link['url'] }}" class="hover:text-[#db5f15] transition-colors">{{ $loop_link['text'] }}</a>
              </li>
            @endforeach
          </ul>
        @endif

        <div class="flex items-center gap-5 mt-1 md:mt-0">
          @if($phone)
            <span class="text-[13px] text-white font-medium whitespace-nowrap">{{ $phone }}</span>
          @endif
          
          @if($btn_text)
            <a href="{{ $btn_url }}" class="bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[16px] px-5 py-2.5 rounded-md leading-none whitespace-nowrap transition-colors uppercase tracking-wide">
              {{ $btn_text }}
            </a>
          @endif
        </div>

      </div>
    </div>

    <nav class="max-w-7xl mx-auto mt-4">
      @if(!empty($nav_links))
        <ul class="flex justify-center gap-12">
          @foreach($nav_links as $nav)
            <li>
              <a href="{{ $nav['url'] }}" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium">
                {{ $nav['text'] }}
              </a>
            </li>
          @endforeach
        </ul>
      @endif
    </nav>
    
  </div>
</header>