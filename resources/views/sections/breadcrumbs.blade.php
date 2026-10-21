@unless ($breadcrumbs->isEmpty())
  <div {{ $section->editor_attributes }} {{ $section->settings->color_scheme?->attributes() }} class="border-b">
    <div class="container py-4">
      <nav class="flex items-center text-sm" aria-label="{{ trans('visual-debut::shop.breadcrumbs') }}">
        @foreach ($breadcrumbs as $breadcrumb)
          @if ($breadcrumb->url && !$loop->last)
            <a class="hover:text-primary shrink-0 whitespace-nowrap transition-colors" href="{{ $breadcrumb->url }}">
              {{ $breadcrumb->title }}
            </a>
            <x-lucide-chevron-right class="mx-2 h-4 w-4 shrink-0" />
          @else
            <span class="text-primary truncate font-medium">
              {{ $breadcrumb->title }}
            </span>
          @endif
        @endforeach
      </nav>
    </div>
  </div>
@endunless
