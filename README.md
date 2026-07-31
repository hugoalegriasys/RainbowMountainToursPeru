# mi-tema

Tema de WordPress para un sitio de viajes, construido sobre [Sage](https://roots.io/sage/) 11 con Laravel Blade, Tailwind CSS y Vite.

## Características

- Plantillas Blade con herencia de layouts y secciones reutilizables.
- Estilos con Tailwind CSS (v4) y flujo de desarrollo con Vite (hot-reload y build).
- Alpine.js para interactividad ligera en el front-end.
- Integración con ACF (Advanced Custom Fields) para el contenido editable de cada página.
- Contact Form 7 en el formulario de contacto.
- Polylang para versiones ES/EN en títulos, subtítulos y textos fijos.
- Widget de reservas con calendario dinámico y botón de WhatsApp en la plantilla de tour.

## Plantillas

| Plantilla | Archivo | Uso |
|---|---|---|
| About Us | `resources/views/template-about.blade.php` | Página de presentación: misión, visión, compromiso, premios y destinos. |
| Contact Us | `resources/views/template-contact.blade.php` | Tarjetas de contacto, formulario CF7, mapa y FAQ. |
| Plantilla Tour | `resources/views/template-tour.blade.php` | Ficha de tour: héroe, facts bar, galería, itinerario, pestañas y reserva. |
| Travel Guide | `resources/views/template-rainbow-guide.blade.php` | Guía de la Montaña de Colores con secciones bilingües. |
| Custom | `resources/views/template-custom.blade.php` | Plantilla base personalizada. |

## Estructura

```
app/                 Lógica PHP (Composers, filters, setup).
resources/views/     Vistas Blade.
  layouts/           Layout base.
  partials/          Componentes reutilizables.
  sections/          Secciones (header, hero, stats, tours, footer…).
resources/css/       Estilos Tailwind / CSS.
resources/js/        Scripts de entrada (app, editor).
public/build/        Build de producción (generado).
```

## Desarrollo

```bash
npm install
npm run dev      # desarrollo con hot-reload
npm run build    # build de producción
```

Requisitos: PHP 8.2+, WordPress 6.6+ y [Acorn](https://github.com/roots/acorn) instalado vía Composer.

## Ajustes aplicados

- **Heredoc**: sin sintaxis heredoc (`<<<`) en vistas ni en `app/`; se usa interpolación Blade.
- **Comentarios Blade**: los comentarios internos usan `{{-- --}}` (no se renderizan al navegador); se eliminaron comentarios numerados, instructivos y de prueba.
- **Indentación**: normalizada según `.editorconfig` (2 espacios en Blade, 4 en PHP, LF, UTF-8 sin BOM), incluidos el índice y los bloques tipográficos.
- **README**: se reemplazó el README por defecto de Sage por esta documentación y se añadió `README.txt` en formato del repositorio de temas de WordPress.
