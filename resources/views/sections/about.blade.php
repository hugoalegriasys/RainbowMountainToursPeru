@php
  $home_id = get_option('page_on_front');

  $about_titulo    = get_field('about_titulo', $home_id);
  $about_parrafo_1 = get_field('about_parrafo_1', $home_id);
  $about_parrafo_2 = get_field('about_parrafo_2', $home_id);
  $about_parrafo_3 = get_field('about_parrafo_3', $home_id);

  $tarjeta_1_texto = get_field('tarjeta_1_texto', $home_id);
  $tarjeta_2_texto = get_field('tarjeta_2_texto', $home_id);
  $tarjeta_3_texto = get_field('tarjeta_3_texto', $home_id);

  $icono_1 = get_field('icono_tarjeta_1', $home_id);
  $icono_2 = get_field('icono_tarjeta_2', $home_id);
  $icono_3 = get_field('icono_tarjeta_3', $home_id);

  $award1 = get_field('award_1', $home_id);
  $award2 = get_field('award_2', $home_id);
  $award3 = get_field('award_3', $home_id);
  $award4 = get_field('award_4', $home_id);
  $award5 = get_field('award_5', $home_id);
  $award6 = get_field('award_6', $home_id);
  $award7 = get_field('award_7', $home_id);
@endphp

<section class="py-20 md:py-28 bg-white border-t border-gray-200">
  <div class="max-w-7xl mx-auto px-4 md:px-6">

    <!-- CABECERA DE SECCIÓN Y PÁRRAFOS -->
    <div class="text-center max-w-4xl mx-auto mb-16">
      @if($about_titulo)
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 uppercase tracking-[0.1em]">
          {{ $about_titulo }}
        </h2>
        <div class="w-12 h-[2px] bg-[#db5f15] mx-auto mb-8"></div>
      @endif

      <div class="text-sm md:text-base text-gray-500 font-light leading-relaxed flex flex-col gap-6">
        @if($about_parrafo_1) <p>{{ $about_parrafo_1 }}</p> @endif
        @if($about_parrafo_2) <p>{{ $about_parrafo_2 }}</p> @endif
        @if($about_parrafo_3) <p>{{ $about_parrafo_3 }}</p> @endif
      </div>
    </div>

    <!-- PREMIOS Y RECONOCIMIENTOS (Con efecto Grayscale) -->
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-14 mb-20 border-y border-gray-100 py-10">
      @if($award1) <img src="{{ $award1 }}" alt="Award 1" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award2) <img src="{{ $award2 }}" alt="Award 2" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award3) <img src="{{ $award3 }}" alt="Award 3" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award4) <img src="{{ $award4 }}" alt="Award 4" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award5) <img src="{{ $award5 }}" alt="Award 5" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award6) <img src="{{ $award6 }}" alt="Award 6" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
      @if($award7) <img src="{{ $award7 }}" alt="Award 7" class="h-12 md:h-16 w-auto object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"> @endif
    </div>

    <!-- TARJETAS INFERIORES (Cuadrícula 1px) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-gray-200 border border-gray-200">
      
      <div class="bg-white p-10 md:p-14 flex flex-col items-center text-center group">
        <div class="h-14 md:h-16 mb-8 flex items-center justify-center transform group-hover:-translate-y-2 transition-transform duration-300">
          @if($icono_1)
            <img src="{{ $icono_1 }}" alt="Icon 1" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_1_texto)
          <p class="text-sm text-gray-500 font-light leading-relaxed">
            {{ $tarjeta_1_texto }}
          </p>
        @endif
      </div>

      <div class="bg-white p-10 md:p-14 flex flex-col items-center text-center group">
        <div class="h-14 md:h-16 mb-8 flex items-center justify-center transform group-hover:-translate-y-2 transition-transform duration-300">
          @if($icono_2)
            <img src="{{ $icono_2 }}" alt="Icon 2" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_2_texto)
          <p class="text-sm text-gray-500 font-light leading-relaxed">
            {{ $tarjeta_2_texto }}
          </p>
        @endif
      </div>

      <div class="bg-white p-10 md:p-14 flex flex-col items-center text-center group">
        <div class="h-14 md:h-16 mb-8 flex items-center justify-center transform group-hover:-translate-y-2 transition-transform duration-300">
          @if($icono_3)
            <img src="{{ $icono_3 }}" alt="Icon 3" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_3_texto)
          <p class="text-sm text-gray-500 font-light leading-relaxed">
            {{ $tarjeta_3_texto }}
          </p>
        @endif
      </div>

    </div>

  </div>
</section>