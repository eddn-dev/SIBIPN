{{-- resources/views/partials/landing/parallax1.blade.php --}}
<section id="parallax-section-2"
         class="parallax-section relative h-[80vh] md:h-screen text-white overflow-hidden"
         data-speed="0.55"
         data-overlay="0.25"
         data-float="true"
         data-inview="65">

  <div class="parallax-bg-main absolute inset-0 will-change-transform">
      <img src="{{ asset('images/parallax2.jpg') }}"
           srcset="{{ asset('images/parallax2.jpg') }} 1x,
                   {{ asset('images/parallax2.jpg') }} 2x"
           loading="lazy" decoding="async"
           alt="Investigación y descubrimiento en el IPN"
           class="absolute w-full h-[140%] -top-[20%] left-0 object-cover" />
  </div>
  {{-- Capa 2 – Overlay --}}
  <div class="parallax-bg-layer parallax-overlay absolute inset-0 z-10 bg-ipn-guinda/70"></div>

  {{-- Capa 3 – Texto --}}
  <div class="parallax-content-container container mx-auto px-4 sm:px-6 lg:px-8
              flex items-center justify-center h-full relative z-30">
    <h3 class="parallax-text text-center max-w-3xl text-3xl lg:text-4xl xl:text-5xl
               font-roboto font-semibold">
      <span>Fomentando</span><span>el</span> <span>desarrollo</span> <span>de</span><span>la</span>
      <span>ciencia</span> <span>y</span> <span>la</span> <span>tecnología</span>
    </h3>
  </div>
</section>
