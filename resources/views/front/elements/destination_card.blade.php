<div class="destination relative">
    <a href="{{ route('front.destinations.show', $destination->slug) }}">
        <div class="destination__img"><img src="{{ $destination->mediumImageUrl }}" class="block" alt="{{ $destination->name }}" width="630" height="375"></div>
        <div class="absolute text bg-white px-4 py-2 text-center shadow-sm">
            <h3 class="font-bold">{{ $destination->name }}</h3>
            <div class="text-gray text-sm">{{ $destination->trips->count() }} tours</div>
        </div>
    </a>
</div>
