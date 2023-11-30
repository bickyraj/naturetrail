<div class="relative">
    <div class="grid gap-10 lg:grid-cols-2">
        <div>
            <img src="{{ $tour->mediumImageUrl }}" alt="{{ $tour->name }}" style="border-radius: 10px;">
        </div>
        <div>
            <h3 class="mb-2 text-3xl font-display">
                {{ $tour->name }}
            </h3>
            <div class="mb-2">
                <svg class="w-6 h-6 text-primary">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                </svg>
                <span>{{ $tour->location }}</span>
            </div>
            <p> {{ Str::limit(strip_tags($tour->trip_info['overview'] ?? ''), 240) }} </p>

            <div class="flex mb-4 wrap">
                <div class="flex p-2 mr-2 gap-2">
                    <svg class="w-10 h-10 text-primary">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}"></use>
                    </svg>
                    <div>
                        <div class="font-bold text-sm">Duration</div>
                        <span class="fs-lg bold"> <?= $tour->duration ?> </span> days
                    </div>
                </div>
                <div class="flex p-2 mr-2 items-center">
                    <svg "http://www.w3.org/2000/svg" viewbox="0 0 50 50" class="flex-shrink-0 w-10 h-10 mr-2 text-primary">
                        <circle cx="25" cy="25" r="20" fill="none" stroke="#ccc" stroke-width="10" />
                        @php
                            $circ = 2 * pi() * 20;
                        @endphp
                        @if (strtolower($tour->difficulty_grade_value) === 'beginner')
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#48d441" stroke-dasharray="{{ $circ / 5 }} {{ ($circ / 5) * 4 }}"
                                stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                        @elseif (strtolower($tour->difficulty_grade_value) === 'easy')
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#99e330" stroke-dasharray="{{ ($circ / 5) * 2 }} {{ ($circ / 5) * 3 }}"
                                stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                        @elseif (strtolower($tour->difficulty_grade_value) === 'moderate')
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#f1f41d" stroke-dasharray="{{ ($circ / 5) * 3 }} {{ ($circ / 5) * 2 }}"
                                stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                        @elseif (strtolower($tour->difficulty_grade_value) === 'difficult')
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#e47517" stroke-dasharray="{{ ($circ / 5) * 4 }} {{ $circ / 5 }}"
                                stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                        @elseif (strtolower($tour->difficulty_grade_value) === 'advance')
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#d91212" stroke-width="10" />
                        @endif
                    </svg>
                    <div>
                        <div class="font-bold text-sm">Difficulty</div>
                        {{ ucfirst(strtolower($tour->difficulty_grade_value)) }}
                    </div>
                </div>
            </div>

            <div class="flex justify-between gap-10">
                @if ($tour->cost)
                    <div class="mb-4 price">
                        <div>
                            <span class="text-sm">
                                from
                            </span>
                            <s class="font-bold text-red">
                                US $ {{ number_format($tour->cost) }}
                            </s>
                        </div>
                        <div class="font-display">
                            <span>US $</span>
                            @php
                                $price_arr = explode('.', number_format($tour->offer_price));
                            @endphp
                            <span class="text-4xl">{{ $price_arr[0] }}</span>
                        </div>
                    </div>
                @endif
                <div>
                    <a href="{{ route('front.trips.show', $tour->slug) }}" class="btn btn-primary">
                        Explore
                        <svg class="w-5 h-5">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}"></use>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
