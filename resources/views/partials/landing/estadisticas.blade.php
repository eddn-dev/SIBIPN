<section
    id="stats"
    class="relative py-16 lg:py-24 bg-ipn-guinda text-white overflow-hidden"
>
    {{-- un suave degradado de fondo extra --}}
    <div
        class="absolute inset-0 pointer-events-none"
        style="background:radial-gradient(circle at top left,
        rgba(0,0,0,0.2), transparent 70%);"
    ></div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8">
        <h2
            class="text-3xl lg:text-4xl font-teko font-bold text-center mb-4"
        >
            SIBIPN en Números
        </h2>
        <p class="text-center text-ipn-gray-light mb-12 lg:mb-16"> {{-- Aumentado mb --}}
            Indicadores clave de nuestra plataforma y red de bibliotecas.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Stat 1: Recursos Disponibles --}}
            <div
                x-data="countUp(1_000_000,'M+')" x-intersect.once="start()"
                class="bg-ipn-guinda-dark bg-opacity-20 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center space-y-4 text-center" {{-- Aumentada opacidad y añadido text-center --}}
            >
                {{-- Icono Mejorado: Book Open (Heroicons) --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-gray-lighten opacity-90"> {{-- Ajustado tamaño y color --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                {{-- Contador --}}
                <div class="text-4xl lg:text-5xl font-teko font-bold" x-text="display"></div>
                {{-- Etiqueta --}}
                <p class="text-lg font-medium text-ipn-gray-lighten">Recursos Disponibles</p>
                {{-- Sparkline Eliminado --}}
            </div>

            {{-- Stat 2: Usuarios Activos --}}
            <div
                x-data="countUp(50_000,'K+')" x-intersect.once="start()"
                class="bg-ipn-guinda-dark bg-opacity-20 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center space-y-4 text-center"
            >
                {{-- Icono Mejorado: Users (Heroicons) --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-gray-lighten opacity-90">
                     <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-10.75 0a9.38 9.38 0 0 1 2.625-.372M12 11.25a5.25 5.25 0 0 1-5.25-.372M12 11.25a5.25 5.25 0 0 0 5.25-.372M12 11.25v9.75M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25a5.25 5.25 0 0 0-5.25-.372M12 11.25v9.75m0-9.75a5.25 5.25 0 0 0-5.25-.372M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25v9.75M7.875 15a9.375 9.375 0 0 0 8.25 0M12 21a9.375 9.375 0 0 0-8.25-6m16.5 0a9.375 9.375 0 0 0-8.25 6M12 3.75a3.75 3.75 0 0 0-3.75 3.75v1.125a3.75 3.75 0 0 0 3.75 3.75m0-8.625a3.75 3.75 0 0 1 3.75 3.75v1.125a3.75 3.75 0 0 1-3.75 3.75m0-8.625v8.625" />
                    </svg>
                </div>
                {{-- Contador --}}
                <div class="text-4xl lg:text-5xl font-teko font-bold" x-text="display"></div>
                 {{-- Etiqueta --}}
                <p class="text-lg font-medium text-ipn-gray-lighten">Usuarios Activos</p>
                 {{-- Sparkline Eliminado --}}
            </div>

            {{-- Stat 3: Bibliotecas Conectadas --}}
            <div
                x-data="countUp(20,'+')" x-intersect.once="start()" {{-- Ajustado el sufijo a '+' --}}
                class="bg-ipn-guinda-dark bg-opacity-20 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center space-y-4 text-center"
            >
                {{-- Icono Mejorado: Building Library (Heroicons) --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-gray-lighten opacity-90">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                    </svg>
                </div>
                {{-- Contador --}}
                <div class="text-4xl lg:text-5xl font-teko font-bold" x-text="display"></div>
                 {{-- Etiqueta --}}
                <p class="text-lg font-medium text-ipn-gray-lighten">Bibliotecas Conectadas</p>
                 {{-- Sparkline Eliminado --}}
            </div>

            {{-- Stat 4: Foros y Grupos --}}
            <div
                x-data="countUp(100,'+')" x-intersect.once="start()"
                class="bg-ipn-guinda-dark bg-opacity-20 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center space-y-4 text-center"
            >
                {{-- Icono Mejorado: Chat Bubble Left Right (Heroicons) --}}
                <div class="flex-shrink-0 w-12 h-12 text-ipn-gray-lighten opacity-90">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.091-3.091c-.94.043-1.872.043-2.805 0l-3.091 3.091v-3.091c-.34-.02-.68-.045-1.02-.072-.344-.027-.69-.053-1.034-.082A1.94 1.94 0 0 1 5.12 16.474v-4.286c0-.97.616-1.813 1.5-2.097M16.5 9.75V14.25M12 14.25v-4.5m3.75 4.5v-4.5m-7.5 4.5v-4.5M3 16.811V8.69c0-1.243.875-2.278 2.07-2.462a48.527 48.527 0 0 1 11.86 0c1.195.184 2.07 1.219 2.07 2.462v8.121c0 1.243-.875 2.278-2.07 2.462a48.331 48.331 0 0 1-11.86 0c-1.195-.184-2.07-1.219-2.07-2.462Z" />
                    </svg>
                </div>
                {{-- Contador --}}
                <div class="text-4xl lg:text-5xl font-teko font-bold" x-text="display"></div>
                 {{-- Etiqueta --}}
                <p class="text-lg font-medium text-ipn-gray-lighten">Foros y Grupos</p>
                 {{-- Sparkline Eliminado --}}
            </div>

        </div> {{-- Fin del grid --}}
    </div>
</section>

<script>
// Alpine.js component para contar hasta `target`
// suffix opcional: 'M+', 'K+', '+', etc.
function countUp(target, suffix = '') {
  return {
    count: 0,
    display: '0',
    start() {
      const steps = 60;
      const increment = target / steps;
      let i = 0;
      const timer = setInterval(() => {
        this.count = Math.min(target, this.count + increment);
        this.display =
          new Intl.NumberFormat('es-MX', {maximumFractionDigits:0})
            .format(Math.round(this.count)) + suffix;
        if (++i >= steps) clearInterval(timer);
      }, 20);
    },
  };
}
</script>