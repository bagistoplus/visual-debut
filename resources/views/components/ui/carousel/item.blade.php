{{-- The track stretches every slide to the tallest one; its content fills the slide, so cards match in height as they do in a grid --}}
<ui-carousel-item {{ $attributes->merge(['class' => '[&>*]:h-full']) }}>
  {{ $slot }}
</ui-carousel-item>
