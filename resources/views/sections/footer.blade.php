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
          <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="inline-block bg-[#db5f15] hover:bg-[#c25411] text-white font-bold text-[13px] py-3 px-6 rounded transition-colors uppercase tracking-wide text-center">
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
  <!-- OVERLAY DEL MODAL (Fondo oscuro) -->
<div id="modal-enquire" class="fixed inset-0 z-[9999] hidden bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
  <style>
  /* 1. Estilo de los títulos (Labels) más suaves */
  #modal-enquire .wpcf7-form label { 
    color: #6b7280 !important; /* Gris suave */
    font-weight: 400 !important;
    font-size: 13.5px !important;
    display: block; 
    margin-bottom: 5px; 
  }
  
  /* 2. Cajas de texto amigables (Bordes claros, sin sombras duras) */
  #modal-enquire .wpcf7-form input[type="text"],
  #modal-enquire .wpcf7-form input[type="email"],
  #modal-enquire .wpcf7-form input[type="tel"],
  #modal-enquire .wpcf7-form input[type="number"],
  #modal-enquire .wpcf7-form input[type="date"],
  #modal-enquire .wpcf7-form select,
  #modal-enquire .wpcf7-form textarea {
    width: 100%;
    border: 1px solid #e5e7eb !important; /* Borde gris súper clarito */
    border-radius: 3px !important;
    padding: 10px 14px !important;
    background-color: #ffffff !important;
    color: #374151 !important;
    outline: none !important;
    box-shadow: none !important; /* Mata cualquier sombra negra por defecto */
    font-size: 14px !important;
    transition: all 0.3s ease !important;
  }
  
  /* 3. Efecto Focus (Cuando haces clic para escribir se pone naranja) */
  #modal-enquire .wpcf7-form input:focus, 
  #modal-enquire .wpcf7-form select:focus, 
  #modal-enquire .wpcf7-form textarea:focus {
    border-color: #db5f15 !important;
    box-shadow: 0 0 0 1px #db5f15 !important; 
  }
  
  /* 4. Botón de envío idéntico al de tu ejemplo */
  #modal-enquire .wpcf7-form input[type="submit"] {
    background-color: #db5f15 !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 12px 35px !important;
    border-radius: 2px !important;
    border: none !important;
    cursor: pointer !important;
    transition: background-color 0.3s !important;
    margin-top: 15px !important;
    font-size: 15px !important;
  }
  
  #modal-enquire .wpcf7-form input[type="submit"]:hover {
    background-color: #c25411 !important;
  }

  /* 5. Mensajes de error más sutiles */
  #modal-enquire .wpcf7-not-valid-tip {
    color: #ef4444 !important;
    font-size: 12px !important;
    margin-top: 4px !important;
  }
  #modal-enquire .wpcf7-response-output {
    border-radius: 3px !important;
    font-size: 14px !important;
    margin-top: 15px !important;
  }
</style>
  
  <!-- CAJA DEL MODAL -->
  <div class="bg-white rounded-lg shadow-2xl w-full max-w-5xl flex flex-col md:flex-row overflow-hidden relative max-h-[95vh]">
    
    <!-- Botón Cerrar (X) -->
    <button onclick="document.getElementById('modal-enquire').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-[#db5f15] z-50 transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <!-- COLUMNA IZQUIERDA (Imagen y Texto) -->
    <!-- Cambia la URL por tu imagen real -->
    <div class="hidden md:flex md:w-5/12 bg-cover bg-center relative p-10 flex-col justify-center items-center text-center" style="background-image: url('{{ get_template_directory_uri() }}/public/images/bg-modal.jpg');">
      <div class="absolute inset-0 bg-black/50"></div>
      
      <div class="relative z-10 text-white">
        <!-- Puedes poner un icono o logo tipo Award aquí -->
        <h3 class="text-3xl font-light text-white mb-2">
          Contact Us <span class="text-[#db5f15] font-bold block">Easily!</span>
        </h3>
        <div class="w-12 h-1 bg-[#db5f15] mx-auto mb-6"></div>
        <p class="text-[14.5px] leading-relaxed text-gray-200">
          Let us arrange everything for you properly. Contact us, and one of our travel specialists will provide you with everything you need to make this an unforgettable experience.
        </p>
      </div>
    </div>

    <!-- COLUMNA DERECHA (Formulario) -->
    <div class="w-full md:w-7/12 p-8 md:p-10 overflow-y-auto custom-scrollbar text-gray-800 bg-white">
      <h2 class="text-2xl text-[#db5f15] font-light mb-6">Enquire Now</h2>
      
      <!-- LÓGICA DE IDIOMAS PARA EL SHORTCODE -->
      @if(function_exists('pll_current_language') && pll_current_language() == 'es')
        <!-- Aquí irá el ID de tu formulario cuando lo crees en español -->
        {!! do_shortcode('[contact-form-7 id="TU_ID_ESPANOL" title="Consultar Ahora"]') !!}
      @else
        <!-- Reemplaza el "123" por el ID real que copiaste en el Paso 2 -->
        {!! do_shortcode('[contact-form-7 id="353" title="Enquire Now - English"]') !!}
      @endif
      
    </div>
  </div>
</div>
</footer>