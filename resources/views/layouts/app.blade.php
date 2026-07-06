<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content', 'sage') }}
      </a>

      @include('sections.header')

      <main id="main" class="main">
        @yield('content')
      </main>


  @php(do_action('get_footer'))
  @include('sections.footer')
</body>

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())

    <div class="bg-red-500 text-white p-8 mt-10 rounded-xl shadow-lg text-center">
    <h2 class="text-4xl font-bold">
        ¡Hola Vite! 🚀 El HMR está funcionando.
    </h2>
    <p class="mt-4 text-red-100">
        Si cambio bg-red-500 a bg-green-500 en mi editor, esto cambiará de color instantáneamente.
    </p>
</div>
  </body>
</html>
