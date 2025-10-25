<div {{ $block->editor_attributes }}>
  <livewire:cart-preview key="cart-preview" :block="[
      'id' => $block->id,
      'heading' => $block->settings->heading,
      'description' => $block->settings->description,
      'liveUpdate' => [
          'heading' => $block->liveUpdate()->text('heading')->toHtml(),
          'description' => $block->liveUpdate()->html('description')->toHtml(),
      ],
  ]" />
</div>
