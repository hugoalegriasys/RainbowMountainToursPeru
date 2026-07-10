@php
  // Aseguramos que siempre busque en la página de Inicio
  $home_id = get_option('page_on_front');

  // Textos de Contacto y Horarios
  $address  = get_field('footer_address', $home_id);
  $email    = get_field('footer_email', $home_id);
  $phone    = get_field('footer_phone', $home_id);
  $btn_text = get_field('footer_btn_text', $home_id);
  $btn_url  = get_field('footer_btn_url', $home_id) ?: '#';
  // Horarios de ventas (Un solo campo WYSIWYG)
  $sales_hours = get_field('footer_sales_hours', $home_id);

  // Redes Sociales
  $socials = [
      'tiktok'    => get_field('footer_tiktok', $home_id),
      'facebook'  => get_field('footer_facebook', $home_id),
      'whatsapp'  => get_field('footer_whatsapp', $home_id),
      'instagram' => get_field('footer_instagram', $home_id),
  ];

  // Bucle DINÁMICO para Destinations
  // Se ejecutará infinitamente mientras encuentre un campo 'dest_X_text'
  $destinations = [];
  $d = 1;
  while (get_field("dest_{$d}_text", $home_id)) {
      $destinations[] = [
          'text' => get_field("dest_{$d}_text", $home_id),
          'url'  => get_field("dest_{$d}_url", $home_id) ?: '#'
      ];
      $d++;
  }

  // Bucle DINÁMICO para Useful Information
  // Se ejecutará infinitamente mientras encuentre un campo 'info_X_text'
  $useful_info = [];
  $u = 1;
  while (get_field("info_{$u}_text", $home_id)) {
      $useful_info[] = [
          'text' => get_field("info_{$u}_text", $home_id),
          'url'  => get_field("info_{$u}_url", $home_id) ?: '#'
      ];
      $u++;
  }
@endphp

<footer class="bg-black text-white pt-16 pb-8 px-6 mt-auto">
  <div class="max-w-[1200px] mx-auto">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-4 mb-14 text-[13.3px]">
      
      <!-- Columna 1: Destinations -->
      <div>
        <h4 class="font-bold text-[15px] mb-6 uppercase tracking-wide text-white">Destinations</h4>
        <ul class="flex flex-col gap-3 text-gray-400">
          @foreach($destinations as $link)
            <li><a href="{{ $link['url'] }}" class="hover:text-[#db5f15] transition-colors">{{ $link['text'] }}</a></li>
          @endforeach
        </ul>
      </div>

      <!-- Columna 2: Useful Information -->
      <div>
        <h4 class="font-bold text-[15px] mb-6 uppercase tracking-wide text-white">Useful Information</h4>
        <ul class="flex flex-col gap-3 text-gray-400">
          @foreach($useful_info as $link)
            <li><a href="{{ $link['url'] }}" class="hover:text-[#db5f15] transition-colors">{{ $link['text'] }}</a></li>
          @endforeach
        </ul>
      </div>

      <!-- Columna 3: Office Hours -->
      <div class="lg:pr-4">
        <h4 class="font-bold text-[15px] mb-6 uppercase tracking-wide text-white">Office Hours (PET)</h4>
        
        @if($address)
          <p class="text-gray-400 leading-relaxed mb-5">{{ $address }}</p>
        @endif

        @if($sales_hours)
          <span class="block mb-4 font-semibold text-white">Sales Team Hours</span>
          
          <div class="flex items-start gap-3 text-gray-400">
            <!-- Icono del relojito alineado a la izquierda -->
<span class="mt-1 text-white">
  <svg xmlns="http://www.w3.org/2000/svg"
       width="20"
       height="20"
       fill="currentColor"
       viewBox="0 0 256 256">
    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/>
  </svg>
</span>
            <!-- Contenedor del Editor Visual -->
            <div class="text-[13.3px] leading-relaxed flex flex-col gap-2 [&>p>strong]:text-white [&>p>strong]:font-medium [&>p>strong]:block [&>p]:mb-3 last:[&>p]:mb-0">
              {!! $sales_hours !!}
            </div>
          </div>
        @endif
      </div>

      <!-- Columna 4: Espaciador -->
      <div class="hidden lg:block"></div>

      <!-- Columna 5: Contact Us -->
      <div>
        <h4 class="font-bold text-[15px] mb-6 uppercase tracking-wide text-white">Contact Us</h4>
        
        @if($email)
          <a href="mailto:{{ $email }}" class="block text-[#db5f15] hover:text-white transition-colors mb-4 text-[14px]">
            {{ $email }}
          </a>
        @endif

        @if($phone)
          <div class="text-gray-300 mb-6 flex items-center gap-2 text-[14px]">
            <span class="text-[16px]"></span> {{ $phone }}
          </div>
        @endif
        
        <div class="border-t border-dashed border-gray-700 my-6"></div>
        
        @if($btn_text)
          <a href="{{ $btn_url }}" class="inline-block bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[13px] py-3 px-6 rounded transition-colors uppercase tracking-wide text-center">
            {{ $btn_text }}
          </a>
        @endif
      </div>

    </div>

    <!-- Parte Inferior del Footer -->
    <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
      
      <!-- Redes Sociales Dinámicas -->
      <div class="flex gap-4 text-[18px] text-gray-400">
        @if($socials['tiktok']) <a href="{{ $socials['tiktok'] }}" class="hover:text-white transition-colors">𝕋</a> @endif
        @if($socials['facebook']) <a href="{{ $socials['facebook'] }}" class="hover:text-white transition-colors">f</a> @endif
        @if($socials['whatsapp']) <a href="{{ $socials['whatsapp'] }}" class="hover:text-white transition-colors">☎</a> @endif
        @if($socials['instagram']) <a href="{{ $socials['instagram'] }}" class="hover:text-white transition-colors">◎</a> @endif
      </div>

      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="{{ home_url('/') }}">
          <img src="{{ get_template_directory_uri() }}/public/images/logo.png" alt="Salkantay Trekking logo" class="h-[50px] w-auto grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
        </a>
      </div>

      <!-- Copyright dinámico -->
      <div class="flex flex-col xl:flex-row items-center gap-2 xl:gap-8 text-[12px] text-gray-500">
        <span>Copyright © {{ date('Y') }} Quechuas Expeditions</span>
        <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
          <a href="#" class="hover:text-[#db5f15] transition-colors">Complaints Book</a>
          <a href="#" class="hover:text-[#db5f15] transition-colors">Terms & Conditions</a>
          <a href="#" class="hover:text-[#db5f15] transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-[#db5f15] transition-colors">ESNNA Code</a>
        </div>
      </div>

      

    </div>
  </div>
</footer>