@php
  $home_id = get_option('page_on_front');

  // Textos de cabecera
  $tours_titulo    = get_field('tours_titulo', $home_id);
  $tours_parrafo_1 = get_field('tours_parrafo_1', $home_id);
  $tours_parrafo_2 = get_field('tours_parrafo_2', $home_id);

  // Arrays para simplificar el código en Blade y no escribir 3 veces lo mismo
  $tours = [
    [
      'imagen'      => get_field('tour_1_imagen', $home_id),
      'duracion'    => get_field('tour_1_duracion', $home_id),
      'dificultad'  => get_field('tour_1_dificultad', $home_id),
      'titulo'      => get_field('tour_1_titulo', $home_id),
      'ubicacion'   => get_field('tour_1_ubicacion', $home_id),
      'descripcion' => get_field('tour_1_descripcion', $home_id),
      'grupo'       => get_field('tour_1_grupo', $home_id),
      'altitud'     => get_field('tour_1_altitud', $home_id),
      'precio'      => get_field('tour_1_precio', $home_id),
      'enlace'      => get_field('tour_1_enlace', $home_id) ?: '#',
    ],
    [
      'imagen'      => get_field('tour_2_imagen', $home_id),
      'duracion'    => get_field('tour_2_duracion', $home_id),
      'dificultad'  => get_field('tour_2_dificultad', $home_id),
      'titulo'      => get_field('tour_2_titulo', $home_id),
      'ubicacion'   => get_field('tour_2_ubicacion', $home_id),
      'descripcion' => get_field('tour_2_descripcion', $home_id),
      'grupo'       => get_field('tour_2_grupo', $home_id),
      'altitud'     => get_field('tour_2_altitud', $home_id),
      'precio'      => get_field('tour_2_precio', $home_id),
      'enlace'      => get_field('tour_2_enlace', $home_id) ?: '#',
    ],
    [
      'imagen'      => get_field('tour_3_imagen', $home_id),
      'duracion'    => get_field('tour_3_duracion', $home_id),
      'dificultad'  => get_field('tour_3_dificultad', $home_id),
      'titulo'      => get_field('tour_3_titulo', $home_id),
      'ubicacion'   => get_field('tour_3_ubicacion', $home_id),
      'descripcion' => get_field('tour_3_descripcion', $home_id),
      'grupo'       => get_field('tour_3_grupo', $home_id),
      'altitud'     => get_field('tour_3_altitud', $home_id),
      'precio'      => get_field('tour_3_precio', $home_id),
      'enlace'      => get_field('tour_3_enlace', $home_id) ?: '#',
    ]
  ];
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
      
      @foreach($tours as $tour)
        <!-- Tarjeta individual -->
        <div class="border border-[#eaeaea] bg-white flex flex-col shadow-[0_2px_15px_rgba(0,0,0,0.03)] group">
          
          <!-- Imagen del Tour -->
          <div class="h-[240px] overflow-hidden">
            @if($tour['imagen'])
              <img src="{{ $tour['imagen'] }}" alt="{{ $tour['titulo'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            @else
              <div class="w-full h-full bg-gray-200"></div> <!-- Placeholder si no hay imagen -->
            @endif
          </div>

          <!-- Contenido de la Tarjeta -->
          <div class="p-8 flex flex-col flex-grow">
            
            <!-- Meta superior: Duración y Dificultad -->
            <div class="flex justify-between items-center text-[12px] text-[#777] border-b border-[#eaeaea] pb-4 mb-5">
              <span>{{ $tour['duracion'] }}</span>
              <span>{{ $tour['dificultad'] }}</span>
            </div>

            <!-- Título y Ubicación -->
            <h3 class="text-[19px] font-medium text-[#222] mb-2 leading-[1.3]">
              {{ $tour['titulo'] }}
            </h3>
            <p class="text-[13px] text-[#888] mb-4">
              {{ $tour['ubicacion'] }}
            </p>

            <!-- Descripción -->
            <p class="text-[14px] text-[#555] leading-[1.7] mb-6 flex-grow line-clamp-4">
              {{ $tour['descripcion'] }}
            </p>

            <!-- Meta inferior: Grupo y Altitud -->
            <div class="flex justify-between items-center text-[13px] text-[#666] border-b border-[#eaeaea] pb-5 mb-5">
              <span>{{ $tour['grupo'] }}</span>
              <span>{{ $tour['altitud'] }}</span>
            </div>

            <!-- Precio y Botón -->
            <div class="flex justify-between items-center mt-auto">
              <div class="text-[13px] text-[#666]">
                From $<span class="text-[22px] font-bold text-[#333] ml-1">{{ $tour['precio'] }}</span> <span class="text-[12px]">per person</span>
              </div>
              <a href="{{ $tour['enlace'] }}" class="bg-[#db6923] text-white font-bold text-[13px] tracking-[0.3px] px-5 py-3 transition-colors duration-200 hover:bg-[#c25a1b]">
                View Itinerary
              </a>
            </div>

          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>