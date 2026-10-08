@props(['id', 'title' => null])

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
    class="z-1100 fixed inset-0 grid h-screen w-screen place-content-center"
  >
    <ui-dialog-content
      id="{{ $id }}-content"
      wire:ignore.self
      class="bg-background data-[state=open]:animate-fade-in data-[state=closed]:animate-fade-out relative min-w-96 overflow-hidden rounded-lg p-4 shadow-lg md:p-6"
    >
      <ui-dialog-close-trigger delegate>
        <x-shop::ui.button
          id="{{ $id }}-close"
          wire:ignore.self
          class="absolute! right-4 top-4"
          variant="ghost"
          color="secondary"
          size="sm"
          icon="lucide-x"
          square
          rounded
        />
      </ui-dialog-close-trigger>

      @isset($title)
        <x-shop::ui.modal.title>
          {{ $title }}
        </x-shop::ui.modal.title>
      @endisset

      {{ $slot }}
    </ui-dialog-content>
  </ui-dialog-positioner>
</ui-dialog>
