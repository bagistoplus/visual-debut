<div class="relative">

    <input
        type="search"
        wire:model.live="query"
        minlength="{{ core()->getConfigData('catalog.products.search.min_query_length') }}"
        maxlength="{{ core()->getConfigData('catalog.products.search.max_query_length') }}"
        placeholder="@lang('visual-debut::sections.header.blocks.search.placeholder')"
        aria-label="@lang('visual-debut::sections.header.blocks.search.placeholder')"
        aria-required="true"
        pattern="[^\\]+"
        required
        class="p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-gray-900 placeholder-gray-400"
    >
    @if (strlen($query) > 0)
        @if (count($results))
            <ul class=" absolute z-10 mt-2 w-full bg-white border border-gray-300 shadow" style="background-color: white !important; max-height: 400px !important; overflow-y: auto;">
                @foreach ($results as $result)
                    @php
                        $image = optional($result->product->images->first())->path;
                        $imageUrl = $image ? asset('storage/' . $image) : asset('images/default.jpg');
                    @endphp

                    <li class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <a href="{{  $result->url_key }}" class="flex items-center w-full">
                            {{-- Product Image --}}
                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $result->name }}"
                                class="object-cover mr-4 h-12 w-12 max-h-12 max-w-12"
                                style="max-height: 3rem; max-width: 3rem;"
                            >

                            {{-- Name and Price --}}
                            <div class="flex flex-col">
                                <span>{{ $result->name }}</span>
                                <span class="font-bold">
                            {{ core()->currency($result->price) }}
                        </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="absolute z-10 mt-2 w-full bg-white border border-gray-300 shadow px-4 py-2 text-center text-gray-500" style="background-color: white !important;">
                No results found.
            </div>
        @endif
    @endif


</div>
