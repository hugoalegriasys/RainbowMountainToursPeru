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

<section class="py-20 px-6 bg-white">
  <div class="max-w-[1200px] mx-auto">

    <!-- Cabecera de la sección -->
    <div class="text-center max-w-[900px] mx-auto mb-16">
      @if($tours_titulo)
        <h2 class="text-[32px] sm:text-[36px] font-medium text-[#1c5067] mb-6">
          {{ $tours_titulo }}
        </h2>
      @endif

      <div class="text-[15px] text-[#555] leading-[1.8] flex flex-col gap-4">
        @if($tours_parrafo_1) <p>{{ $tours_parrafo_1 }}</p> @endif
        @if($tours_parrafo_2) <p>{{ $tours_parrafo_2 }}</p> @endif
      </div>
    </div>

    <!-- Grilla de Tours -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

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

          <!-- Tarjeta individual -->
          <div class="border border-[#eaeaea] bg-white flex flex-col shadow-[0_2px_15px_rgba(0,0,0,0.03)] group">

            <!-- Imagen del Tour -->
            <div class="h-[240px] overflow-hidden">
              @if($imagen)
                <img src="{{ $imagen }}" alt="{{ get_the_title() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
              @endif
            </div>

            <!-- Contenido de la Tarjeta -->
            <div class="p-8 flex flex-col flex-grow">

              <!-- Meta superior: Duración y Dificultad -->
              <div class="flex justify-between items-center text-[12px] text-[#777] border-b border-[#eaeaea] pb-4 mb-5">
                <span>{{ $duracion }}</span>
                <span>{{ $dificultad }}</span>
              </div>

              <!-- Título y Ubicación -->
              <h3 class="text-[19px] font-medium text-[#222] mb-2 leading-[1.3]">
                {{ get_the_title() }}
              </h3>
              <p class="text-[13px] text-[#888] mb-4">
                {{ $ubicacion }}
              </p>

              <!-- Descripción -->
              <p class="text-[14px] text-[#555] leading-[1.7] mb-6 flex-grow line-clamp-4">
                {{ $descripcion }}
              </p>

              <!-- Meta inferior: Grupo y Altitud -->
              <div class="flex justify-between items-center text-[13px] text-[#666] border-b border-[#eaeaea] pb-5 mb-5">
                <span>{{ $grupo }}</span>
                <span>{{ $altitud }}</span>
              </div>

              <!-- Precio y Botón -->
              <div class="flex justify-between items-center mt-auto">
                <div class="text-[13px] text-[#666]">
                  From $<span class="text-[22px] font-bold text-[#333] ml-1">{{ $precio }}</span> <span class="text-[12px]">per person</span>
                </div>
                <a href="{{ get_permalink() }}" class="bg-[#db6923] text-white font-bold text-[13px] tracking-[0.3px] px-5 py-3 transition-colors duration-200 hover:bg-[#c25a1b]">
                  View Itinerary
                </a>
              </div>

            </div>
          </div>
        @endwhile
        @php wp_reset_postdata(); @endphp
      @else
        <div class="col-span-1 md:col-span-3 text-center py-10">
          <p class="text-gray-500 text-[15px]">More adventures coming soon...</p>
        </div>
      @endif

    </div>
  </div>
</section>
