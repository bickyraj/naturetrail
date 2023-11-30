<a href="{{ route('front.activities.show', $activity->slug) }}" class="activity">
    <div class="relative">
        <img src="{{ $activity->mediumImageUrl }}" alt="{{ $activity->name }}" class="block w-full" width="630" height="375" loading="lazy">
        <div class="text absolute text-white px-2 py-4">
            <h3 class="font-display uppercase">{{ $activity->name }}</h3>
            <div class="tours">
                <span class="fs-xl bold">{{ $activity->trips->count() }}</span>
                <span class="fs-sm">tours</span>
            </div>
        </div>
    </div>
</a>