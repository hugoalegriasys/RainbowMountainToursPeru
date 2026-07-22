{{--
  Template Name: Contact Us
--}}

@extends('layouts.app')

@section('content')

  @php
    // Detectar si el idioma actual de Polylang es español
    $is_es = function_exists('pll_current_language') && pll_current_language() == 'es';

    // Obtener campos de ACF con textos adaptados por defecto
    $hero_img      = get_field('contacto_hero_imagen') ?: get_template_directory_uri() . '/public/images/rainbow-mountain-hero.jpg';
    $hero_titulo   = get_field('contacto_hero_titulo') ?: ($is_es ? 'Contáctanos' : 'Contact Us');
    $hero_sub      = get_field('contacto_hero_subtitulo') ?: ($is_es ? 'Estamos aquí para ayudarte a planificar tu aventura en Perú. Nuestro equipo local responderá todas tus consultas sobre tours, disponibilidad, precios y recomendaciones.' : 'We are here to help you plan your adventure in Peru. Our local team will answer all your questions about tours, availability, prices, and travel recommendations. Average response time: under 30 minutes during office hours.');
    
    // Datos de las 4 tarjetas
    $dir_texto     = get_field('contacto_dir_texto') ?: "265 Garcilaso Street\nOffice 7 – Historic Center\nCusco, Peru";
    $wa_num        = get_field('contacto_wa_numero') ?: '+51 953 486 045';
    $email         = get_field('contacto_email') ?: 'info@rainbowmountainperu.com';
    $horario       = get_field('contacto_horario') ?: "Monday – Friday\n9:00 am – 1:00 pm / 3:00 pm – 7:00 pm\nSaturday\n9:00 am – 1:00 pm";

    // Mapa de Google Maps (Iframe)
    $maps_iframe   = get_field('contacto_google_maps_iframe');

    // Preguntas Frecuentes (Repeater de ACF)
    $faqs          = get_field('contacto_faqs');
  @endphp

  <!-- 1. HERO SECTION -->
  <section class="relative w-full h-[60vh] min-h-[480px] flex items-center justify-center text-center">
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

    <!-- 2. INFORMACIÓN RÁPIDA (4 TARJETAS) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Tarjeta Oficina -->
      <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col justify-between">
        <div>
          <div class="text-3xl mb-3">📍</div>
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
          <div class="text-3xl mb-3">📞</div>
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
          <div class="text-3xl mb-3">✉️</div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">Email</h3>
          <a href="mailto:{{ $email }}" class="text-[#db5f15] hover:underline font-medium text-sm break-all">
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
          <div class="text-3xl mb-3">🕐</div>
          <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $is_es ? 'Horario de Oficina' : 'Office Hours' }}</h3>
          <p class="text-gray-600 text-xs whitespace-pre-line leading-relaxed">{{ $horario }}</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-green-600 font-bold uppercase tracking-wider">
          {{ $is_es ? '● Abierto ahora' : '● Open now' }}
        </div>
      </div>

    </div>

    <!-- 3. FORMULARIO DE CONTACTO & BENEFICIOS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-gray-100">
      
      <!-- Formulario (Ocupa 2 columnas) -->
      <div class="lg:col-span-2 space-y-6">
        <div>
          <h2 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $is_es ? 'Envíanos un Mensaje' : 'Send Us a Message' }}</h2>
          <p class="text-gray-600 text-sm">{{ $is_es ? 'Completa el formulario y nos pondremos en contacto contigo en menos de 30 minutos.' : 'Complete the form and we will get back to you in less than 30 minutes.' }}</p>
        </div>

        <form action="#" method="POST" class="space-y-4">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'Nombre completo *' : 'Full Name *' }}</label>
              <input type="text" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">Email *</label>
              <input type="email" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">WhatsApp / Phone *</label>
              <input type="text" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'País *' : 'Country *' }}</label>
              <input type="text" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'Fecha del tour (opcional)' : 'Tour Date (optional)' }}</label>
              <input type="date" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
            <div>
              <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'Número de viajeros' : 'Number of Travelers' }}</label>
              <input type="number" min="1" value="1" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'Tour de interés' : 'Tour of Interest' }}</label>
            <select class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none">
              <option>Classic Rainbow Mountain</option>
              <option>Rainbow + Red Valley</option>
              <option>Private Tour</option>
              <option>Ausangate Trek</option>
              <option>Humantay Lake</option>
              <option>Machu Picchu</option>
              <option>{{ $is_es ? 'Otro' : 'Other' }}</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase text-gray-700 mb-1">{{ $is_es ? 'Mensaje' : 'Message' }}</label>
            <textarea rows="4" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#db5f15] focus:outline-none" placeholder="{{ $is_es ? 'Cuéntanos tus dudas o requerimientos especiales...' : 'Tell us your questions or special requirements...' }}"></textarea>
          </div>

          <button type="submit" class="w-full bg-[#db5f15] hover:bg-[#c25411] text-white font-bold uppercase tracking-wider py-4 rounded-lg shadow-lg transition-colors text-base">
            {{ $is_es ? 'ENVIAR MI SOLICITUD' : 'SEND MY REQUEST' }}
          </button>
        </form>
      </div>

      <!-- 4. ¿Por qué reservar con nosotros? (1 Columna lateral) -->
      <div class="bg-gray-50 p-6 md:p-8 rounded-xl border border-gray-200 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">{{ $is_es ? '¿Por qué reservar con nosotros?' : 'Why Book With Us?' }}</h3>
          <ul class="space-y-4 text-sm text-gray-700">
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Operador local' : 'Local operator' }}</strong> {{ $is_es ? 'en Cusco' : 'in Cusco' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Respuesta rápida' : 'Fast response' }}</strong> {{ $is_es ? 'por WhatsApp' : 'via WhatsApp' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Guías profesionales' : 'Professional guides' }}</strong> {{ $is_es ? 'certificados' : 'certified' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Sin cargos ocultos' : 'No hidden fees' }}</strong> {{ $is_es ? 'ni comisiones sorpresas' : 'or surprise commissions' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
              <span><strong>{{ $is_es ? 'Cancelación flexible' : 'Flexible cancellation' }}</strong> {{ $is_es ? 'garantizada' : 'guaranteed' }}</span>
            </li>
            <li class="flex items-start space-x-3">
              <span class="text-green-600 font-bold">✔</span>
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

    <!-- 5. GOOGLE MAPS (EMBED REAL) -->
    <div class="bg-white p-4 rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <div class="mb-4 px-4 pt-2">
        <h3 class="text-xl font-bold text-gray-900">{{ $is_es ? 'Ubicación de nuestra Oficina' : 'Our Office Location' }}</h3>
        <p class="text-gray-500 text-sm">{{ $is_es ? 'Visítanos en el Centro Histórico de Cusco.' : 'Visit us in the Historic Center of Cusco.' }}</p>
      </div>
      <div class="w-full h-[400px] rounded-xl overflow-hidden">
        @if($maps_iframe)
          {!! $maps_iframe !!}
        @else
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3879.673898!2d-71.984!3d-13.5168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x916dd5f8c!2sC.%20Garcilaso%20265%2C%20Cusco!5e0!3m2!1ses!2spe!4v1650000000000!5m2!1ses!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        @endif
      </div>
    </div>

    <!-- 6. INFORMACIÓN ADICIONAL Y FAQ (PREGUNTAS FRECUENTES) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-gray-100">
      
      <!-- Columna Izquierda: Información de Visita -->
      <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $is_es ? 'También puedes visitarnos' : 'You Can Also Visit Us' }}</h3>
        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
          {{ $is_es ? 'Nuestras puertas están abiertas para atenderte personalmente, resolver cualquier duda sobre tu itinerario o coordinar pagos en efectivo o tarjeta directamente en agencia.' : 'Our doors are open to assist you personally, answer any questions about your itinerary, or coordinate cash or card payments directly at our agency.' }}
        </p>
        <div class="space-y-3 text-sm text-gray-700">
          <p><strong>Office Address:</strong> <br>265 Garcilaso Street, Office 7, Historic Center, Cusco, Peru</p>
          <p><strong>Phone:</strong> <br>{{ $wa_num }}</p>
          <p><strong>Email:</strong> <br>{{ $email }}</p>
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

    <!-- 7. SELLOS DE CONFIANZA -->
    <div class="bg-gray-900 text-white py-10 px-6 rounded-2xl shadow-xl flex flex-wrap items-center justify-around gap-6 text-center">
      <div class="flex flex-col items-center">
        <span class="text-2xl mb-1">⭐⭐⭐⭐⭐</span>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-300">Excellent Reviews</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="text-2xl mb-1">🔒</span>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-300">Secure Payments</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="text-2xl mb-1">🏔️</span>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-300">Local Tour Operator</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="text-2xl mb-1">👨‍💼</span>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-300">Licensed Guides</span>
      </div>
      <div class="flex flex-col items-center">
        <span class="text-2xl mb-1">💬</span>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-300">24/7 Support</span>
      </div>
    </div>

  </main>

  </div>

@endsection