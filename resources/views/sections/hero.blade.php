@php
  $home_id = get_option('page_on_front');

  $titulo_principal = get_field('titulo_principal', $home_id);
  $descripcion_titulo_principal = get_field('descripcion_titulo_principal', $home_id);
  $texto_boton1 = get_field('texto_boton1', $home_id);
  $texto_boton2 = get_field('texto_boton2', $home_id);
  
  // Nuevo campo para el video
  $video_hero = get_field('video_hero', $home_id);
@endphp

<section class="relative min-h-screen flex items-center justify-center bg-[#333] overflow-hidden pt-[120px]">
  
  <!-- Video de Fondo -->
  @if($video_hero)
    <!-- playsinline es vital para que el video funcione en iPhones -->
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
      <source src="{{ $video_hero }}" type="video/mp4">
    </video>
  @else
    <!-- Imagen de respaldo por si el cliente olvida subir el video -->
    <img src="https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=1920&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover z-0" alt="Respaldo Salkantay">
  @endif

  <!-- Overlay oscuro para que el texto resalte -->
  <div class="absolute inset-0 bg-black/50 z-0"></div>

  <!-- Contenido principal -->
  <div class="relative z-10 max-w-[850px] px-6 pt-32 pb-12 text-center text-white flex flex-col items-center gap-6">
    
    @if($titulo_principal)
      <h1 class="font-black text-[36px] sm:text-[50px] md:text-[60px] leading-[1.1] m-0 drop-shadow-lg uppercase tracking-wide">
          {{ $titulo_principal }}
      </h1>
    @endif
    
    @if($descripcion_titulo_principal)
      <p class="font-normal text-[16px] sm:text-[18px] leading-[1.6] m-0 opacity-90 max-w-[700px]">
        {{ $descripcion_titulo_principal }}
      </p>
    @endif

    <!-- Botones -->
    <div class="flex flex-wrap items-center justify-center gap-4 mt-6">
      @if($texto_boton1)
        <a href="#" class="bg-[#db5f15] text-white font-bold text-[13px] sm:text-[14px] uppercase tracking-[1px] px-8 py-4 inline-flex items-center justify-center whitespace-nowrap transition-colors duration-200 hover:bg-[#c25411] rounded-sm shadow-lg">
          {{ $texto_boton1 }}
        </a>
      @endif
      
      @if($texto_boton2)
        <a href="#" class="bg-black/40 backdrop-blur-sm border border-white text-white font-bold text-[13px] sm:text-[14px] uppercase tracking-[1px] px-8 py-4 inline-flex items-center justify-center whitespace-nowrap transition-all duration-200 hover:bg-white hover:text-black rounded-sm shadow-lg">
         {{ $texto_boton2 }}
        </a>
      @endif
    </div>

  </div>
</section>