@php
  $home_id = get_option('page_on_front');
  $quote_top  = get_field('quote_text_top', $home_id);
  $quote_bold = get_field('quote_text_bold', $home_id);
  $bg_image   = get_field('quote_image', $home_id) ?: 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=1920';
@endphp

<section class="relative py-12 md:py-16 px-6 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('{{ $bg_image }}');">
  <!-- Overlay oscuro -->
  <div class="absolute inset-0 bg-gray-900/80 z-0"></div>

  <div class="relative z-10 max-w-4xl mx-auto text-center flex flex-col items-center gap-4">
    
    @if($quote_top)
      <p class="text-xl md:text-2xl lg:text-3xl font-light italic leading-relaxed text-gray-200">
        {{ $quote_top }}
      </p>
    @endif

    @if($quote_bold)
      <h2 class="text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-white">
        {{ $quote_bold }}
      </h2>
    @endif

  </div>
</section>