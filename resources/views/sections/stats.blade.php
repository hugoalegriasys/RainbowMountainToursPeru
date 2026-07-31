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

<section class="bg-[#f8f8f8] py-14 px-6 border-y border-[#eaeaea]">
  <div class="max-w-[1200px] mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      @foreach($stats as $stat)
        <div class="flex flex-col items-center justify-center">
          <span class="text-[36px] sm:text-[44px] font-bold text-[#db6923] leading-none mb-2">
            {{ $stat['numero'] ?: '0' }}
          </span>
          <span class="text-[13px] sm:text-[15px] text-[#555] uppercase tracking-wide">
            {{ $stat['texto'] ?: 'DATA PENDING' }}
          </span>
        </div>
      @endforeach
    </div>
  </div>
</section>
