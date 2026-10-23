// Components only some pages use, loaded the first time their element is in the page.
// They are custom elements: until the module defines them they stay inert, and
// @bagistoplus/ui's CSS draws them in their initial state, then they upgrade in place.
const components: Record<string, () => Promise<unknown>> = {
  'ui-accordion': () => import('@bagistoplus/ui/accordion'),
  'ui-carousel': () => import('@bagistoplus/ui/carousel'),
  'ui-number-input': () => import('@bagistoplus/ui/number-input'),
  'ui-rating': () => import('@bagistoplus/ui/rating'),
  'ui-slider': () => import('@bagistoplus/ui/slider'),
};

function loadPresent(root: ParentNode): void {
  for (const [tag, load] of Object.entries(components)) {
    const present = (root instanceof Element && root.matches(tag)) || root.querySelector(tag) !== null;

    if (present) {
      delete components[tag];
      load();
    }
  }
}

export function loadComponentsOnDemand(): void {
  loadPresent(document);

  if (Object.keys(components).length === 0) {
    return;
  }

  // Livewire updates, drawers and modals can add one of them later.
  const observer = new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      for (const node of mutation.addedNodes) {
        if (node instanceof Element) {
          loadPresent(node);
        }
      }
    }

    if (Object.keys(components).length === 0) {
      observer.disconnect();
    }
  });

  observer.observe(document.documentElement, { childList: true, subtree: true });
}
