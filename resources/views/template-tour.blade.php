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
  body {
    background-color: #ffffff !important;
  }
  /* Forzar permiso para que Sticky funcione */
  html, body, #app, main {
    overflow-x: clip !important;
    overflow-y: visible !important;
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
      <div class="tour-route"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg></span><span>{{ $route }}</span></div>
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

    <!-- Overview -->
    <a class="tour-tab active" href="#">
      <span class="tab-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M168,128a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,128Zm-8,24H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16ZM216,40V200a32,32,0,0,1-32,32H72a32,32,0,0,1-32-32V40a8,8,0,0,1,8-8H72V24a8,8,0,0,1,16,0v8h32V24a8,8,0,0,1,16,0v8h32V24a8,8,0,0,1,16,0v8h24A8,8,0,0,1,216,40Zm-16,8H184v8a8,8,0,0,1-16,0V48H136v8a8,8,0,0,1-16,0V48H88v8a8,8,0,0,1-16,0V48H56V200a16,16,0,0,0,16,16H184a16,16,0,0,0,16-16Z"></path>
        </svg>
      </span>
      Overview
    </a>

    <!-- Itinerary -->
    <a class="tour-tab" href="#itinerary">
      <span class="tab-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M228.92,49.69a8,8,0,0,0-6.86-1.45L160.93,63.52,99.58,32.84a8,8,0,0,0-5.52-.6l-64,16A8,8,0,0,0,24,56V200a8,8,0,0,0,9.94,7.76l61.13-15.28,61.35,30.68A8.15,8.15,0,0,0,160,224a8,8,0,0,0,1.94-.24l64-16A8,8,0,0,0,232,200V56A8,8,0,0,0,228.92,49.69ZM104,52.94l48,24V203.06l-48-24ZM40,62.25l48-12v127.5l-48,12Zm176,131.5-48,12V78.25l48-12Z"></path>
        </svg>
      </span>
      Itinerary
    </a>

    <!-- Inclusions -->
    <a class="tour-tab enquire" href="#enquire">
      <span class="tab-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M243.28,68.24l-24-23.56a16,16,0,0,0-22.59,0L104,136.23l-36.69-35.6a16,16,0,0,0-22.58.05l-24,24a16,16,0,0,0,0,22.61l71.62,72a16,16,0,0,0,22.63,0L243.33,90.91A16,16,0,0,0,243.28,68.24ZM103.62,208,32,136l24-24a.6.6,0,0,1,.08.08l42.35,41.09a8,8,0,0,0,11.19,0L208.06,56,232,79.6Z"></path>
        </svg>
      </span>
      Inclusions
    </a>

    <!-- Packing List -->
    <a class="tour-tab enquire" href="#enquire">
      <span class="tab-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M224,128a8,8,0,0,1-8,8H128a8,8,0,0,1,0-16h88A8,8,0,0,1,224,128ZM128,72h88a8,8,0,0,0,0-16H128a8,8,0,0,0,0,16Zm88,112H128a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16ZM82.34,42.34,56,68.69,45.66,58.34A8,8,0,0,0,34.34,69.66l16,16a8,8,0,0,0,11.32,0l32-32A8,8,0,0,0,82.34,42.34Zm0,64L56,132.69,45.66,122.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Zm0,64L56,196.69,45.66,186.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Z"></path>
        </svg>
      </span>
      Packing List
    </a>

    <!-- Pricing -->
    <a class="tour-tab enquire" href="#enquire">
      <span class="tab-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M184,89.57V84c0-25.08-37.83-44-88-44S8,58.92,8,84v40c0,20.89,26.25,37.49,64,42.46V172c0,25.08,37.83,44,88,44s88-18.92,88-44V132C248,111.3,222.58,94.68,184,89.57ZM232,132c0,13.22-30.79,28-72,28-3.73,0-7.43-.13-11.08-.37C170.49,151.77,184,139,184,124V105.74C213.87,110.19,232,122.27,232,132ZM72,150.25V126.46A183.74,183.74,0,0,0,96,128a183.74,183.74,0,0,0,24-1.54v23.79A163,163,0,0,1,96,152,163,163,0,0,1,72,150.25Zm96-40.32V124c0,8.39-12.41,17.4-32,22.87V123.5C148.91,120.37,159.84,115.71,168,109.93ZM96,56c41.21,0,72,14.78,72,28s-30.79,28-72,28S24,97.22,24,84,54.79,56,96,56ZM24,124V109.93c8.16,5.78,19.09,10.44,32,13.57v23.37C36.41,141.4,24,132.39,24,124Zm64,48v-4.17c2.63.1,5.29.17,8,.17,3.88,0,7.67-.13,11.39-.35A121.92,121.92,0,0,0,120,171.41v23.46C100.41,189.4,88,180.39,88,172Zm48,26.25V174.4a179.48,179.48,0,0,0,24,1.6,183.74,183.74,0,0,0,24-1.54v23.79a165.45,165.45,0,0,1-48,0Zm64-3.38V171.5c12.91-3.13,23.84-7.79,32-13.57V172C232,180.39,219.59,189.4,200,194.87Z"></path>
        </svg>
      </span>
      Pricing
    </a>

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