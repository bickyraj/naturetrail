<div class="relative pt-10">
    <div class="max-w-6xl mx-auto px-4">
    <!--<div class="container">-->
        <div class="grid gap-10 lg:grid-cols-3">
            <div>
                 <img src="{{ asset('assets/front/img/plan-trip.webp') }}">
            </div>
            <div class="lg:col-span-2 px-4 py-10 prose">
                <h2>
                    <div class="mb-4 text-left text-gray-600 text-3xl lg:text-5xl font-bold">
                        Plan your trip with local expert.
                    </div>
                    <div class="text-left text-gray-600 text-2xl lg:text-4xl font-handwriting font-bold">
                        The most authentic way to see the world.
                    </div>
                </h2>
                <p>Inquire me and I will tailor-made your holidays! You will have incredible experiences and life time memory!</p> 
                @if(request()->routeIs('home'))
                <a href="{{ route('front.plantrip') }}" class="btn btn-accent" style="text-decoration:none;">Plan Your Trip</a>
                @else
                <a href="{{ route('front.contact.index') }}" class="btn btn-accent" style="text-decoration:none;">Contact Us</a>
                @endif
            </div>
        </div>
    </div>
</div>