{{--
  Template Name: Contact Us
--}}

@extends('layouts.app')

@section('content')

  @php
    $is_es = function_exists('pll_current_language') && pll_current_language() == 'es';

    $hero_img      = get_field('contacto_hero_imagen') ?: get_template_directory_uri() . '/public/images/rainbow-mountain-hero.jpg';
    $hero_titulo   = get_field('contacto_hero_titulo') ?: ($is_es ? 'Contáctanos' : 'Contact Us');
    $hero_sub      = get_field('contacto_hero_subtitulo') ?: ($is_es ? 'Estamos aquí para ayudarte a planificar tu aventura en Perú. Nuestro equipo local responderá todas tus consultas sobre tours, disponibilidad, precios y recomendaciones.' : 'We are here to help you plan your adventure in Peru. Our local team will answer all your questions about tours, availability, prices, and travel recommendations. Average response time: under 30 minutes during office hours.');

    $dir_texto     = get_field('contacto_dir_texto') ?: "265 Garcilaso Street\nOffice 7 – Historic Center\nCusco, Peru";
    $wa_num        = get_field('contacto_wa_numero') ?: '+51 953 486 045';
    $email         = get_field('contacto_email') ?: 'info@rainbowmountainperu.com';
    $horario       = get_field('contacto_horario') ?: "Monday – Friday\n9:00 am – 1:00 pm / 3:00 pm – 7:00 pm\nSaturday\n9:00 am – 1:00 pm";

    $maps_iframe   = get_field('contacto_google_maps_iframe');
    $faqs          = get_field('contacto_faqs');
  @endphp

  <!-- HERO SECTION: Elegante, overlay sólido y tipografía espaciada -->
  <section class="relative w-full h-[70vh] min-h-[500px] flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ is_array($hero_img) ? $hero_img['url'] : $hero_img }}');"></div>
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-4xl px-4 mx-auto pt-20">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 uppercase tracking-[0.2em]">
        {{ $hero_titulo }}
      </h1>
      <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto font-light tracking-wide leading-relaxed">
        {{ $hero_sub }}
      </p>
    </div>
  </section>

  <!-- CONTENEDOR PRINCIPAL -->
  <div class="bg-white w-full py-20 relative z-20">
    <main class="max-w-7xl mx-auto px-4 space-y-24">

    <!-- INFO CARDS: Cuadrícula con bordes finos, diseño plano (sin sombras) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200 border border-gray-200">

      <!-- Tarjeta Oficina -->
      <div class="bg-white p-10 flex flex-col justify-between">
        <div>
          <div class="mb-6 text-[#db5f15]">
            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
              <path d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-sm uppercase tracking-widest mb-4">{{ $is_es ? 'Oficina' : 'Office' }}</h3>
          <p class="text-gray-500 font-light text-sm whitespace-pre-line leading-relaxed">{{ $dir_texto }}</p>
        </div>
        <div class="mt-8 pt-4 border-t border-gray-100 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
          {{ $is_es ? 'Oficina física disponible' : 'Physical office available' }}
        </div>
      </div>

      <!-- Tarjeta WhatsApp -->
      <div class="bg-white p-10 flex flex-col justify-between">
        <div>
          <div class="mb-6 text-[#db5f15]">
            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-23.1-115-65-157zM223.9 415.2c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 334.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-sm uppercase tracking-widest mb-4">WhatsApp</h3>
          <p class="text-gray-900 font-semibold text-sm mb-1">{{ $wa_num }}</p>
          <p class="text-gray-500 font-light text-xs">{{ $is_es ? 'Disponible todos los días' : 'Available every day' }}</p>
        </div>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa_num) }}" target="_blank" class="mt-8 block text-center border border-gray-300 hover:border-[#db5f15] hover:bg-[#db5f15] hover:text-white text-gray-700 text-[11px] font-bold py-3 px-4 transition-colors uppercase tracking-widest">
          {{ $is_es ? 'Chatear' : 'Chat' }}
        </a>
      </div>

      <!-- Tarjeta Email -->
      <div class="bg-white p-10 flex flex-col justify-between">
        <div>
          <div class="mb-6 text-[#db5f15]">
            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
              <path d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-sm uppercase tracking-widest mb-4">Email</h3>
          <a href="mailto:{{ $email }}" class="text-[#db5f15] hover:text-[#c25411] hover:underline font-medium text-sm tracking-tight break-all">
            {{ $email }}
          </a>
        </div>
        <div class="mt-8 pt-4 border-t border-gray-100 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
          {{ $is_es ? 'Atención rápida' : 'Fast response' }}
        </div>
      </div>

      <!-- Tarjeta Horario -->
      <div class="bg-white p-10 flex flex-col justify-between">
        <div>
          <div class="mb-6 text-[#db5f15]">
            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M528 320C528 434.9 434.9 528 320 528C205.1 528 112 434.9 112 320C112 205.1 205.1 112 320 112C434.9 112 528 205.1 528 320zM64 320C64 461.4 178.6 576 320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 text-sm uppercase tracking-widest mb-4">{{ $is_es ? 'Horario de Oficina' : 'Office Hours' }}</h3>
          <p class="text-gray-500 font-light text-sm whitespace-pre-line leading-relaxed">{{ $horario }}</p>
        </div>
        <div class="mt-8 pt-4 border-t border-gray-100 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
          {{ $is_es ? 'Lunes a Sábado' : 'Mon to Sat' }}
        </div>
      </div>

    </div>

    <!-- SECCIÓN FORMULARIO Y MOTIVOS: Cuadrícula unificada -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-px bg-gray-200 border border-gray-200">

      <!-- Columna Izquierda: Formulario (Ocupa 2 columnas) -->
      <div class="lg:col-span-2 bg-white p-8 md:p-14">
        <div class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $is_es ? 'Envíanos un Mensaje' : 'Send Us a Message' }}</h2>
          <div class="w-12 h-[2px] bg-[#db5f15] mb-4"></div>
          <p class="text-gray-500 font-light text-sm">{{ $is_es ? 'Completa el formulario y nos pondremos en contacto contigo en menos de 30 minutos.' : 'Complete the form and we will get back to you in less than 30 minutes.' }}</p>
        </div>

        <!-- Renderizado de Contact Form 7 -->
        <div>
          <style>
            /* Estilo FORZADO PLANO para el botón de CF7 */
            .btn-cf7-naranja {
              display: block; width: 100%; background-color: #db5f15; color: #ffffff !important;
              font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em;
              padding: 1.25rem 2rem; border-radius: 0; transition: background-color 0.3s ease;
              cursor: pointer; border: none; margin-top: 1.5rem; font-size: 0.875rem;
            }
            .btn-cf7-naranja:hover { background-color: #c25411; }

            /* Forzar bordes RECTOS y diseño limpio en inputs */
            .wpcf7-form input:not([type="submit"]),
            .wpcf7-form select,
            .wpcf7-form textarea {
              border: 1px solid #e5e7eb !important; border-radius: 0 !important;
              background-color: #f9fafb !important; padding-top: 0.875rem !important;
              padding-bottom: 0.875rem !important; padding-right: 1rem !important;
              outline: none !important; box-shadow: none !important; width: 100% !important;
              box-sizing: border-box !important; font-size: 0.875rem; color: #374151;
            }

            .wpcf7-form input[name="your-name"],
            .wpcf7-form input[name="your-email"],
            .wpcf7-form input[name="your-date"],
            .wpcf7-form input[name="your-travelers"],
            .wpcf7-form select,
            .wpcf7-form textarea {
              padding-left: 1rem !important;
            }

            .wpcf7-form input:not([type="submit"]):focus,
            .wpcf7-form select:focus,
            .wpcf7-form textarea:focus {
              border-color: #db5f15 !important; background-color: #ffffff !important;
            }
            
            /* Ajuste de etiquetas CF7 */
            .wpcf7-form label {
                font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;
                color: #6b7280; font-weight: 700; margin-bottom: 0.5rem; display: block;
            }
          </style>

          @if($is_es)
            {!! do_shortcode('[contact-form-7 id="be30650" title="Página Contacto - Español"]') !!}
          @else
            {!! do_shortcode('[contact-form-7 id="419" title="Contact Form EN"]') !!}
          @endif
        </div>
      </div>

      <!-- Columna Derecha: ¿Por qué reservar con nosotros? -->
      <div class="bg-gray-50 p-8 md:p-14 flex flex-col justify-between">
        <div>
          <h3 class="text-sm font-bold uppercase tracking-widest text-gray-900 mb-6 border-b border-gray-200 pb-4">{{ $is_es ? '¿Por qué reservar con nosotros?' : 'Why Book With Us?' }}</h3>
          <ul class="space-y-5 text-sm text-gray-600 font-light">
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Operador local' : 'Local operator' }}</strong> {{ $is_es ? 'en Cusco' : 'in Cusco' }}</span>
            </li>
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Respuesta rápida' : 'Fast response' }}</strong> {{ $is_es ? 'por WhatsApp' : 'via WhatsApp' }}</span>
            </li>
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Guías profesionales' : 'Professional guides' }}</strong> {{ $is_es ? 'certificados' : 'certified' }}</span>
            </li>
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Sin cargos ocultos' : 'No hidden fees' }}</strong> {{ $is_es ? 'ni comisiones' : 'or commissions' }}</span>
            </li>
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Cancelación flexible' : 'Flexible cancellation' }}</strong> {{ $is_es ? 'garantizada' : 'guaranteed' }}</span>
            </li>
            <li class="flex items-start space-x-4">
              <svg class="w-4 h-4 text-[#db5f15] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
              <span><strong class="font-bold text-gray-900">{{ $is_es ? 'Miles de viajeros' : 'Thousands of travelers' }}</strong> {{ $is_es ? 'satisfechos' : 'satisfied' }}</span>
            </li>
          </ul>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200 text-center">
          <p class="text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-4">{{ $is_es ? '¿Asistencia inmediata?' : 'Immediate assistance?' }}</p>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa_num) }}" target="_blank" class="block text-center border border-[#db5f15] text-[#db5f15] hover:bg-[#db5f15] hover:text-white text-xs font-bold py-3 px-4 transition-colors uppercase tracking-widest">
            {{ $is_es ? 'WhatsApp Directo' : 'Direct WhatsApp' }}
          </a>
        </div>
      </div>

    </div>

    <!-- MAPA -->
    <div class="border border-gray-200 bg-gray-50 p-2">
      <div class="bg-white px-8 py-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
        <div>
          <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">{{ $is_es ? 'Ubicación de nuestra Oficina' : 'Our Office Location' }}</h3>
          <p class="text-gray-500 font-light text-sm mt-1">{{ $is_es ? 'Visítanos en el Centro Histórico de Cusco.' : 'Visit us in the Historic Center of Cusco.' }}</p>
        </div>
      </div>

      <!-- Estilo forzado para el iframe del mapa SIN BORDES CURVOS -->
      <style>
        .map-wrapper iframe {
          width: 100% !important;
          height: 100% !important;
          border: none !important;
        }
      </style>

      <div class="w-full h-[450px] map-wrapper">
        @if($maps_iframe)
          {!! $maps_iframe !!}
        @else
          <!-- Mapa por defecto -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3879.673898!2d-71.984!3d-13.5168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x916dd5f8c!2sC.%20Garcilaso%20265%2C%20Cusco!5e0!3m2!1ses!2spe!4v1650000000000!5m2!1ses!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        @endif
      </div>
    </div>

    <!-- INFO EXTRA Y FAQs -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24">

      <!-- Columna Izquierda: Información de Visita -->
      <div>
        <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $is_es ? 'También puedes visitarnos' : 'You Can Also Visit Us' }}</h3>
        <div class="w-12 h-[2px] bg-[#db5f15] mb-8"></div>
        <p class="text-gray-600 font-light text-base mb-8 leading-relaxed">
          {{ $is_es ? 'Nuestras puertas están abiertas para atenderte personalmente, resolver cualquier duda sobre tu itinerario o coordinar pagos en efectivo o tarjeta directamente en agencia.' : 'Our doors are open to assist you personally, answer any questions about your itinerary, or coordinate cash or card payments directly at our agency.' }}
        </p>

        <div class="space-y-6 text-sm text-gray-600 font-light border-l border-[#db5f15] pl-6">
          <p>
            <strong class="font-bold text-gray-900 uppercase tracking-wide text-xs block mb-1">{{ $is_es ? 'Dirección de Oficina:' : 'Office Address:' }}</strong>
            265 Garcilaso Street<br>
            Office 7 – 2nd Floor<br>
            Historic Center<br>
            Cusco, Peru
          </p>

          <p>
            <strong class="font-bold text-gray-900 uppercase tracking-wide text-xs block mb-1">{{ $is_es ? 'Teléfono / WhatsApp:' : 'Phone / WhatsApp:' }}</strong>
            {{ $wa_num }}
          </p>

          <p>
            <strong class="font-bold text-gray-900 uppercase tracking-wide text-xs block mb-1">Email:</strong>
            <a href="mailto:{{ $email }}" class="text-[#db5f15] hover:text-[#c25411] hover:underline font-medium">
              {{ $email }}
            </a>
          </p>
        </div>
      </div>
      
      <!-- Columna Derecha: Preguntas Frecuentes (FAQ) -->
      <div>
        <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $is_es ? 'Preguntas Frecuentes' : 'Frequently Asked Questions' }}</h3>
        <div class="w-12 h-[2px] bg-[#db5f15] mb-8"></div>
        
        <div class="space-y-6">
          @if($faqs)
            @foreach($faqs as $faq)
              <div class="border-b border-gray-200 pb-5">
                <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $faq['pregunta'] }}</h4>
                <p class="text-gray-600 font-light text-sm leading-relaxed">{{ $faq['respuesta'] }}</p>
              </div>
            @endforeach
          @else
            <!-- Preguntas por defecto -->
            <div class="border-b border-gray-200 pb-5">
              <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $is_es ? '¿Cuánto tardan en responder?' : 'How long does it take to respond?' }}</h4>
              <p class="text-gray-600 font-light text-sm leading-relaxed">{{ $is_es ? 'Normalmente respondemos dentro de los 30 minutos durante el horario de atención.' : 'We typically respond within 30 minutes during business hours.' }}</p>
            </div>
            <div class="border-b border-gray-200 pb-5">
              <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $is_es ? '¿Puedo reservar por WhatsApp?' : 'Can I book via WhatsApp?' }}</h4>
              <p class="text-gray-600 font-light text-sm leading-relaxed">{{ $is_es ? 'Sí. Nuestro equipo está disponible para ayudarte antes, durante y después de tu viaje.' : 'Yes. Our team is available to help you before, during, and after your trip.' }}</p>
            </div>
            <div class="border-b border-gray-200 pb-5">
              <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $is_es ? '¿Ofrecen tours privados?' : 'Do you offer private tours?' }}</h4>
              <p class="text-gray-600 font-light text-sm leading-relaxed">{{ $is_es ? 'Sí. Todos nuestros tours pueden organizarse en servicio privado.' : 'Yes. All our tours can be arranged in private service.' }}</p>
            </div>
            <div class="border-b border-gray-200 pb-5">
              <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $is_es ? '¿Aceptan pagos con tarjeta?' : 'Do you accept card payments?' }}</h4>
              <p class="text-gray-600 font-light text-sm leading-relaxed">{{ $is_es ? 'Sí. Aceptamos Visa, MasterCard y otros métodos de pago seguros.' : 'Yes. We accept Visa, MasterCard, and other secure payment methods.' }}</p>
            </div>
          @endif
        </div>
      </div>

    </div>

    <!-- TRUST BADGES: Franja limpia y plana -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-px bg-gray-200 border border-gray-200">
      
      <div class="bg-white p-8 flex flex-col items-center text-center">
        <svg class="w-8 h-8 text-[#db5f15] mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
          <path d="M12 8l1.2 2.5 2.8.4-2 2 .5 2.7-2.5-1.3-2.5 1.3.5-2.7-2-2 2.8-.4L12 8z" fill="#db5f15" fill-opacity="0.1"/>
        </svg>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900 leading-tight">Excellent<br>Reviews</span>
      </div>

      <div class="bg-white p-8 flex flex-col items-center text-center">
        <svg class="w-8 h-8 text-[#db5f15] mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#db5f15" fill-opacity="0.1"/>
          <path d="m9 12 2 2 4-4"/>
        </svg>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900 leading-tight">Secure<br>Payments</span>
      </div>

      <div class="bg-white p-8 flex flex-col items-center text-center">
        <svg class="w-8 h-8 text-[#db5f15] mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="m8 3 4 8 5-5 5 15H2L8 3z" fill="#db5f15" fill-opacity="0.1"/>
          <circle cx="17" cy="5" r="2"/>
        </svg>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900 leading-tight">Local Tour<br>Operator</span>
      </div>

      <div class="bg-white p-8 flex flex-col items-center text-center">
        <svg class="w-8 h-8 text-[#db5f15] mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <rect width="16" height="20" x="4" y="2" rx="2" ry="2" fill="#db5f15" fill-opacity="0.1"/>
          <circle cx="12" cy="10" r="3"/>
          <path d="M7 17v-1.5c0-1.4 2.2-2.5 5-2.5s5 1.1 5 2.5V17"/><path d="M12 2v2"/>
        </svg>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900 leading-tight">Licensed<br>Guides</span>
      </div>

      <div class="bg-white p-8 flex flex-col items-center text-center col-span-2 lg:col-span-1">
        <svg class="w-8 h-8 text-[#db5f15] mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M3 11a9 9 0 0 1 18 0v5h-3v-5a6 6 0 0 0-12 0v5H3v-5Z" fill="#db5f15" fill-opacity="0.1"/>
          <path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/>
        </svg>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900 leading-tight">24/7<br>Support</span>
      </div>

    </div>

  </main>
</div>

@endsection