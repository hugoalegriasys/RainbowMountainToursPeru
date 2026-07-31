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

  <section class="relative w-full h-[80vh] min-h-[650px] flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ is_array($hero_img) ? $hero_img['url'] : $hero_img }}');"></div>
    <div class="absolute inset-0 bg-black/65"></div>

    <div class="relative z-10 max-w-4xl px-4 mx-auto pt-28">
      <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-wider drop-shadow-lg">
        {{ $hero_titulo }}
      </h1>
      <p class="text-base md:text-lg text-gray-200 max-w-2xl mx-auto leading-relaxed drop-shadow-md">
        {{ $hero_sub }}
      </p>
    </div>
  </section>

  <!-- CONTENEDOR PRINCIPAL -->
  <div class="bg-white w-full py-16 -mt-16 relative z-20">
    <main class="max-w-6xl mx-auto px-4 md:px-8 space-y-16">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

      <!-- Tarjeta Oficina -->
      <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col justify-between">
        <div>
          <div class="mb-3 text-[#db5f15]">
            <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
              <!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
              <path d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $is_es ? 'Oficina' : 'Office' }}</h3>
          <p class="text-gray-600 text-sm whitespace-pre-line leading-relaxed">{{ $dir_texto }}</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-gray-400 font-semibold uppercase tracking-wider">
          {{ $is_es ? 'Oficina física disponible' : 'Physical office available' }}
        </div>
      </div>

      <!-- Tarjeta WhatsApp -->
      <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col justify-between">
        <div>
          <div class="mb-3 text-[#35eb11]">
            <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free-->
              <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-23.1-115-65-157zM223.9 415.2c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 334.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">WhatsApp</h3>
          <p class="text-gray-800 font-semibold text-sm mb-1">{{ $wa_num }}</p>
          <p class="text-gray-500 text-xs">{{ $is_es ? 'Disponible todos los días' : 'Available every day' }}</p>
        </div>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa_num) }}" target="_blank" class="mt-4 inline-block text-center bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 px-4 rounded-md transition-colors shadow">
          {{ $is_es ? 'Chatear por WhatsApp' : 'Chat on WhatsApp' }}
        </a>
      </div>

      <!-- Tarjeta Email -->
      <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col justify-between">
        <div>
          <div class="mb-3 text-[#000000]">
            <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
              <path d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z"/>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">Email</h3>
          <a href="mailto:{{ $email }}" class="text-[#db5f15] hover:underline font-medium text-[13px] tracking-tight whitespace-nowrap">
            {{ $email }}
          </a>
        </div>

        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-gray-400 font-semibold uppercase tracking-wider">
          {{ $is_es ? 'Atención rápida' : 'Fast response' }}
        </div>
      </div>

      <!-- Tarjeta Horario -->
      <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col justify-between">
        <div>
          <div class="mb-3 text-[#000000]">
            <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M528 320C528 434.9 434.9 528 320 528C205.1 528 112 434.9 112 320C112 205.1 205.1 112 320 112C434.9 112 528 205.1 528 320zM64 320C64 461.4 178.6 576 320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $is_es ? 'Horario de Oficina' : 'Office Hours' }}</h3>
          <p class="text-gray-600 text-xs whitespace-pre-line leading-relaxed">{{ $horario }}</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-green-600 font-bold uppercase tracking-wider">
          {{ $is_es ? '● Abierto ahora' : '● Open now' }}
        </div>
      </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-gray-100">

      <!-- Columna Izquierda: Formulario (Ocupa 2 columnas) -->
      <div class="lg:col-span-2 space-y-6">
        <div>
          <h2 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $is_es ? 'Envíanos un Mensaje' : 'Send Us a Message' }}</h2>
          <p class="text-gray-600 text-sm">{{ $is_es ? 'Completa el formulario y nos pondremos en contacto contigo en menos de 30 minutos.' : 'Complete the form and we will get back to you in less than 30 minutes.' }}</p>
        </div>

        <!-- Renderizado de Contact Form 7 -->
        <div class="mt-4">
          <style>
            /* Estilo forzado para el botón de CF7 */
            .btn-cf7-naranja {
              display: block;
              width: 100%;
              background-color: #db5f15;
              color: #ffffff !important;
              font-weight: bold;
              text-transform: uppercase;
              letter-spacing: 0.05em;
              padding: 1rem;
              border-radius: 0.5rem;
              box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
              transition: background-color 0.3s ease;
              cursor: pointer;
              border: none;
              margin-top: 1.5rem;
            }
            .btn-cf7-naranja:hover {
              background-color: #c25411;
            }

            /* Forzar bordes y ESPACIOS (Arriba, Abajo, Derecha) en todos */
            .wpcf7-form input:not([type="submit"]),
            .wpcf7-form select,
            .wpcf7-form textarea {
              border: 1px solid #d1d5db !important;
              border-radius: 0.5rem !important;
              padding-top: 0.75rem !important;
              padding-bottom: 0.75rem !important;
              padding-right: 1rem !important;
              outline: none !important;
              box-shadow: none !important;
              width: 100% !important;
              box-sizing: border-box !important;
            }

            /* Padding izquierdo SOLO para campos normales (dejamos que el plugin controle las banderas) */
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
              border-color: #db5f15 !important;
              box-shadow: 0 0 0 2px rgba(219, 95, 21, 0.2) !important;
            }
          </style>

          @if($is_es)
            {!! do_shortcode('[contact-form-7 id="be30650" title="Página Contacto - Español"]') !!}
          @else
            {!! do_shortcode('[contact-form-7 id="419" title="Contact Form EN"]') !!}
          @endif
        </div>
      </div>

      <!-- Columna Derecha: ¿Por qué reservar con nosotros? (Ocupa 1 columna) -->
      <div class="bg-gray-50 p-6 md:p-8 rounded-xl border border-gray-200 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">{{ $is_es ? '¿Por qué reservar con nosotros?' : 'Why Book With Us?' }}</h3>
          <ul class="space-y-4 text-sm text-gray-700">
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Operador local' : 'Local operator' }}</strong> {{ $is_es ? 'en Cusco' : 'in Cusco' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Respuesta rápida' : 'Fast response' }}</strong> {{ $is_es ? 'por WhatsApp' : 'via WhatsApp' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Guías profesionales' : 'Professional guides' }}</strong> {{ $is_es ? 'certificados' : 'certified' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Sin cargos ocultos' : 'No hidden fees' }}</strong> {{ $is_es ? 'ni comisiones sorpresas' : 'or surprise commissions' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Cancelación flexible' : 'Flexible cancellation' }}</strong> {{ $is_es ? 'garantizada' : 'guaranteed' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-indigo-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Miles de viajeros' : 'Thousands of travelers' }}</strong> {{ $is_es ? 'satisfechos' : 'satisfied' }}</span>
            </li>
          </ul>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
          <p class="text-xs text-gray-500 mb-2">{{ $is_es ? '¿Necesitas asistencia inmediata?' : 'Need immediate assistance?' }}</p>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa_num) }}" target="_blank" class="inline-block text-xs font-bold text-green-700 bg-green-100 hover:bg-green-200 py-2 px-4 rounded transition-colors">
            {{ $is_es ? 'Escríbenos al WhatsApp Directo' : 'Direct WhatsApp Chat' }}
          </a>
        </div>
      </div>

    </div>

    <div class="bg-white p-4 rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <div class="mb-4 px-4 pt-2">
        <h3 class="text-xl font-bold text-gray-900">{{ $is_es ? 'Ubicación de nuestra Oficina' : 'Our Office Location' }}</h3>
        <p class="text-gray-500 text-sm">{{ $is_es ? 'Visítanos en el Centro Histórico de Cusco.' : 'Visit us in the Historic Center of Cusco.' }}</p>
      </div>

      <!-- Estilo forzado para el iframe del mapa -->
      <style>
        .map-wrapper iframe {
          width: 100% !important;
          height: 100% !important;
          border-radius: 0.75rem; /* Redondea los bordes del mapa para que encaje perfecto */
        }
      </style>

      <div class="w-full h-[400px] rounded-xl overflow-hidden map-wrapper">
        @if($maps_iframe)
          {!! $maps_iframe !!}
        @else
          <!-- Mapa por defecto -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3879.673898!2d-71.984!3d-13.5168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x916dd5f8c!2sC.%20Garcilaso%20265%2C%20Cusco!5e0!3m2!1ses!2spe!4v1650000000000!5m2!1ses!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        @endif
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-gray-100">

      <!-- Columna Izquierda: Información de Visita -->
      <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $is_es ? 'También puedes visitarnos' : 'You Can Also Visit Us' }}</h3>
        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
          {{ $is_es ? 'Nuestras puertas están abiertas para atenderte personalmente, resolver cualquier duda sobre tu itinerario o coordinar pagos en efectivo o tarjeta directamente en agencia.' : 'Our doors are open to assist you personally, answer any questions about your itinerary, or coordinate cash or card payments directly at our agency.' }}
        </p>

        <div class="space-y-4 text-sm text-gray-700">
          <p>
            <strong class="text-gray-900">{{ $is_es ? 'Dirección de Oficina:' : 'Office Address:' }}</strong> <br>
            265 Garcilaso Street<br>
            Office 7 – 2nd Floor<br>
            Historic Center<br>
            Cusco, Peru
          </p>

          <!-- Teléfono / WhatsApp desde ACF -->
          <p>
            <strong class="text-gray-900">{{ $is_es ? 'Teléfono / WhatsApp:' : 'Phone / WhatsApp:' }}</strong> <br>
            {{ $wa_num }}
          </p>

          <!-- Email desde ACF con link clickable -->
          <p>
            <strong class="text-gray-900">Email:</strong> <br>
            <a href="mailto:{{ $email }}" class="text-[#db5f15] hover:underline font-medium">
              {{ $email }}
            </a>
          </p>
        </div>
      </div>
      <!-- Columna Derecha: Preguntas Frecuentes (FAQ) -->
      <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h3>
        <div class="space-y-4">
          @if($faqs)
            @foreach($faqs as $faq)
              <div class="border-b pb-3">
                <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $faq['pregunta'] }}</h4>
                <p class="text-gray-600 text-xs leading-relaxed">{{ $faq['respuesta'] }}</p>
              </div>
            @endforeach
          @else
            <!-- Preguntas por defecto en inglés (y traducidas si está en español) -->
            <div class="border-b pb-3">
              <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $is_es ? '¿Cuánto tardan en responder?' : 'How long does it take to respond?' }}</h4>
              <p class="text-gray-600 text-xs leading-relaxed">{{ $is_es ? 'Normalmente respondemos dentro de los 30 minutos durante el horario de atención.' : 'We typically respond within 30 minutes during business hours.' }}</p>
            </div>
            <div class="border-b pb-3">
              <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $is_es ? '¿Puedo reservar por WhatsApp?' : 'Can I book via WhatsApp?' }}</h4>
              <p class="text-gray-600 text-xs leading-relaxed">{{ $is_es ? 'Sí. Nuestro equipo está disponible para ayudarte antes, durante y después de tu viaje.' : 'Yes. Our team is available to help you before, during, and after your trip.' }}</p>
            </div>
            <div class="border-b pb-3">
              <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $is_es ? '¿Ofrecen tours privados?' : 'Do you offer private tours?' }}</h4>
              <p class="text-gray-600 text-xs leading-relaxed">{{ $is_es ? 'Sí. Todos nuestros tours pueden organizarse en servicio privado.' : 'Yes. All our tours can be arranged in private service.' }}</p>
            </div>
            <div class="border-b pb-3">
              <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $is_es ? '¿Aceptan pagos con tarjeta?' : 'Do you accept card payments?' }}</h4>
              <p class="text-gray-600 text-xs leading-relaxed">{{ $is_es ? 'Sí. Aceptamos Visa, MasterCard y otros métodos de pago seguros.' : 'Yes. We accept Visa, MasterCard, and other secure payment methods.' }}</p>
            </div>
          @endif
        </div>
      </div>

    </div>

    <div class="bg-white border border-gray-100 py-10 px-6 rounded-2xl shadow-xl flex flex-wrap items-start justify-center gap-10 md:gap-14 text-center">

      <!-- Excelente Reviews (Medalla con Estrella) -->
      <div class="flex flex-col items-center w-32">
        <div class="w-16 h-16 mb-4 rounded-full bg-orange-50 flex items-center justify-center shadow-inner">
          <svg class="w-8 h-8 text-[#db5f15]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <!-- Forma exterior de medalla -->
            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
            <!-- Estrella interior con relleno suave -->
            <path d="M12 8l1.2 2.5 2.8.4-2 2 .5 2.7-2.5-1.3-2.5 1.3.5-2.7-2-2 2.8-.4L12 8z" fill="#db5f15" fill-opacity="0.15"/>
          </svg>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-gray-800 leading-tight">Excellent<br>Reviews</span>
      </div>

      <!-- Secure Payments (Escudo de Seguridad) -->
      <div class="flex flex-col items-center w-32">
        <div class="w-16 h-16 mb-4 rounded-full bg-orange-50 flex items-center justify-center shadow-inner">
          <svg class="w-8 h-8 text-[#db5f15]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <!-- Escudo con relleno suave -->
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#db5f15" fill-opacity="0.15"/>
            <!-- Check mark -->
            <path d="m9 12 2 2 4-4"/>
          </svg>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-gray-800 leading-tight">Secure<br>Payments</span>
      </div>

      <!-- Local Tour Operator (Montaña y Sol) -->
      <div class="flex flex-col items-center w-32">
        <div class="w-16 h-16 mb-4 rounded-full bg-orange-50 flex items-center justify-center shadow-inner">
          <svg class="w-8 h-8 text-[#db5f15]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <!-- Montaña con relleno suave -->
            <path d="m8 3 4 8 5-5 5 15H2L8 3z" fill="#db5f15" fill-opacity="0.15"/>
            <!-- Sol / Luna -->
            <circle cx="17" cy="5" r="2"/>
          </svg>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-gray-800 leading-tight">Local Tour<br>Operator</span>
      </div>

      <!-- Licensed Guides (Credencial de Guía) -->
      <div class="flex flex-col items-center w-32">
        <div class="w-16 h-16 mb-4 rounded-full bg-orange-50 flex items-center justify-center shadow-inner">
          <svg class="w-8 h-8 text-[#db5f15]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <!-- Tarjeta ID con relleno suave -->
            <rect width="16" height="20" x="4" y="2" rx="2" ry="2" fill="#db5f15" fill-opacity="0.15"/>
            <circle cx="12" cy="10" r="3"/>
            <path d="M7 17v-1.5c0-1.4 2.2-2.5 5-2.5s5 1.1 5 2.5V17"/>
            <path d="M12 2v2"/>
          </svg>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-gray-800 leading-tight">Licensed<br>Guides</span>
      </div>

      <div class="flex flex-col items-center w-32">
        <div class="w-16 h-16 mb-4 rounded-full bg-orange-50 flex items-center justify-center shadow-inner">
          <svg class="w-8 h-8 text-[#db5f15]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <!-- Diadema con relleno suave -->
            <path d="M3 11a9 9 0 0 1 18 0v5h-3v-5a6 6 0 0 0-12 0v5H3v-5Z" fill="#db5f15" fill-opacity="0.15"/>
            <!-- Auriculares y micro -->
            <path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/>
            <path d="M21 16v2a4 4 0 0 1-4 4h-5"/>
          </svg>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-gray-800 leading-tight">24/7<br>Support</span>
      </div>

    </div>
  </main>
  </div>

@endsection
