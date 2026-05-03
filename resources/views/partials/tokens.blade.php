@style
  :root {
  @php
    $btnVars = \BagistoPlus\BasicBlocks\Settings\ButtonSettingsSchema::resolveCssVars($theme->settings);
  @endphp
  @foreach ($btnVars as $var => $value)
  {{ $var }}: {{ $value }};
  @endforeach

  --box-radius: {{ $theme->settings->box_border_radius }};
  --box-border-width: {{ $theme->settings->box_border_width }}px;

  --input-radius: {{ $theme->settings->input_border_radius }};
  --input-border-width: {{ $theme->settings->input_border_width }}px;
  --input-height: {{ $theme->settings->button_height }};
  }

  @foreach ($theme->settings->color_schemes as $scheme)
    @if ($scheme->id === $theme->settings->default_scheme->id)
      :root,
    @endif
    [{!! $scheme->attributes() !!}]
    {
    {!! $scheme->outputCssVars() !!}
    }
  @endforeach

  @foreach ($theme->settings->typography_presets as $typo)
    @php
      $customSelector = match ($typo->id) {
          'body' => ':root',
          'heading-1' => 'h1',
          'heading-2' => 'h2',
          'heading-3' => 'h3',
          'heading-4' => 'h4',
          'heading-5' => 'h5',
          'heading-6' => 'h6',
          default => null,
      };
    @endphp

    {{ $typo->toCss($customSelector) }}
  @endforeach
@endstyle
