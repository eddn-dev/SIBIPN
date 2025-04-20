<section class="relative py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-4">
            Recursos Destacados
        </h2>
        {{-- Párrafo alineado a la izquierda y sin margen automático horizontal --}}
        <p class="text-left text-lg text-ipn-gray-dark max-w-3xl mb-12 lg:mb-16"> {{-- Incrementado max-w ligeramente para texto a la izquierda --}}
            Accede rápidamente a las herramientas y colecciones esenciales que el SIBIPN pone a tu disposición para potenciar tu investigación y aprendizaje.
        </p>

        {{-- Grid con las nuevas tarjetas y disposición asimétrica --}}
        {{-- Default: 1 columna. A partir de 'md': 3 columnas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

            {{-- Tarjeta 1: Catálogo en Línea (Ocupa 1 columna en md+) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-1">
                {{-- Fondo Placeholder --}}
                <div class="absolute inset-0 bg-ipn-guinda-desat transition-transform duration-300 ease-in-out group-hover:scale-105"></div>
                {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white">
                    <h3 class="text-xl font-roboto font-semibold mb-2">Catálogo en Línea</h3>
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Accede a millones de registros bibliográficos de todas las bibliotecas de la red politécnica. Tu punto de partida para encontrar libros, revistas y más.
                    </p>
                    <a href="/buscar" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Explorar Catálogo &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 2: Biblioteca Digital (Ocupa 2 columnas en md+) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-2">
                {{-- Fondo Placeholder --}}
                <div class="absolute inset-0 bg-ipn-guinda-light transition-transform duration-300 ease-in-out group-hover:scale-105"></div>
                {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white">
                    <h3 class="text-xl font-roboto font-semibold mb-2">Biblioteca Digital</h3>
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Consulta miles de libros electrónicos, artículos de bases de datos especializadas y revistas científicas suscritas por el IPN, disponibles 24/7.
                    </p>
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Acceder Ahora &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 3: Repositorio Institucional (Ocupa 2 columnas en md+) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-2">
                {{-- Fondo Placeholder --}}
                <div class="absolute inset-0 bg-ipn-gray-dark transition-transform duration-300 ease-in-out group-hover:scale-105"></div>
                {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white">
                    <h3 class="text-xl font-roboto font-semibold mb-2">Repositorio Institucional</h3>
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Encuentra tesis doctorales, trabajos de grado, artículos de investigación y toda la producción científica y académica generada en el IPN.
                    </p>
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Consultar Repositorio &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 4: Guías y Tutoriales (Ocupa 1 columna en md+) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-1">
                {{-- Fondo Placeholder --}}
                <div class="absolute inset-0 bg-ipn-gray transition-transform duration-300 ease-in-out group-hover:scale-105"></div>
                {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white">
                    <h3 class="text-xl font-roboto font-semibold mb-2">Guías y Tutoriales</h3>
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Aprende a sacar el máximo provecho de las bases de datos, gestores bibliográficos como Zotero o Mendeley, y otras herramientas clave.
                    </p>
                    <a href="/aprende" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Ver Guías &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>