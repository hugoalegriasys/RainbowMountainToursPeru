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

<section class="py-20 px-6 bg-white">
  <div class="max-w-[1200px] mx-auto text-center">
    @if($about_titulo)
      <h2 class="text-[32px] sm:text-[36px] font-medium text-[#1c5067] mb-8">
        {{ $about_titulo }}
      </h2>
    @endif

    <div class="max-w-[1000px] mx-auto text-[15px] text-[#555] leading-[1.8] flex flex-col gap-6 mb-16">
      @if($about_parrafo_1) <p>{{ $about_parrafo_1 }}</p> @endif
      @if($about_parrafo_2) <p>{{ $about_parrafo_2 }}</p> @endif
      @if($about_parrafo_3) <p>{{ $about_parrafo_3 }}</p> @endif
    </div>

    <div class="flex flex-wrap justify-center items-center gap-6 sm:gap-10 mb-20">
      @if($award1) <img src="{{ $award_1 }}" alt="Award 1" class="h-16 w-auto object-contain"> @endif
      @if($award2) <img src="{{ $award_2 }}" alt="Award 2" class="h-16 w-auto object-contain"> @endif
      @if($award3) <img src="{{ $award_3 }}" alt="Award 3" class="h-16 w-auto object-contain"> @endif
      @if($award4) <img src="{{ $award_4 }}" alt="Award 4" class="h-16 w-auto object-contain"> @endif
      @if($award5) <img src="{{ $award_5 }}" alt="Award 5" class="h-16 w-auto object-contain"> @endif
      @if($award6) <img src="{{ $award_6 }}" alt="Award 6" class="h-16 w-auto object-contain"> @endif
      @if($award7) <img src="{{ $award_7 }}" alt="Award 7" class="h-16 w-auto object-contain"> @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="border border-[#f0f0f0] bg-white p-10 flex flex-col items-center shadow-[0_2px_15px_rgba(0,0,0,0.03)]">
        <div class="h-16 mb-6 flex items-center justify-center">
          @if($icono_1)
            <img src="{{ $icono_1 }}" alt="Icon 1" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_1_texto)
          <p class="text-[14.5px] text-[#444] leading-[1.7] font-medium">
            {{ $tarjeta_1_texto }}
          </p>
        @endif
      </div>

      <div class="border border-[#f0f0f0] bg-white p-10 flex flex-col items-center shadow-[0_2px_15px_rgba(0,0,0,0.03)]">
        <div class="h-16 mb-6 flex items-center justify-center">
          @if($icono_2)
            <img src="{{ $icono_2 }}" alt="Icon 2" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_2_texto)
          <p class="text-[14.5px] text-[#444] leading-[1.7] font-medium">
            {{ $tarjeta_2_texto }}
          </p>
        @endif
      </div>

      <div class="border border-[#f0f0f0] bg-white p-10 flex flex-col items-center shadow-[0_2px_15px_rgba(0,0,0,0.03)]">
        <div class="h-16 mb-6 flex items-center justify-center">
          @if($icono_3)
            <img src="{{ $icono_3 }}" alt="Icon 3" class="max-h-full max-w-full object-contain">
          @endif
        </div>
        @if($tarjeta_3_texto)
          <p class="text-[14.5px] text-[#444] leading-[1.7] font-medium">
            {{ $tarjeta_3_texto }}
          </p>
        @endif
      </div>
    </div>
  </div>
</section>
