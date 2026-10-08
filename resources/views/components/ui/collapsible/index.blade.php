@props(['id', 'open' => false])

<ui-collapsible id="{{ $id }}" @if ($open) default-open @endif {{ $attributes }}>
  {{ $slot }}
</ui-collapsible>
