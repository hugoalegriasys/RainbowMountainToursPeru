@php
  $home_id = get_option('page_on_front');
  // Creamos un arreglo con tus preguntas
  $faqs = [];
  for ($i = 1; $i <= 10; $i++) {
      $faqs[] = [
          'pregunta' => get_field("faq_{$i}_pregunta", $home_id),
          'respuesta' => get_field("faq_{$i}_respuesta", $home_id),
      ];
  }
@endphp

<section class="py-20 px-6 bg-[#fcfcfc]">
  <div class="max-w-[1000px] mx-auto">
    <h2 class="text-center text-[36px] font-medium text-[#1c5067] mb-12">Frequently Asked Questions</h2>

    <div class="grid md:grid-cols-2 gap-6">
      @foreach($faqs as $faq)
        @if($faq['pregunta'])
          <div x-data="{ open: false }" class="border border-[#e0e0e0] bg-white">
            <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left text-[15px] font-medium text-[#444] hover:bg-gray-50 transition">
              {{ $faq['pregunta'] }}
              <span :class="open ? 'rotate-180' : ''" class="transition-transform duration-300">▼</span>
            </button>
            <div x-show="open" x-cloak class="p-5 pt-0 text-[14px] text-[#666] leading-relaxed border-t border-[#f0f0f0]">
              {{ $faq['respuesta'] }}
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</section>