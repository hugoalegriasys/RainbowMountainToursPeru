{{--
  Template Name: Plantilla de Tour
  Template Post Type: page, tour
--}}


@extends('layouts.app')

@section('content')

@php
  $post_id = get_the_ID();

  // Obtenemos el ID de WeTravel
  $wetravel_id = get_field('wetravel_id', $post_id);

  $bg          = get_field('tour_bg', $post_id) ?: 'https://images.unsplash.com/photo-1526392060635-9d6019884377?q=80&w=1920&auto=format&fit=crop';
  $duration    = get_field('tour_duration', $post_id);
  $title       = get_the_title();
  $fact_1      = get_field('fact_1', $post_id);
  $fact_2      = get_field('fact_2', $post_id);
  $fact_3      = get_field('fact_3', $post_id);
  $fact_4      = get_field('fact_4', $post_id);

  $subtitle    = get_field('tour_subtitle', $post_id);
  $route       = get_field('tour_route', $post_id);
  $description = get_field('tour_description', $post_id);
  $price       = get_field('tour_price', $post_id) ?: '0';
  $distance    = get_field('tour_distance', $post_id);
  $meals       = get_field('tour_meals', $post_id);

  $media_1     = get_field('media_video_bg', $post_id);
  $media_2     = get_field('media_brochure_bg', $post_id);
  $media_3     = get_field('media_map_bg', $post_id);

  $video_propio = get_field('video_propio', $post_id);
  $brochure_pdf = get_field('brochure_pdf', $post_id);
  $map_propio  = get_field('map_propio', $post_id);

  $gallery_1   = get_field('gallery_1', $post_id);
  $gallery_2   = get_field('gallery_2', $post_id);
  $gallery_3   = get_field('gallery_3', $post_id);
  $gallery_4   = get_field('gallery_4', $post_id);

  $highlights  = get_field('tour_highlights', $post_id);
  $notice      = get_field('important_notice', $post_id);

  $inclusions   = get_field('tour_inclusions', $post_id);
  $packing_list = get_field('tour_packing_list', $post_id);
  $pricing      = get_field('tour_pricing', $post_id);

  $tour_duration_text = get_field('tour_duration', $post_id);

  $tour_duration_number = intval($tour_duration_text);

  if($tour_duration_number < 1) {
    $tour_duration_number = 1;
  }
@endphp

<style>
  :root {
    --orange: #db5f15;
    --gray-text: #4b5563;
    --black: #111827;
    --border-color: #e5e7eb;
  }
  body { background-color: #ffffff !important; }
  html, body, #app, main { overflow-x: clip !important; overflow-y: visible !important; }

  /* WIDGET DE RESERVA */
  .booking-widget { border: 1px solid var(--border-color) !important; background: #fff !important; box-shadow: none !important; border-radius: 0 !important; }
  .booking-header { background: var(--black) !important; color: #fff !important; text-align: center; padding: 1.25rem !important; font-size: 14px !important; font-weight: 700 !important; text-transform: uppercase; letter-spacing: 2px; }
  .booking-info { padding: 24px 20px; text-align: center; border-bottom: 1px solid var(--border-color); background: #f9fafb; }
  .booking-title { font-size: 13px; color: var(--gray-text); margin-bottom: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
  .booking-price { color: var(--black) !important; font-size: 28px !important; font-weight: 800 !important; }
  .booking-divider { border-top: none !important; border-bottom: 1px solid var(--border-color) !important; padding: 14px; text-align: center; font-size: 11px !important; color: var(--gray-text) !important; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; background: #fff; }
  .booking-body { padding: 24px 20px; }
  .booking-step { display: flex; align-items: center; font-size: 13px !important; color: var(--black) !important; margin-bottom: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
  .step-num { background: var(--orange) !important; color: #fff !important; width: 22px; height: 22px; border-radius: 0 !important; display: flex; align-items: center; justify-content: center; font-size: 11px !important; font-weight: bold; margin-right: 10px; }
  .step-note { color: var(--gray-text) !important; font-size: 11px !important; margin-left: 5px; font-weight: 400; text-transform: none; letter-spacing: 0; }

  .cal-date { padding: 8px 0 !important; border-radius: 0 !important; transition: all 0.2s ease; cursor: pointer; color: #4b5563 !important; }
  .cal-date.disabled { text-decoration: line-through; color: #d1d5db !important; background: transparent !important; cursor: not-allowed; }
  .cal-date.available { background: #f3f4f6 !important; }
  .cal-date:not(.disabled):hover { background: #ffedd5 !important; color: var(--orange) !important; font-weight: bold; transform: none !important; }
  .cal-date.active { background: var(--orange) !important; color: #ffffff !important; font-weight: bold; box-shadow: none !important; transform: none !important;}
  .calendar-mockup { border: 1px solid var(--border-color) !important; padding: 15px; margin-bottom: 15px; }
  .cal-header { display: flex; justify-content: space-between; align-items: center; font-size: 12px !important; font-weight: bold; color: var(--black) !important; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
  .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 4px !important; font-size: 12px !important; }
  .cal-day-name { color: var(--gray-text) !important; font-weight: 600 !important; margin-bottom: 8px; font-size: 11px !important; }
  .cal-legend { font-size: 11px !important; color: var(--gray-text) !important; margin-bottom: 30px; display: flex; flex-direction: column; gap: 8px; }
  .legend-item { display: flex; align-items: flex-start; gap: 8px; }
  .legend-box { width: 14px; height: 14px; flex-shrink: 0; margin-top: 1px; border: 1px solid var(--border-color); border-radius: 0 !important;}
  
  .pax-selector { display: flex; justify-content: space-between; align-items: center; font-size: 13px !important; color: var(--black) !important; border: 1px solid var(--border-color); padding: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;}
  .pax-controls { display: flex; align-items: center; gap: 15px; }
  .pax-btn { color: var(--orange) !important; background: none; border: none; font-size: 20px !important; cursor: pointer; }
  .pax-input { width: 30px; text-align: center; border: none; font-size: 14px !important; color: var(--black) !important; pointer-events: none; font-weight: 700; background: transparent; }

  #btn-whatsapp { border-radius: 0 !important; text-transform: uppercase; letter-spacing: 1px; font-size: 13px !important; box-shadow: none !important; }

  /* DISEÑO GENERAL */
  .tour-header { position: relative; min-height: 70vh; display: flex; align-items: center; padding-top: 80px; }
  .tour-header-overlay { position: absolute; inset: 0; background: rgba(0, 0, 0, 0.5) !important; }
  .tour-header-inner { position: relative; z-index: 1; max-width: 1600px; margin: 0 auto; width: 100%; padding: 60px 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; text-align: center; flex-direction: column; }
  .tour-header-text { color: #fff; width: 100%; }
  .tour-header-duration { font-size: 12px !important; margin: 0 0 12px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.3); display: inline-block; padding: 8px 20px; }
  .tour-header-title { font-weight: 800 !important; font-size: 48px !important; line-height: 1.2; margin: 20px 0 0; text-transform: uppercase; letter-spacing: 4px; }

  .facts-bar-wrap { padding: 0 24px; margin-top: 0 !important; position: relative; z-index: 2; border-bottom: 1px solid var(--border-color); background: #fff;}
  .facts-bar { max-width: 1600px; margin: 0 auto; background: transparent !important; box-shadow: none !important; display: flex; align-items: stretch; flex-wrap: wrap; border-radius: 0 !important;}
  .facts-bar-items { background: transparent !important; flex: 1; display: grid !important; grid-template-columns: repeat(4, 1fr); padding: 0 !important; gap: 0 !important;}
  @media (max-width: 900px) { .facts-bar-items { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 500px) { .facts-bar-items { grid-template-columns: 1fr; } }
  .fact-item { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; padding: 30px 20px; border-right: 1px solid var(--border-color); justify-content: center;}
  .fact-item:last-child { border-right: none; }
  @media (max-width: 900px) { .fact-item:nth-child(2) { border-right: none; } .fact-item:nth-child(1), .fact-item:nth-child(2) { border-bottom: 1px solid var(--border-color); } }
  .fact-item .fact-icon { font-size: 26px; color: var(--orange) !important; display: flex; justify-content: center; align-items: center; width: auto !important;}
  .fact-item .fact-value { font-weight: 700 !important; font-size: 15px !important; color: var(--black) !important; display: block; }
  .fact-item .fact-label { font-size: 10px !important; letter-spacing: 2px !important; text-transform: uppercase; color: var(--gray-text) !important; display: block; margin-top: 3px; font-weight: 600;}

  .breadcrumb { max-width: 1600px; margin: 40px auto 0 !important; padding: 0 24px; display: flex; flex-wrap: wrap; gap: 8px !important; font-size: 11px !important; color: var(--gray-text) !important; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;}
  .breadcrumb a { color: var(--gray-text) !important; text-decoration: none; transition: color 0.2s;}
  .breadcrumb a:hover { color: var(--orange) !important; }
  
  .tour-content { max-width: 1600px; margin: 0 auto; padding: 0 24px 40px; display: grid; grid-template-columns: 1fr 380px; gap: 60px !important; }
  .tour-subtitle { font-size: 28px !important; color: var(--black) !important; font-weight: 800 !important; margin: 20px 0 24px !important; padding-bottom: 20px; border-bottom: 2px solid var(--orange) !important; display: inline-block;}
  .tour-route { display: flex; align-items: flex-start; gap: 12px !important; font-size: 14px !important; color: var(--gray-text) !important; margin-bottom: 30px !important; background: #f9fafb; padding: 20px; border: 1px solid var(--border-color); line-height: 1.6; font-style: normal !important;}
  .tour-route .icon { color: var(--orange) !important; margin-top: 2px;}
  .tour-description { font-size: 16px !important; color: var(--gray-text) !important; line-height: 1.8 !important; margin: 0 0 24px; font-weight: 300;}
  .tour-description p { margin-bottom: 20px; }

  .tour-sidebar { background: #fff !important; border: 1px solid var(--border-color) !important; border-radius: 0 !important; height: fit-content; overflow: hidden; box-shadow: none !important; }
  .sidebar-price { background: #f9fafb !important; text-align: center; padding: 30px 24px !important; border-bottom: 1px solid var(--border-color);}
  .sidebar-price .label { font-size: 11px !important; color: var(--gray-text) !important; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;}
  .sidebar-price .amount { font-weight: 800 !important; font-size: 36px !important; color: var(--black) !important; margin: 10px 0 !important; }
  .sidebar-price .per { font-size: 11px !important; color: var(--gray-text) !important; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;}
  .sidebar-list { list-style: none; margin: 0; padding: 30px 24px 0 !important; display: flex !important; flex-direction: column; gap: 20px;}
  .sidebar-list li { position: relative; padding-left: 0 !important; margin-bottom: 0 !important; display: flex; flex-direction: column; gap: 4px; border-bottom: 1px solid #f3f4f6; padding-bottom: 15px;}
  .sidebar-list li:last-child { border-bottom: none; padding-bottom: 0; }
  .sidebar-list li::before { display: none !important; }
  .sidebar-list .item-value { font-weight: 600 !important; font-size: 14px !important; color: var(--black) !important; display: block; }
  .sidebar-list .item-label { font-size: 10px !important; text-transform: uppercase; color: var(--gray-text) !important; display: block; margin-top: 0 !important; letter-spacing: 1px; font-weight: 600;}
  
  .sidebar-buttons { display: flex; flex-direction: column; padding: 24px; gap: 10px !important; border-top: 1px solid var(--border-color); margin-top: 20px;}
  .sidebar-buttons a { width: 100%; text-align: center; padding: 16px 10px !important; font-weight: 700 !important; font-size: 12px !important; text-transform: uppercase; text-decoration: none; letter-spacing: 2px; transition: all 0.2s;}
  .sidebar-buttons .book-online { background: var(--orange) !important; color: #fff !important; border: 1px solid var(--orange);}
  .sidebar-buttons .book-online:hover { background: #c25411 !important; border-color: #c25411; }
  .sidebar-buttons .enquire { background: transparent !important; border: 1px solid var(--border-color) !important; color: var(--black) !important; }
  .sidebar-buttons .enquire:hover { border-color: var(--black) !important; }
  .sidebar-help { text-align: center; font-size: 13px !important; color: var(--gray-text) !important; padding: 0 24px 28px !important; line-height: 1.7; }
  .sidebar-help strong { color: var(--orange) !important; font-weight: 600;}

  /* MEDIA CARDS */
  .media-modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9) !important; align-items: center; justify-content: center; backdrop-filter: blur(5px); }
  .media-modal.show { display: flex; }
  .media-modal-content { position: relative; width: 90%; max-width: 1000px; height: 80vh; background: #000; border-radius: 0 !important; overflow: hidden; box-shadow: none !important; border: 1px solid #333;}
  .media-modal-close { position: absolute; top: 10px; right: 20px; color: #fff; font-size: 36px; font-weight: 300 !important; cursor: pointer; z-index: 10; line-height: 1; text-shadow: none !important; }
  .media-modal-close:hover { color: var(--orange) !important; }

  .media-card.media-trigger { cursor: pointer; }
  .media-cards { max-width: 1600px; margin: 0 auto 60px !important; padding: 0 24px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px !important; background: var(--border-color); border: 1px solid var(--border-color);}
  .media-card { position: relative; border-radius: 0 !important; overflow: hidden; display: block; height: 250px; background: #fff !important;}
  .media-card img { width: 100%; height: 100%; object-fit: cover; display: block; opacity: 0.9 !important; transition: transform 0.5s ease !important;}
  .media-card:hover img {transform: scale(1.05); opacity: 1 !important;}
  .media-card-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3); transition: background 0.3s;}
  .media-card:hover .media-card-overlay { background: rgba(0,0,0,0.1); }
  .media-card-label { color: #fff !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase; letter-spacing: 2px !important; border: 1px solid #fff; padding: 10px 20px; backdrop-filter: blur(2px); background: rgba(0,0,0,0.2);}
  @media (max-width: 1100px) {
    .media-cards { grid-template-columns: 1fr; height: auto; border: none; background: transparent; gap: 20px !important;}
    .media-card { height: 220px; border: 1px solid var(--border-color);}
  }

  /* TABS & EDITOR CONTENT */
  .tour-tabs { position: -webkit-sticky; position: sticky; top: 0 !important; background: #fff !important; z-index: 999; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);}
  .tour-tabs-inner { max-width: 1600px; margin: 0 auto; display: flex; overflow-x: auto; }
  .tour-tab { flex: 1; min-width: 130px; padding: 20px 10px !important; color: var(--gray-text) !important; text-decoration: none; font-size: 11px !important; letter-spacing: 2px !important; text-transform: uppercase; font-weight: 700 !important; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; border-bottom: 2px solid transparent; transition: all 0.2s;}
  .tour-tab .tab-icon { display: none !important; }
  .tour-tab:hover { color: var(--orange) !important; }
  .tour-tab.active { color: var(--orange) !important; border-bottom-color: var(--orange) !important; background: transparent !important;}
  
  .tour-page-grid { max-width: 1600px; margin: 0 auto; padding: 60px 24px 100px !important; display: grid; grid-template-columns: 1fr 380px; gap: 60px !important; }
  .section-heading { font-size: 24px !important; color: var(--black) !important; font-weight: 800 !important; margin: 0 0 30px !important; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;}

  .highlights-block ul { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 40px !important; list-style: none; padding: 0 !important; }
  @media (max-width: 768px) { .highlights-block ul { grid-template-columns: 1fr; } }
  .highlights-block li { position: relative; padding-left: 24px !important; color: var(--gray-text) !important; font-size: 15px !important; line-height: 1.6; font-weight: 300;}
  .highlights-block li::before { content: "" !important; position: absolute; left: 0; top: 8px !important; width: 6px; height: 6px; background: var(--orange) !important; border-radius: 0; font-size: 0 !important;}

  .itinerary-day { display: flex; flex-direction: column; gap: 15px !important; padding: 30px 0 !important; border-bottom: 1px solid var(--border-color) !important; }
  @media(min-width: 768px) { .itinerary-day { flex-direction: row; gap: 30px !important; } }
  .itinerary-day-num { flex-shrink: 0; width: auto !important; display: flex; align-items: baseline; gap: 8px;}
  @media(min-width: 768px) { .itinerary-day-num { width: 80px !important; display: block;} }
  .itinerary-day-num .label { color: var(--orange) !important; font-weight: 700 !important; font-size: 11px !important; letter-spacing: 2px !important; text-transform: uppercase; display: block; }
  .itinerary-day-num .num { color: var(--black) !important; font-weight: 800 !important; font-size: 24px !important; line-height: 1;}
  .itinerary-day-content .title { font-size: 18px !important; color: var(--black) !important; margin: 0 0 10px !important; font-weight: 700 !important; }
  .itinerary-day-content .desc { font-size: 15px !important; color: var(--gray-text) !important; line-height: 1.7; margin: 0; font-weight: 300;}

  .itinerary-detailed-day { margin-bottom: 60px !important; padding-bottom: 60px; border-bottom: 1px solid var(--border-color); }
  .itinerary-detailed-day:last-child { border-bottom: none; }
  .day-header { display: flex; align-items: center; gap: 20px !important; margin-bottom: 30px !important; }
  .day-badge { background: #fff !important; color: var(--black) !important; width: 60px !important; height: 60px !important; border-radius: 0 !important; border: 2px solid var(--black) !important; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: bold; line-height: 1; flex-shrink: 0;}
  .day-badge span:first-child { font-size: 10px !important; letter-spacing: 1px; margin-bottom: 2px;}
  .day-badge span:last-child { font-size: 18px !important; }
  .day-header h2 { font-size: 22px !important; color: #000 !important; margin: 0 !important; font-weight: 700 !important; text-transform: uppercase; letter-spacing: 1px;}

  .gallery-block { margin-top: 40px !important; margin-bottom: 40px !important; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 40px 0; background: #f9fafb;}
  .gallery-scroll { display: flex; gap: 20px !important; overflow-x: auto; padding: 0 24px 20px !important; scrollbar-width: thin; scrollbar-color: var(--orange) var(--border-color);}
  .gallery-scroll img { height: 380px !important; width: 260px !important; object-fit: cover; border-radius: 0 !important; flex-shrink: 0; border: 1px solid var(--border-color); padding: 4px; background: #fff; }

  .important-notice { background: #fffaf5 !important; color: #9c4221 !important; padding: 24px !important; border: 1px solid #ffdbce; border-left: 4px solid var(--orange); border-radius: 0 !important; margin-bottom: 30px !important; }
  .important-notice .notice-title { display: flex; align-items: center; gap: 10px; font-weight: 800 !important; font-size: 14px !important; text-transform: uppercase; margin-bottom: 10px !important; letter-spacing: 1px;}
  .important-notice p { font-size: 14px !important; line-height: 1.6; margin: 0 0 10px !important; }
  .important-notice p:last-child { margin-bottom: 0 !important; }

  @media (max-width: 1100px) {
    .tour-content, .tour-page-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
  }

  .tour-editor-content { font-size: 15px !important; line-height: 1.8 !important; color: var(--gray-text) !important; font-weight: 300;}
  .tour-editor-content p { margin-bottom: 20px !important; }
  .tour-editor-content h2, .tour-editor-content h3, .tour-editor-content h4 { color: var(--black) !important; font-weight: 800 !important; margin-top: 40px !important; margin-bottom: 20px !important; line-height: 1.3 !important; text-transform: uppercase; letter-spacing: 1px;}
  .tour-editor-content h2 { font-size: 20px !important; padding-bottom: 12px !important; border-bottom: 1px solid var(--border-color) !important; }
  .tour-editor-content h3 { font-size: 16px !important; }
  .tour-editor-content strong, .tour-editor-content b { font-weight: 700 !important; color: var(--black) !important; }
  .tour-editor-content ul { list-style: none !important; padding-left: 0 !important; margin-bottom: 24px !important; }
  .tour-editor-content ul li { position: relative; padding-left: 24px !important; margin-bottom: 12px !important; }
  .tour-editor-content ul li::before { content: "" !important; position: absolute; left: 0; top: 10px !important; width: 6px; height: 6px; background: var(--orange) !important; border-radius: 0 !important; font-size:0 !important; }
  .tour-editor-content del, .tour-editor-content s, .tour-editor-content strike { color: #9ca3af !important; text-decoration: line-through; margin-right: 6px !important; }
  .tour-editor-content a { color: var(--orange) !important; text-decoration: none; font-weight: 600 !important; }
  .tour-editor-content a:hover { text-decoration: underline !important; }
</style>

<header class="tour-header" style="background-image: url('{{ $bg }}');">
  <div class="tour-header-overlay"></div>
  <div class="tour-header-inner">
    <div class="tour-header-text">
      <h1 class="tour-header-title">{{ html_entity_decode($title) }}</h1>
      @if($duration) <p class="tour-header-duration">{{ $duration }}</p> @endif
    </div>
  </div>
</header>

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
      @if($wetravel_id)
        <!-- Botón de WeTravel para el sidebar superior -->
        <a class="book-online wtrvl-checkout_button" id="wt_{{ $wetravel_id }}_top" href="https://www.wetravel.com/checkout_embed?uuid={{ $wetravel_id }}">Book Online</a>
      @else
        <!-- Botón clásico por si no hay ID configurado -->
        <a class="book-online" href="#booking">Book Online</a>
      @endif
      
      <a href="javascript:void(0);" onclick="document.getElementById('modal-enquire').classList.remove('hidden')" class="enquire">Enquire Now</a>
    </div>
    
    <p class="sidebar-help">Got questions? Reach out anytime via <strong>WhatsApp</strong>.</p>
  </aside>
</div>

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

<div id="mediaModal" class="media-modal">
  <div class="media-modal-content">
    <span class="media-modal-close">&times;</span>

    <video id="mediaVideo" controls style="display: none; width: 100%; height: 100%; outline: none;">
      Tu navegador no soporta videos HTML5.
    </video>

    <img id="mediaImage" src="" alt="Mapa del Tour" style="display: none; width: 100%; height: 100%; object-fit: contain; background: #fff;" />

  </div>
</div>

</div>

<div id="mediaModal" class="media-modal">
  <div class="media-modal-content">
    <span class="media-modal-close">&times;</span>
    <iframe id="mediaIframe" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>

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

<div class="tour-page-grid">

    <div class="tour-page-main">

        <div id="barra-flotante" class="sticky top-0 bg-white shadow-sm z-50 ...">
        </div>

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

        <div id="tab-inclusions" class="tab-pane" style="display:none;">

            <h2 class="section-heading">What's Included</h2>

            @if($inclusions)
                <div class="tour-editor-content">
                    {!! $inclusions !!}
                </div>
            @endif

        </div>

        <div id="tab-packing" class="tab-pane" style="display:none;">

            <h2 class="section-heading">Packing List</h2>

            @if($packing_list)
                <div class="tour-editor-content">
                    {!! $packing_list !!}
                </div>
            @endif

        </div>

        <div id="tab-pricing" class="tab-pane" style="display:none;">

            <h2 class="section-heading">Pricing & Dates</h2>

            @if($pricing)
                <div class="tour-editor-content">
                    {!! $pricing !!}
                </div>
            @endif

        </div>

    </div>
<aside class="tour-page-sidebar">

    <div class="booking-widget" style="position: sticky; top: 120px;">
      <div class="booking-header">Booking</div>

      @if(!$wetravel_id)
        <!-- Ocultamos el precio estático si WeTravel está activo, porque el widget ya trae sus propios precios -->
        <div class="booking-info">
          <h3 class="booking-title">{{ get_the_title() }}</h3>
          <div class="booking-price" id="total-price">US$350.00</div>
        </div>
      @endif

      <div class="booking-divider">Choose your travel date</div>

      <div class="booking-body" style="padding: 0;">

        @if($wetravel_id)
          
          <!-- CALENDARIO REAL DE WETRAVEL (INLINE) -->
          <iframe 
            src="https://www.wetravel.com/checkout_embed?uuid={{ $wetravel_id }}" 
            style="width: 100%; border: none; min-height: 850px;" 
            frameborder="0">
          </iframe>

        @else

          <!-- CALENDARIO DE RESPALDO (WHATSAPP) -->
          <div style="padding: 24px 20px;">
            <div class="booking-step">
              <span class="step-num">1</span> Select Date
            </div>

            <div class="calendar-mockup">
              <div class="cal-header">
                <span id="prev-month" style="cursor:pointer; padding: 0 10px; font-size: 16px;">&lt;</span>
                <span id="cal-month-year"></span>
                <span id="next-month" style="cursor:pointer; padding: 0 10px; font-size: 16px;">&gt;</span>
              </div>
              <div class="cal-grid" id="cal-grid">
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
                  <button type="button" class="pax-btn btn-minus">-</button>
                  <input type="text" class="pax-input" id="pax-count" value="1" readonly>
                  <button type="button" class="pax-btn btn-plus">+</button>
               </div>
            </div>

            <div style="margin-top: 30px; display: flex; flex-direction: column; gap: 12px;">
              <a href="#" id="btn-whatsapp" target="_blank" style="display: flex; align-items: center; justify-content: center; background: #25D366; color: #fff; padding: 14px; border-radius: 0px; font-weight: bold; text-decoration: none; font-size: 16px; transition: background 0.3s;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256" style="margin-right: 8px;"><path d="M187.58,144.84l-32-16a8,8,0,0,0-8,1.5l-19.24,16a80.38,80.38,0,0,1-40-40l16-19.24a8,8,0,0,0,1.5-8l-16-32a8,8,0,0,0-9.73-4.28C74.36,44.52,64,57.14,64,72a128.14,128.14,0,0,0,128,128c14.86,0,27.48-10.36,29.18-16.11A8,8,0,0,0,187.58,144.84Z"></path></svg>
                Book via WhatsApp
              </a>
            </div>
          </div>

        @endif

      </div>
    </div>
  </aside>

</div>
</div>
<div id="zona-ocultar-barra" style="position: relative; z-index: 1000; background-color: #ffffff;">
  @include('sections.faq')
  @include('sections.tours')
  @include('sections.destinations')
  @include('sections.quote')
</div>

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

            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(pane => {
              pane.style.display = 'none';
              pane.classList.remove('active');
            });

            this.classList.add('active');

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

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll('.tour-tab');
    const panes = document.querySelectorAll('.tab-pane');

    const contentContainer = document.querySelector('.tour-page-grid');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-target');

            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.style.display = 'none');

            this.classList.add('active');
            document.getElementById(targetId).style.display = 'block';

            // Si el usuario ya bajó de la zona de inicio, lo regresamos.
            if (contentContainer) {
                // Obtenemos la posición real del contenedor en el documento
                const elementTop = contentContainer.getBoundingClientRect().top + window.scrollY;

                // Le restamos 140px para compensar la altura de tu menú superior (header) y la propia barra sticky.
                const offsetPosition = elementTop - 140;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
});
</script>

@if($wetravel_id)
  <!-- WeTravel Script para el Pop-up -->
  <script src="https://cdn.wetravel.com/widgets/embed_checkout.js"></script>
@endif

@endsection