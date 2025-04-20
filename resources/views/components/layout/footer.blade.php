{{-- resources/views/components/layout/footer.blade.php --}}
<footer class="relative ">

    {{-- Footer 1: Footer del Sitio (Estilo oscuro - Gris Oscuro IPN) --}}
    {{-- Fondo cambiado a bg-ipn-gray-dark --}}
    <div class="relative separator-sup-der-dark bg-ipn-guinda-dark text-gray-300 py-12">
        {{-- Contenedor y Grid estandarizados --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Col 1: Logos y Redes --}}
                <div>
                    {{-- Logos SIBIPN e IPN insertados --}}
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo_sibipn_blanco.svg') }}" alt="Logotipo SIBIPN" class="h-10 w-auto mr-3"> {{-- Logo SIB --}}
                        <img src="{{ asset('images/logo_ipn.svg') }}" alt="Logotipo IPN" class="h-10 w-auto"> {{-- Logo IPN --}}
                        {{-- <span class="text-lg font-semibold text-white font-roboto ml-2">SIBIPN</span> --}} {{-- Texto opcional --}}
                    </div>
                    <p class="text-sm text-gray-400 mb-4">&copy; {{ date('Y') }} Instituto Politécnico Nacional.<br>Todos los derechos reservados.</p> {{-- Texto copyright ajustado --}}
                    {{-- Redes Sociales (iconos placeholder, reemplazar si es necesario) --}}
                    <div class="flex space-x-4">
                        <a href="#" aria-label="Facebook" class="text-gray-400 hover:text-white transition duration-200">
                            {{-- Icono Facebook (Ejemplo) --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="text-gray-400 hover:text-white transition duration-200">
                             {{-- Icono Twitter (Ejemplo) --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" /></svg>
                        </a>
                        {{-- Añadir más redes si es necesario --}}
                    </div>
                </div>

                {{-- Col 2: Enlaces Rápidos --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 font-roboto">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition duration-200">Inicio</a></li>
                        <li><a href="/buscar" class="hover:text-white transition duration-200">Buscar</a></li>
                        <li><a href="/aprende" class="hover:text-white transition duration-200">Aprende</a></li>
                        <li><a href="/comunidad" class="hover:text-white transition duration-200">Comunidad</a></li>
                        <li><a href="/ayuda#faq" class="hover:text-white transition duration-200">FAQ</a></li> {{-- Enlace más específico a FAQ --}}
                    </ul>
                </div>

                {{-- Col 3: Ayuda y Legal --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 font-roboto">Ayuda y Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/ayuda" class="hover:text-white transition duration-200">Ayuda y Soporte</a></li>
                        <li><a href="/privacidad" class="hover:text-white transition duration-200">Aviso de Privacidad</a></li> {{-- Nombre más común --}}
                        <li><a href="/terminos" class="hover:text-white transition duration-200">Términos de Uso</a></li>
                        <li><a href="/mapa-sitio" class="hover:text-white transition duration-200">Mapa del Sitio</a></li>
                    </ul>
                </div>

                {{-- Col 4: Recursos IPN --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 font-roboto">Recursos IPN</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://www.ipn.mx" target="_blank" rel="noopener noreferrer" class="hover:text-white transition duration-200">Portal IPN</a></li>
                        <li><a href="https://www.ipn.mx/biblioteca/" target="_blank" rel="noopener noreferrer" class="hover:text-white transition duration-200">Bibliotecas IPN (Oficial)</a></li>
                        <li><a href="https://www.saes.ipn.mx/" target="_blank" rel="noopener noreferrer" class="hover:text-white transition duration-200">SAES</a></li>
                        <li><a href="https://www.ipn.mx/correo/" target="_blank" rel="noopener noreferrer" class="hover:text-white transition duration-200">Correo Institucional</a></li>
                         <li><a href="https://www.ipn.mx/dcyc/" target="_blank" rel="noopener noreferrer" class="hover:text-white transition duration-200">DCyC</a></li> {{-- Añadido DCyC --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="relative separator-sup-der-dark bg-ipn-guinda text-white pt-12">
         {{-- Contenedor y Grid estandarizados --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            {{-- Grid estandarizado --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                {{-- Col 1: Logo Gobierno --}}
                <div class="flex items-center sm:items-start justify-center sm:justify-start"> {{-- Alineación ajustada --}}
                    {{-- Usar asset() para el logo del gobierno también --}}
                    <img src="{{ asset('images/logo_blanco.svg') }}" alt="Logo Gobierno de México" class="w-32 h-auto" {{-- Tamaño ajustado --}}
                         onerror="this.alt='Logo Gobierno de México'; this.style.display='block';">
                </div>

                {{-- Col 2: Enlaces Gobierno --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3 font-roboto">Enlaces</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://www.gob.mx/participa" target="_blank" rel="noopener noreferrer" class="hover:underline">Participa</a></li>
                        <li><a href="https://www.gob.mx/publicaciones" target="_blank" rel="noopener noreferrer" class="hover:underline">Publicaciones Oficiales</a></li> {{-- Enlace actualizado --}}
                        <li><a href="https://www.plataformadetransparencia.org.mx/" target="_blank" rel="noopener noreferrer" class="hover:underline">Plataforma Nacional de Transparencia</a></li>
                        <li><a href="https://alertadores.funcionpublica.gob.mx/" target="_blank" rel="noopener noreferrer" class="hover:underline">Alerta</a></li>
                        <li><a href="https://sidec.funcionpublica.gob.mx/" target="_blank" rel="noopener noreferrer" class="hover:underline">Denuncia</a></li>
                    </ul>
                </div>

                {{-- Col 3: Qué es gob.mx --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3 font-roboto">¿Qué es gob.mx?</h3>
                    <p class="text-sm mb-2">Es el portal único de trámites, información y participación ciudadana. <a href="https://www.gob.mx/que-es-gobmx" target="_blank" rel="noopener noreferrer" class="hover:underline">Leer más</a></p>
                    <ul class="space-y-2 text-sm mt-4">
                        <li><a href="https://datos.gob.mx" target="_blank" rel="noopener noreferrer" class="hover:underline">Portal de datos abiertos</a></li>
                        <li><a href="https://www.gob.mx/accesibilidad" target="_blank" rel="noopener noreferrer" class="hover:underline">Declaración de accesibilidad</a></li>
                        <li><a href="https://www.gob.mx/privacidadintegral" target="_blank" rel="noopener noreferrer" class="hover:underline">Aviso de privacidad integral</a></li> {{-- Actualizado --}}
                        <li><a href="https://www.gob.mx/privacidadsimplificado" target="_blank" rel="noopener noreferrer" class="hover:underline">Aviso de privacidad simplificado</a></li> {{-- Actualizado --}}
                        <li><a href="https://www.gob.mx/terminos" target="_blank" rel="noopener noreferrer" class="hover:underline">Términos y Condiciones</a></li>
                        <li><a href="https://www.gob.mx/terminos#medidas-seguridad" target="_blank" rel="noopener noreferrer" class="hover:underline">Política de seguridad</a></li>
                        <li><a href="https://www.gob.mx/sitemap" target="_blank" rel="noopener noreferrer" class="hover:underline">Mapa de sitio</a></li>
                    </ul>
                </div>

                {{-- Col 4: Denuncia y Redes --}}
                <div>
                    <h3 class="text-lg font-semibold mb-3 font-roboto"><a href="https://www.gob.mx/tramites/ficha/presentacion-de-denuncias-contra-servidores-publicos/SFP5411" target="_blank" rel="noopener noreferrer" class="hover:underline">Denuncia contra servidores públicos</a></h3>
                    <h3 class="text-lg font-semibold mb-3 mt-4 font-roboto">Síguenos en</h3>
                    {{-- Redes Sociales Gobierno (iconos placeholder) --}}
                    <div class="flex space-x-4">
                         <a href="https://www.facebook.com/gobmexico" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="text-white hover:opacity-80 transition-opacity duration-200">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                         </a>
                         <a href="https://twitter.com/GobiernoMX" target="_blank" rel="noopener noreferrer" aria-label="Twitter" class="text-white hover:opacity-80 transition-opacity duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" /></svg>
                         </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative separator-sup-der w-full h-auto">
            <img src="{{ asset('images/pleca.svg') }}" alt="Imagen decorativa Pleca Gubernamental" class="w-full h-auto object-cover"
                 onerror="this.style.display='none'; document.getElementById('pleca-fallback-footer').style.display='block'; console.error('Error al cargar pleca.svg')">
            <div class="h-2 bg-gradient-to-r from-red-700 via-green-700 to-purple-800 w-full" style="display: none;" id="pleca-fallback-footer"></div>
        </div>
    </div>
</footer>