@php
  $home_id = get_option('page_on_front');

  $titulo_principal = get_field('titulo_principal', $home_id);
  $descripcion_titulo_principal = get_field('descripcion_titulo_principal', $home_id);
  $texto_boton1 = get_field('texto_boton1', $home_id);
  $video_hero = get_field('video_hero', $home_id);
@endphp

<section class="relative h-screen min-h-[600px] flex items-center justify-center bg-[#111] overflow-hidden">
  @if($video_hero)
    <!-- playsinline es vital para que el video funcione en iPhones -->
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
      <source src="{{ $video_hero }}" type="video/mp4">
    </video>
  @else
    <!-- Imagen de respaldo por si el cliente olvida subir el video -->
    <img src="https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=1920&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover z-0" alt="Respaldo Salkantay">
  @endif

  <!-- Overlay aplanado -->
  <div class="absolute inset-0 bg-black/60 z-0"></div>

  <div class="relative z-10 max-w-5xl px-6 pt-20 text-center text-white flex flex-col items-center">
    @if($titulo_principal)
      <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold uppercase tracking-[0.15em] leading-tight mb-6">
        {{ $titulo_principal }}
      </h1>
      <!-- Línea naranja característica del diseño editorial -->
      <div class="w-16 h-[2px] bg-[#db5f15] mx-auto mb-8"></div>
    @endif

    @if($descripcion_titulo_principal)
      <p class="text-base md:text-lg lg:text-xl font-light tracking-wide leading-relaxed text-gray-200 max-w-3xl mb-12">
        {{ $descripcion_titulo_principal }}
      </p>
    @endif

    <div class="flex flex-wrap items-center justify-center gap-6 mt-4">
      @if($texto_boton1)
        <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[11px] md:text-[12px] uppercase tracking-[0.2em] px-10 py-5 transition-colors duration-300">
          {{ $texto_boton1 }}
        </a>
      @endif
    </div>
  </div>
</section>