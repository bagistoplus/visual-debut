@isset($product)
  @if ($product->getTypeInstance()->isCustomizable())
  @php
    $options = $product
        ->customizable_options()
        ->with(['customizable_option_prices'])
        ->get();
  @endphp

  @if ($options->isNotEmpty())
    <div {{ $block->editor_attributes }} x-data x-product-customizable="@js(['options' => $options, 'basePrice' => $product->getTypeInstance()->getMinimalPrice()])">
      <div class="space-y-4">
        @foreach ($options as $option)
          <div class="border-b pb-3 last:border-b-0">
            @switch($option->type)
              @case('text')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>
                <input
                  id="customizable-option-{{ $option->id }}"
                  type="text"
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}]"
                  x-model="selectedOptions[{{ $option->id }}]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                >

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('textarea')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>
                <textarea
                  id="customizable-option-{{ $option->id }}"
                  class="mt-1 w-full"
                  rows="2"
                  name="customizable_options[{{ $option->id }}]"
                  x-model="selectedOptions[{{ $option->id }}]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                ></textarea>

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('select')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                </label>
                <select
                  id="customizable-option-{{ $option->id }}"
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}]"
                  x-model.number="selectedOptions[{{ $option->id }}]"
                  wire:model.number="customizableOptions.{{ $option->id }}"
                  @if ($option->is_required) required @endif
                  :data-invalid="hasError({{ $option->id }})"
                >
                  @if ($option->is_required)
                    <option
                      value=""
                      disabled
                      selected
                      hidden
                    >
                      @lang('visual-debut::shop.product.customizable-options.choose')
                    </option>
                  @else
                    <option value="0">@lang('visual-debut::shop.product.customizable-options.none')</option>
                  @endif
                  @foreach ($option->customizable_option_prices as $price)
                    <option value="{{ $price->id }}">
                      {{ $price->label }}
                      @if ($price->price > 0)
                        + <x-shop::formatted-price :price="$price->price" />
                      @endif
                    </option>
                  @endforeach
                </select>

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('multiselect')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                </label>
                <select
                  id="customizable-option-{{ $option->id }}"
                  multiple
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}][]"
                  x-model.number="selectedOptions[{{ $option->id }}]"
                  wire:model.number="customizableOptions.{{ $option->id }}"
                  @if ($option->is_required) required @endif
                  :data-invalid="hasError({{ $option->id }})"
                >
                  @if ($option->is_required)
                    <option
                      value=""
                      disabled
                      selected
                      hidden
                    >@lang('visual-debut::shop.product.customizable-options.choose-options')</option>
                  @else
                    <option value="0">@lang('visual-debut::shop.product.customizable-options.none')</option>
                  @endif
                  @foreach ($option->customizable_option_prices as $price)
                    <option value="{{ $price->id }}">
                      {{ $price->label }}
                      @if ($price->price > 0)
                        + <x-shop::formatted-price :price="$price->price" />
                      @endif
                    </option>
                  @endforeach
                </select>

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('radio')
                <div class="space-y-2">
                  <label class="text-sm font-semibold" @if ($option->is_required) required @endif>
                    {{ $option->label }}
                  </label>

                  @foreach ($option->customizable_option_prices as $price)
                    <label class="flex items-center gap-2">
                      <input
                        type="radio"
                        name="customizable_options[{{ $option->id }}]"
                        value="{{ $price->id }}"
                        x-model.number="selectedOptions[{{ $option->id }}]"
                        wire:model.number="customizableOptions.{{ $option->id }}"
                        :data-invalid="hasError({{ $option->id }})"
                      >
                      <span>
                        {{ $price->label }}
                        @if ($price->price > 0)
                          + <x-shop::formatted-price :price="$price->price" />
                        @endif
                      </span>
                    </label>
                  @endforeach

                  @if ($option->is_required)
                    <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                      @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                    </span>
                  @endif

                  @error('customizableOptions.' . $option->id)
                    <span class="text-danger text-xs italic">{{ $message }}</span>
                  @enderror
                </div>
              @break

              @case('checkbox')
                <div class="space-y-2">
                  <label class="text-sm font-semibold" @if ($option->is_required) required @endif>
                    {{ $option->label }}
                  </label>

                  @foreach ($option->customizable_option_prices as $price)
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        name="customizable_options[{{ $option->id }}][]"
                        value="{{ $price->id }}"
                        x-model.number="selectedOptions[{{ $option->id }}]"
                        wire:model.number="customizableOptions.{{ $option->id }}"
                        :data-invalid="hasError({{ $option->id }})"
                      >
                      <span>
                        {{ $price->label }}
                        @if ($price->price > 0)
                          + <x-shop::formatted-price :price="$price->price" />
                        @endif
                      </span>
                    </label>
                  @endforeach

                  @if ($option->is_required)
                    <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                      @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                    </span>
                  @endif

                  @error('customizableOptions.' . $option->id)
                    <span class="text-danger text-xs italic">{{ $message }}</span>
                  @enderror
                </div>
              @break

              @case('date')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>
                <input
                  id="customizable-option-{{ $option->id }}"
                  type="date"
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}]"
                  x-model="selectedOptions[{{ $option->id }}]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                >

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('datetime')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>
                <input
                  id="customizable-option-{{ $option->id }}"
                  type="datetime-local"
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}]"
                  x-model="selectedOptions[{{ $option->id }}]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                >

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('time')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>
                <input
                  id="customizable-option-{{ $option->id }}"
                  type="time"
                  class="mt-1 w-full"
                  name="customizable_options[{{ $option->id }}]"
                  x-model="selectedOptions[{{ $option->id }}]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                >

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break

              @case('file')
                <label
                  for="customizable-option-{{ $option->id }}"
                  class="text-sm font-semibold"
                  @if ($option->is_required) required @endif
                >
                  {{ $option->label }}
                  @if ($option->customizable_option_prices->isNotEmpty() && $option->customizable_option_prices->first()->price > 0)
                    <span class="text-secondary text-xs font-normal">
                      + <x-shop::formatted-price :price="$option->customizable_option_prices->first()->price" />
                    </span>
                  @endif
                </label>

                @if ($option->supported_file_extensions)
                  <p class="text-secondary mt-1 text-xs">
                    @lang('visual-debut::shop.product.customizable-options.allowed-types'):
                    {{ strtoupper(str_replace(',', ', ', $option->supported_file_extensions)) }}
                  </p>
                @endif

                <input
                  id="customizable-option-{{ $option->id }}"
                  type="file"
                  class="mt-1 w-full py-2"
                  name="customizable_options[{{ $option->id }}]"
                  @if ($option->supported_file_extensions)
                    accept="{{ collect(explode(',', $option->supported_file_extensions))->map(fn($ext) => '.' . trim($ext))->implode(',') }}"
                  @endif
                  x-on:change="selectedOptions[{{ $option->id }}] = $event.target.files[0]"
                  wire:model="customizableOptions.{{ $option->id }}"
                  :data-invalid="hasError({{ $option->id }})"
                >

                @if ($option->is_required)
                  <span x-show="hasError({{ $option->id }})" class="text-danger text-xs italic">
                    @lang('visual-debut::shop.product.option-required', ['option' => $option->label])
                  </span>
                @endif

                @error('customizableOptions.' . $option->id)
                  <span class="text-danger text-xs italic">{{ $message }}</span>
                @enderror
              @break
            @endswitch
          </div>
        @endforeach
      </div>

      <!-- Total Price Display -->
      <div class="mb-2.5 mt-5 flex items-center justify-between">
        <p class="text-sm font-semibold">
          @lang('shop::app.products.view.type.simple.customizable-options.total-amount')
        </p>

        <p class="text-primary text-lg font-medium">
          <span x-text="formattedTotalPrice"></span>
        </p>
      </div>
    </div>
  @endif
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="text-muted">
    <div class="border-b pb-3">
      <label class="text-sm font-semibold">
        @lang('visual-debut::blocks.product-customizable-options.placeholder.customizable-option')
        <span class="text-secondary text-xs font-normal">+ $5.00</span>
      </label>
      <input type="text" class="mt-1 w-full" disabled placeholder="{{ trans('visual-debut::blocks.product-customizable-options.placeholder.enter-value') }}">
    </div>
  </div>
  @end_visual_design_mode
@endisset
