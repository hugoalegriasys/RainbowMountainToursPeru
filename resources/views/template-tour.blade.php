{{--
  Template Name: Plantilla Tour
--}}

@extends('layouts.app')

@section('content')

@php
  $post_id = get_the_ID();

  // 1. Hero y Facts
  $bg          = get_field('tour_bg', $post_id) ?: 'https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=1920&auto=format&fit=crop';
  $duration    = get_field('tour_duration', $post_id);
  $title       = get_the_title();
  $fact_1      = get_field('fact_1', $post_id);
  $fact_2      = get_field('fact_2', $post_id);
  $fact_3      = get_field('fact_3', $post_id);
  $fact_4      = get_field('fact_4', $post_id);
  
  // 2. Overview y Sidebar
  $subtitle    = get_field('tour_subtitle', $post_id);
  $route       = get_field('tour_route', $post_id);
  $description = get_field('tour_description', $post_id);
  $price       = get_field('tour_price', $post_id) ?: '0';
  $distance    = get_field('tour_distance', $post_id);
  $meals       = get_field('tour_meals', $post_id);
  
  // 3. Media Cards y Galería
  $media_1     = get_field('media_video_bg', $post_id);
  $media_2     = get_field('media_brochure_bg', $post_id);
  $media_3     = get_field('media_map_bg', $post_id);

// Asegúrate de que estas variables estén declaradas en tu bloque @php
  $video_propio = get_field('video_propio', $post_id);
  $brochure_pdf = get_field('brochure_pdf', $post_id);
  $map_propio  = get_field('map_propio', $post_id);

  // Agrega estas 4 variables nuevas para la galería:
  $gallery_1   = get_field('gallery_1', $post_id);
  $gallery_2   = get_field('gallery_2', $post_id);
  $gallery_3   = get_field('gallery_3', $post_id);
  $gallery_4   = get_field('gallery_4', $post_id);

  // 4. Itinerario y Aviso
  $highlights  = get_field('tour_highlights', $post_id);
  $notice      = get_field('important_notice', $post_id);

  // Nuevos campos para las pestañas
  $inclusions   = get_field('tour_inclusions', $post_id);
  $packing_list = get_field('tour_packing_list', $post_id);
  $pricing      = get_field('tour_pricing', $post_id);

// Obtenemos el texto tal cual lo escribiste (ej: "2 Days & nigth")
  $tour_duration_text = get_field('tour_duration', $post_id);

  // Extraemos SOLO el número para el calendario usando intval()
  $tour_duration_number = intval($tour_duration_text); 
  
  // Si escribiste algo sin números (como "Full Day") o lo dejaste vacío, el calendario tomará 1 día por defecto
  if($tour_duration_number < 1) { 
      $tour_duration_number = 1; 
  }
@endphp

<style>
  :root {
    --orange: #db5f15;
    --gray-text: #888888;
    --black: #000000;
  }
  body {
    background-color: #ffffff !important;
  }
  /* Forzar permiso para que Sticky funcione */
  html, body, #app, main {
    overflow-x: clip !important;
    overflow-y: visible !important;
  }

  /* ========================================================
     BOOKING WIDGET (SIDEBAR)
     ======================================================== */
  .booking-widget {border: 1px solid #eaeaea; background: #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.05);}
  .booking-header {background: #333; color: #fff; text-align: center; padding: 18px; font-size: 22px; font-weight: 700;}
  .booking-info {padding: 24px 20px; text-align: center; }
  .booking-title { font-size: 15px; color: #555; margin-bottom: 12px; font-weight: 400; line-height: 1.4; }
  .booking-price { color: var(--orange, #e56b2e); font-size: 22px; font-weight: 700; }
  .booking-divider { border-top: 1px solid #eaeaea; border-bottom: 1px solid #eaeaea; padding: 14px; text-align: center; font-size: 11px; color: #777; text-transform: uppercase; letter-spacing: 1px; }
  .booking-body { padding: 24px 20px; }
  .booking-step { display: flex; align-items: center; font-size: 14px; color: #333; margin-bottom: 15px; }
  .step-num { background: var(--orange, #e56b2e); color: #fff; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; margin-right: 10px;}
  .step-note {color: var(--orange, #e56b2e);font-size: 12px;margin-left: 5px; }

  /* Colores y estados del Calendario */
  .cal-date {
    padding: 8px 0; /* Un poco más de espacio para que los números respiren */
    border-radius: 4px; /* Bordes ligeramente redondeados */
    transition: all 0.2s ease;
  }

  /* 1. Días pasados (Bloqueados) */
  .cal-date.disabled { 
    text-decoration: line-through; 
    color: #ccc; 
    background: transparent;
  }

  /* 2. Días disponibles (Sin seleccionar) - Gris muy suave */
  .cal-date.available { 
    background: #f4f4f4; 
    color: #444; 
  }

  /* 3. El Hover (Cuando pasas el mouse por encima) - Naranja pálido */
  .cal-date:not(.disabled):hover { 
    background: #ffe3d4; 
    color: #e56b2e; 
    font-weight: bold; 
    transform: scale(1.05); 
  }

  /* 4. Días Seleccionados (El rango elegido) - Naranja fuerte y letras blancas */
  .cal-date.active { 
    background: var(--orange, #e56b2e) !important; 
    color: #ffffff !important; 
    font-weight: bold; 
    box-shadow: 0 3px 6px rgba(229, 107, 46, 0.3); /* Una pequeña sombra para que resalte 3D */
    transform: scale(1.05); /* Efecto pop-out */
  }
  /* Diseño visual del Calendario */
  .calendar-mockup { border: 1px solid #eaeaea; padding: 15px; margin-bottom: 15px; } 
  .cal-header { display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: bold; color: #333; margin-bottom: 15px; }
  .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 5px; font-size: 12px; }
  .cal-day-name { color: var(--orange, #e56b2e); font-weight: bold; margin-bottom: 8px; }
  .cal-date { padding: 6px 0; color: #555; }
  .cal-legend {font-size: 11px; color: #555; margin-bottom: 30px; display: flex; flex-direction: column; gap: 8px;}
  .legend-item { display: flex; align-items: flex-start; gap: 8px; }
  .legend-box { width: 14px; height: 14px; flex-shrink: 0; margin-top: 1px; border: 1px solid #eee; }
  /* Selector de Pasajeros */
  .pax-selector {display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #333;}
  .pax-controls { display: flex; align-items: center; gap: 15px; }
  .pax-btn { color: var(--orange, #e56b2e); background: none; border: none; font-size: 20px; cursor: pointer; }
  .pax-input { width: 30px; text-align: center; border: none; font-size: 14px; color: #333; pointer-events: none; }
  
  /* Todo el CSS global de tu diseño original */
  .tour-header { position: relative; min-height: 85vh; background: #222 url("{{ $bg }}") center/cover no-repeat; display: flex; align-items: center; padding-top: 80px; }
  .tour-header-overlay { position: absolute; inset: 0; background: rgba(0, 0, 0, 0.35); }
  .tour-header-inner { position: relative; z-index: 1; max-width: 1600px; margin: 0 auto; width: 100%; padding: 60px 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; }
  .tour-header-text { color: #fff; }
  .tour-header-duration { font-size: 20px; margin: 0 0 12px; }
  .tour-header-title { font-weight: 900; font-size: 42px; line-height: 1.2; margin: 0; text-transform: uppercase; }
  .tour-header-badge { color: #fff; text-align: center; display: flex; flex-direction: column; align-items: center; min-width: 260px; }
  .tour-header-badge .rank { font-weight: 700; font-size: 68px; line-height: 1; margin: 0 0 8px; }
  .tour-header-awards { display: flex; gap: 12px; margin-top: 18px; }
  .tour-header-awards img { height: 90px; width: auto; opacity: 0.8; }
  
  /* Facts Bar */
  .facts-bar-wrap { padding: 0 24px; margin-top: -40px; position: relative; z-index: 2; }
  .facts-bar { max-width: 1600px; margin: 0 auto; background: #333; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); display: flex; align-items: stretch; flex-wrap: wrap;  }
  .facts-bar-play { background: var(--orange); width: 100px; min-height: 100px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .facts-bar-play a { color: #fff; font-size: 26px; text-decoration: none; }
  .facts-bar-items { background: #fff; flex: 1; display: flex; align-items: center; justify-content: space-evenly; flex-wrap: wrap; gap: 24px; padding: 20px 24px; }
  .fact-item { display: flex; align-items: center; gap: 14px; }
  .fact-item .fact-icon { font-size: 26px; color: var(--orange); width: 34px; text-align: center; flex-shrink: 0; }
  .fact-item .fact-value { font-weight: 700; font-size: 14.5px; color: #555; display: block; }
  .fact-item .fact-label { font-size: 10px; letter-spacing: 1px; text-transform: uppercase; color: #555; display: block; margin-top: 3px; }
  .facts-bar-brochure { background: #f0f0f0; display: flex; align-items: center; justify-content: center; padding: 20px; flex-shrink: 0; }
  .facts-bar-brochure a { background: #333; color: #fff; font-weight: 700; font-size: 12px; letter-spacing: 0.3px; text-transform: uppercase; text-decoration: none; padding: 16px 26px; white-space: nowrap; }

  /* Breadcrumb & Content */
  .breadcrumb { max-width: 1600px; margin: 40px auto 0; padding: 0 24px; display: flex; flex-wrap: wrap; gap: 6px; font-size: 12.6px; color: #555; }
  .breadcrumb a { color: #555; text-decoration: none; }
  .breadcrumb a:hover { color: var(--orange); }
  .tour-content { max-width: 1600px; margin: 0 auto; padding: 0 24px 40px; display: grid; grid-template-columns: 1fr 380px; gap: 40px; }
  .tour-subtitle { font-size: 26px; color: #000; font-weight: 400; margin: 20px 0 24px; padding-bottom: 20px; border-bottom: 1px solid #ddd; }
  .tour-route { display: flex; align-items: center; gap: 10px; font-style: italic; font-size: 13.7px; color: #555; margin-bottom: 24px; }
  .tour-route .icon { color: var(--orange); }
  .tour-description { font-size: 18px; color: #555; line-height: 1.8; margin: 0 0 24px; }
  .tour-description p { margin-bottom: 20px; }

  /* Sidebar */
  .tour-sidebar { background: #f9f9f9; border: 2px solid #efefef; border-radius: 12px; height: fit-content; overflow: hidden; }
  .sidebar-price { background: #efefef; text-align: center; padding: 24px; }
  .sidebar-price .label { font-size: 14px; color: #555; }
  .sidebar-price .amount { font-weight: 700; font-size: 28px; color: var(--orange); margin: 6px 0; }
  .sidebar-price .per { font-size: 14px; color: #555; }
  .sidebar-list { list-style: none; margin: 0; padding: 20px 24px 0; }
  .sidebar-list li { position: relative; padding-left: 20px; margin-bottom: 20px; }
  .sidebar-list li::before { content: ""; position: absolute; left: 0; top: 7px; width: 5px; height: 5px; border-radius: 50%; background: var(--orange); }
  .sidebar-list .item-value { font-weight: 500; font-size: 13.8px; color: #000; display: block; }
  .sidebar-list .item-label { font-size: 10.5px; text-transform: uppercase; color: #686d76; display: block; margin-top: 4px; }
  .sidebar-award { text-align: center; padding: 8px 24px 0; }
  .sidebar-award img { width: 100px; height: auto; margin: 0 auto; }
  .sidebar-buttons { display: flex; padding: 24px; gap: 0; }
  .sidebar-buttons a { flex: 1; text-align: center; padding: 14px 10px; font-weight: 700; font-size: 13px; text-transform: uppercase; text-decoration: none; }
  .sidebar-buttons .book-online { background: var(--orange); color: #fff; }
  .sidebar-buttons .enquire { background: transparent; border: 1px solid var(--orange); color: var(--orange); }
  .sidebar-help { text-align: center; font-size: 14px; color: #555; padding: 0 24px 28px; line-height: 1.7; }
  .sidebar-help strong { color: var(--orange); }

  /* Estilos para el Popup/Modal de Media */
  .media-modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); align-items: center; justify-content: center; backdrop-filter: blur(5px); }
  .media-modal.show { display: flex; }
  .media-modal-content { position: relative; width: 90%; max-width: 1000px; height: 80vh; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
  .media-modal-close { position: absolute; top: 10px; right: 20px; color: #fff; font-size: 36px; font-weight: bold; cursor: pointer; z-index: 10; line-height: 1; text-shadow: 0 2px 4px rgba(0,0,0,0.8); }
  .media-modal-close:hover { color: var(--orange); }
  .media-modal-content iframe { width: 100%; height: 100%; border: none; background: #fff; }
  
  /* Cambiamos el cursor para que las tarjetas parezcan clickeables */
  .media-card.media-trigger { cursor: pointer; }
  /* Contenedor de las 3 tarjetas */
  .media-cards { max-width: 1600px; margin: 40px auto; padding: 0 24px; display: grid; grid-template-columns: repeat(3, 1fr); /* Esto fuerza las 3 columnas */gap: 24px; }
  /* Estilo individual de cada tarjeta */
  .media-card { position: relative; border-radius: 12px; overflow: hidden; display: block; height: 250px; /* Altura fija para que todas se vean parejas */background: #000;}
  .media-card img { width: 100%; height: 100%; object-fit: cover; display: block; opacity: 0.8; /* Oscurece un poco la imagen para que el texto resalte */transition: transform 0.3s ease;}
  .media-card:hover img {transform: scale(1.05); /* Efecto de zoom al pasar el mouse */}
  /* El texto centrado de Play Video / View Map */
  .media-card-overlay { position: absolute; inset: 0;  display: flex; align-items: center; justify-content: center; }
  .media-card-label { color: #fff; font-size: 18px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
  @media (max-width: 1100px) {
  .media-cards { grid-template-columns: 1fr; height: auto; }
  .media-card { height: 200px; }
}

/* Tabs y Grid Secundario */
  .tour-tabs { position: -webkit-sticky; position: sticky; top: 40px; background: #f7f8fa; z-index: 999; }
  .tour-tabs-inner { max-width: 1600px; margin: 0 auto; display: flex; overflow-x: auto; }
  .tour-tab { flex: 1; min-width: 130px; padding: 18px 10px; color: #333; text-decoration: none; font-size: 11.5px; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; }
  .tour-tab .tab-icon { display: block; font-size: 20px; margin-bottom: 8px; }
  .tour-tab.active { background: #fff; color: var(--orange); }
  .tour-page-grid { max-width: 1600px; margin: 0 auto; padding: 40px 24px 100px; display: grid; grid-template-columns: 1fr 380px; gap: 40px; }
  .section-heading { font-size: 24px; color: #000; font-weight: 400; margin: 0 0 24px; }

  /* Highlight WYSIWYG Styling */
  .highlights-block ul { display: grid; grid-template-columns: 1fr 1fr; gap: 24px 40px; list-style: none; padding: 0; }
  .highlights-block li { position: relative; padding-left: 30px; color: #555; font-size: 15px; line-height: 1.6; }
  .highlights-block li::before { content: "☆"; position: absolute; left: 0; top: -2px; color: var(--orange); font-size: 20px; }

  /* Itinerary */
  .itinerary-day { display: flex; gap: 20px; padding: 20px 0; border-bottom: 1px solid #eee; }
  .itinerary-day-num { flex-shrink: 0; width: 70px; }
  .itinerary-day-num .label { color: var(--orange); font-weight: 700; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; }
  .itinerary-day-num .num { color: var(--orange); font-weight: 700; font-size: 26px; }
  .itinerary-day-content .title { font-size: 16px; color: #000; margin: 0 0 8px; font-weight: 700; }
  .itinerary-day-content .desc { font-size: 14.5px; color: #555; line-height: 1.6; margin: 0; }

  /* Grid Secundario y Galería */
    .tour-page-grid { max-width: 1600px; margin: 0 auto; padding: 40px 24px 100px; display: grid; grid-template-columns: 1fr 380px; gap: 40px; }
    .gallery-block { margin-top: 32px; margin-bottom: 32px; }
    .gallery-scroll { display: flex; gap: 16px; overflow-x: auto; padding-bottom: 12px; }
    .gallery-scroll img { height: 340px; width: 220px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
    .gallery-scroll::-webkit-scrollbar { height: 8px; }
    .gallery-scroll::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 4px; }
    .gallery-scroll::-webkit-scrollbar-thumb { background: #db5f15; border-radius: 4px; }

  /* Notice */
  .important-notice { background: var(--orange); color: #fff; padding: 20px 22px; border-radius: 4px; margin-bottom: 24px; }
  .important-notice .notice-title { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 15px; text-transform: uppercase; margin-bottom: 14px; }
  .important-notice p { font-size: 13.5px; line-height: 1.6; margin: 0 0 14px; }
  .important-notice p:last-child { margin-bottom: 0; }

  @media (max-width: 1100px) {
    .tour-content, .tour-page-grid { grid-template-columns: 1fr; }
    .media-cards { grid-template-columns: 1fr; }
  }

  /* ========================================================
     ESTILOS PREMIUM PARA EL CONTENIDO DEL EDITOR (WYSIWYG)
     ======================================================== */
  .tour-editor-content { font-size: 15px; line-height: 1.8; color: #555; /* Un gris un poco más suave para descansar la vista */}
  
  /* Párrafos con más aire */
  .tour-editor-content p { margin-bottom: 22px; }
  /* Títulos con la línea divisoria fina (Como en "2026 Land Cost") */
  .tour-editor-content h2, 
  .tour-editor-content h3, 
  .tour-editor-content h4 { color: #222; font-weight: 700; margin-top: 40px; margin-bottom: 20px; padding-bottom: 12px;border-bottom: 1px solid #eaeaea; /* Línea gris muy sutil */line-height: 1.3;}
  .tour-editor-content h2 { font-size: 20px; }
  .tour-editor-content h3 { font-size: 18px; }
  /* Negritas oscuras para resaltar (Como en "Group Price:") */
  .tour-editor-content strong, 
  .tour-editor-content b { font-weight: 700; color: #222; }
  /* Convertimos las viñetas normales en "Checks" Naranjas */
  .tour-editor-content ul { list-style: none; /* Quitamos el punto negro */padding-left: 0; margin-bottom: 24px; }
  .tour-editor-content ul li { position: relative;padding-left: 28px;margin-bottom: 12px;}
  /* El ícono de check */
  .tour-editor-content ul li::before {content: '✔'; position: absolute;left: 0;top: 2px;color: var(--orange, #e56b2e); font-size: 15px;}
  /* Estilos para textos tachados (Como el "US$100.00" de oferta) */
  .tour-editor-content del,
  .tour-editor-content s,
  .tour-editor-content strike {color: #999;text-decoration: line-through;margin-right: 6px;}
  /* Enlaces */
  .tour-editor-content a { color: var(--orange, #e56b2e); text-decoration: none;font-weight: 600;}
  .tour-editor-content a:hover {text-decoration: underline;}

</style>

<!-- 1. HEADER DEL TOUR -->
<header class="tour-header">
  <div class="tour-header-overlay"></div>
  <div class="tour-header-inner">
    <div class="tour-header-text">
      <h1 class="tour-header-title">{{ html_entity_decode($title) }}</h1>
      @if($duration) <p class="tour-header-duration">{{ $duration }}</p> @endif
    </div>
  </div>
</header>

<!-- 2. FACTS BAR -->
<div class="facts-bar-wrap">
  <div class="facts-bar">
    <div class="facts-bar-items">
      @if($fact_1)
      <div class="fact-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
      class="lucide lucide-tent-tree-icon lucide-tent-tree"><circle cx="4" cy="4" r="2"/><path d="m14 5 3-3 3 3"/><path d="m14 10 3-3 3 3"/><path d="M17 14V2"/><path d="M17 14H7l-5 8h20Z"/><path d="M8 14v8"/><path d="m9 14 5 8"/></svg><span><span class="fact-value">{{ $fact_1 }}</span><span class="fact-label">Accommodation</span></span></div>
      @endif
      @if($fact_2)
      <div class="fact-item"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path></svg><span><span class="fact-value">{{ $fact_2 }}</span><span class="fact-label">Group Size</span></span></div>
      @endif
      @if($fact_3)
      <div class="fact-item"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M164,80a28,28,0,1,0-28-28A28,28,0,0,0,164,80Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,40Zm90.88,155.92-54.56-92.08A15.87,15.87,0,0,0,186.55,96h0a15.85,15.85,0,0,0-13.76,7.84L146.63,148l-44.84-76.1a16,16,0,0,0-27.58,0L1.11,195.94A8,8,0,0,0,8,208H248a8,8,0,0,0,6.88-12.08ZM88,80l23.57,40H64.43ZM22,192l33-56h66l18.74,31.8,0,0L154,192Zm150.57,0-16.66-28.28L186.55,112,234,192Z"></path></svg><span><span class="fact-value">{{ $fact_3 }}</span><span class="fact-label">Max. Altitude</span></span></div>
      @endif
      @if($fact_4)
      <div class="fact-item"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0v94.37L90.73,98a8,8,0,0,1,10.07-.38l58.81,44.11L218.73,90a8,8,0,1,1,10.54,12l-64,56a8,8,0,0,1-10.07.38L96.39,114.29,40,163.63V200H224A8,8,0,0,1,232,208Z"></path></svg><span><span class="fact-value">{{ $fact_4 }}</span><span class="fact-label">Difficulty</span></span></div>
      @endif
    </div>
  </div>
</div>

<!-- 3. OVERVIEW & SIDEBAR -->
<nav class="breadcrumb">
  <a href="/">Home</a> <span>→</span> <span>Tours</span> <span>→</span> <span>{{ $title }}</span>
</nav>

<div class="tour-content mt-8">
  <div class="tour-main">
    @if($subtitle) <h2 class="tour-subtitle">{{ $subtitle }}</h2> @endif
    @if($route)
      <div class="tour-route"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg></span><span>{{ $route }}</span></div>
    @endif
    
    @if($description)
      <div class="tour-description">{!! $description !!}</div>
    @endif
  </div>

  <aside class="tour-sidebar">
    <div class="sidebar-price">
      <div class="label">Starting from</div>
      <div class="amount">${{ $price }}</div>
      <div class="per">per person</div>
    </div>
    <ul class="sidebar-list">
      @if($distance)<li><span class="item-value">{{ $distance }}</span><span class="item-label">Walking Distance</span></li>@endif
      @if($meals)<li><span class="item-value">{{ $meals }}</span><span class="item-label">Meals</span></li>@endif
      <li><span class="item-value">Locally Owned & Operated</span><span class="item-label">Your Team</span></li>
    </ul>
    <div class="sidebar-buttons">
      <a class="book-online" href="#booking">Book Online</a>
      <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="enquire" href="#contact">Enquire Now</a>
    </div>
    <p class="sidebar-help">Got questions? Reach out anytime via <strong>WhatsApp</strong>.</p>
  </aside>
</div>

<!-- 4. MEDIA CARDS -->
<div class="media-cards">
  
  @if($media_1 && $video_propio)
  <div class="media-card media-trigger" data-url="{{ $video_propio }}" data-type="video">
    <img src="{{ $media_1 }}" alt="Video" />
    <div class="media-card-overlay"><span class="media-card-label">Play Video</span></div>
  </div>
  @endif

  @if($media_2 && $brochure_pdf)
  <a class="media-card" href="{{ $brochure_pdf }}" target="_blank" download>
    <img src="{{ $media_2 }}" alt="Brochure" />
    <div class="media-card-overlay"><span class="media-card-label">Download Brochure</span></div>
  </a>
  @endif

  @if($media_3 && $map_propio)
  <div class="media-card media-trigger" data-url="{{ $map_propio }}" data-type="image">
    <img src="{{ $media_3 }}" alt="Map" />
    <div class="media-card-overlay"><span class="media-card-label">View Map</span></div>
  </div>
  @endif

</div>

<!-- LA VENTANA MODAL ACTUALIZADA -->
<div id="mediaModal" class="media-modal">
  <div class="media-modal-content">
    <span class="media-modal-close">&times;</span>
    
    <!-- Contenedor para el Video Propio -->
    <video id="mediaVideo" controls style="display: none; width: 100%; height: 100%; outline: none;">
      Tu navegador no soporta videos HTML5.
    </video>
    
    <!-- Contenedor para el Mapa Propio -->
    <img id="mediaImage" src="" alt="Mapa del Tour" style="display: none; width: 100%; height: 100%; object-fit: contain; background: #fff;" />
    
  </div>
</div>

</div>

<!-- LA VENTANA MODAL (Oculta por defecto) -->
<div id="mediaModal" class="media-modal">
  <div class="media-modal-content">
    <span class="media-modal-close">&times;</span>
    <iframe id="mediaIframe" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>

<!-- 5. TABS -->
<nav class="tour-tabs">
  <div class="tour-tabs-inner">
    <a class="tour-tab active" href="#overview" data-target="tab-overview">
      <span class="tab-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path d="M168,128a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,128Zm-8,24H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16ZM216,40V200a32,32,0,0,1-32,32H72a32,32,0,0,1-32-32V40a8,8,0,0,1,8-8H72V24a8,8,0,0,1,16,0v8h32V24a8,8,0,0,1,16,0v8h32V24a8,8,0,0,1,16,0v8h24A8,8,0,0,1,216,40Zm-16,8H184v8a8,8,0,0,1-16,0V48H136v8a8,8,0,0,1-16,0V48H88v8a8,8,0,0,1-16,0V48H56V200a16,16,0,0,0,16,16H184a16,16,0,0,0,16-16Z"></path>
          </svg></span>Overview
    </a>
    <a class="tour-tab" href="#itinerary" data-target="tab-itinerary">
      <span class="tab-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path d="M228.92,49.69a8,8,0,0,0-6.86-1.45L160.93,63.52,99.58,32.84a8,8,0,0,0-5.52-.6l-64,16A8,8,0,0,0,24,56V200a8,8,0,0,0,9.94,7.76l61.13-15.28,61.35,30.68A8.15,8.15,0,0,0,160,224a8,8,0,0,0,1.94-.24l64-16A8,8,0,0,0,232,200V56A8,8,0,0,0,228.92,49.69ZM104,52.94l48,24V203.06l-48-24ZM40,62.25l48-12v127.5l-48,12Zm176,131.5-48,12V78.25l48-12Z"></path>
          </svg></span>Itinerary
    </a>
    <a class="tour-tab" href="#inclusions" data-target="tab-inclusions">
      <span class="tab-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path d="M243.28,68.24l-24-23.56a16,16,0,0,0-22.59,0L104,136.23l-36.69-35.6a16,16,0,0,0-22.58.05l-24,24a16,16,0,0,0,0,22.61l71.62,72a16,16,0,0,0,22.63,0L243.33,90.91A16,16,0,0,0,243.28,68.24ZM103.62,208,32,136l24-24a.6.6,0,0,1,.08.08l42.35,41.09a8,8,0,0,0,11.19,0L208.06,56,232,79.6Z"></path>
          </svg></span>Inclusions
    </a>
    <a class="tour-tab" href="#packing" data-target="tab-packing">
      <span class="tab-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path d="M224,128a8,8,0,0,1-8,8H128a8,8,0,0,1,0-16h88A8,8,0,0,1,224,128ZM128,72h88a8,8,0,0,0,0-16H128a8,8,0,0,0,0,16Zm88,112H128a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16ZM82.34,42.34,56,68.69,45.66,58.34A8,8,0,0,0,34.34,69.66l16,16a8,8,0,0,0,11.32,0l32-32A8,8,0,0,0,82.34,42.34Zm0,64L56,132.69,45.66,122.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Zm0,64L56,196.69,45.66,186.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Z"></path>
          </svg></span>Packing list
    </a>
    <a class="tour-tab" href="#pricing" data-target="tab-pricing">
      <span class="tab-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path d="M184,89.57V84c0-25.08-37.83-44-88-44S8,58.92,8,84v40c0,20.89,26.25,37.49,64,42.46V172c0,25.08,37.83,44,88,44s88-18.92,88-44V132C248,111.3,222.58,94.68,184,89.57ZM232,132c0,13.22-30.79,28-72,28-3.73,0-7.43-.13-11.08-.37C170.49,151.77,184,139,184,124V105.74C213.87,110.19,232,122.27,232,132ZM72,150.25V126.46A183.74,183.74,0,0,0,96,128a183.74,183.74,0,0,0,24-1.54v23.79A163,163,0,0,1,96,152,163,163,0,0,1,72,150.25Zm96-40.32V124c0,8.39-12.41,17.4-32,22.87V123.5C148.91,120.37,159.84,115.71,168,109.93ZM96,56c41.21,0,72,14.78,72,28s-30.79,28-72,28S24,97.22,24,84,54.79,56,96,56ZM24,124V109.93c8.16,5.78,19.09,10.44,32,13.57v23.37C36.41,141.4,24,132.39,24,124Zm64,48v-4.17c2.63.1,5.29.17,8,.17,3.88,0,7.67-.13,11.39-.35A121.92,121.92,0,0,0,120,171.41v23.46C100.41,189.4,88,180.39,88,172Zm48,26.25V174.4a179.48,179.48,0,0,0,24,1.6,183.74,183.74,0,0,0,24-1.54v23.79a165.45,165.45,0,0,1-48,0Zm64-3.38V171.5c12.91-3.13,23.84-7.79,32-13.57V172C232,180.39,219.59,189.4,200,194.87Z"></path>
          </svg></span>Pricing 
    </a>
  </div>
</nav>

<!-- 6. CONTENIDO SECUNDARIO (Highlights e Itinerario) -->
<div class="tour-page-grid">

    <!-- ==========================================
         COLUMNA IZQUIERDA
    =========================================== -->
    <div class="tour-page-main">

        <!-- Barra flotante -->
        <div id="barra-flotante" class="sticky top-0 bg-white shadow-sm z-50 ...">
            <!-- Aquí adentro están tus botones de Overview, Itinerary, etc. -->
        </div>

        <!-- CAJA 1: OVERVIEW -->
        <div id="tab-overview" class="tab-pane active">

            @if($highlights)
            <section class="highlights-block">
                <h2 class="section-heading">Experience Highlights</h2>
                {!! $highlights !!}
            </section>
            @endif

            @if($gallery_1 || $gallery_2 || $gallery_3 || $gallery_4)
            <section class="gallery-block">
                <div class="gallery-scroll">
                    @if($gallery_1)
                        <img src="{{ $gallery_1 }}" alt="Tour Gallery 1">
                    @endif

                    @if($gallery_2)
                        <img src="{{ $gallery_2 }}" alt="Tour Gallery 2">
                    @endif

                    @if($gallery_3)
                        <img src="{{ $gallery_3 }}" alt="Tour Gallery 3">
                    @endif

                    @if($gallery_4)
                        <img src="{{ $gallery_4 }}" alt="Tour Gallery 4">
                    @endif
                </div>
            </section>
            @endif

            <section class="itinerary-short-block mt-8">

                <h2 class="section-heading">
                    Itinerary at a Glance
                </h2>

                @for ($i = 1; $i <= 5; $i++)

                    @php
                        $it_title = get_field("itinerary_{$i}_title", $post_id);
                        $it_desc  = get_field("itinerary_{$i}_desc", $post_id);
                    @endphp

                    @if($it_title && $it_desc)

                        <div class="itinerary-day">

                            <div class="itinerary-day-num">
                                <span class="label">Day</span>
                                <span class="num">0{{ $i }}</span>
                            </div>

                            <div class="itinerary-day-content">
                                <h3 class="title">{{ $it_title }}</h3>
                                <p class="desc">{{ $it_desc }}</p>
                            </div>

                        </div>

                    @endif

                @endfor

            </section>

        </div>

        <!-- CAJA 2 -->
        <div id="tab-itinerary" class="tab-pane" style="display:none;">

            @for ($i = 1; $i <= 5; $i++)

                @php
                    $it_title = get_field("itinerary_{$i}_title", $post_id);
                    $it_full  = get_field("itinerary_{$i}_full", $post_id);
                @endphp

                @if($it_title && $it_full)

                    <div class="itinerary-detailed-day" style="margin-bottom:60px;">

                        <div class="day-header" style="display:flex;align-items:center;gap:15px;margin-bottom:25px;">

                            <div class="day-badge" style="background:var(--orange,#e56b2e);color:#fff;width:60px;height:60px;border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;font-weight:bold;line-height:1;">
                                <span style="font-size:12px;">DAY</span>
                                <span style="font-size:20px;">0{{ $i }}</span>
                            </div>

                            <h2 style="font-size:22px;color:#000;margin:0;font-weight:600;">
                                {{ $it_title }}
                            </h2>

                        </div>

                        <div class="day-content tour-editor-content">
                            {!! $it_full !!}
                        </div>

                    </div>

                @endif

            @endfor

        </div>

        <!-- CAJA 3 -->
        <div id="tab-inclusions" class="tab-pane" style="display:none;">

            <h2 class="section-heading">What's Included</h2>

            @if($inclusions)
                <div class="tour-editor-content">
                    {!! $inclusions !!}
                </div>
            @endif

        </div>

        <!-- CAJA 4 -->
        <div id="tab-packing" class="tab-pane" style="display:none;">

            <h2 class="section-heading">Packing List</h2>

            @if($packing_list)
                <div class="tour-editor-content">
                    {!! $packing_list !!}
                </div>
            @endif

        </div>

        <!-- CAJA 5 -->
        <div id="tab-pricing" class="tab-pane" style="display:none;">

            <h2 class="section-heading">Pricing & Dates</h2>

            @if($pricing)
                <div class="tour-editor-content">
                    {!! $pricing !!}
                </div>
            @endif

        </div>

    </div>
    <!-- FIN tour-page-main -->
  <!-- ABRIMOS LA BARRA LATERAL (Y NO LA CERRAMOS HASTA EL FINAL) -->
  <aside class="tour-page-sidebar">

    <!-- EL NUEVO WIDGET DE RESERVAS ADENTRO DEL ASIDE -->
    <div class="booking-widget" style="position: sticky; top: 120px;">
      <div class="booking-header">Booking</div>

      <div class="booking-info">
        <h3 class="booking-title">{{ get_the_title() }}</h3>
        <!-- Le pusimos un ID al precio para cambiarlo al sumar pasajeros -->
        <div class="booking-price" id="total-price">US$350.00</div>
      </div>

      <div class="booking-divider">Choose your travel date</div>

      <div class="booking-body">
        
        <div class="booking-step">
          <span class="step-num">1</span> Select Date
        </div>

       <!-- Calendario Dinámico -->
        <div class="calendar-mockup">
          <div class="cal-header">
            <span id="prev-month" style="cursor:pointer; padding: 0 10px; font-size: 16px;">&lt;</span>
            <span id="cal-month-year"></span>
            <span id="next-month" style="cursor:pointer; padding: 0 10px; font-size: 16px;">&gt;</span>
          </div>
          <!-- Le pusimos un ID al grid para que JS pueda inyectar los días aquí -->
          <div class="cal-grid" id="cal-grid">
            <!-- El contenido se generará automáticamente con JavaScript -->
          </div>
        </div>
        <div class="cal-legend">
           <div class="legend-item"><div class="legend-box" style="background: #ffefe6;"></div> <span><strong>1+ travelers</strong> Solo or any group size</span></div>
           <div class="legend-item"><div class="legend-box" style="background: #e6f7ff;"></div> <span><strong>2+ travelers</strong> Minimum 2 people required</span></div>
        </div>

        <div class="booking-step">
          <span class="step-num">2</span> Passengers <span class="step-note">(First select a date)</span>
        </div>

        <div class="pax-selector">
           <div>Pax<br><span style="font-size: 11px; color:#999;">Pax</span></div>
           <div class="pax-controls">
              <!-- Agregamos clases "btn-minus" y "btn-plus" -->
              <button type="button" class="pax-btn btn-minus">-</button>
              <input type="text" class="pax-input" id="pax-count" value="1" readonly>
              <button type="button" class="pax-btn btn-plus">+</button>
           </div>
        </div>

        <!-- PASO 3: BOTÓN DE WHATSAPP -->
        <div style="margin-top: 30px;">
          <a href="#" id="btn-whatsapp" target="_blank" style="display: flex; align-items: center; justify-content: center; background: #25D366; color: #fff; padding: 14px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 16px; transition: background 0.3s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256" style="margin-right: 8px;"><path d="M187.58,144.84l-32-16a8,8,0,0,0-8,1.5l-19.24,16a80.38,80.38,0,0,1-40-40l16-19.24a8,8,0,0,0,1.5-8l-16-32a8,8,0,0,0-9.73-4.28C74.36,44.52,64,57.14,64,72a128.14,128.14,0,0,0,128,128c14.86,0,27.48-10.36,29.18-16.11A8,8,0,0,0,187.58,144.84Z"></path></svg>
            Book via WhatsApp
          </a>
        </div>

      </div>
    </div>
  </aside>

</div> <!-- ESTE DIV CIERRA EL CONTENEDOR PRINCIPAL (GRID) -->

<!-- 👉 ¡AQUÍ EXACTAMENTE PEGAS EL INCLUDE! 👈 -->
<!-- ZONA DONDE LA BARRA DEBE DESAPARECER -->
<div id="zona-ocultar-barra">
  @include('sections.faq')
  @include('sections.tours')
  @include('sections.destinations')
  @include('sections.quote')
</div>



<!-- ==========================================
     SCRIPT EXCLUSIVO PARA LAS PESTAÑAS
     ========================================== -->
     <!-- ==========================================
     SCRIPT DEFINITIVO: OCULTAR BARRA FLOTANTE
     ========================================== -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const barraFlotante = document.getElementById('barra-flotante');
    const zonaOculta = document.getElementById('zona-ocultar-barra');

    if (barraFlotante && zonaOculta) {
      // Configuramos la animación suave directamente
      barraFlotante.style.transition = 'all 0.3s ease-in-out';

      // Creamos un evento que vigila el scroll en tiempo real
      window.addEventListener('scroll', function() {
        // Mide a qué distancia está la zona de FAQs del borde superior de la pantalla
        const distanciaTop = zonaOculta.getBoundingClientRect().top;

        // Si la zona de FAQs sube y se acerca a 150px del borde superior...
        if (distanciaTop < 150) {
          // Desaparecemos la barra tirándola hacia arriba y haciéndola invisible
          barraFlotante.style.opacity = '0';
          barraFlotante.style.visibility = 'hidden';
          barraFlotante.style.transform = 'translateY(-100%)';
        } else {
          // Si el usuario vuelve a subir, la restauramos a la normalidad
          barraFlotante.style.opacity = '1';
          barraFlotante.style.visibility = 'visible';
          barraFlotante.style.transform = 'translateY(0)';
        }
      });
    } else {
      console.error("Falta el ID 'barra-flotante' o 'zona-ocultar-barra' en el HTML.");
    }
  });
</script>
<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    
    const btnMinus = document.querySelector('.btn-minus');
    const btnPlus = document.querySelector('.btn-plus');
    const inputPax = document.getElementById('pax-count');
    const totalPriceEl = document.getElementById('total-price');
    const btnWhatsApp = document.getElementById('btn-whatsapp');
    
// --- VARIABLES DINÁMICAS DESDE WORDPRESS ---
    // Usamos la variable con el número limpio para las matemáticas del calendario
    const tourDuration = {{ $tour_duration_number }}; 
    const tourName = "{{ get_the_title() }}"; 
    const numeroWhatsApp = "51992478968";

    let pax = 1;
    let pricePerPax = 350; 
    let selectedStartDate = null; // Guardamos la fecha real de inicio
    let selectedEndDate = null;   // Guardamos la fecha real de fin
    
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let currentDate = new Date();
    let displayMonth = currentDate.getMonth();
    let displayYear = currentDate.getFullYear();

    // 1. GENERAR EL CALENDARIO
    function renderCalendar(month, year) {
      const calGrid = document.getElementById('cal-grid');
      const calMonthYear = document.getElementById('cal-month-year');
      
      calMonthYear.innerText = `${monthNames[month].toUpperCase()} ${year}`;
      
      let firstDay = new Date(year, month, 1).getDay();
      let daysInMonth = new Date(year, month + 1, 0).getDate();
      
      let html = `
        <div class="cal-day-name">S</div><div class="cal-day-name">M</div><div class="cal-day-name">T</div>
        <div class="cal-day-name">W</div><div class="cal-day-name">T</div><div class="cal-day-name">F</div><div class="cal-day-name">S</div>
      `;
      
      for(let i = 0; i < firstDay; i++) {
        html += `<div class="cal-date disabled"></div>`;
      }
      
      let today = new Date();
      today.setHours(0,0,0,0); 

      for(let i = 1; i <= daysInMonth; i++) {
        let loopDate = new Date(year, month, i);
        
        if(loopDate < today) {
          html += `<div class="cal-date disabled">${i}</div>`;
        } else {
          html += `<div class="cal-date available" data-day="${i}">${i}</div>`;
        }
      }
      calGrid.innerHTML = html;

      // Aplicar el sombreado visual a los días seleccionados
      applyHighlight(month, year);

      // Evento de clic en los días
      const availableDates = document.querySelectorAll('.cal-date.available');
      availableDates.forEach(date => {
        date.addEventListener('click', function() {
          let clickedDay = parseInt(this.getAttribute('data-day'));
          
          // Calculamos la fecha de inicio y la fecha de fin sumándole los días de duración
          selectedStartDate = new Date(year, month, clickedDay);
          selectedEndDate = new Date(year, month, clickedDay + tourDuration - 1);
          
          applyHighlight(month, year);
          updateBooking();
        });
      });
    }

    // 2. FUNCIÓN PARA PINTAR EL RANGO DE FECHAS
    function applyHighlight(renderedMonth, renderedYear) {
      if(!selectedStartDate || !selectedEndDate) return;

      const availableDates = document.querySelectorAll('.cal-date.available');
      availableDates.forEach(d => {
        d.classList.remove('active');
        let dayNum = parseInt(d.getAttribute('data-day'));
        let dDate = new Date(renderedYear, renderedMonth, dayNum);
        
        // Si la celda del calendario está entre la fecha de inicio y la fecha final, se ilumina
        if(dDate >= selectedStartDate && dDate <= selectedEndDate) {
          d.classList.add('active');
        }
      });
    }

    // 3. ACTUALIZAR WHATSAPP Y PRECIOS
    function updateBooking() {
      const total = pax * pricePerPax;
      totalPriceEl.innerHTML = `US$${total.toFixed(2)}`;

      if(selectedStartDate && selectedEndDate) {
        // Formateamos las fechas para que se vean bonitas (Ej: 29 July 2026)
        let startStr = `${selectedStartDate.getDate()} ${monthNames[selectedStartDate.getMonth()]} ${selectedStartDate.getFullYear()}`;
        let endStr = `${selectedEndDate.getDate()} ${monthNames[selectedEndDate.getMonth()]} ${selectedEndDate.getFullYear()}`;
        
        // Si el tour es de 1 día, solo muestra esa fecha, si es de más, muestra el rango
        let dateMsg = tourDuration > 1 ? `${startStr} to ${endStr}` : startStr;

        const message = `Hello! I'm interested in booking the tour: *${tourName}*%0A%0A📅 Dates: ${dateMsg}%0A👥 Passengers: ${pax}%0A💵 Total approx: US$${total.toFixed(2)}%0A%0AI would like to confirm availability and proceed.`;
        
        btnWhatsApp.href = `https://wa.me/${numeroWhatsApp}?text=${message}`;
        btnWhatsApp.style.opacity = "1";
        btnWhatsApp.style.pointerEvents = "auto";
      } else {
        btnWhatsApp.href = "#";
        btnWhatsApp.style.opacity = "0.5";
        btnWhatsApp.style.pointerEvents = "none";
      }
    }

    // EVENTOS DE BOTONES
    btnPlus.addEventListener('click', function() {
      pax++; inputPax.value = pax; updateBooking();
    });

    btnMinus.addEventListener('click', function() {
      if (pax > 1) { pax--; inputPax.value = pax; updateBooking(); }
    });

    document.getElementById('prev-month').addEventListener('click', () => {
      displayMonth--;
      if(displayMonth < 0) { displayMonth = 11; displayYear--; }
      renderCalendar(displayMonth, displayYear);
    });

    document.getElementById('next-month').addEventListener('click', () => {
      displayMonth++;
      if(displayMonth > 11) { displayMonth = 0; displayYear++; }
      renderCalendar(displayMonth, displayYear);
    });

    // INICIALIZAR
    renderCalendar(displayMonth, displayYear);
    updateBooking();

  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const triggers = document.querySelectorAll('.media-trigger');
    const modal = document.getElementById('mediaModal');
    const videoPlayer = document.getElementById('mediaVideo');
    const imageViewer = document.getElementById('mediaImage');
    const closeBtn = document.querySelector('.media-modal-close');

    // Al hacer clic en un cuadro de video o mapa
    triggers.forEach(trigger => {
      trigger.addEventListener('click', function() {
        const url = this.getAttribute('data-url');
        const type = this.getAttribute('data-type');
        
        if (type === 'video') {
          videoPlayer.src = url;
          videoPlayer.style.display = 'block';
          imageViewer.style.display = 'none';
          videoPlayer.play(); // Inicia el video automáticamente
        } else if (type === 'image') {
          imageViewer.src = url;
          imageViewer.style.display = 'block';
          videoPlayer.style.display = 'none';
        }
        
        modal.classList.add('show');
      });
    });

    // Función para cerrar y limpiar
    const closeModal = () => {
      modal.classList.remove('show');
      
      // Detiene el video y limpia las rutas
      videoPlayer.pause();
      videoPlayer.src = '';
      imageViewer.src = '';
    };

    // Cerrar modal
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
      if(e.target === modal) closeModal();
    });
  });
</script>

<!-- ==========================================
     SCRIPT DE PESTAÑAS (OVERVIEW, ITINERARY, ETC)
     ========================================== -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    try {
      const tabs = document.querySelectorAll('.tour-tab');
      const tabPanes = document.querySelectorAll('.tab-pane');

      // Solo ejecuta esto si encuentra pestañas en la página
      if(tabs.length > 0) {
        tabs.forEach(tab => {
          tab.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            // 1. Apagamos todas las pestañas
            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(pane => {
              pane.style.display = 'none';
              pane.classList.remove('active');
            });

            // 2. Encendemos la que tocaste
            this.classList.add('active');

            // 3. Buscamos a qué caja pertenece
            let targetId = this.getAttribute('data-target');
            if(!targetId) {
                targetId = this.getAttribute('href').replace('#', '');
            }
            
            const targetPane = document.getElementById(targetId);
            if(targetPane) {
              targetPane.style.display = 'block';
              targetPane.classList.add('active');
            } else {
              console.warn("No se encontró la caja con el ID:", targetId);
            }
          });
        });
      }
    } catch (error) {
      console.error("Error en el sistema de pestañas:", error);
    }
  });
</script>

@endsection <!-- AQUÍ TERMINA TU ARCHIVO BLADE -->