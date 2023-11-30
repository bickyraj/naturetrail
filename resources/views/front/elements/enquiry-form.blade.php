<h2 class="mb-8 text-2xl uppercase font-display text-gray-600">Quick Enquiry</h2>
<form id="enquiry-form" action="{{ route('front.contact.store') }}" method="POST" style="width:320px" >
    @csrf
    <input type="hidden" id="redirect-url" name="redirect_url">
    <div class="mb-2 form-group">
        <label class="sr-only" for="">Name</label>
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center p-2 rounded-full bg-gray">
                <svg class="w-4 h-4 text-light-gray">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#users" />
                </svg>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
    </div>
    <div class="mb-2 form-group">
        <label class="sr-only" for="email">E-mail</label>
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center p-2 rounded-full bg-gray">
                <svg class="w-4 h-4 text-light-gray">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                </svg>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
    </div>
    <div class="mb-2 form-group">
        <label class="sr-only" for="country">Country</label>
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center p-2 rounded-full bg-gray">
                <svg class="w-4 h-4 text-light-gray">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#flag" />
                </svg>
            </div>
            <input name="country" id="" class="form-control" list="countries" placeholder="Country">
        </div>
    </div>
    <div class="mb-2 form-group">
        <label class="sr-only" for="phone">Phone Number</label>
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center p-2 rounded-full bg-gray">
                <svg class="w-4 h-4 text-light-gray">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                </svg>
            </div>
            <input type="tel" name="phone" class="form-control" placeholder="Phone No.">
        </div>
    </div>
    <div class="mb-2 form-group">
        <label class="sr-only" for="">Message</label>
        <div class="flex items-center">
            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
        </div>
    </div>
    <div class="mb-2 form-group">
        <input type="hidden" id="enquiry-recaptcha" name="enquiry-recaptcha">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>