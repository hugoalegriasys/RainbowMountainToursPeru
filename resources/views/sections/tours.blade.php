@php
  $current_tour_id = get_the_ID();

  $tours_titulo    = get_field('tours_titulo', $current_tour_id);
  $tours_parrafo_1 = get_field('tours_parrafo_1', $current_tour_id);
  $tours_parrafo_2 = get_field('tours_parrafo_2', $current_tour_id);

  $args = [
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post__not_in'   => [$current_tour_id],
    'meta_query'     => [
      [
        'key'   => '_wp_page_template',
        'value' => 'template-tour.blade.php',
      ],
    ],
  ];
  $tours_query = new WP_Query($args);
@endphp

<section class="py-20 md:py-28 bg-white border-t border-gray-200">
  <div class="max-w-7xl mx-auto px-4 md:px-6">

    <!-- Cabecera de la sección -->
    <div class="text-center max-w-3xl mx-auto mb-16 md:mb-20">
      @if($tours_titulo)
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 uppercase tracking-[0.1em]">
          {{ $tours_titulo }}
        </h2>
        <div class="w-12 h-[2px] bg-[#db5f15] mx-auto mb-8"></div>
      @endif

      <div class="text-sm md:text-base text-gray-500 font-light leading-relaxed flex flex-col gap-4">
        @if($tours_parrafo_1) <p>{{ $tours_parrafo_1 }}</p> @endif
        @if($tours_parrafo_2) <p>{{ $tours_parrafo_2 }}</p> @endif
      </div>
    </div>

    <!-- Grilla de Tours (Corregido para quitar el fondo plomo) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-gray-200">

      @if($tours_query->have_posts())
        @while($tours_query->have_posts())
          @php
            $tours_query->the_post();

            $imagen      = get_field('tour_bg') ?: get_the_post_thumbnail_url(get_the_ID(), 'large');
            $duracion    = get_field('tour_duration');

            $dificultad  = get_field('fact_4');
            $grupo       = get_field('fact_1');
            $altitud     = get_field('fact_2');

            $ubicacion   = get_field('tour_route');
            $precio      = get_field('tour_price');

            // Descripción: quitamos etiquetas HTML e imágenes y la cortamos a 15 palabras
            $descripcion = wp_trim_words(strip_tags(get_field('tour_description')), 15, '...');
          @endphp

          <!-- Tarjeta individual con bordes propios (border-r y border-b) -->
          <div class="bg-white flex flex-col group relative border-r border-b border-gray-200">

            <!-- Imagen del Tour -->
            <div class="h-[250px] overflow-hidden relative bg-black">
              @if($imagen)
                <img src="{{ $imagen }}" alt="{{ get_the_title() }}" class="w-full h-full object-cover opacity-90 group-hover:scale-105 group-hover:opacity-100 transition-all duration-700 ease-out">
              @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs uppercase tracking-widest font-bold">No Image</div>
              @endif
            </div>

            <!-- Contenido de la Tarjeta -->
            <div class="p-8 md:p-10 flex flex-col flex-grow">

              <!-- Meta superior: Duración y Dificultad -->
              <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100 pb-4 mb-6">
                <span>{{ $duracion }}</span>
                <span>{{ $dificultad }}</span>
              </div>

              <!-- Título y Ubicación -->
              <h3 class="text-lg font-bold text-gray-900 uppercase tracking-[0.1em] mb-2 leading-snug">
                {!! get_the_title() !!}
              </h3>
              <p class="text-[11px] font-bold uppercase tracking-widest text-[#db5f15] mb-6">
                {{ $ubicacion }}
              </p>

              <!-- Descripción -->
              <p class="text-sm text-gray-500 font-light leading-relaxed mb-8 flex-grow">
                {{ $descripcion }}
              </p>

              <!-- Meta inferior: Grupo y Altitud -->
              <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100 pb-4 mb-6">
                <span>{{ $grupo }}</span>
                <span>{{ $altitud }}</span>
              </div>

              <!-- Precio y Botón -->
              <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6 mt-auto">
                <div class="flex flex-col">
                  <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Starting from</span>
                  <div class="text-gray-900 mt-1">
                    <span class="text-2xl font-bold">${{ $precio }}</span>
                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest ml-1">USD</span>
                  </div>
                </div>
                
                <a href="{{ get_permalink() }}" class="w-full xl:w-auto text-center border border-[#db5f15] text-[#db5f15] group-hover:bg-[#db5f15] group-hover:text-white font-bold text-[11px] py-4 px-6 transition-colors duration-300 uppercase tracking-[0.15em]">
                  View Itinerary
                </a>
              </div>

            </div>
          </div>
        @endwhile
        @php wp_reset_postdata(); @endphp
      @else
        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white border-b border-r border-gray-200">
          <p class="text-gray-500 text-sm font-light uppercase tracking-widest">More adventures coming soon...</p>
        </div>
      @endif

    </div>
  </div>
</section>