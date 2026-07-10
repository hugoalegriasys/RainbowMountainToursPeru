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

  // Agrega estas 4 variables nuevas para la galería:
  $gallery_1   = get_field('gallery_1', $post_id);
  $gallery_2   = get_field('gallery_2', $post_id);
  $gallery_3   = get_field('gallery_3', $post_id);
  $gallery_4   = get_field('gallery_4', $post_id);

  // 4. Itinerario y Aviso
  $highlights  = get_field('tour_highlights', $post_id);
  $notice      = get_field('important_notice', $post_id);
@endphp

<style>
  :root {
    --orange: #db5f15;
    --gray-text: #888888;
    --black: #000000;
  }
  
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
  .facts-bar { max-width: 1600px; margin: 0 auto; background: #333; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); display: flex; align-items: stretch; flex-wrap: wrap; }
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

  /* Media Cards */
  .media-cards { max-width: 1600px; margin: 20px auto 80px; padding: 0 24px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
  .media-card { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 503 / 324; background: #686d76; text-decoration: none; display: block; }
  .media-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .media-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.55), rgba(0,0,0,0)); display: flex; align-items: flex-end; justify-content: center; padding-bottom: 30px; }
  .media-card-label { border: 1px solid #fff; color: #fff; font-weight: 600; font-size: 14px; text-transform: uppercase; padding: 14px 24px; backdrop-filter: blur(4px); }

  /* Tabs y Grid Secundario */
  .tour-tabs { position: relative; background: #f7f8fa; border-top: 1px solid #eee; border-bottom: 1px solid #eee; z-index: 10; }
  .tour-tabs-inner { max-width: 1600px; margin: 0 auto; display: flex; overflow-x: auto; }
  .tour-tab { flex: 1; min-width: 130px; text-align: center; padding: 18px 10px; color: #333; text-decoration: none; font-size: 11.5px; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; border-right: 1px solid #eee; }
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
</style>

<!-- 1. HEADER DEL TOUR -->
<header class="tour-header">
  <div class="tour-header-overlay"></div>
  <div class="tour-header-inner">
    <div class="tour-header-text">
      @if($duration) <p class="tour-header-duration">{{ $duration }}</p> @endif
      <h1 class="tour-header-title">{{ $title }}</h1>
    </div>
  </div>
</header>

<!-- 2. FACTS BAR -->
<div class="facts-bar-wrap">
  <div class="facts-bar">
    <div class="facts-bar-play"><a href="#">▶</a></div>
    <div class="facts-bar-items">
      @if($fact_1)
      <div class="fact-item"><span class="fact-icon">🏕</span><span><span class="fact-value">{{ $fact_1 }}</span><span class="fact-label">Accommodation</span></span></div>
      @endif
      @if($fact_2)
      <div class="fact-item"><span class="fact-icon">👥</span><span><span class="fact-value">{{ $fact_2 }}</span><span class="fact-label">Group Size</span></span></div>
      @endif
      @if($fact_3)
      <div class="fact-item"><span class="fact-icon">⛰</span><span><span class="fact-value">{{ $fact_3 }}</span><span class="fact-label">Max. Altitude</span></span></div>
      @endif
      @if($fact_4)
      <div class="fact-item"><span class="fact-icon">📊</span><span><span class="fact-value">{{ $fact_4 }}</span><span class="fact-label">Difficulty</span></span></div>
      @endif
    </div>
    <div class="facts-bar-brochure"><a href="#">Download Brochure</a></div>
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
      <div class="tour-route"><span class="icon">📍</span><span>{{ $route }}</span></div>
    @endif
    
    @if($description)
      <div class="tour-description">{!! $description !!}</div>
    @endif
  </div>

  <aside class="tour-sidebar">
    <div class="sidebar-price">
      <div class="label">Starting from</div>
      <div class="amount">US${{ $price }}</div>
      <div class="per">per person</div>
    </div>
    <ul class="sidebar-list">
      @if($distance)<li><span class="item-value">{{ $distance }}</span><span class="item-label">Walking Distance</span></li>@endif
      @if($meals)<li><span class="item-value">{{ $meals }}</span><span class="item-label">Meals</span></li>@endif
      <li><span class="item-value">Locally Owned & Operated</span><span class="item-label">Your Team</span></li>
    </ul>
    <div class="sidebar-award">
      <img src="https://www.figma.com/api/mcp/asset/cbfa96d7-64e7-4e44-940a-d2041c7be074" alt="TripAdvisor" />
    </div>
    <div class="sidebar-buttons">
      <a class="book-online" href="#booking">Book Online</a>
      <a class="enquire" href="#contact">Enquire Now</a>
    </div>
    <p class="sidebar-help">Got questions? Reach out anytime via <strong>WhatsApp</strong>.</p>
  </aside>
</div>

<!-- 4. MEDIA CARDS -->
<div class="media-cards">
  @if($media_1)
  <a class="media-card" href="#"><img src="{{ $media_1 }}" alt="Video" /><div class="media-card-overlay"><span class="media-card-label">Play Video</span></div></a>
  @endif
  @if($media_2)
  <a class="media-card" href="#"><img src="{{ $media_2 }}" alt="Brochure" /><div class="media-card-overlay"><span class="media-card-label">Download Brochure</span></div></a>
  @endif
  @if($media_3)
  <a class="media-card" href="#"><img src="{{ $media_3 }}" alt="Map" /><div class="media-card-overlay"><span class="media-card-label">View Map</span></div></a>
  @endif
</div>

<!-- 5. TABS -->
<nav class="tour-tabs">
  <div class="tour-tabs-inner">
    <a class="tour-tab active" href="#"><span class="tab-icon">🧭</span>Overview</a>
    <a class="tour-tab" href="#itinerary"><span class="tab-icon">🗺️</span>Itinerary</a>
    <a class="tour-tab enquire" href="#enquire"><span class="tab-icon">✉️</span>Enquire Now</a>
  </div>
</nav>

<!-- 6. CONTENIDO SECUNDARIO (Highlights e Itinerario) -->
<div class="tour-page-grid">
  <div class="tour-page-main">
    
    @if($highlights)
    <section class="highlights-block">
      <h2 class="section-heading">Experience Highlights</h2>
      {!! $highlights !!} <!-- Las viñetas de WP tomarán forma de estrella gracias al CSS -->
    </section>
    @endif

    @if($gallery_1 || $gallery_2 || $gallery_3 || $gallery_4)
      <section class="gallery-block">
        <div class="gallery-scroll">
          @if($gallery_1) <img src="{{ $gallery_1 }}" alt="Tour Gallery 1" /> @endif
          @if($gallery_2) <img src="{{ $gallery_2 }}" alt="Tour Gallery 2" /> @endif
          @if($gallery_3) <img src="{{ $gallery_3 }}" alt="Tour Gallery 3" /> @endif
          @if($gallery_4) <img src="{{ $gallery_4 }}" alt="Tour Gallery 4" /> @endif
        </div>
      </section>
    @endif

    <section class="itinerary-block" id="itinerary">
      <h2 class="section-heading">Itinerary at a Glance</h2>
      
      <!-- Bucle dinámico para el Itinerario -->
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

  <aside class="tour-page-sidebar">
    @if($notice)
      <div class="important-notice">
        <div class="notice-title">💡 Important</div>
        {!! $notice !!}
      </div>
    @endif
  </aside>
</div>

@endsection