@php
  $home_id = get_option('page_on_front');
  $quote_top  = get_field('quote_text_top', $home_id);
  $quote_bold = get_field('quote_text_bold', $home_id);
  $bg_image   = get_field('quote_image', $home_id) ?: 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=1920';
@endphp

<section class="relative py-24 px-6 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('{{ $bg_image }}');">
  
  <!-- Overlay oscuro para que el texto resalte -->
  <div class="absolute inset-0 bg-black/60 z-0"></div>

  <!-- Contenido -->
  <div class="relative z-10 max-w-[900px] mx-auto text-center text-white">
    @if($quote_top)
      <p class="italic text-[20px] sm:text-[24px] font-light mb-4 opacity-90">
        {{ $quote_top }}
      </p>
    @endif
    
    @if($quote_bold)
      <h2 class="text-[28px] sm:text-[40px] font-bold leading-[1.2]">
        {{ $quote_bold }}
      </h2>
    @endif
  </div>

</section>