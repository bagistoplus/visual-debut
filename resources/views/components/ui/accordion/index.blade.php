@props(['id', 'value' => [], 'multiple' => false])

<ui-accordion
  id="{{ $id }}"
  collapsible
  presence
  @if ($multiple) multiple @endif
  default-value="{{ collect($value)->implode(',') }}"
  {{ $attributes }}
>
  {{ $slot }}
</ui-accordion>
