{{--
  The WebMCP tools Bagisto declares on its own header search and footer newsletter forms. Debut's
  search lives in a header block a merchant may remove and carries the page's query string along,
  and its newsletter is a section placed per page, so the tools are declared here on their own.
  Bagisto's bridge registers every form[toolname] on the page.
--}}
<form
  action="{{ route('shop.search.index') }}"
  method="GET"
  toolname="search_products"
  tooldescription="{{ trans('shop::app.components.layouts.webmcp.search-products') }}"
  toolautosubmit
>
  <input
    type="text"
    name="query"
    aria-label="{{ trans('shop::app.components.layouts.webmcp.search-products-query') }}"
    toolparamdescription="{{ trans('shop::app.components.layouts.webmcp.search-products-query') }}"
  >

  <button type="submit" aria-hidden="true"></button>
</form>

@if (core()->getConfigData('customer.settings.newsletter.subscription'))
  {{-- Outside the form but submitted with it: the bridge offers every field inside a form to the agent as a parameter --}}
  <input
    type="hidden"
    name="_token"
    value="{{ csrf_token() }}"
    form="webmcp-subscribe-newsletter"
  >

  <form
    id="webmcp-subscribe-newsletter"
    action="{{ route('shop.subscription.store') }}"
    method="POST"
    toolname="subscribe_to_newsletter"
    tooldescription="{{ trans('shop::app.components.layouts.webmcp.subscribe-newsletter') }}"
    toolautosubmit
  >
    <input
      type="email"
      name="email"
      required
      aria-label="{{ trans('shop::app.components.layouts.webmcp.subscribe-newsletter-email') }}"
      toolparamdescription="{{ trans('shop::app.components.layouts.webmcp.subscribe-newsletter-email') }}"
    >

    <button type="submit" aria-hidden="true"></button>
  </form>
@endif
