<div class="flex flex-col bg-white shadow-md tour">
    <div class="top">
        <img src="{{ $tour->mediumImageUrl }}" alt="{{ $tour->name }}" width="630" height="375" loading="lazy">
        <div class="top__overlay items-center">
            <div class="location">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                </svg>
                <span><?= $tour->location ?></span>
            </div>
            <div>{{ $tour->trip_activity_type }}</div>
        </div>
    </div>
    @if (trim($tour->best_value) !== '')
        <div class="offer">{{ $tour->best_value }}</div>
    @endif
    <div class="flex flex-col justify-between bottom flex-grow-1">
        <div class="flex flex-col p-4 flex-grow-1">
            {{-- Activity badge --}}
            <div class="mb-2 flex justify-between items-center gap-4">
                <span class="inline-block px-2 py-1 text-xs rounded-full bg-light">
                    {{ ucfirst(strtolower($tour->difficulty_grade_value)) }}
                </span>

                <div class="flex items-center gap-2">
                    <div class="flex items-center text-accent">
                        @for ($i = 0; $i < $tour->rating; $i++)
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                            </svg>
                        @endfor
                        @for ($i = 0; $i < 5 - $tour->rating; $i++)
                            <svg class="w-6 h-6" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-xs">({{ $tour->reviews_count }} reviews)</span>
                </div>
            </div>

            {{-- Tour Name --}}
            <a href="{{ route('front.trips.show', ['slug' => $tour->slug]) }}" class="mb-4 flex-grow-1">
                <h3 class="mb-2 text-2xl font-display text-gray">{{ $tour->name }}</h3>
            </a>


            {{-- Action Buttons --}}
            <div class="flex items-end justify-between">

                {{-- Price --}}
                @if ($tour->cost)
                    <div class="price">
                        <div class="mr-2 text-gray">
                            <span class="text-sm">
                                from
                            </span>
                            <s class="font-bold text-red">
                                US $ {{ number_format($tour->cost, 0) }}
                            </s>
                        </div>
                        <div class="font-display text-gray">
                            <span>US $</span>
                            @php
                                $price_arr = explode('.', number_format($tour->offer_price, 2));
                            @endphp
                            <span class="text-3xl"> {{ $price_arr[0] }} </span>
                        </div>
                    </div>
                @endif
                <div>
                    <div class="text-right">
                        {{ $tour->duration }} days
                    </div>
                    <a href="{{ route('front.trips.show', ['slug' => $tour->slug]) }}"
                        class="btn btn-primary">
                        Explore
                        <svg class="w-5 h-5">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
