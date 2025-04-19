{{-- resources/views/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'SIBIPN')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('head')
</head>
<body class="relative min-h-screen bg-ipn-gray-light flex flex-col">

  {{-- Flecha para volver al inicio --}}
  <div class="absolute top-4 left-4 z-50">
    <a href="{{ url('/') }}" class="inline-flex items-center text-ipn-gray hover:text-ipn-gray-light transition-colors">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 19l-7-7 7-7" />
      </svg>
      <span class="ml-2 font-medium">Volver al inicio</span>
    </a>
  </div>

  <main class="flex-grow">
    @yield('content')
  </main>

  <x-layout.footer />
</body>
</html>
