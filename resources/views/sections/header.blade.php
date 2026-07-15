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

<header class="absolute inset-x-0 top-0 z-50 bg-transparent text-white">
  <div class="max-w-7xl mx-auto px-6 pt-8">

    <!-- TOP BAR Y LOGO -->
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

    <!-- NAVEGACIÓN PRINCIPAL -->
    <nav class="max-w-7xl mx-auto mt-4">
      <ul class="flex justify-center items-center gap-12">
        
        <!-- 1. ITEM DESPLEGABLE: RAINBOW MOUNTAIN -->
        <li class="relative group">
          <a href="#" class="flex items-center gap-1 text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
            Rainbow Mountain
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
          </a>
          
          <!-- SUBMENÚ 100% TRANSPARENTE -->
          <ul class="absolute left-0 top-full mt-0 w-[280px] bg-transparent py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 border-t-2 border-[#db5f15]">
            
            @if($tours_menu_query->have_posts())
              @while($tours_menu_query->have_posts()) 
                @php $tours_menu_query->the_post(); @endphp
                <li>
                  <!-- Quitamos el fondo al hover para que se mantenga transparente siempre -->
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

        <!-- 2. RAINBOW MOUNTAIN FAQ'S -->
        <li>
          <a href="#faqs" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
            Rainbow Mountain FAQ's
          </a>
        </li>

        <!-- 3. ABOUT US -->
        <li>
          <a href="#about" class="text-white text-[13.5px] uppercase tracking-[1px] hover:text-[#db5f15] transition-colors whitespace-nowrap font-medium py-2">
            About Us
          </a>
        </li>

      </ul>
    </nav>
    
  </div>
</header>