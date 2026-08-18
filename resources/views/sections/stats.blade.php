@php
  $home_id = get_option('page_on_front');

  $stats = [
    [
      'numero' => get_field('stat_1_numero', $home_id),
      'texto'  => get_field('stat_1_texto', $home_id),
    ],
    [
      'numero' => get_field('stat_2_numero', $home_id),
      'texto'  => get_field('stat_2_texto', $home_id),
    ],
    [
      'numero' => get_field('stat_3_numero', $home_id),
      'texto'  => get_field('stat_3_texto', $home_id),
    ],
    [
      'numero' => get_field('stat_4_numero', $home_id),
      'texto'  => get_field('stat_4_texto', $home_id),
    ]
  ];
@endphp

<section class="bg-white py-16 md:py-24 border-t border-gray-200">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    
    <!-- Cuadrícula editorial de 1px -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 border border-gray-200">
      
      @foreach($stats as $stat)
        <div class="bg-white flex flex-col items-center justify-center py-12 md:py-16 px-4 group transition-colors duration-500 hover:bg-gray-50">
          
          <!-- Número (Elegante y ligero, con el "+" en color naranja) -->
          <span class="text-4xl md:text-5xl lg:text-6xl font-light text-gray-900 mb-4 transition-colors duration-500 group-hover:text-[#db5f15] flex items-center">
            {{ $stat['numero'] ?: '0' }}
            <span class="text-[#db5f15] font-medium ml-1">+</span>
          </span>
          
          <!-- Texto descriptivo (Pequeño, espaciado y en negrita) -->
          <span class="text-[10px] md:text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center leading-relaxed">
            {{ $stat['texto'] ?: 'DATA PENDING' }}
          </span>
          
        </div>
      @endforeach

    </div>
    
  </div>
</section>