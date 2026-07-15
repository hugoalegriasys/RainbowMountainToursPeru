{{-- Template Name: Plantilla - About Us --}}

@extends('layouts.app')

@section('content')

@php
    $titulo      = get_field('about_titulo') ?: get_the_title();
    $descripcion = get_field('about_descripcion') ?: '';
    $imagen      = get_field('about_imagen');

    // Imagen del Hero desde ACF
    $hero = get_field('fondo_img');

    if (!empty($hero)) {
        $hero_bg = is_array($hero) ? $hero['url'] : $hero;
    } else {
        // Si no existe, usa la imagen destacada
        $hero_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }

    // Imagen lateral
    if (!empty($imagen)) {
        $img_url = is_array($imagen) ? $imagen['url'] : $imagen;
    } else {
        $img_url = '';
    }
@endphp


<!-- ========================= -->
<!-- HERO -->
<!-- ========================= -->

<section
    class="relative h-[60vh] pt-[170px] flex items-center justify-center bg-cover bg-center"
    style="
        background-image:
        linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
        url('{{ $hero_bg }}');
    ">

    <div class="text-center px-6">

        <h1 class="text-white text-5xl md:text-6xl font-bold uppercase tracking-wider">
            {{ $titulo }}
        </h1>

    </div>

</section>


<!-- ========================= -->
<!-- ABOUT CONTENT -->
<!-- ========================= -->

<section class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            <!-- TEXTO -->

            <div
                class="text-[16px] text-[#555] leading-8

                [&>h2]:text-[34px]
                [&>h2]:font-bold
                [&>h2]:text-[#1f2937]
                [&>h2]:mb-6

                [&>h3]:text-[24px]
                [&>h3]:font-semibold
                [&>h3]:mt-10
                [&>h3]:mb-5
                [&>h3]:text-[#1f2937]

                [&>p]:mb-6

                [&>ul]:space-y-3
                [&>ul]:mb-8

                [&>ul>li]:relative
                [&>ul>li]:pl-8

                [&>ul>li::before]:content-['✓']
                [&>ul>li::before]:absolute
                [&>ul>li::before]:left-0
                [&>ul>li::before]:text-[#db5f15]
                [&>ul>li::before]:font-bold

            ">

                {!! $descripcion !!}

            </div>


            <!-- IMAGEN -->

            <div class="lg:sticky lg:top-32">

                @if($img_url)

                    <img
                        src="{{ $img_url }}"
                        alt="{{ $titulo }}"
                        class="w-full rounded-2xl shadow-2xl object-cover">

                @endif

            </div>

        </div>

    </div>

</section>

@endsection