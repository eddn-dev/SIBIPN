{{-- resources/views/vendor/pagination/tailwind-dark.blade.php --}}
{{-- Adaptado para tema oscuro / glassmorphism --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- Información de "Mostrando X a Y de Z resultados" --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-ipn-gray-lighten/80 leading-5">
                    {!! __('Mostrando') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium text-white">{{ $paginator->firstItem() }}</span>
                        {!! __('a') !!}
                        <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('de') !!}
                    <span class="font-medium text-white">{{ $paginator->total() }}</span>
                    {!! __('resultados') !!}
                </p>
            </div>

            {{-- Enlaces de Paginación (Desktop) --}}
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Botón Anterior --}}
                    <span>
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-white/10 bg-white/5 text-sm font-medium text-gray-500 cursor-default" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-white/10 bg-white/5 text-sm font-medium text-ipn-gray-lighten hover:bg-white/10 hover:text-white focus:z-10 focus:outline-none focus:ring-1 focus:ring-ipn-guinda-light focus:border-ipn-guinda-light transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </span>

                    {{-- Elementos de Paginación (Números, etc.) --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px border border-white/10 bg-white/5 text-sm font-medium text-gray-500 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span>
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px border border-ipn-guinda-light bg-ipn-guinda-light/20 text-sm font-medium text-white cursor-default">{{ $page }}</span>
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px border border-white/10 bg-white/5 text-sm font-medium text-ipn-gray-lighten hover:bg-white/10 hover:text-white focus:z-10 focus:outline-none focus:ring-1 focus:ring-ipn-guinda-light focus:border-ipn-guinda-light transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </a>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Botón Siguiente --}}
                    <span>
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px rounded-r-md border border-white/10 bg-white/5 text-sm font-medium text-ipn-gray-lighten hover:bg-white/10 hover:text-white focus:z-10 focus:outline-none focus:ring-1 focus:ring-ipn-guinda-light focus:border-ipn-guinda-light transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-2 py-2 -ml-px rounded-r-md border border-white/10 bg-white/5 text-sm font-medium text-gray-500 cursor-default" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @endif
                    </span>
                </span>
            </div>
        </div>

         {{-- Enlaces de Paginación (Móvil) --}}
         <div class="flex-1 flex justify-between sm:hidden">
             @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 border border-white/10 text-sm font-medium text-gray-500 bg-white/5 rounded-md cursor-default">
                    {!! __('pagination.previous') !!}
                </span>
             @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-white/10 text-sm font-medium text-ipn-gray-lighten bg-white/5 rounded-md hover:bg-white/10 hover:text-white transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
             @endif

             @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 border border-white/10 text-sm font-medium text-ipn-gray-lighten bg-white/5 rounded-md hover:bg-white/10 hover:text-white transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
             @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 border border-white/10 text-sm font-medium text-gray-500 bg-white/5 rounded-md cursor-default">
                    {!! __('pagination.next') !!}
                </span>
             @endif
         </div>
    </nav>
@endif

