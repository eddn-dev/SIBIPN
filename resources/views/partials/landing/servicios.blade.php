{{-- resources/views/partials/landing/servicios.blade.php --}}
<section id="servicios-section" class="relative py-16 bg-ipn-gray-light">
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-12 lg:mb-16">
            Servicios Bibliotecarios
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">

            {{-- Servicio 1: Préstamo a Domicilio --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-domicile"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Préstamo a Domicilio
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Llévate libros y materiales a casa según tu categoría de usuario y las políticas vigentes.
                    </p>
                    <a href="/ayuda#prestamo" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Políticas <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Servicio 2: Renovaciones en Línea --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-return"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Renovaciones en Línea
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Extiende el periodo de tus préstamos fácilmente desde tu cuenta personal en "Mi SIBIPN".
                    </p>
                    <a href="/mi-sibipn/prestamos" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Ir a Mis Préstamos <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Servicio 3: Préstamo Interbibliotecario --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-location"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Préstamo Interbibliotecario
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Solicita materiales disponibles únicamente en otras bibliotecas de la red IPN o convenios externos.
                    </p>
                    <a href="/ayuda#interbibliotecario" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Cómo solicitar <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Servicio 4: Cubículos de Estudio --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-study"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Cubículos de Estudio
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Reserva espacios individuales o grupales para estudiar o trabajar en equipo dentro de las bibliotecas.
                    </p>
                    <a href="#" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Ver disponibilidad <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Servicio 5: Pago de Multas en Línea --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-card"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Pago de Multas en Línea
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Realiza el pago de tus multas pendientes de forma rápida y segura a través de nuestro portal.
                    </p>
                    <a href="/mi-sibipn/multas" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Pagar ahora <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Servicio 6: Asesoría Especializada --}}
            <div class="service-item flex items-start gap-4 group">
                <div class="service-icon-container flex-shrink-0 w-12 h-12 text-ipn-guinda">
                    <svg class="service-icon-svg w-full h-full" aria-hidden="true">
                        <use xlink:href="#icon-graduation-cap"></use>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="service-title text-xl font-roboto font-semibold mb-1 text-ipn-gray-dark">
                        Asesoría Especializada
                    </h3>
                    <p class="text-ipn-gray font-sans text-sm mb-2">
                        Contacta a nuestros bibliotecarios referencistas para obtener ayuda personalizada en tus búsquedas de información.
                    </p>
                    <a href="/ayuda#asesoria" class="text-ipn-guinda hover:underline font-medium text-sm">
                        Solicitar Ayuda <span class="service-arrow inline-block">&rarr;</span>
                    </a>
                </div>
            </div>

        </div> {{-- Fin del grid --}}
    </div>
</section>
