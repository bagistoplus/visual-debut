{{-- Zag gives every close trigger in a dialog the same id, so extra close buttons close it through the element instead --}}
<span class="contents" onclick="this.closest('ui-dialog').hide()">
  {{ $slot }}
</span>
