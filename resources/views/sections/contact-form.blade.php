@push('scripts')
  {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
@endpush

<div {{ $section->editor_attributes }} class="py-12">
  <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
    <div class="bg-surface text-on-surface box p-8 shadow-sm">
      <h1 class="mb-6 text-3xl">
        @lang('shop::app.home.contact.title')
      </h1>

      <p class="text-on-surface/80 mb-6 text-lg">
        @lang('shop::app.home.contact.about')
      </p>

      <form
        method="POST"
        action="{{ route('shop.home.contact_us.send_mail') }}"
        class="space-y-6"
      >
        @csrf

        <div>
          <label
            for="name"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.home.contact.name')
          </label>

          <input
            id="name"
            required
            type="text"
            name="name"
            class="mt-1"
            placeholder="{{ trans('shop::app.home.contact.name') }}"
          >

          @error('name')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label
            for="email"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.home.contact.email')
          </label>

          <input
            id="email"
            required
            type="text"
            name="email"
            autocomplete="email"
            class="mt-1"
            placeholder="{{ trans('shop::app.home.contact.email') }}"
          >

          @error('email')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="contact" class="block text-sm font-medium">
            @lang('shop::app.home.contact.phone-number')
          </label>

          <input
            id="contact"
            type="text"
            name="contact"
            class="mt-1"
            placeholder="{{ trans('shop::app.home.contact.phone-number') }}"
          >

          @error('contact')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label
            for="message"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.home.contact.desc')
          </label>

          <textarea
            id="message"
            name="message"
            required
            class="mt-1 min-h-[150px] w-full"
            placeholder="{{ trans('shop::app.home.contact.describe-here') }}"
          ></textarea>

          @error('message')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <!-- Captcha -->
        @if (core()->getConfigData('customer.captcha.credentials.status'))
          <div class="[&_.control-error]:text-danger mt-4 flex flex-col items-center gap-2 [&_.control-error]:text-xs">
            {!! \Webkul\Customer\Facades\Captcha::render() !!}
          </div>
        @endif

        <div class="text-center">
          <x-shop::ui.button icon="lucide-send">
            @lang('shop::app.home.contact.submit')
          </x-shop::ui.button>
        </div>
      </form>
    </div>
  </div>
</div>
