<section class="relative text-white separator-sup-der-dark
        bg-ipn-guinda-dark py-2 lg:py-4 ">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Columna Izquierda: Elemento Gráfico de Red Neuronal Tecnológica Avanzada --}}
            <div class="flex justify-center items-center">
                <svg class="w-80 h-80 lg:w-[420px] lg:h-[420px] text-ipn-gray-light opacity-95" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        {{-- Gradientes para Nodos y Efectos --}}
                        <radialGradient id="core_emitter_grad" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" style="stop-color:var(--color-ipn-gray-lighten, #e5a5c1); stop-opacity:1"/>
                            <stop offset="70%" style="stop-color:var(--color-ipn-guinda-light, #7A2A4D); stop-opacity:0.8"/>
                            <stop offset="100%" style="stop-color:var(--color-ipn-guinda-dark, #401527); stop-opacity:0.5"/>
                        </radialGradient>
                        <radialGradient id="node_processing_glow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" style="stop-color:var(--color-ipn-gray-lighten, #e5a5c1); stop-opacity:0.9"/>
                            <stop offset="100%" style="stop-color:var(--color-ipn-guinda-light, #7A2A4D); stop-opacity:0"/>
                        </radialGradient>
                        <linearGradient id="cable_energy_flow" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:var(--color-ipn-guinda-light, #7A2A4D); stop-opacity:0.1">
                                <animate attributeName="offset" values="-1;2" dur="1.5s" repeatCount="indefinite"/>
                            </stop>
                            <stop offset="50%" style="stop-color:var(--color-ipn-gray-lighten, #e5a5c1); stop-opacity:0.8">
                                <animate attributeName="offset" values="-0.5;1.5" dur="1.5s" repeatCount="indefinite"/>
                            </stop>
                            <stop offset="100%" style="stop-color:var(--color-ipn-guinda-light, #7A2A4D); stop-opacity:0.1">
                                <animate attributeName="offset" values="0;3" dur="1.5s" repeatCount="indefinite"/>
                            </stop>
                        </linearGradient>

                        {{-- Patrones Tecnológicos --}}
                        <pattern id="tech_grid_pattern" patternUnits="userSpaceOnUse" width="25" height="25">
                            <path d="M0 12.5h25M12.5 0v25" stroke="var(--color-ipn-guinda-dark, #401527)" stroke-width="0.2" opacity="0.5"/>
                            <circle cx="12.5" cy="12.5" r="0.7" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.3"/>
                        </pattern>

                        {{-- Filtros --}}
                        <filter id="tech_bloom_effect" x="-50%" y="-50%" width="200%" height="200%">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="2.5" result="blurred_bloom"/>
                            <feMerge>
                                <feMergeNode in="blurred_bloom"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>

                        {{-- Marcadores para Conexiones --}}
                        <marker id="cable_connector_start" viewBox="0 0 10 10" refX="2" refY="5" markerWidth="4" markerHeight="4" orient="auto">
                            <rect x="0" y="2.5" width="4" height="5" rx="1" fill="var(--color-ipn-gray-light, #ccc)" opacity="0.6"/>
                        </marker>
                        <marker id="cable_connector_end" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="4" markerHeight="4" orient="auto">
                            <circle cx="5" cy="5" r="2.5" fill="var(--color-ipn-guinda-light, #7A2A4D)" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="0.5" opacity="0.8"/>
                        </marker>
                    </defs>

                    {{-- CAPA DE FONDO TECNOLÓGICO --}}
                    <rect width="400" height="400" fill="url(#tech_grid_pattern)" />
                    <circle cx="200" cy="200" r="190" fill="var(--color-ipn-guinda-dark, #401527)" opacity="0.7"/>

                    {{-- NÚCLEO EMISOR CENTRAL --}}
                    <g id="central_core_emitter">
                        <circle id="core_main" cx="200" cy="200" r="25" fill="url(#core_emitter_grad)" filter="url(#tech_bloom_effect)">
                            <animate attributeName="r" values="25;28;25" dur="3s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="200" cy="200" r="35" stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="1.5" fill="none" opacity="0.5">
                            <animate attributeName="r" values="35;45;35" dur="2s" begin="0s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.5;0;0.5" dur="2s" begin="0s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="200" cy="200" r="38" stroke="var(--color-ipn-guinda-light, #7A2A4D)" stroke-width="1" fill="none" opacity="0.4">
                            <animate attributeName="r" values="38;50;38" dur="2.5s" begin="0.5s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.4;0;0.4" dur="2.5s" begin="0.5s" repeatCount="indefinite"/>
                        </circle>
                    </g>

                    {{-- CAPA RADIAL 1 (NODOS DE PROCESAMIENTO) - 4 NODOS --}}
                    {{-- Radio de esta capa: 80, Radio de nodos: 10 (animado a 12) --}}
                    <g id="radial_layer_1">
                        <circle id="l1_node_0" cx="280.00" cy="200.00" r="10" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.8">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="3.5s" begin="1.0s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="10;12;10" dur="3.5s" begin="1.0s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l1_node_1" cx="200.00" cy="280.00" r="10" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.8">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="3.5s" begin="1.2s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="10;12;10" dur="3.5s" begin="1.2s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l1_node_2" cx="120.00" cy="200.00" r="10" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.8">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="3.5s" begin="1.4s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="10;12;10" dur="3.5s" begin="1.4s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l1_node_3" cx="200.00" cy="120.00" r="10" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.8">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="3.5s" begin="1.6s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="10;12;10" dur="3.5s" begin="1.6s" repeatCount="indefinite"/>
                        </circle>
                    </g>

                    {{-- CAPA RADIAL 2 (MÁS NODOS DE PROCESAMIENTO) - 6 NODOS --}}
                    {{-- Radio de esta capa: 130, Radio de nodos: 8 (animado a 10), Ángulo inicial desfasado PI/6 --}}
                    <g id="radial_layer_2">
                        <circle id="l2_node_0" cx="312.58" cy="265.00" r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="2.50s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="2.50s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l2_node_1" cx="200.00" cy="330.00" r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="2.75s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="2.75s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l2_node_2" cx="87.42"  cy="265.00" r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="3.00s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="3.00s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l2_node_3" cx="87.42"  cy="135.00" r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="3.25s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="3.25s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l2_node_4" cx="200.00" cy="70.00"  r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="3.50s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="3.50s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="l2_node_5" cx="312.58" cy="135.00" r="8" fill="var(--color-ipn-guinda-light, #7A2A4D)" opacity="0.7">
                            <animate attributeName="fill" values="var(--color-ipn-guinda-light, #7A2A4D); url(#node_processing_glow); var(--color-ipn-guinda-light, #7A2A4D)" dur="4s" begin="3.75s" repeatCount="indefinite"/>
                            <animate attributeName="r" values="8;10;8" dur="4s" begin="3.75s" repeatCount="indefinite"/>
                        </circle>
                    </g>

                    {{-- NODOS DE SALIDA PERIFÉRICOS - 5 NODOS --}}
                    {{-- Radio de esta capa: 180, Radio de nodos: 12 (animado a 15) --}}
                    <g id="peripheral_output_nodes">
                        <circle id="out_node_0" cx="380.00" cy="200.00" r="12" fill="var(--color-ipn-gray-lighten, #e5a5c1)" filter="url(#tech_bloom_effect)" opacity="0.9">
                            <animate attributeName="r" values="12;15;12" dur="3s" begin="4.0s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;1;0.9" dur="3s" begin="4.0s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="out_node_1" cx="255.59" cy="347.77" r="12" fill="var(--color-ipn-gray-lighten, #e5a5c1)" filter="url(#tech_bloom_effect)" opacity="0.9">
                            <animate attributeName="r" values="12;15;12" dur="3s" begin="4.3s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;1;0.9" dur="3s" begin="4.3s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="out_node_2" cx="104.41" cy="291.21" r="12" fill="var(--color-ipn-gray-lighten, #e5a5c1)" filter="url(#tech_bloom_effect)" opacity="0.9">
                            <animate attributeName="r" values="12;15;12" dur="3s" begin="4.6s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;1;0.9" dur="3s" begin="4.6s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="out_node_3" cx="104.41" cy="108.79" r="12" fill="var(--color-ipn-gray-lighten, #e5a5c1)" filter="url(#tech_bloom_effect)" opacity="0.9">
                            <animate attributeName="r" values="12;15;12" dur="3s" begin="4.9s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;1;0.9" dur="3s" begin="4.9s" repeatCount="indefinite"/>
                        </circle>
                        <circle id="out_node_4" cx="255.59" cy="52.23" r="12" fill="var(--color-ipn-gray-lighten, #e5a5c1)" filter="url(#tech_bloom_effect)" opacity="0.9">
                            <animate attributeName="r" values="12;15;12" dur="3s" begin="5.2s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;1;0.9" dur="3s" begin="5.2s" repeatCount="indefinite"/>
                        </circle>
                    </g>

                    {{-- CONEXIONES TECNOLÓGICAS (CABLES/PISTAS) --}}
                    <g id="tech_connections_paths" stroke-linecap="round">
                        {{-- Conexión Core (200,200 R:28) -> l1_node_0 (280,200 R:12) --}}
                        {{-- Punto de salida del core: (200 + 28*cos(0), 200 + 28*sin(0)) = (228, 200) --}}
                        {{-- Punto de entrada a l1_node_0: (280 - 12*cos(0), 200 - 12*sin(0)) = (268, 200) --}}
                        {{-- Punto de control (ejemplo): ( (228+268)/2, 200 - 20 ) = (248, 180) --}}
                        <path d="M 228.00 200.00 Q 248.00 180.00, 268.00 200.00"
                              stroke="url(#cable_energy_flow)" stroke-width="2.5" marker-start="url(#cable_connector_start)" marker-end="url(#cable_connector_end)">
                            <animate attributeName="opacity" values="0;0.8;0" dur="1.5s" begin="0.5s" repeatCount="indefinite"/>
                        </path>
                        <path d="M 228.00 200.00 Q 248.00 180.00, 268.00 200.00"
                              stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="1.5" opacity="0.7"
                              transform="translate(1.5 1.5)" {{-- Ligero offset --}}
                              marker-start="url(#cable_connector_start)" marker-end="url(#cable_connector_end)">
                            <animate attributeName="stroke-dasharray" values="0 60; 8 52; 0 60" dur="1.5s" begin="l1_node_0.begin-0.8s" repeatCount="indefinite"/>
                            <animate attributeName="stroke-dashoffset" values="0; -60" dur="1.5s" begin="l1_node_0.begin-0.8s" repeatCount="indefinite"/>
                        </path>

                        {{-- Conexión l1_node_0 (280,200 R:12) -> l2_node_0 (312.58,265.00 R:10) --}}
                        {{-- Punto de salida de l1_node_0 (aprox): (280 + 12*cos(angle_to_l2_0), 200 + 12*sin(angle_to_l2_0)) --}}
                        {{-- Angle l1_0 to l2_0: atan2(265-200, 312.58-280) = atan2(65, 32.58) approx 1.10 rad --}}
                        {{-- Salida l1_0: (280 + 12*0.45, 200 + 12*0.89) = (285.4, 210.68) --}}
                        {{-- Entrada l2_0: (312.58 - 10*0.45, 265 - 10*0.89) = (308.08, 256.1) --}}
                        {{-- Control (ejemplo): ( (285.4+308.08)/2 + 15, (210.68+256.1)/2 ) = (311.74, 233.39) --}}
                         <path d="M 285.40 210.68 Q 311.74 233.39, 308.08 256.10"
                              stroke="url(#cable_energy_flow)" stroke-width="2" marker-start="url(#cable_connector_start)" marker-end="url(#cable_connector_end)">
                             <animate attributeName="opacity" values="0;0.7;0" dur="1.5s" begin="l1_node_0.begin+0.5s" repeatCount="indefinite"/>
                         </path>

                        {{-- Conexión l2_node_0 (312.58,265 R:10) -> out_node_0 (380,200 R:15) --}}
                        {{-- Angle l2_0 to out_0: atan2(200-265, 380-312.58) = atan2(-65, 67.42) approx -0.76 rad --}}
                        {{-- Salida l2_0: (312.58 + 10*0.72, 265 + 10*(-0.69)) = (319.78, 258.1) --}}
                        {{-- Entrada out_0: (380 - 15*0.72, 200 - 15*(-0.69)) = (369.2, 210.35) --}}
                        {{-- Control (ejemplo): ( (319.78+369.2)/2, (258.1+210.35)/2 - 20 ) = (344.49, 214.22) --}}
                        <path d="M 319.78 258.10 Q 344.49 214.22, 369.20 210.35"
                              stroke="var(--color-ipn-gray-lighten, #e5a5c1)" stroke-width="2.5" opacity="0.8"
                              marker-start="url(#cable_connector_start)" marker-end="url(#cable_connector_end)">
                            <animate attributeName="stroke-dasharray" values="0 100; 10 90; 0 100" dur="1.8s" begin="l2_node_0.begin+0.6s" repeatCount="indefinite"/>
                            <animate attributeName="stroke-dashoffset" values="0; -100" dur="1.8s" begin="l2_node_0.begin+0.6s" repeatCount="indefinite"/>
                        </path>

                        {{-- Para una red completa, necesitarías definir muchas más conexiones:
                             - Core -> todos los nodos de Layer 1
                             - Nodos de Layer 1 -> nodos de Layer 2 (varias combinaciones)
                             - Nodos de Layer 2 -> nodos de Salida
                             - Los puntos de control de las curvas 'Q' deben ajustarse para cada path para evitar colisiones y crear una apariencia visual agradable.
                        --}}
                    </g>
                </svg>
            </div>

            {{-- Columna Derecha: Texto y Botones (sin cambios) --}}
            <div class="text-center md:text-left">
                 <h2 class="text-4xl lg:text-5xl xl:text-6xl font-teko font-bold mb-6 leading-tight">
                    Únete a la Comunidad SIBIPN
                </h2>
                <p class="text-lg sm:text-xl mb-10 max-w-lg mx-auto md:mx-0 text-ipn-gray-light">
                    Regístrate o inicia sesión para acceder a todos los servicios personalizados, guardar tus búsquedas y gestionar tus préstamos fácilmente.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                    <x-button.primary href="{{ route('login') }}" class="w-full sm:w-auto text-lg px-8 py-3">
                        Iniciar Sesión
                    </x-button.primary>
                </div>
            </div>
        </div>
    </div>
</section>