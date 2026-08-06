@php
  $home_id = get_option('page_on_front');
  $faqs = [];
  for ($i = 1; $i <= 10; $i++) {
    $faqs[] = [
      'pregunta'  => get_field("faq_{$i}_pregunta", $home_id),
      'respuesta' => get_field("faq_{$i}_respuesta", $home_id),
    ];
  }
@endphp

<section id="seccion-faqs" class="py-20 md:py-28 bg-white border-t border-gray-200">
  <div class="max-w-5xl mx-auto px-4 md:px-6">
    
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900 mb-4 uppercase tracking-[0.1em]">
        Frequently Asked Questions
      </h2>
      <div class="w-12 h-[2px] bg-[#db5f15] mx-auto"></div>
    </div>

    <!-- El x-data pasa al contenedor padre para controlar todas las preguntas -->
    <div x-data="{ active: null }" class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-2">
      @foreach($faqs as $faq)
        @if($faq['pregunta'])
          <div class="border-b border-gray-200">
            <!-- Comparamos la pregunta activa con el índice actual del bucle de WordPress -->
            <button @click="active = active === {{ $loop->index }} ? null : {{ $loop->index }}" class="w-full flex justify-between items-center py-6 text-left group focus:outline-none">
              
              <span class="text-sm md:text-base font-bold text-gray-900 group-hover:text-[#db5f15] transition-colors pr-6 leading-snug">
                {{ $faq['pregunta'] }}
              </span>
              
              <span class="flex-shrink-0 transition-colors duration-300" :class="active === {{ $loop->index }} ? 'text-[#db5f15]' : 'text-gray-400 group-hover:text-[#db5f15]'">
                <svg class="w-5 h-5 transition-transform duration-300" :class="active === {{ $loop->index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
                </svg>
              </span>
              
            </button>
            
            <div x-show="active === {{ $loop->index }}" x-cloak class="pb-6 text-sm text-gray-600 font-light leading-relaxed">
              {{ $faq['respuesta'] }}
            </div>
          </div>
        @endif
      @endforeach
    </div>

  </div>
</section>