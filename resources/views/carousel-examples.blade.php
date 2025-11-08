@php
  $direction = core()->getCurrentLocale()->direction;
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $direction }}">

  <head>
    {!! view_render_event('bagisto.shop.layout.head.before') !!}

    @include('shop::partials.head')

    {!! view_render_event('bagisto.shop.layout.head.after') !!}
  </head>

  <body class="{{ $direction }}" style="scroll-behavior: smooth;">
    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    <x-shop::toasts />

    <x-shop::confirm-modal />

    {{-- Carousel Component Examples --}}
    <div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
      <h1 style="margin-bottom: 2rem;">Carousel Component Examples</h1>

      {{-- Example 1: Full-width slides with dots pagination --}}
      <div style="margin-bottom: 3rem;">
        <h3 style="margin-bottom: 1rem;">Full-width Slides with Autoplay</h3>
        <div
          x-carousel="{
          slidesPerView: 1,
          spaceBetween: 0,
          pagination: 'dots',
          draggable: true,
          autoplay: { delay: 3000, pauseOnHover: true }
        }"
          style="position: relative;"
        >
          <div x-carousel:viewport style="overflow: hidden; border-radius: 8px;">
            <div style="display: flex;">
              <div x-carousel:slide
                style="flex-shrink: 0; width: 100%; height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;"
              >
                Slide 1
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 100%; height: 300px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;"
              >
                Slide 2
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 100%; height: 300px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;"
              >
                Slide 3
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 100%; height: 300px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;"
              >
                Slide 4
              </div>
            </div>
          </div>

          <button x-carousel:prev-button
            style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 1.25rem;"
          >
            ←
          </button>
          <button x-carousel:next-button
            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 1.25rem;"
          >
            →
          </button>

          <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 1rem;">
            <button x-carousel:pagination="0" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #333; background: white; cursor: pointer; padding: 0; transition: background 0.3s;" :style="$carousel.activeIndex === 0 && 'background: #333'">
              <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border-width: 0;">Go to slide 1</span>
            </button>
            <button x-carousel:pagination="1" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #333; background: white; cursor: pointer; padding: 0; transition: background 0.3s;" :style="$carousel.activeIndex === 1 && 'background: #333'">
              <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border-width: 0;">Go to slide 2</span>
            </button>
            <button x-carousel:pagination="2" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #333; background: white; cursor: pointer; padding: 0; transition: background 0.3s;" :style="$carousel.activeIndex === 2 && 'background: #333'">
              <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border-width: 0;">Go to slide 3</span>
            </button>
            <button x-carousel:pagination="3" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #333; background: white; cursor: pointer; padding: 0; transition: background 0.3s;" :style="$carousel.activeIndex === 3 && 'background: #333'">
              <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border-width: 0;">Go to slide 4</span>
            </button>
          </div>
        </div>
      </div>

      {{-- Example 2: Dynamic width slides --}}
      <div style="margin-bottom: 3rem;">
        <h3 style="margin-bottom: 1rem;">Dynamic Width Slides (slidesPerView: 'auto')</h3>
        <div
          x-data
          x-carousel="{
          slidesPerView: 'auto',
          spaceBetween: 16,
          pagination: 'fraction',
          draggable: true,
          freeMode: true
        }"
          style="position: relative;"
        >
          <div x-carousel:viewport style="overflow: hidden; border-radius: 8px;">
            <div style="display: flex; gap: 16px;">
              <div x-carousel:slide
                style="flex-shrink: 0; width: 280px; height: 200px; background: #ff6b6b; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                280px
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 340px; height: 200px; background: #4ecdc4; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                340px
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 220px; height: 200px; background: #45b7d1; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                220px
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 300px; height: 200px; background: #f7b731; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                300px
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 260px; height: 200px; background: #5f27cd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                260px
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: 320px; height: 200px; background: #00d2d3; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;"
              >
                320px
              </div>
            </div>
          </div>

          <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 1rem;">
            <button x-carousel:prev-button style="background: #333; color: white; border: none; border-radius: 4px; padding: 0.5rem 1rem; cursor: pointer;">
              Previous
            </button>
            <div x-carousel:pagination-fraction style="font-weight: 600; color: #333;"></div>
            <button x-carousel:next-button style="background: #333; color: white; border: none; border-radius: 4px; padding: 0.5rem 1rem; cursor: pointer;">
              Next
            </button>
          </div>
        </div>
      </div>

      {{-- Example 3: Progress bar pagination --}}
      <div style="margin-bottom: 3rem;">
        <h3 style="margin-bottom: 1rem;">Progress Bar Pagination</h3>
        <div
          x-data
          x-carousel="{
          slidesPerView: 3,
          spaceBetween: 20,
          pagination: 'progress',
          draggable: true,
          breakpoints: {
            768: { slidesPerView: 2 },
            480: { slidesPerView: 1 }
          }
        }"
          style="position: relative;"
        >
          <div x-carousel:viewport style="overflow: hidden;">
            <div style="display: flex; gap: 20px;">
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #e74c3c; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 1
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #3498db; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 2
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #2ecc71; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 3
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #f39c12; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 4
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #9b59b6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 5
              </div>
              <div x-carousel:slide
                style="flex-shrink: 0; width: calc((100% - 40px) / 3); height: 150px; background: #1abc9c; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;"
              >
                Card 6
              </div>
            </div>
          </div>

          <div style="margin-top: 1rem; height: 4px; background: #e0e0e0; border-radius: 2px; overflow: hidden;">
            <div x-carousel:pagination-progress style="height: 100%; background: #2c3e50; transition: width 0.3s;"></div>
          </div>

          <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button x-carousel:prev-button
              style="flex: 1; background: #2c3e50; color: white; border: none; border-radius: 4px; padding: 0.75rem; cursor: pointer; font-weight: 600;"
            >
              ← Prev
            </button>
            <button x-carousel:next-button
              style="flex: 1; background: #2c3e50; color: white; border: none; border-radius: 4px; padding: 0.75rem; cursor: pointer; font-weight: 600;"
            >
              Next →
            </button>
          </div>
        </div>
      </div>
    </div>

    @stack('scripts')
    @livewireScriptConfig
  </body>

</html>
