<div class="price-card bg-gray mb-6 pt-4">

    <div class="p-10">
        @if($trip->cost)
            <div class="flex justify-between gap-6 mb-4">
                <div>
                    Save
                    <div class="font-bold text-2xl text-gray-600 font-display">US$ {{ number_format($trip->cost - $trip->offer_price) }}</div>
                </div>
                <div>
                    <div class="">
                        <span class="mr-2">Group discount</span>
                    </div>
                    <div>
                        <div>
                            <s class="font-bold text-red text-lg">US ${{ number_format($trip->cost) }}</s>
                        </div>
                        <span class="font-display font-bold text-3xl text-gray-600">US $</span>
                        <span class="font-display font-bold text-3xl text-gray-600">{{ number_format($trip->offer_price) }}</span>
                        <div class="text-sm">(per person)</div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mb-2 text-center">
            <a href="{{ route('front.trips.booking', $trip->slug) }}" class="mb-2 btn btn-accent w-full">Book Now</a>
            <a href="{{ route('front.plantrip.createfortrip', $trip->slug) }}" class="btn btn-primary">
                <svg class="w-6 h-6 flex-shrink-0 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#adjustments" />
                </svg>
                Plan My Trip
            </a>
        </div>
        <div class="actions p-1">
            <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="flex items-center p-1" title="Print tour details">
                <svg class="w-4 h-4 flex-shrink-0 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#printer" />
                </svg>
                <span class="text-sm">Print Tour Details</span>
            </a>
            <a href="#" class="flex items-center p-1" title="">
                <svg class="w-4 h-4 flex-shrink-0 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#download" />
                </svg>
                <span class="text-sm">Download Tour Brochure</span>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.trips.show', ['slug' => $trip->slug]) }}" class="flex items-center p-1" title="Share tour">
                <svg class="w-4 h-4 flex-shrink-0 mr-2">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#share" />
                </svg>
                <span class="text-sm">Share Tour</span>
            </a>
        </div>
    </div>
    {{-- <div class="bg-light p-2">
        <div class="mb-2 font-bold">Get group discounts</div>
        <table>
            <thead>
                <th class="font-display px-1 py-2">Group size</th>
                <th class="font-display px-1 py-2">Price per person</th>
            </thead>
            <tbody>
                <tr>
                    <td class="px-1 py-2 text-sm">1 person</td>
                    <td class="px-1 py-2 text-sm text-right">$1500</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">2 - 4 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1450</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">5-10 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1425</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">10-20 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1415</td>
                </tr>
                <tr>
                    <td class="px-1 py-2 text-sm">more than 20 people</td>
                    <td class="px-1 py-2 text-sm text-right">$1415</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
</div>
