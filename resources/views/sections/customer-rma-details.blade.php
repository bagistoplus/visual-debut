@php
  use BagistoPlus\VisualDebut\Support\Rma;
  use Webkul\RMA\Enums\DefaultRMAResolution;

  // Bagisto's own labels end in " :" for its two column layout
$label = fn(string $key) => rtrim(trans($key), ' :');

$item = $rma->item;
$orderItem = $item?->orderItem;
$image = product_image()->getProductBaseImage($orderItem?->product);
$statusColor = preg_match('/^#[0-9a-f]{6}$/i', (string) $rmaStatus->color) ? $rmaStatus->color : null;
$canCancel = Rma::canCancel($rma);
$canChangeStatus = !$isExpired && ($canCloseRma || $canReopenRma);

$conversation = [
    'rmaId' => $rma->id,
    'messagesUrl' => Rma::route('get_messages'),
    'sendUrl' => Rma::route('send_message'),
    'storageUrl' => Rma::storageUrl(),
    'customerName' => auth()->guard('customer')->user()->name,
    'allowedTypes' => array_values(array_filter(array_map('trim', explode(',', (string) core()->getConfigData('sales.rma.setting.allowed_file_extension'))))),
    'labels' => [
        'admin' => trans('shop::app.rma.view-customer-rma.admin'),
        'invalidType' => trans('shop::app.customers.account.rma.view.allowed-file-types'),
      ],
  ];
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="space-y-6"
  x-data="VisualRmaRequest(@js(['cancelUrl' => Rma::route('cancel', $rma->id)]))"
>
  <!-- Title, status and cancel -->
  <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
    <h1 class="text-on-background text-2xl font-semibold">
      @lang('shop::app.customers.account.rma.view.id') #{{ $rma->id }}
    </h1>

    <span class="rounded-full px-3 py-1 text-xs font-semibold" @if ($statusColor) style="background: {{ $statusColor }}20; color: {{ $statusColor }}" @endif>
      {{ $rmaStatus->title }}
    </span>

    @if ($canCancel)
      <x-shop::ui.button
        class="ml-auto"
        size="sm"
        variant="outline"
        color="danger"
        :loading="false"
        x-bind:disabled="canceling"
        x-on:click="$confirm(() => cancel())"
      >
        @lang('shop::app.rma.customer-rma-index.cancel')
      </x-shop::ui.button>
    @endif
  </div>

  <!-- Request -->
  <div class="bg-background rounded-lg shadow">
    <div class="p-6">
      <h2 class="mb-5 text-lg font-semibold">
        @lang('shop::app.rma.view-customer-rma.heading')
      </h2>

      <dl class="grid gap-x-6 gap-y-3 text-sm sm:grid-cols-[12rem_1fr]">
        <dt class="text-on-background/70">{{ $label('shop::app.rma.view-customer-rma-content.request-on') }}</dt>
        <dd>{{ core()->formatDate($rma->created_at, 'd M Y, H:i') }}</dd>

        <dt class="text-on-background/70">{{ $label('shop::app.rma.view-customer-rma.order-id') }}</dt>
        <dd>
          <a href="{{ route('shop.customers.account.orders.view', $rma->order_id) }}" class="text-primary hover:underline">
            #{{ $rma->order->increment_id }}
          </a>
        </dd>

        @foreach ($rma->additionalFields->filter(fn($field) => filled($field->value)) as $field)
          <dt class="text-on-background/70">{{ $field->customField?->label }}</dt>
          <dd class="wrap-break-word">{{ $field->value }}</dd>
        @endforeach

        @if (!empty($rma->information))
          <dt class="text-on-background/70">{{ $label('shop::app.rma.view-customer-rma.additional-information') }}</dt>
          <dd class="wrap-break-word whitespace-pre-line">{{ $rma->information }}</dd>
        @endif

        @if ($rma->images->isNotEmpty())
          <dt class="text-on-background/70">{{ $label('shop::app.rma.view-customer-rma.images') }}</dt>
          <dd class="flex flex-wrap gap-2">
            @foreach ($rma->images as $rmaImage)
              <a
                href="{{ Rma::imageUrl($rmaImage) }}"
                target="_blank"
                rel="noopener"
              >
                <img
                  src="{{ Rma::imageUrl($rmaImage) }}"
                  alt=""
                  class="h-20 w-20 rounded border object-cover"
                >
              </a>
            @endforeach
          </dd>
        @endif
      </dl>
    </div>

    @if ($canChangeStatus)
      <form
        x-ref="statusForm"
        method="post"
        action="{{ $canCloseRma ? Rma::route('update_status', $rma->id) : Rma::route('re_open', $rma->id) }}"
        class="border-on-background/10 flex flex-wrap items-center justify-between gap-4 border-t px-6 py-4"
      >
        @csrf
        <input
          type="hidden"
          name="{{ $canCloseRma ? 'close_rma' : 'reopen_rma' }}"
          value="1"
        >

        @if ($canCloseRma)
          <p class="text-on-background/70 text-sm">
            @lang('shop::app.rma.view-customer-rma.status-quotes')
          </p>
        @endif

        <x-shop::ui.button
          class="ml-auto"
          size="sm"
          :loading="false"
          x-on:click.prevent="$confirm(() => $refs.statusForm.submit())"
        >
          {{ $canCloseRma ? trans('visual-debut::shop.rma.mark-solved') : trans('shop::app.rma.customer.create.reopen-request') }}
        </x-shop::ui.button>
      </form>
    @endif
  </div>

  <!-- Item -->
  @if ($item && $orderItem)
    <div class="bg-background rounded-lg p-6 shadow">
      <h2 class="mb-5 text-lg font-semibold">
        @lang('shop::app.rma.view-customer-rma.items-request')
      </h2>

      <div class="flex flex-col gap-4 sm:flex-row">
        @if ($image)
          <img
            src="{{ $image['small_image_url'] }}"
            alt="{{ $orderItem->name }}"
            class="h-16 w-16 flex-none rounded object-cover"
          >
        @else
          <div class="bg-surface h-16 w-16 flex-none rounded"></div>
        @endif

        <div class="flex-1 space-y-1 text-sm">
          @if ($orderItem->product?->url_key && $orderItem->product?->visible_individually)
            <a href="{{ route('shop.product_or_category.index', $orderItem->product->url_key) }}" class="text-on-background hover:text-primary text-base font-medium">
              {{ $orderItem->name }}
            </a>
          @else
            <p class="text-on-background text-base font-medium">{{ $orderItem->name }}</p>
          @endif

          @foreach (array_filter($orderItem->additional['attributes'] ?? []) as $attribute)
            <p>
              <span class="font-medium">{{ $attribute['attribute_name'] }}:</span>
              {{ $attribute['option_label'] }}
            </p>
          @endforeach

          <p>
            <span class="font-medium">@lang('shop::app.rma.table-heading.sku'):</span>
            {{ $orderItem->product?->sku ?? $orderItem->sku }}
          </p>
        </div>

        <dl class="grid flex-none grid-cols-[auto_1fr] gap-x-4 gap-y-1 text-sm sm:text-right">
          <dt class="text-on-background/70">@lang('shop::app.rma.table-heading.price')</dt>
          <dd>{{ core()->formatPrice($orderItem->price, $rma->order->order_currency_code) }}</dd>

          <dt class="text-on-background/70">@lang('shop::app.rma.table-heading.rma-qty')</dt>
          <dd>{{ $item->quantity }} / {{ $orderItem->qty_ordered }}</dd>

          <dt class="text-on-background/70">@lang('shop::app.rma.table-heading.resolution-type')</dt>
          <dd>
            {{ $item->resolution === DefaultRMAResolution::RETURN->value ? trans('shop::app.customers.account.rma.create.return') : trans('shop::app.customers.account.rma.create.cancel-items') }}
          </dd>

          <dt class="text-on-background/70">@lang('shop::app.rma.table-heading.reason')</dt>
          <dd>{{ $item->reason?->title }}</dd>
        </dl>
      </div>
    </div>
  @endif

  <!-- Conversation -->
  <div class="bg-background rounded-lg p-6 shadow" x-data="VisualRmaConversation(@js($conversation))">
    <h2 class="mb-5 text-lg font-semibold">
      @lang('shop::app.rma.view-customer-rma.conversations')
    </h2>

    <div class="space-y-4">
      <template x-if="hasOlder">
        <div class="text-center">
          <x-shop::ui.button
            size="sm"
            variant="ghost"
            color="secondary"
            :loading="false"
            x-bind:disabled="loading"
            x-on:click="loadOlder()"
          >
            @lang('visual-debut::shop.rma.load-older-messages')
          </x-shop::ui.button>
        </div>
      </template>

      <template x-for="message in thread" x-bind:key="message.id">
        <div class="flex" x-bind:class="isAdmin(message) ? 'justify-start' : 'justify-end'">
          <div class="max-w-[85%] rounded-lg px-4 py-3 text-sm sm:max-w-[70%]" x-bind:class="isAdmin(message) ? 'bg-surface text-on-surface' : 'bg-primary/10'">
            <p class="text-on-background/70 mb-1 text-xs">
              <span class="font-semibold" x-text="author(message)"></span>
              <span x-text="'· ' + date(message.created_at)"></span>
            </p>

            <p class="wrap-break-word whitespace-pre-line" x-text="message.message"></p>

            <template x-if="message.attachment">
              <a
                x-bind:href="attachmentUrl(message)"
                target="_blank"
                rel="noopener"
                class="text-primary mt-2 flex items-center gap-1.5 text-xs hover:underline"
              >
                <x-lucide-paperclip class="h-3.5 w-3.5 flex-none" />
                <span class="break-all" x-text="message.attachment"></span>
              </a>
            </template>
          </div>
        </div>
      </template>

      <template x-if="loaded && !thread.length">
        <p class="text-on-background/60 py-6 text-center text-sm">
          @lang('shop::app.rma.conversation-texts.no-record')
        </p>
      </template>
    </div>

    <form class="border-on-background/10 mt-6 space-y-3 border-t pt-6" x-on:submit.prevent="send()">
      <x-shop::ui.form.textarea
        name="message"
        rows="3"
        maxlength="250"
        required
        :placeholder="trans('shop::app.customers.account.rma.view.enter-message')"
        x-model="message"
      />
      <p
        class="text-danger text-sm"
        x-show="errors.message"
        x-text="errors.message"
        x-cloak
      ></p>

      <div class="flex flex-wrap items-center gap-3">
        <label class="btn btn-sm btn-secondary btn-soft relative cursor-pointer">
          <x-lucide-paperclip class="h-4 w-4" />
          @lang('shop::app.customers.account.rma.view.add-attachments')
          <input
            type="file"
            class="sr-only"
            x-ref="file"
            x-bind:accept="allowedTypes.join(',')"
            x-on:change="pickFile($event)"
          >
        </label>

        <template x-if="file">
          <span class="flex min-w-0 items-center gap-2 text-sm">
            <span class="truncate" x-text="file.name"></span>
            <button
              type="button"
              class="text-primary hover:underline"
              x-on:click="clearFile()"
            >
              @lang('shop::app.customers.account.rma.view.remove')
            </button>
          </span>
        </template>

        <x-shop::ui.button
          type="submit"
          size="sm"
          class="ml-auto"
          :loading="false"
          x-bind:disabled="sending"
        >
          @lang('shop::app.customers.account.rma.view.send-message-btn')
        </x-shop::ui.button>
      </div>
      <p
        class="text-danger text-sm"
        x-show="errors.file"
        x-text="errors.file"
        x-cloak
      ></p>
    </form>
  </div>
</div>
