@props(['options' => []])
<div x-data="{ showOptions: false }">
  <button
    class="text-xs data-[expanded=true]:[&>svg]:rotate-180"
    x-on:click="showOptions = !showOptions"
    x-bind:data-expanded="showOptions"
  >
    @lang('shop::app.checkout.cart.mini-cart.see-details')
    @svg('lucide-chevron-down', ['class' => 'inline-block h-3 w-3 transition-transform'])
  </button>
  <div x-show="showOptions" class="space-y-2">
    @foreach ($options as $option)
      <div class="{{ isset($option->attribute_type) && $option->attribute_type === 'file' ? 'truncate' : '' }} text-xs">
        <span class="font-bold">{{ $option->attribute_name }}: </span>
        @if (isset($option->attribute_type) && $option->attribute_type === 'file')
          <a
            href="{{ $option->file_url }}"
            target="_blank"
            class="text-primary"
            download="{{ $option->file_name }}"
          >
            {{ $option->file_name }}
          </a>
        @else
          <span>{{ $option->option_label }}</span>
        @endif
      </div>
    @endforeach
  </div>
</div>
