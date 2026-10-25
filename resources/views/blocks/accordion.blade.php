@php
  $openByDefault = collect($block->children())->filter(fn($child) => $child->settings->open_by_default ?? false)->pluck('id')->toArray();
@endphp

<div
  {{ $block->editor_attributes }}
  class="accordion w-full {{ $paddingClasses }}"
>
  <x-shop::ui.accordion :id="'accordion-' . $block->id" :value="$openByDefault" multiple>
    @children
  </x-shop::ui.accordion>
</div>

@visual_design_mode
@pushOnce('scripts')
  <script>
    (() => {
      // Accordions only read their open rows when they start, so the editor drives them itself
      const itemFor = (value) => document.querySelector(`ui-accordion-item[value="${CSS.escape(value)}"]`);

      const setOpen = (item, open) => {
        const root = item?.closest('ui-accordion');
        const value = item?.getAttribute('value');

        if (!root?.api || !value || root.api.value.includes(value) === open) {
          return;
        }

        root.api.setValue(open ? [value, ...root.api.value] : root.api.value.filter((other) => other !== value));
      };

      // Show the row being edited, as BlocksPro does. A row block wraps its item, and a block inside the row sits within it
      const openItemFor = (target) => {
        if (target instanceof Element) {
          setOpen(target.closest('ui-accordion-item') ?? target.querySelector(':scope > ui-accordion-item'), true);
        }
      };

      document.addEventListener('visual:block:selected', (event) => openItemFor(event.detail?.element));
      document.addEventListener('visual:block:added', (event) => openItemFor(event.detail?.element));

      document.addEventListener('visual:block:setting:updated:open_by_default', (event) => {
        const id = event.detail?.block?.id;

        if (id) {
          setOpen(itemFor(id), Boolean(event.detail.value));
        }
      });
    })();
  </script>
@endPushOnce
@end_visual_design_mode
