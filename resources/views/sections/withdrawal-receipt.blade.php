@php
  $status = $withdrawal->status;
  $orderNumber = $withdrawal->order->increment_id ?? $withdrawal->order_id;
  $orderUrl = $isGuest ? null : route('shop.customers.account.orders.view', $withdrawal->order_id);

  // Bagisto records the declaration in UTC and shows it that way, as evidence
  $utc = fn($date) => $date->copy()->setTimezone('UTC')->format('d M Y, H:i') . ' UTC';

  $badge =
      [
          'received' => 'bg-warning-100 text-warning-900',
          'refunded' => 'bg-success/15 text-success',
          'declined' => 'bg-danger/15 text-danger',
      ][$status] ?? 'bg-surface text-on-surface';

  $emailFailed = !$withdrawal->confirmation_sent_at && $withdrawal->confirmation_error;

  $done = 'bg-success/15 text-success';
  $pending = 'border-on-background/30 border opacity-60';
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  @class(['mx-auto max-w-3xl px-4 py-12' => $isGuest])
  x-data="VisualWithdrawalReceipt(@js(['copied' => trans('visual-debut::shop.eu-withdrawal.confirmation.reference-copied')]))"
>
  <div class="bg-background text-on-background box border-none shadow-sm" x-ref="receipt">
    <!-- Outcome -->
    <div class="flex flex-wrap items-center gap-4 border-b p-4">
      <span @class([
          'grid h-10 w-10 shrink-0 place-items-center rounded-full',
          'bg-danger/15 text-danger' => $status === 'declined',
          'bg-success/15 text-success' => $status !== 'declined',
      ])>
        @svg($status === 'declined' ? 'lucide-x' : 'lucide-check', ['class' => 'h-5 w-5', 'aria-hidden' => true])
      </span>

      <div class="min-w-0 flex-1 basis-56">
        <h1 class="text-2xl">
          @lang('visual-debut::shop.eu-withdrawal.confirmation.heading-' . $status)
        </h1>
        <p class="mt-1 text-sm opacity-80">
          @lang('visual-debut::shop.eu-withdrawal.confirmation.intro-' . $status)
        </p>
      </div>

      <x-shop::ui.button
        variant="soft"
        color="secondary"
        icon="lucide-printer"
        size="sm"
        :loading="false"
        data-print-hidden
        x-on:click="print()"
      >
        @lang('visual-debut::shop.eu-withdrawal.confirmation.print')
      </x-shop::ui.button>
    </div>

    <div class="space-y-6 p-6">
      <!-- Declaration -->
      <dl class="grid gap-x-6 gap-y-5 text-sm sm:grid-cols-2">
        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.received-at')
          </dt>
          <dd class="mt-1 font-medium">{{ $utc($withdrawal->received_at) }}</dd>
        </div>

        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.reference')
          </dt>
          <dd class="bg-surface text-on-surface mt-1 flex items-center gap-2 rounded-lg px-3 py-2">
            <code class="flex-1 break-all font-mono font-medium">{{ $withdrawal->uuid }}</code>
            <button
              type="button"
              class="hover:text-primary shrink-0 p-1 transition-colors"
              title="{{ trans('visual-debut::shop.eu-withdrawal.confirmation.copy-reference') }}"
              aria-label="{{ trans('visual-debut::shop.eu-withdrawal.confirmation.copy-reference') }}"
              data-print-hidden
              x-on:click="copy(@js($withdrawal->uuid))"
            >
              @svg('lucide-copy', ['class' => 'h-4 w-4', 'aria-hidden' => true])
            </button>
          </dd>
        </div>

        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.order')
          </dt>
          <dd class="mt-1 font-medium">
            @if ($orderUrl)
              <a href="{{ $orderUrl }}" class="text-primary hover:underline">#{{ $orderNumber }}</a>
            @else
              #{{ $orderNumber }}
            @endif
          </dd>
        </div>

        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.email')
          </dt>
          <dd class="mt-1 break-all font-medium">{{ $withdrawal->customer_email }}</dd>
        </div>

        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.status')
          </dt>
          <dd class="mt-1">
            <span class="{{ $badge }} inline-flex rounded-full px-3 py-1 text-xs font-semibold">
              @lang('visual-debut::shop.eu-withdrawal.confirmation.status-' . $status)
            </span>
          </dd>
        </div>

        <div>
          <dt class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('visual-debut::shop.eu-withdrawal.confirmation.reason')
          </dt>
          <dd class="mt-1 whitespace-pre-wrap">{{ $withdrawal->reason_text ?: '—' }}</dd>
        </div>
      </dl>

      <!-- What happens next -->
      <div class="border-t pt-6">
        <h2 class="text-lg font-semibold">
          @lang('visual-debut::shop.eu-withdrawal.confirmation.next-steps-title')
        </h2>

        <ol class="mt-4 space-y-4 text-sm">
          <li class="flex gap-3">
            <span class="{{ $done }} grid h-6 w-6 shrink-0 place-items-center rounded-full">
              @svg('lucide-check', ['class' => 'h-4 w-4', 'aria-hidden' => true])
            </span>
            <div>
              <p class="font-medium">@lang('visual-debut::shop.eu-withdrawal.confirmation.step-received')</p>
              <p class="text-xs opacity-70">{{ $utc($withdrawal->received_at) }}</p>
            </div>
          </li>

          <li class="flex gap-3">
            <span class="{{ $withdrawal->confirmation_sent_at ? $done : $pending }} grid h-6 w-6 shrink-0 place-items-center rounded-full">
              @if ($withdrawal->confirmation_sent_at)
                @svg('lucide-check', ['class' => 'h-4 w-4', 'aria-hidden' => true])
              @endif
            </span>
            <div>
              <p class="font-medium">@lang('visual-debut::shop.eu-withdrawal.confirmation.step-email')</p>
              <p @class([
                  'text-xs',
                  'text-warning-900' => $emailFailed,
                  'opacity-70' => !$emailFailed,
              ])>
                @if ($withdrawal->confirmation_sent_at)
                  @lang('visual-debut::shop.eu-withdrawal.confirmation.email-sent')
                @else
                  @lang('visual-debut::shop.eu-withdrawal.confirmation.email-pending')
                @endif
              </p>
            </div>
          </li>

          <li class="flex gap-3">
            @if ($withdrawal->refunded_at)
              <span class="{{ $done }} grid h-6 w-6 shrink-0 place-items-center rounded-full">
                @svg('lucide-check', ['class' => 'h-4 w-4', 'aria-hidden' => true])
              </span>
              <div>
                <p class="font-medium">@lang('visual-debut::shop.eu-withdrawal.confirmation.step-refund-done')</p>
                <p class="text-xs opacity-70">{{ $utc($withdrawal->refunded_at) }}</p>
              </div>
            @elseif ($withdrawal->declined_at)
              <span class="bg-danger/15 text-danger grid h-6 w-6 shrink-0 place-items-center rounded-full">
                @svg('lucide-x', ['class' => 'h-4 w-4', 'aria-hidden' => true])
              </span>
              <div class="flex-1">
                <p class="font-medium">@lang('visual-debut::shop.eu-withdrawal.confirmation.step-declined')</p>

                @if ($withdrawal->declined_reason)
                  <div class="bg-danger/10 border-danger/30 rounded-(--box-radius) mt-2 border p-3">
                    <p class="text-danger text-xs font-medium uppercase tracking-wide">
                      @lang('visual-debut::shop.eu-withdrawal.confirmation.declined-reason-label')
                    </p>
                    <p class="mt-1 whitespace-pre-wrap">{{ $withdrawal->declined_reason }}</p>
                  </div>
                @endif

                <p class="mt-2 text-xs opacity-70">@lang('visual-debut::shop.eu-withdrawal.confirmation.declined-notice')</p>
              </div>
            @else
              <span class="{{ $pending }} grid h-6 w-6 shrink-0 place-items-center rounded-full"></span>
              <div>
                <p class="font-medium">@lang('visual-debut::shop.eu-withdrawal.confirmation.step-refund')</p>
                <p class="text-xs opacity-70">@lang('visual-debut::shop.eu-withdrawal.confirmation.refund-notice')</p>
              </div>
            @endif
          </li>
        </ol>
      </div>

      <p class="text-xs opacity-70">
        @lang('visual-debut::shop.eu-withdrawal.confirmation.durable-medium-notice')
      </p>
    </div>
  </div>

  @if ($orderUrl)
    <a href="{{ $orderUrl }}" class="text-primary mt-6 inline-flex items-center gap-1 text-sm hover:underline">
      <x-lucide-arrow-left class="h-4 w-4 rtl:rotate-180" />
      @lang('shop::app.customers.account.orders.title')
    </a>
  @endif
</div>

@pushOnce('scripts')
  <style>
    .withdrawal-print-copy {
      display: none;
    }

    @media print {
      .withdrawal-print-hidden {
        display: none !important;
      }

      .withdrawal-print-copy {
        display: block;
        background: #fff;
        color: #000;
      }

      .withdrawal-print-copy [data-print-hidden] {
        display: none !important;
      }
    }
  </style>
@endPushOnce
