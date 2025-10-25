@style
  :root {
  --btn-radius: {{ $theme->settings->button_border_radius }};
  --btn-border-width: {{ $theme->settings->button_border_width }}px;

  --box-radius: {{ $theme->settings->box_border_radius }};
  --box-border-width: {{ $theme->settings->box_border_width }}px;

  --input-radius: {{ $theme->settings->input_border_radius }};
  --input-border-width: {{ $theme->settings->input_border_width }}px;
  --input-height: {{ $theme->settings->button_height }};

  @if ($theme->settings->default_font)
    --default-font-family: {{ $theme->settings->default_font }}, sans-serif;
  @endif
  @if ($theme->settings->heading_font)
    --heading-font-family: {{ $theme->settings->heading_font }}, sans-serif;
  @endif
  @if ($theme->settings->subheading_font)
    --subheading-font-family: {{ $theme->settings->subheading_font }}, sans-serif;
  @endif

  @php
    $fontMap = ['default' => 'var(--default-font-family)', 'heading' => 'var(--heading-font-family)', 'subheading' => 'var(--subheading-font-family)'];
    $sizeMap = [
        'xs' => '0.75rem',
        'sm' => '0.875rem',
        'base' => '1rem',
        'lg' => '1.125rem',
        'xl' => '1.25rem',
        '2xl' => '1.5rem',
        '3xl' => '1.875rem',
        '4xl' => '2.25rem',
        '5xl' => '3rem',
        '6xl' => '3.75rem',
        '7xl' => '4.5rem',
        '8xl' => '6rem',
        '9xl' => '8rem',
    ];
    $lineHeightMap = ['none' => '1', 'tight' => '1.25', 'snug' => '1.375', 'normal' => '1.5', 'relaxed' => '1.625', 'loose' => '2'];
    $spacingMap = ['tighter' => '-0.05em', 'tight' => '-0.025em', 'normal' => '0', 'wide' => '0.025em', 'wider' => '0.05em', 'widest' => '0.1em'];
    $caseMap = ['normal' => 'none', 'uppercase' => 'uppercase', 'lowercase' => 'lowercase', 'capitalize' => 'capitalize'];

    $presets = ['paragraph', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
  @endphp

  @foreach ($presets as $preset)
    @php
      $sizeValue = $theme->settings->get($preset . '_size');
      $lineHeightValue = $theme->settings->get($preset . '_line_height');

      $baseSize = visual_is_responsive_value($sizeValue) ? $sizeValue->get('_default') : $sizeValue;
      $baseLineHeight = visual_is_responsive_value($lineHeightValue) ? $lineHeightValue->get('_default') : $lineHeightValue;
    @endphp

    --text-preset-{{ $preset }}-font: {{ $fontMap[$theme->settings->get($preset . '_font')] ?? 'var(--default-font-family)' }};
    --text-preset-{{ $preset }}-size: {{ $sizeMap[$baseSize] ?? '1rem' }};
    --text-preset-{{ $preset }}-line-height: {{ $lineHeightMap[$baseLineHeight] ?? '1.5' }};
    --text-preset-{{ $preset }}-spacing: {{ $spacingMap[$theme->settings->get($preset . '_letter_spacing')] ?? '0' }};
    --text-preset-{{ $preset }}-case: {{ $caseMap[$theme->settings->get($preset . '_case')] ?? 'none' }};
  @endforeach
  }

  @foreach ($presets as $preset)
    @php
      $sizeValue = $theme->settings->get($preset . '_size');
      $lineHeightValue = $theme->settings->get($preset . '_line_height');

      // Handle ResponsiveValue objects
      $isResponsiveSize = visual_is_responsive_value($sizeValue);
      $isResponsiveLineHeight = visual_is_responsive_value($lineHeightValue);

      $baseSize = $isResponsiveSize ? $sizeValue->get('_default') : $sizeValue;
      $baseLineHeight = $isResponsiveLineHeight ? $lineHeightValue->get('_default') : $lineHeightValue;

      // Mobile override
      $hasMobileSize = $isResponsiveSize && $sizeValue->has('mobile') && $sizeValue->get('mobile') !== $baseSize;
      $hasMobileLineHeight = $isResponsiveLineHeight && $lineHeightValue->has('mobile') && $lineHeightValue->get('mobile') !== $baseLineHeight;
      $hasMobile = $hasMobileSize || $hasMobileLineHeight;

      // Tablet override
      $hasTabletSize = $isResponsiveSize && $sizeValue->has('tablet') && $sizeValue->get('tablet') !== $baseSize;
      $hasTabletLineHeight = $isResponsiveLineHeight && $lineHeightValue->has('tablet') && $lineHeightValue->get('tablet') !== $baseLineHeight;
      $hasTablet = $hasTabletSize || $hasTabletLineHeight;

      // Desktop override
      $hasDesktopSize = $isResponsiveSize && $sizeValue->has('desktop') && $sizeValue->get('desktop') !== $baseSize;
      $hasDesktopLineHeight = $isResponsiveLineHeight && $lineHeightValue->has('desktop') && $lineHeightValue->get('desktop') !== $baseLineHeight;
      $hasDesktop = $hasDesktopSize || $hasDesktopLineHeight;
    @endphp

    @if ($hasMobile)
      @media (max-width: 639px) {
      :root {
      @if ($hasMobileSize)
        --text-preset-{{ $preset }}-size: {{ $sizeMap[$sizeValue->get('mobile')] ?? '1rem' }};
      @endif
      @if ($hasMobileLineHeight)
        --text-preset-{{ $preset }}-line-height: {{ $lineHeightMap[$lineHeightValue->get('mobile')] ?? '1.5' }};
      @endif
      }
      }
    @endif

    @if ($hasTablet)
      @media (min-width: 640px) and (max-width: 1023px) {
      :root {
      @if ($hasTabletSize)
        --text-preset-{{ $preset }}-size: {{ $sizeMap[$sizeValue->get('tablet')] ?? '1rem' }};
      @endif
      @if ($hasTabletLineHeight)
        --text-preset-{{ $preset }}-line-height: {{ $lineHeightMap[$lineHeightValue->get('tablet')] ?? '1.5' }};
      @endif
      }
      }
    @endif

    @if ($hasDesktop)
      @media (min-width: 1024px) {
      :root {
      @if ($hasDesktopSize)
        --text-preset-{{ $preset }}-size: {{ $sizeMap[$sizeValue->get('desktop')] ?? '1rem' }};
      @endif
      @if ($hasDesktopLineHeight)
        --text-preset-{{ $preset }}-line-height: {{ $lineHeightMap[$lineHeightValue->get('desktop')] ?? '1.5' }};
      @endif
      }
      }
    @endif
  @endforeach

  @foreach ($theme->settings->color_schemes as $scheme)
    @if ($scheme->id === $theme->settings->default_scheme->id)
      :root,
    @endif
    [{!! $scheme->attributes() !!}]
    {
    {!! $scheme->outputCssVars() !!}
    }
  @endforeach
@endstyle
