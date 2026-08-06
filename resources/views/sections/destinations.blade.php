@php
  $home_id = get_option('page_on_front');
  $destinations = [];

  for ($i = 1; $i <= 6; $i++) {
    $destinations[] = [
      'imagen'     => get_field("dest_{$i}_imagen", $home_id),
      'titulo'     => get_field("dest_{$i}_titulo", $home_id),
      'subtitulo'  => get_field("dest_{$i}_subtitulo", $home_id),
      'enlace'     => get_field("dest_{$i}_enlace", $home_id) ?: '#',
    ];
  }
@endphp

<section class="py-20 md:py-28 bg-white border-t border-gray-200">
  
  <!-- CABECERA DE SECCIÓN -->
  <div class="max-w-4xl mx-auto text-center mb-16 px-6">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 uppercase tracking-[0.1em]">
      Suggested Peru Destinations
    </h2>
    <div class="w-12 h-[2px] bg-[#db5f15] mx-auto mb-8"></div>
    <p class="text-sm md:text-base text-gray-500 font-light leading-relaxed max-w-2xl mx-auto">
      Discover Machu Picchu and Cusco alongside the country's finest travel guides. Peru offers world-class tourist attractions...
    </p>
  </div>

  <!-- CUADRÍCULA DE DESTINOS (Burbujas en 1 fila en PC) -->
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <!-- En PC (lg) muestra 6 columnas (1 fila). En tablet (md) 3 columnas. En celular 2 columnas. -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-8">
      
      @foreach($destinations as $dest)
        <a href="{{ $dest['enlace'] }}" class="group flex flex-col items-center text-center">
          
          <!-- Contenedor Circular -->
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden mb-5 relative border border-gray-200 group-hover:border-[#db5f15] group-hover:shadow-lg transition-all duration-500">
            <!-- Imagen con zoom sutil -->
            <img src="{{ $dest['imagen'] }}" alt="{{ $dest['titulo'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
            <!-- Overlay oscuro muy suave que desaparece al pasar el mouse -->
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500"></div>
          </div>

          <!-- Contenido de Texto debajo del círculo -->
          <h3 class="text-[12px] md:text-[14px] font-bold text-gray-900 uppercase tracking-[0.1em] group-hover:text-[#db5f15] transition-colors leading-tight">
            {{ $dest['titulo'] }}
          </h3>
          <p class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-widest mt-1.5 font-light">
            {{ $dest['subtitulo'] }}
          </p>
          
        </a>
      @endforeach

    </div>
  </div>
</section>