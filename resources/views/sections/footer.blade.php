@php
  $home_id = get_option('page_on_front');

  $address  = get_field('footer_address', $home_id);
  $email    = get_field('footer_email', $home_id);
  $phone    = get_field('footer_phone', $home_id);
  $btn_text = get_field('footer_btn_text', $home_id);
  $btn_url  = get_field('footer_btn_url', $home_id) ?: '#';
  $sales_hours = get_field('footer_sales_hours', $home_id);

  $socials = [
    'tiktok'    => get_field('footer_tiktok', $home_id),
    'facebook'  => get_field('footer_facebook', $home_id),
    'whatsapp'  => get_field('footer_whatsapp', $home_id),
    'instagram' => get_field('footer_instagram', $home_id),
  ];

  $destinations = [];
  $d = 1;
  while (get_field("dest_{$d}_text", $home_id)) {
    $destinations[] = [
      'text' => get_field("dest_{$d}_text", $home_id),
      'url'  => get_field("dest_{$d}_url", $home_id) ?: '#',
    ];
    $d++;
  }

  $useful_info = [];
  $u = 1;
  while (get_field("info_{$u}_text", $home_id)) {
    $useful_info[] = [
      'text' => get_field("info_{$u}_text", $home_id),
      'url'  => get_field("info_{$u}_url", $home_id) ?: '#',
    ];
    $u++;
  }
@endphp

<footer class="bg-[#0a0a0a] text-white pt-20 pb-10 px-6 mt-auto">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-10 xl:gap-16 w-full">
      
      <!-- COLUMNA 1: DESTINATIONS -->
      <div class="flex flex-col">
        <h3 class="text-[11px] font-bold tracking-[0.2em] uppercase text-white mb-6 border-b border-white/10 pb-4">
          @if(function_exists('pll_current_language') && pll_current_language() == 'es') Destinos @else Destinations @endif
        </h3>

        <ul class="flex flex-col space-y-3 text-gray-400 font-light text-[13px]">
          @php
            $parent_base_id = 377;
            $parent_id = $parent_base_id;
            if (function_exists('pll_get_post')) {
              $translated_id = pll_get_post($parent_base_id);
              $parent_id = $translated_id ? $translated_id : -1;
            }

            $args = [
              'post_type'      => 'page',
              'post_parent'    => $parent_id,
              'posts_per_page' => 6,
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
              'post_status'    => 'publish',
            ];
            $tours_query = new WP_Query($args);
          @endphp

          @if($tours_query->have_posts())
            @while($tours_query->have_posts()) @php $tours_query->the_post() @endphp
              <li>
                <a href="{{ get_permalink() }}" class="hover:text-[#db5f15] transition-colors duration-300">
                  {!! get_the_title() !!}
                </a>
              </li>
            @endwhile
            @php wp_reset_postdata() @endphp
          @else
            <li><span class="text-gray-600">No destinations found.</span></li>
          @endif
        </ul>
      </div>

      <!-- COLUMNA 2: USEFUL INFORMATION -->
      <div class="flex flex-col">
        <h3 class="text-[11px] font-bold tracking-[0.2em] uppercase text-white mb-6 border-b border-white/10 pb-4">Useful Information</h3>
        <ul class="flex flex-col space-y-3 text-gray-400 font-light text-[13px]">
          <li><a href="{{ home_url('/about-us/') }}" class="hover:text-[#db5f15] transition-colors duration-300">About Us</a></li>
          <li><a href="{{ home_url('/rainbow-mountain-guide/') }}" class="hover:text-[#db5f15] transition-colors duration-300">Travel Guide</a></li>
          <li><a href="{{ home_url('/faqs/') }}" class="hover:text-[#db5f15] transition-colors duration-300">FAQ's</a></li>
          <li><a href="{{ home_url('/contact-us/') }}" class="hover:text-[#db5f15] transition-colors duration-300">Contact Us</a></li>
          <li><a href="{{ home_url('/blog/') }}" class="hover:text-[#db5f15] transition-colors duration-300">Blog</a></li>
        </ul>
      </div>

      <!-- Columna 3: Office Hours -->
      <div class="flex flex-col">
        <h3 class="text-[11px] font-bold tracking-[0.2em] uppercase text-white mb-6 border-b border-white/10 pb-4">Office Hours (PET)</h3>

        @if($address)
          <p class="text-gray-400 font-light text-[13px] leading-relaxed mb-6">{{ $address }}</p>
        @endif

        @if($sales_hours)
          <span class="block mb-4 font-bold text-white text-[12px] uppercase tracking-widest">Sales Team Hours</span>

          <div class="flex items-start gap-3 text-gray-400 font-light text-[13px]">
            <span class="mt-0.5 text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"/>
              </svg>
            </span>
            <div class="leading-relaxed flex flex-col gap-2 [&>p>strong]:text-white [&>p>strong]:font-semibold [&>p>strong]:block [&>p]:mb-2 last:[&>p]:mb-0">
              {!! $sales_hours !!}
            </div>
          </div>
        @endif
      </div>

      <!-- Columna 4: Contact Us -->
      <div class="flex flex-col">
        <h3 class="text-[11px] font-bold tracking-[0.2em] uppercase text-white mb-6 border-b border-white/10 pb-4">Contact Us</h3>

        @if($email)
          <a href="mailto:{{ $email }}" class="block text-[#db5f15] hover:text-white transition-colors mb-4 text-[13px] font-medium break-all">
            {{ $email }}
          </a>
        @endif

        @if($phone)
          <div class="text-gray-300 mb-8 font-light text-[14px]">
            {{ $phone }}
          </div>
        @endif

        @if($btn_text)
          <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="block border border-[#db5f15] text-[#db5f15] hover:bg-[#db5f15] hover:text-white font-bold text-[11px] py-4 px-6 transition-colors uppercase tracking-[0.15em] text-center">
            {{ $btn_text }}
          </a>
        @endif
      </div>

    </div>

    <!-- Parte Inferior del Footer -->
    <div class="relative border-t border-white/10 mt-20 pt-8 flex flex-col lg:flex-row items-center justify-between gap-8 w-full">

      <!-- REDES SOCIALES -->
      <div class="absolute left-1/2 -translate-x-1/2 -top-[21px] bg-[#0a0a0a] border border-gray-600 rounded-full px-7 py-2.5 flex items-center gap-5 text-white z-10">
        @if(!empty($socials['facebook']))
          <a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#db5f15] transition-colors flex items-center">
            <svg class="w-[15px] h-[15px] fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
          </a>
        @endif
        @if(!empty($socials['instagram']))
          <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#db5f15] transition-colors flex items-center">
            <svg class="w-[16px] h-[16px] fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
          </a>
        @endif
        @if(!empty($socials['tiktok']))
          <a href="{{ $socials['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#db5f15] transition-colors flex items-center">
            <svg class="w-[15px] h-[15px] fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/></svg>
          </a>
        @endif
        @if(!empty($socials['whatsapp']))
          <a href="{{ $socials['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#db5f15] transition-colors flex items-center">
            <svg class="w-[16px] h-[16px] fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zM223.9 413.6c-33.6 0-66.5-9-95.2-26.1l-6.8-4-70.8 18.6 18.9-69-4.4-7c-18.7-29.7-28.6-64-28.6-99.1 0-101.4 82.5-183.9 184-183.9 49.1 0 95.3 19.1 130 53.9 34.7 34.8 53.8 81 53.8 130.2 0 101.4-82.5 183.8-184.2 183.8h-.2c0 0 0 0 0 0zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-2.1-3.6 2.1-3.2 7.3-13.6 1.4-2.8.7-5.1-.4-7-1.1-1.9-12.5-30.2-17.1-41.4-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
          </a>
        @endif
      </div>

      <!-- LADO IZQUIERDO: Logo -->
      <div class="flex-shrink-0">
        <a href="{{ home_url('/') }}">
          <img src="{{ get_template_directory_uri() }}/public/images/logo.png" alt="Salkantay Treks" class="h-10 w-auto grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
        </a>
      </div>

      <!-- CENTRO: Copyright y Enlaces Legales -->
      <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8 text-[11px] font-light text-gray-500 uppercase tracking-widest text-center">
        <span>&copy; {{ date('Y') }} Quechuas Expeditions</span>
        <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
          <a href="#" class="hover:text-[#db5f15] transition-colors">Terms & Conditions</a>
          <a href="#" class="hover:text-[#db5f15] transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-[#db5f15] transition-colors">ESNNA Code</a>
        </div>
      </div>

      <div class="hidden lg:block w-[120px]"></div>

    </div>
  </div>

  <!-- ==============================================
       MODAL ENVOLTORIO (Arreglado para centrado total)
       ============================================== -->
  <div id="modal-enquire" class="fixed inset-0 z-[9999] hidden">
    
    <!-- Contenedor flex (Controla el centrado y el fondo negro borroso) -->
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 md:p-10 transition-opacity">

      <style>
        #modal-enquire .wpcf7-form label {
          color: #4b5563 !important;
          font-weight: 700 !important;
          font-size: 0.75rem !important;
          text-transform: uppercase;
          letter-spacing: 0.05em;
          display: block;
          margin-bottom: 0.5rem;
        }

        #modal-enquire .wpcf7-form input[type="text"]:not(.wpcf7-countrytext):not(.wpcf7-phonetext),
        #modal-enquire .wpcf7-form input[type="email"],
        #modal-enquire .wpcf7-form input[type="tel"]:not(.wpcf7-phonetext),
        #modal-enquire .wpcf7-form input[type="number"],
        #modal-enquire .wpcf7-form input[type="date"],
        #modal-enquire .wpcf7-form select,
        #modal-enquire .wpcf7-form textarea {
          width: 100%;
          border: 1px solid #e5e7eb !important;
          border-radius: 0 !important;
          padding: 0.875rem 1rem !important;
          background-color: #f9fafb !important;
          color: #111827 !important;
          outline: none !important;
          box-shadow: none !important;
          font-size: 0.875rem !important;
          transition: all 0.3s ease !important;
        }

        #modal-enquire .wpcf7-form .iti,
        #modal-enquire .wpcf7-form .iti--allow-dropdown {
          width: 100% !important;
          display: block !important;
        }

        #modal-enquire .wpcf7-form .wpcf7-countrytext,
        #modal-enquire .wpcf7-form .wpcf7-phonetext {
          width: 100% !important;
          border: 1px solid #e5e7eb !important;
          border-radius: 0 !important;
          background-color: #f9fafb !important;
          color: #111827 !important;
          outline: none !important;
          box-shadow: none !important;
          font-size: 0.875rem !important;
          height: 45px !important;
          transition: border-color 0.3s ease !important;
        }

        #modal-enquire .wpcf7-form .wpcf7-countrytext { padding: 10px 14px 10px 45px !important; }
        #modal-enquire .wpcf7-form .wpcf7-phonetext { padding: 10px 14px 10px 95px !important; }

        #modal-enquire .wpcf7-form .iti--separate-dial-code .iti__flag-container {
          border-right: 1px solid #e5e7eb !important;
          background-color: #f3f4f6 !important;
          border-radius: 0 !important;
        }

        #modal-enquire .wpcf7-form input:focus,
        #modal-enquire .wpcf7-form select:focus,
        #modal-enquire .wpcf7-form textarea:focus {
          border-color: #db5f15 !important;
          background-color: #ffffff !important;
        }

        #modal-enquire .wpcf7-form input[type="submit"] {
          display: block;
          width: 100%;
          background-color: #db5f15 !important;
          color: white !important;
          font-weight: 700 !important;
          text-transform: uppercase;
          letter-spacing: 0.1em;
          padding: 1.25rem 2rem !important;
          border-radius: 0 !important;
          border: none !important;
          cursor: pointer !important;
          transition: background-color 0.3s !important;
          margin-top: 1.5rem !important;
          font-size: 0.875rem !important;
        }

        #modal-enquire .wpcf7-form input[type="submit"]:hover {
          background-color: #c25411 !important;
        }

        #modal-enquire .wpcf7-not-valid-tip {
          color: #ef4444 !important;
          font-size: 11px !important;
          margin-top: 4px !important;
          text-transform: uppercase;
          letter-spacing: 1px;
        }
        #modal-enquire .wpcf7-response-output {
          border-radius: 0 !important;
          font-size: 13px !important;
          margin-top: 15px !important;
          border: 1px solid #e5e7eb !important;
        }
      </style>

      <!-- CAJA DEL MODAL -->
      <div class="bg-white w-full max-w-5xl flex flex-col md:flex-row overflow-hidden relative max-h-[95vh] border border-gray-200 shadow-none rounded-none">

        <!-- Botón Cerrar (X) -> Solo tiene que añadir la clase "hidden" -->
        <button onclick="document.getElementById('modal-enquire').classList.add('hidden');" class="absolute top-4 right-4 text-gray-400 hover:text-[#db5f15] z-50 transition-colors bg-white/80 md:bg-transparent p-1 rounded-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <!-- COLUMNA IZQUIERDA -->
        <div class="hidden md:flex md:w-5/12 bg-cover bg-center relative p-12 flex-col justify-center items-center text-center" style="background-image: url('{{ get_template_directory_uri() }}/public/images/bg-modal.jpg');">
          <div class="absolute inset-0 bg-gray-900/80"></div>

          <div class="relative z-10 text-white">
            <h3 class="text-3xl font-bold text-white mb-4 tracking-wide uppercase">
              Contact <span class="text-[#db5f15]">Us</span>
            </h3>
            <div class="w-10 h-[2px] bg-[#db5f15] mx-auto mb-8"></div>
            <p class="text-[14px] leading-relaxed text-gray-300 font-light">
              Let us arrange everything for you properly. Contact us, and one of our travel specialists will provide you with everything you need to make this an unforgettable experience.
            </p>
          </div>
        </div>

        <!-- COLUMNA DERECHA (Formulario) -->
        <div class="w-full md:w-7/12 p-8 md:p-12 overflow-y-auto custom-scrollbar bg-white">
          <h2 class="text-xl text-gray-900 font-bold uppercase tracking-[0.1em] mb-8 border-b border-gray-100 pb-4">Enquire Now</h2>

          @if(function_exists('pll_current_language') && pll_current_language() == 'es')
            {!! do_shortcode('[contact-form-7 id="ec79ba0" title="Modal Enquire - Español"]') !!}
          @else
            {!! do_shortcode('[contact-form-7 id="1b3221b" title="Enquire Now - English"]') !!}
          @endif

        </div>
      </div>
    </div>
  </div>
</footer>