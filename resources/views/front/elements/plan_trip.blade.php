<div class="relative pt-10">
    <div class="max-w-6xl mx-auto px-4">
        <!--<div class="container">-->
        <div class="grid lg:gap-10 lg:grid-cols-3">
            <div>
                <img src="{{ asset('assets/front/img/plan-trip.webp') }}" alt="Bishnu Subedi">
            </div>
            <div class="lg:col-span-2 px-4 py-10">
                <h2 class="mb-4">
                    <div class="mb-4 text-left text-gray-600 text-3xl lg:text-4xl font-bold">
                        Plan your trip with <span class="text-primary uppercase">local expert</span>.
                    </div>
                    <div class="text-left text-gray-600 text-xl lg:text-3xl font-handwriting font-bold">
                        The most authentic way to see the world.
                    </div>
                </h2>

                <div class="prose mb-6">
                    <p>Feel free to inquire with me, and I will craft a customized holiday experience for you! You're in for incredible adventures and the creation of unforgettable memories!</p>
                </div>

                @if (request()->routeIs('home'))
                    <a href="{{ route('front.plantrip') }}" class="btn btn-accent" style="text-decoration:none;">Plan Your Trip</a>
                @else
                    <a href="{{ route('front.contact.index') }}" class="btn btn-accent" style="text-decoration:none;">Contact Us</a>
                @endif
            </div>
        </div>
    </div>
</div>
