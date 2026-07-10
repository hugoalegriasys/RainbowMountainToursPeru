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

<section class="py-20 px-6 bg-[#fcfcfc]">
  <div class="max-w-[1400px] mx-auto text-center mb-16">
    <h2 class="text-[32px] sm:text-[36px] font-medium text-[#1c5067] mb-6">Suggested Peru Destinations</h2>
    <p class="text-[15px] text-[#555] max-w-[700px] mx-auto leading-[1.7]">
      Discover Machu Picchu and Cusco alongside the country's finest travel guides. Peru offers world-class tourist attractions...
    </p>
  </div>

  <div class="max-w-[1600px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
    @foreach($destinations as $dest)
      <a href="{{ $dest['enlace'] }}" class="group relative block h-[450px] overflow-hidden bg-gray-200">
        <!-- Imagen con zoom suave al pasar el mouse -->
        <img src="{{ $dest['imagen'] }}" alt="{{ $dest['titulo'] }}" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        
        <!-- Degradado inferior para resaltar texto -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
        
        <!-- Textos -->
        <div class="absolute bottom-6 left-6 text-left">
          <h3 class="text-[20px] font-bold text-white mb-1">{{ $dest['titulo'] }}</h3>
          <p class="text-[13px] text-white/90">{{ $dest['subtitulo'] }}</p>
        </div>
      </a>
    @endforeach
  </div>
</section>