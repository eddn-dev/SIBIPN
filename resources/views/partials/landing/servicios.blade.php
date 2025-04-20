<section class="relative py-16 bg-ipn-gray-light">
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-12 lg:mb-16"> {{-- Aumentado mb --}}
            Servicios Bibliotecarios
        </h2>

        {{-- Grid ajustado a 3 columnas en lg para 6 elementos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">

            {{-- Servicio 1: Préstamo a Domicilio (Nuevo formato) --}}
            <div class="flex items-start gap-4 group">
                {{-- Icono --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                    {{-- Icono original: Bookmark Square --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25l-4.5 2.25V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                    </svg>
                </div>
                {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Préstamo a Domicilio</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Llévate libros y materiales a casa según tu categoría de usuario y las políticas vigentes.
                    </p>
                    <a href="/ayuda#prestamo" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Políticas &rarr;
                    </a>
                </div>
            </div>

            {{-- Servicio 2: Renovaciones en Línea (Nuevo formato) --}}
            <div class="flex items-start gap-4 group">
                 {{-- Icono --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                    {{-- Icono original: Arrow Path --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </div>
                 {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Renovaciones en Línea</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Extiende el periodo de tus préstamos fácilmente desde tu cuenta personal en "Mi SIBIPN".
                    </p>
                    <a href="/mi-sibipn/prestamos" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Ir a Mis Préstamos &rarr;
                    </a>
                </div>
            </div>

            {{-- Servicio 3: Préstamo Interbibliotecario (Nuevo formato) --}}
            <div class="flex items-start gap-4 group">
                 {{-- Icono --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                     {{-- Icono original: Arrows Pointing Out --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                    </svg>
                </div>
                 {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Préstamo Interbibliotecario</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Solicita materiales disponibles únicamente en otras bibliotecas de la red IPN o convenios externos.
                    </p>
                    <a href="/ayuda#interbibliotecario" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Cómo solicitar &rarr;
                    </a>
                </div>
            </div>

            {{-- Servicio 4: Cubículos de Estudio (Nuevo formato) --}}
            <div class="flex items-start gap-4 group">
                 {{-- Icono --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                    {{-- Icono original: Building Office 2 --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125h1.875m0-3.75h.375a2.25 2.25 0 0 1 2.25 2.25v1.5c0 .621-.504 1.125-1.125 1.125h-1.5m-1.125-3.75a3.375 3.375 0 0 0-3.375-3.375H7.5a3.375 3.375 0 0 0-3.375 3.375v1.5" />
                    </svg>
                </div>
                 {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Cubículos de Estudio</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Reserva espacios individuales o grupales para estudiar o trabajar en equipo dentro de las bibliotecas.
                    </p>
                    <a href="#" class="text-ipn-guinda hover:underline font-medium text-sm"> {{-- Actualizar href --}}
                        Ver disponibilidad &rarr;
                    </a>
                </div>
            </div>

            {{-- NUEVO Servicio 5: Pago de Multas en Línea --}}
            <div class="flex items-start gap-4 group">
                 {{-- Icono: Credit Card --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                </div>
                 {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Pago de Multas en Línea</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Realiza el pago de tus multas pendientes de forma rápida y segura a través de nuestro portal.
                    </p>
                    <a href="/mi-sibipn/multas" class="text-ipn-guinda hover:underline font-medium text-sm"> {{-- Ejemplo href --}}
                        Pagar ahora &rarr;
                    </a>
                </div>
            </div>

            {{-- NUEVO Servicio 6: Asesoría Especializada --}}
            <div class="flex items-start gap-4 group">
                 {{-- Icono: Academic Cap --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-guinda transition-colors duration-300 group-hover:text-ipn-guinda-light">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
                 {{-- Contenido Texto --}}
                <div class="flex-grow">
                    <h3 class="text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">Asesoría Especializada</h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Contacta a nuestros bibliotecarios referencistas para obtener ayuda personalizada en tus búsquedas de información.
                    </p>
                    <a href="/ayuda#asesoria" class="text-ipn-guinda hover:underline font-medium text-sm"> {{-- Ejemplo href --}}
                        Solicitar Ayuda &rarr;
                    </a>
                </div>
            </div>

        </div> {{-- Fin del grid --}}
    </div>
</section>