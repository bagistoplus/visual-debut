<div {{ $section->editor_attributes }} {{ $section->settings->color_scheme?->attributes() }} class="py-12">
  <div class="container">
    <div class="prose mx-auto max-w-3xl">
      {!! visual_clear_inline_styles($page->html_content) !!}
    </div>
  </div>
</div>
