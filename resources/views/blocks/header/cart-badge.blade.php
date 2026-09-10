{{--
  The cart count badge. Lives in its own deferred island so a page stored by the full page
  cache carries no visitor's count. See src/Blocks/Header/Cart.php.
--}}
@if ($count > 0)
  <span class="bg-primary text-on-primary absolute right-0 top-0 flex h-4 w-4 items-center justify-center rounded-full text-xs">
    {{ $count }}
  </span>
@endif
