{{-- resources/views/partials/landing/parallax1.blade.php --}}
{{-- Aplicar un ID único a cada sección parallax para targeting específico si es necesario --}}
<section id="parallax-section-1" class="parallax-section relative h-[70vh] sm:h-[80vh] md:h-screen text-white overflow-hidden">
    {{-- Capa 1: Fondo Muy Lejano (Imagen Principal, movimiento más lento) --}}
    {{-- Usaremos un div interno para la imagen para poder aplicar transformaciones y parallax --}}
    <div class="parallax-bg-layer parallax-bg-main absolute inset-0 z-0 overflow-hidden">
        {{-- Imagen más alta que la sección y posicionada para cubrir --}}
        {{-- Ejemplo: Si la sección es 100vh, la imagen es 140vh y se desplaza -20vh inicialmente --}}
        {{-- Esto da 20vh de imagen extra arriba y 20vh extra abajo para el movimiento --}}
        <img src="{{ asset('images/parallax.jpg') }}"
             alt="[Imagen de fondo inspiradora sobre investigación y descubrimiento en el IPN]"
             class="absolute w-full h-[200] md:h-[200] top-[-20%] md:top-[-15%] left-0 object-cover">
    </div>

    {{-- Capa 2: Overlay de Color (Movimiento ligeramente diferente o estático respecto al fondo) --}}
    <div class="parallax-bg-layer parallax-overlay absolute inset-0 z-10 bg-ipn-guinda opacity-70"></div>

    {{-- Capa 3: Elementos Gráficos Sutiles (Opcional, para más profundidad) --}}
    {{-- Estos podrían ser SVGs o PNGs transparentes posicionados absolutamente --}}
    {{-- <div class="parallax-bg-layer parallax-graphics absolute inset-0 z-20 overflow-hidden">
        <svg class="graphic-element-1 absolute top-1/4 left-1/4 w-1/4 h-1/4 opacity-20 text-ipn-oro" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="40" />
        </svg>
        <svg class="graphic-element-2 absolute bottom-1/4 right-1/4 w-1/3 h-1/3 opacity-15 text-ipn-gray-light" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M0 50 L50 0 L100 50 L50 100 Z" />
        </svg>
    </div> --}}

    {{-- Capa 4: Contenido de Texto (Centrado y encima de todo) --}}
    <div class="parallax-content-container container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center h-full relative z-30">
        <div class="text-center max-w-3xl">
            {{-- El texto se dividirá en palabras o líneas para la animación --}}
            <h3 class="parallax-text text-3xl lg:text-4xl xl:text-5xl font-roboto font-semibold">
                {{-- Ejemplo para parallax1.blade.php --}}
                {{-- Cada palabra en un span para animación individual --}}
                <span>Impulsando</span> <span>la</span> <span>investigación</span> <span>y</span> <span>el</span> <span>descubrimiento</span> <span>en</span> <span>el</span> <span>Instituto</span> <span>Politécnico</span> <span>Nacional.</span>
            </h3>
        </div>
    </div>
</section>
