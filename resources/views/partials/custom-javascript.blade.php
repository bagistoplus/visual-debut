@php
  $customJavascript = core()->getConfigData('general.content.custom_scripts.custom_javascript');
@endphp

@if (filled($customJavascript))
  <script>
    {!! $customJavascript !!}
  </script>
@endif
