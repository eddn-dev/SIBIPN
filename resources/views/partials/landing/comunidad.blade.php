<section class="relative separator-sup-der -mt-20 py-16 lg:py-24 bg-ipn-guinda text-white overflow-hidden">
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Bloque 1: Texto Izquierda | Imagen Derecha --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Columna Izquierda: Texto Descriptivo --}}
            <div class="text-left md:order-1"> {{-- Orden explícito para claridad --}}
                {{-- Título de la sección --}}
                <h2 class="text-4xl lg:text-5xl font-teko font-bold mb-6 leading-tight">
                    Más que una Biblioteca: Una Comunidad Politécnica
                </h2>

                {{-- Párrafo descriptivo --}}
                <p class="text-lg sm:text-xl mb-8 text-ipn-gray-lighten max-w-xl">
                    SIBIPN es tu espacio para conectar, compartir y crecer. Participa en foros de discusión, descubre recursos compartidos por compañeros y únete a grupos de estudio para alcanzar tus metas académicas.
                </p>

                {{-- Lista de características clave --}}
                <div class="space-y-4 mb-10">
                    {{-- Característica 1: Foros --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.091-3.091c-.94.043-1.872.043-2.805 0l-3.091 3.091v-3.091c-.34-.02-.68-.045-1.02-.072-.344-.027-.69-.053-1.034-.082A1.94 1.94 0 0 1 5.12 16.474v-4.286c0-.97.616-1.813 1.5-2.097M16.5 9.75V14.25M12 14.25v-4.5m3.75 4.5v-4.5m-7.5 4.5v-4.5M3 16.811V8.69c0-1.243.875-2.278 2.07-2.462a48.527 48.527 0 0 1 11.86 0c1.195.184 2.07 1.219 2.07 2.462v8.121c0 1.243-.875 2.278-2.07 2.462a48.331 48.331 0 0 1-11.86 0c-1.195-.184-2.07-1.219-2.07-2.462Z" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Foros temáticos y de ayuda mutua.</span>
                    </div>
                    {{-- Característica 2: Compartir --}}
                    <div class="flex items-center gap-3">
                         <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Intercambio de apuntes, guías y recursos.</span>
                    </div>
                     {{-- Característica 3: Colaboración --}}
                    <div class="flex items-center gap-3">
                         <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-10.75 0a9.38 9.38 0 0 1 2.625-.372M12 11.25a5.25 5.25 0 0 1-5.25-.372M12 11.25a5.25 5.25 0 0 0 5.25-.372M12 11.25v9.75M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25a5.25 5.25 0 0 0-5.25-.372M12 11.25v9.75m0-9.75a5.25 5.25 0 0 0-5.25-.372M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25v9.75M7.875 15a9.375 9.375 0 0 0 8.25 0M12 21a9.375 9.375 0 0 0-8.25-6m16.5 0a9.375 9.375 0 0 0-8.25 6M12 3.75a3.75 3.75 0 0 0-3.75 3.75v1.125a3.75 3.75 0 0 0 3.75 3.75m0-8.625a3.75 3.75 0 0 1 3.75 3.75v1.125a3.75 3.75 0 0 1-3.75 3.75m0-8.625v8.625" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Creación de grupos de estudio y proyectos.</span>
                    </div>
                </div>
                {{-- Botón Opcional --}}
                {{-- <x-button.secondary href="/comunidad" class="text-lg">
                    Explorar Comunidad &rarr;
                </x-button.secondary> --}}
            </div>

            {{-- Columna Derecha: Elemento Visual --}}
            <div class="flex justify-center items-center md:justify-end md:order-2"> {{-- Orden explícito para claridad --}}
                <img src="https://placehold.co/600x500/7A2A4D/FFFFFF?text=Comunidad+Conectada"
                     alt="Ilustración de la comunidad SIBIPN conectada"
                     class="rounded-xl shadow-2xl object-cover w-full max-w-md lg:max-w-lg aspect-[6/5]"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x500/7A2A4D/FFFFFF?text=Error+Cargando+Imagen';"
                     loading="lazy">
            </div>

        </div> {{-- Fin del primer grid --}}

        {{-- Separador Vertical entre bloques --}}
        <div class="my-16 lg:my-24 border-t border-ipn-guinda-light opacity-30"></div>

        {{-- Bloque 2: Imagen Izquierda | Texto Derecha --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Columna Izquierda: Elemento Visual --}}
            <div class="flex justify-center items-center md:justify-start md:order-1"> {{-- Imagen primero en este bloque --}}
                <img src="https://placehold.co/600x500/E5A5C1/3E0D25?text=Colaboración+Estudiantil" {{-- Nueva imagen --}}
                     alt="Estudiantes colaborando en SIBIPN"
                     class="rounded-xl shadow-2xl object-cover w-full max-w-md lg:max-w-lg aspect-[6/5]"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x500/E5A5C1/3E0D25?text=Error+Cargando+Imagen';"
                     loading="lazy">
            </div>

             {{-- Columna Derecha: Texto Descriptivo --}}
            <div class="text-left md:order-2"> {{-- Texto segundo en este bloque --}}
                {{-- Título secundario (h3) --}}
                <h3 class="text-3xl lg:text-4xl font-teko font-bold mb-6 leading-tight">
                    Construye Conocimiento en Conjunto
                </h3>

                {{-- Párrafo descriptivo --}}
                <p class="text-lg sm:text-xl mb-8 text-ipn-gray-lighten max-w-xl">
                    Encuentra compañeros con intereses similares, forma equipos para tus proyectos, comparte tus dudas y ofrece tu experiencia. La colaboración es clave en el aprendizaje politécnico.
                </p>

                {{-- Otra lista de características o beneficios --}}
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                            {{-- Icono: Light Bulb --}}
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.355a7.5 7.5 0 0 1-3 0m3 0a7.5 7.5 0 0 0-3 0m.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Genera ideas y soluciones innovadoras.</span>
                    </div>
                    <div class="flex items-center gap-3">
                         <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                             {{-- Icono: Presentation Chart Line --}}
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9H7.5M16.5 7.5h-1.875a48.47 48.47 0 0 0-4.125 0c-1.571 0-2.875-.994-3.75-2.25m9.75 2.25c.875 1.256 2.179 2.25 3.75 2.25M9 18h6" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Presenta y discute avances de proyectos.</span>
                    </div>
                    <div class="flex items-center gap-3">
                         <div class="flex-shrink-0 w-6 h-6 text-ipn-gray-lighten opacity-90">
                            {{-- Icono: Academic Cap --}}
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                        </div>
                        <span class="text-lg text-ipn-gray-lighten">Recibe apoyo y tutoría de compañeros.</span>
                    </div>
                </div>
                 {{-- Botón Opcional --}}
                {{-- <x-button.secondary href="/grupos" class="text-lg">
                    Buscar Grupos &rarr;
                </x-button.secondary> --}}
            </div>

        </div> {{-- Fin del segundo grid --}}

    </div>
</section>