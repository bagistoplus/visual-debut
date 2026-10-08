@props(['id', 'size' => 'sm', 'placement' => 'end', 'title' => null])

@php
  $sizeClasses = [
      'xs' => 'max-w-xs',
      'sm' => 'max-w-sm',
      'md' => 'max-w-md',
      'lg' => 'max-w-lg',
      'xl' => 'max-w-xl',
      'full' => 'max-w-full',
  ];

  // Position configuration map to avoid repetitive conditionals
  $placementConfigs = [
      'end' => [
          'positionner' => 'justify-end',
          'content' => $sizeClasses[$size] ?? $sizeClasses['md'],
          'animation' => 'data-[state=open]:animate-drawer-in-end data-[state=closed]:animate-drawer-out-end',
      ],
      'start' => [
          'positionner' => 'justify-start',
          'content' => $sizeClasses[$size] ?? $sizeClasses['md'],
          'animation' => 'data-[state=open]:animate-drawer-in-start data-[state=closed]:animate-drawer-out-start',
      ],
      'top' => [
          'positionner' => 'items-start',
          'content' => 'h-max-dvh h-max',
          'animation' => 'data-[state=open]:animate-drawer-in-top data-[state=closed]:animate-drawer-out-top',
      ],
      'bottom' => [
          'positionner' => 'items-end',
          'content' => 'h-max-dvh h-max',
          'animation' => 'data-[state=open]:animate-drawer-in-bottom data-[state=closed]:animate-drawer-out-bottom',
      ],
  ];

  // Get configuration for selected position or fallback to 'right'
  $config = $placementConfigs[$placement] ?? $placementConfigs['end'];
@endphp

<ui-dialog
  id="{{ $id }}"
  top-layer
  {{ $attributes }}
>
  @isset($trigger)
    <x-shop::ui.modal.trigger>
      {{ $trigger }}
    </x-shop::ui.modal.trigger>
  @endisset

  <ui-dialog-backdrop
    id="{{ $id }}-backdrop"
    wire:ignore.self
    class="data-[state=open]:animate-fade-in data-[state=closed]:animate-fade-out z-1000 fixed inset-0 bg-black/50 backdrop-blur-sm"
  ></ui-dialog-backdrop>

  <ui-dialog-positioner
    id="{{ $id }}-positioner"
    wire:ignore.self
    class="{{ $config['positionner'] }} z-1100 fixed inset-0 flex h-screen w-screen"
  >
    <ui-dialog-content
      id="{{ $id }}-content"
      wire:ignore.self
      class="bg-background {{ $config['content'] }} {{ $config['animation'] }} relative flex w-full flex-col shadow-xl"
    >
      <ui-dialog-close-trigger delegate>
        <x-shop::ui.button
          id="{{ $id }}-close"
          wire:ignore.self
          variant="ghost"
          color="secondary"
          icon="lucide-x"
          size="sm"
          class="absolute! right-4 top-4"
          square
          rounded
        />
      </ui-dialog-close-trigger>

      @isset($header)
        <header class="flex h-16 flex-none items-center">
          {{ $header }}
        </header>
      @endisset

      @isset($title)
        <header class="flex h-16 flex-none items-center p-4">
          <x-shop::ui.modal.title>
            {{ $title }}
          </x-shop::ui.modal.title>
        </header>
      @endisset

      <section class="flex-1 overflow-y-auto">
        {{ $slot }}
      </section>

      @isset($footer)
        <footer class="flex h-16 flex-none items-center">
          {{ $footer }}
        </footer>
      @endisset
    </ui-dialog-content>
  </ui-dialog-positioner>
</ui-dialog>
