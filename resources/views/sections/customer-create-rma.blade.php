@php
  use BagistoPlus\VisualDebut\Support\Rma;
  use Webkul\RMA\Repositories\RMACustomFieldRepository;

  $customFields = app(RMACustomFieldRepository::class)->with('options')->where('status', 1)->orderBy('position')->get();
  $returnPolicy = core()->getConfigData('sales.rma.setting.return_policy');

  $props = [
      'ordersUrl' => Rma::route('create'),
      'itemsUrl' => Rma::route('get_order_items', ['orderId' => '__order__']),
      'reasonsUrl' => Rma::route('get_resolution_reasons', ['resolutionType' => '__type__']),
      'storeUrl' => Rma::route('store'),
      'storageUrl' => Rma::storageUrl(),
      'preselectedOrder' => request()->integer('order') ?: null,
      'allowedTypes' => array_values(array_filter(array_map('trim', explode(',', (string) core()->getConfigData('sales.rma.setting.allowed_file_extension'))))),
      'requiredGroups' => $customFields
          ->where('is_required', 1)
          ->where('type', 'checkbox')
          ->mapWithKeys(fn($field) => [$field->id => trans('validation.required', ['attribute' => $field->label])]),
      'labels' => [
          'invalidType' => trans('shop::app.customers.account.rma.view.allowed-file-types'),
      ],
  ];
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="bg-background text-on-background box border-none shadow-sm"
>
  <div class="border-b p-4">
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-2xl">
        @lang('shop::app.rma.customer.create.heading')
      </h1>
      <x-shop::ui.button
        variant="soft"
        color="secondary"
        icon="lucide-arrow-left"
        size="sm"
        :href="Rma::route('index')"
      >
        @lang('shop::app.checkout.onepage.address.back')
      </x-shop::ui.button>
    </div>
  </div>

  <form
    class="space-y-8 p-6"
    x-data="VisualRmaCreate(@js($props))"
    x-on:submit.prevent="submit($el)"
    novalidate
  >
    <!-- Order -->
    <fieldset class="space-y-3">
      <legend class="mb-3 text-lg font-semibold">@lang('visual-debut::shop.rma.choose-order')</legend>

      <template x-if="ordersLoaded && !orders.length">
        <p class="text-on-background/70 text-sm">@lang('visual-debut::shop.rma.no-eligible-orders')</p>
      </template>

      <div class="grid gap-2">
        <template x-for="order in orders" x-bind:key="order.id">
          <label
            class="has-checked:border-primary has-checked:bg-primary/5 border-on-background/15 flex cursor-pointer flex-wrap items-center gap-x-4 gap-y-1 rounded-(--box-radius) border p-3 text-sm"
          >
            <input
              type="radio"
              name="order_id"
              x-bind:value="order.id"
              x-bind:checked="orderId === order.id"
              x-on:change="selectOrder(order)"
            >
            <span class="font-semibold" x-text="text(order.increment_id)"></span>
            <span x-html="order.status"></span>
            <span class="text-on-background/70" x-text="text(order.created_at)"></span>
            <span class="ml-auto font-medium" x-text="text(order.grand_total)"></span>
          </label>
        </template>
      </div>
      <p
        class="text-danger text-sm"
        x-show="errors.order_id"
        x-text="errors.order_id"
        x-cloak
      ></p>
    </fieldset>

    <!-- Item -->
    <template x-if="orderId">
      <fieldset class="space-y-3">
        <legend class="mb-3 text-lg font-semibold">@lang('visual-debut::shop.rma.choose-item')</legend>

        <div class="grid gap-2">
          <template x-for="item in items" x-bind:key="item.order_item_id">
            <label class="has-checked:border-primary has-checked:bg-primary/5 border-on-background/15 flex items-start gap-3 rounded-(--box-radius) border p-3 text-sm"
              x-bind:class="available(item) ? 'cursor-pointer' : 'opacity-60'"
            >
              <input
                type="radio"
                name="order_item_id"
                class="mt-1"
                x-bind:value="item.order_item_id"
                x-bind:checked="itemId === item.order_item_id"
                x-bind:disabled="!available(item)"
                x-on:change="selectItem(item)"
              >
              <template x-if="imageUrl(item)">
                <img
                  x-bind:src="imageUrl(item)"
                  alt=""
                  class="h-14 w-14 flex-none rounded-(--box-radius) object-cover"
                >
              </template>
              <template x-if="!imageUrl(item)">
                <span class="bg-surface h-14 w-14 flex-none rounded-(--box-radius)"></span>
              </template>
              <span class="flex-1 space-y-0.5">
                <span class="block font-medium" x-text="item.name"></span>
                <span class="text-on-background/70 block">
                  @lang('shop::app.customers.account.rma.create.sku'): <span x-text="item.sku"></span>
                </span>
                <template x-for="attribute in attributes(item)">
                  <span class="text-on-background/70 block" x-text="attribute.attribute_name + ': ' + attribute.option_label"></span>
                </template>
                <span class="text-on-background/70 block">
                  @lang('shop::app.rma.customer.create.return-window'): <span x-text="returnWindow(item)"></span>
                </span>
                <template x-if="!available(item)">
                  <span class="text-danger block">@lang('shop::app.customers.account.rma.create.product-already-raw')</span>
                </template>
              </span>
              <span class="flex-none font-medium" x-text="price(item.price)"></span>
            </label>
          </template>
        </div>
        <p
          class="text-danger text-sm"
          x-show="errors.order_item_id"
          x-text="errors.order_item_id"
          x-cloak
        ></p>

        <template x-if="item">
          <div class="grid gap-4 pt-2 sm:grid-cols-2">
            <div>
              <x-shop::ui.form.select
                name="resolution_type"
                :label="trans('shop::app.customers.account.rma.create.resolution-type')"
                required
                x-model="resolution"
              >
                <option value="">@lang('shop::app.customers.account.rma.create.select')</option>
                <template x-if="canReturn(item)">
                  <option value="return">@lang('shop::app.customers.account.rma.create.return')</option>
                </template>
                <template x-if="canCancel(item)">
                  <option value="cancel_items">@lang('shop::app.customers.account.rma.create.cancel-items')</option>
                </template>
              </x-shop::ui.form.select>
              <p
                class="text-danger mt-1 text-sm"
                x-show="errors.resolution_type"
                x-text="errors.resolution_type"
                x-cloak
              ></p>
            </div>

            <div>
              <x-shop::ui.form.select
                name="rma_reason_id"
                :label="trans('shop::app.rma.customer.create.reason')"
                required
                x-model="reasonId"
                x-bind:disabled="!reasons.length"
              >
                <option value="">@lang('shop::app.customers.account.rma.create.select')</option>
                <template x-for="reason in reasons" x-bind:key="reason.id">
                  <option x-bind:value="reason.id" x-text="reason.title"></option>
                </template>
              </x-shop::ui.form.select>
              <p
                class="text-danger mt-1 text-sm"
                x-show="errors.rma_reason_id"
                x-text="errors.rma_reason_id"
                x-cloak
              ></p>
            </div>

            <div>
              <x-shop::ui.form.input
                type="number"
                name="rma_qty"
                :label="trans('shop::app.rma.customer.rma-qty')"
                required
                min="1"
                x-model="quantity"
                x-bind:max="maxQuantity"
              />
              <p
                class="text-danger mt-1 text-sm"
                x-show="errors.rma_qty"
                x-text="errors.rma_qty"
                x-cloak
              ></p>
            </div>

            <template x-if="resolution === 'return'">
              <div>
                <x-shop::ui.form.select name="package_condition" :label="trans('shop::app.customers.account.rma.create.package-condition')">
                  <option value="">@lang('shop::app.customers.account.rma.create.select')</option>
                  <option value="open">@lang('shop::app.customers.account.rma.create.open')</option>
                  <option value="packed">@lang('shop::app.customers.account.rma.create.packed')</option>
                </x-shop::ui.form.select>
              </div>
            </template>
          </div>
        </template>
      </fieldset>
    </template>

    <!-- Details -->
    <div
      class="space-y-4"
      x-show="item"
      x-cloak
    >
      @foreach ($customFields as $field)
        @php
          $fieldId = "rma-custom-field-{$field->id}";
          $fieldName = "customAttributes[{$field->id}]";
          $required = (bool) $field->is_required;
        @endphp

        <div>
          @if (in_array($field->type, ['checkbox', 'radio']))
            <fieldset>
              <legend>
                <x-shop::ui.form.label :required="$required">{{ $field->label }}</x-shop::ui.form.label>
              </legend>
              <div class="flex flex-wrap gap-x-6 gap-y-2">
                @foreach ($field->options as $option)
                  <label class="flex cursor-pointer items-center gap-2 text-sm">
                    @if ($field->type === 'checkbox')
                      <input
                        type="checkbox"
                        name="{{ $fieldName }}[]"
                        value="{{ $option->value }}"
                      >
                    @else
                      {{-- Bagisto stores a radio's name rather than its value --}}
                      <input
                        type="radio"
                        name="{{ $fieldName }}"
                        value="{{ $option->name }}"
                        @required($required)
                      >
                    @endif
                    {{ $option->name }}
                  </label>
                @endforeach
              </div>
            </fieldset>
          @else
            <x-shop::ui.form.label :for="$fieldId" :required="$required">
              {{ $field->label }}
            </x-shop::ui.form.label>

            @if ($field->type === 'textarea')
              <textarea
                id="{{ $fieldId }}"
                name="{{ $fieldName }}"
                rows="3"
                class="w-full py-2"
                @required($required)
              ></textarea>
            @elseif (in_array($field->type, ['select', 'multiselect']))
              <select
                id="{{ $fieldId }}"
                name="{{ $field->type === 'multiselect' ? $fieldName . '[]' : $fieldName }}"
                class="w-full"
                @if ($field->type === 'multiselect') multiple @endif
                @required($required)
              >
                @if ($field->type === 'select')
                  <option value="">@lang('shop::app.customers.account.rma.create.select')</option>
                @endif
                @foreach ($field->options as $option)
                  <option value="{{ $option->value }}">{{ $option->name }}</option>
                @endforeach
              </select>
            @else
              <input
                id="{{ $fieldId }}"
                type="{{ $field->type === 'date' ? 'date' : 'text' }}"
                name="{{ $fieldName }}"
                class="w-full"
                @required($required)
              >
            @endif
          @endif
          <p
            class="text-danger mt-1 text-sm"
            x-show="errors['customAttributes.{{ $field->id }}']"
            x-text="errors['customAttributes.{{ $field->id }}']"
            x-cloak
          ></p>
        </div>
      @endforeach

      <div>
        <x-shop::ui.form.textarea
          name="information"
          :label="trans('shop::app.rma.customer.create.information')"
          rows="3"
          maxlength="250"
        />
        <p
          class="text-danger mt-1 text-sm"
          x-show="errors.information"
          x-text="errors.information"
          x-cloak
        ></p>
      </div>

      <div>
        <x-shop::ui.form.label>@lang('shop::app.customers.account.rma.create.images')</x-shop::ui.form.label>
        <div class="flex flex-wrap items-center gap-3">
          <label class="btn btn-sm btn-secondary btn-soft relative cursor-pointer">
            <x-lucide-image-plus class="h-4 w-4" />
            @lang('shop::app.customers.account.rma.view.add-attachments')
            <input
              type="file"
              class="sr-only"
              multiple
              x-ref="images"
              x-bind:accept="allowedTypes.join(',')"
              x-on:change="pickImages($event)"
            >
          </label>
          <template x-for="(image, index) in images" x-bind:key="index">
            <span class="bg-surface text-on-surface flex items-center gap-2 rounded px-2 py-1 text-sm">
              <span class="max-w-48 truncate" x-text="image.name"></span>
              <button
                type="button"
                class="text-primary hover:underline"
                x-on:click="removeImage(index)"
              >
                @lang('shop::app.customers.account.rma.view.remove')
              </button>
            </span>
          </template>
        </div>
        <p
          class="text-danger mt-1 text-sm"
          x-show="errors.images"
          x-text="errors.images"
          x-cloak
        ></p>
      </div>

      <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">
        <label class="flex cursor-pointer items-center gap-2">
          <input
            type="checkbox"
            name="agreement"
            value="1"
            required
          >
          @lang('shop::app.customers.account.rma.terms.terms')
        </label>

        @if ($returnPolicy)
          <x-shop::ui.modal id="rma-return-policy" :title="trans('visual-debut::shop.rma.return-policy')">
            <x-slot:trigger>
              <button type="button" class="text-primary hover:underline">
                @lang('shop::app.customers.account.rma.terms.read')
              </button>
            </x-slot:trigger>

            <div class="mt-4 max-h-[60vh] max-w-2xl overflow-y-auto whitespace-pre-line text-sm">{{ $returnPolicy }}</div>
          </x-shop::ui.modal>
        @endif
      </div>
      <p
        class="text-danger text-sm"
        x-show="errors.agreement"
        x-text="errors.agreement"
        x-cloak
      ></p>

      <div class="flex justify-end">
        <x-shop::ui.button
          type="submit"
          :loading="false"
          x-bind:disabled="submitting"
        >
          @lang('shop::app.rma.customer.submit-req')
        </x-shop::ui.button>
      </div>
    </div>
  </form>
</div>
