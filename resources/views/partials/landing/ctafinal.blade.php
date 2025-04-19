
<section class="relative text-white separator-sup-der-dark
         bg-ipn-guinda-dark py-2 lg:py-4 ">
    {{-- Fondo de la sección --}}
    {{-- Opcional: Añadir un sutil patrón de fondo si se desea --}}
    {{-- <div class="absolute inset-0 bg-[url('path/to/subtle-pattern.svg')] opacity-5"></div> --}}

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10">
        {{-- Grid principal: 1 columna en móvil, 2 en md+ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Columna Izquierda: Elemento Gráfico --}}
            <div class="flex justify-center items-center">
                {{-- Placeholder SVG: Representación abstracta de red/conocimiento --}}
                {{-- Puedes reemplazar esto con tu logo o una imagen más elaborada --}}
                <svg class="w-64 h-64 lg:w-80 lg:h-80 text-ipn-gray-light opacity-80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <radialGradient id="grad1" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
                            <stop offset="0%" style="stop-color:var(--color-ipn-gray-lighten, #e5a5c1); stop-opacity:0.5"/>
                            <stop offset="100%" style="stop-color:var(--color-ipn-guinda-light, #7A2A4D); stop-opacity:0.1"/>
                        </radialGradient>
                        <filter id="blur1">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="1" />
                        </filter>
                    </defs>
                    {{-- Círculo exterior con gradiente y blur suave --}}
                    <circle cx="50" cy="50" r="45" fill="url(#grad1)" filter="url(#blur1)"/>

                    {{-- Elementos centrales simulando conexión/logo abstracto --}}
                    <path d="M50 30 Q 65 40, 50 50 Q 35 60, 50 70 Q 65 60, 50 50 Q 35 40, 50 30 Z" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.7">
                        <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="20s" repeatCount="indefinite"/>
                    </path>
                    <circle cx="50" cy="50" r="10" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.5"/>
                    <circle cx="50" cy="50" r="5" fill="var(--color-ipn-gray-lighten, #e5a5c1)"/>

                    {{-- Puntos conectados (simplificado) --}}
                    <circle cx="30" cy="35" r="3" fill="var(--color-ipn-gray-lighten, #e5a5c1)" opacity="0.6"/>
                    <circle cx="70" cy="35" r="3" fill="var(--color-ipn-gray-lighten, #e5a5c1)" opacity="0.6"/>
                    <circle cx="30" cy="65" r="3" fill="var(--color-ipn-gray-lighten, #e5a5c1)" opacity="0.6"/>
                    <circle cx="70" cy="65" r="3" fill="var(--color-ipn-gray-lighten, #e5a5c1)" opacity="0.6"/>
                    <line x1="50" y1="50" x2="30" y2="35" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="0.5" opacity="0.3"/>
                    <line x1="50" y1="50" x2="70" y2="35" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="0.5" opacity="0.3"/>
                    <line x1="50" y1="50" x2="30" y2="65" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="0.5" opacity="0.3"/>
                    <line x1="50" y1="50" x2="70" y2="65" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="0.5" opacity="0.3"/>
                </svg>
            </div>

            {{-- Columna Derecha: Texto y Botones --}}
            <div class="text-center md:text-left">
                {{-- Título (más grande) --}}
                <h2 class="text-4xl lg:text-5xl xl:text-6xl font-teko font-bold mb-6 leading-tight">
                    Únete a la Comunidad SIBIPN
                </h2>
                {{-- Párrafo descriptivo --}}
                <p class="text-lg sm:text-xl mb-10 max-w-lg mx-auto md:mx-0 text-ipn-gray-light">
                    Regístrate o inicia sesión para acceder a todos los servicios personalizados, guardar tus búsquedas y gestionar tus préstamos fácilmente.
                </p>
                {{-- Contenedor de botones --}}
                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                    {{-- Botón Primario (Iniciar Sesión) --}}
                    {{-- El componente x-button.primary debería tener estilos que resalten sobre fondo oscuro --}}
                    {{-- Puedes añadir clases extra si es necesario: class="w-full sm:w-auto text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300" --}}
                    <x-button.primary href="{{ route('login') }}" class="w-full sm:w-auto text-lg px-8 py-3">
                        Iniciar Sesión
                    </x-button.primary>
                </div>
            </div>

        </div>
    </div>
</section>