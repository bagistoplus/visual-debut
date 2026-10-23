@php
  $customCss = core()->getConfigData('general.content.custom_scripts.custom_css');
@endphp

@if (filled($customCss))
  <style>
    {!! $customCss !!}
  </style>
@endif
