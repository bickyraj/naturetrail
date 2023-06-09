<div class="relative">
    <div class="grid gap-10 lg:grid-cols-2">
        <div>
            <img src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}" style="border-radius: 10px;">
        </div>
        <div>
            <h2 class="mb-2 text-3xl uppercase font-display">
                {{ $tour->name }}
            </h2>
            <p> {{ truncate(strip_tags($tour->trip_info['overview'])) }} </p>

            <div class="flex mb-4 wrap">
                <div class="flex p-2 mr-2 aic">
                    <svg class="w-6 h-6 mr-1">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Duration</div>
                        <span class="fs-lg bold"> <?= $tour->duration ?> </span> days
                    </div>
                </div>
                <div class="flex p-2 aic">
                    <svg class="w-6 h-6 mr-1">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#emojihappy') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Difficulty</div>
                        {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
            </div>

            <div class="mb-4 price">
                <div class="text-accent">
                    <span class="text-sm">
                        from
                    </span>
                    <s class="font-bold">
                        USD {{ number_format($tour->cost, 2) }}
                    </s>
                </div>
                <div class="font-display">
                    <span>USD</span>
                    @php
                        $price_arr = explode('.', number_format($tour->offer_price, 2));
                    @endphp
                    <span class="text-4xl">{{ $price_arr[0] }}</span>
                    <span>.{{ $price_arr[1] }}</span>
                </div>
            </div>

            <div>
                <a href="{{ route('front.trips.show', $tour->slug) }}" class="btn btn-accent">
                    Explore
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}"></use>
                    </svg>
                </a>
                {{-- <a href="tour-details.php" class="btn btn-gray">
                    Book Now
                </a> --}}
            </div>
        </div>
    </div>
</div>
