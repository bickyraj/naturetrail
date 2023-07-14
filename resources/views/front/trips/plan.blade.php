<?php
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>

@push('styles')
<style>
    .step{
        flex-basis: 1;
    }
    .step:not(:first-child)::before{
        content: '';
        position: absolute;
        top: 1.3rem;
        right: 50%;
        width: 100%;
        height: .5rem;
        background-color: #f0f8ff;
        z-index: -1;
    }
    .step.active:not(:first-child)::before{
        background-color: #709bf0;
    }
    .step .step-bg{
        display:flex;justify-content:center;align-items:center;width:3rem;height:3rem;background-color:#f0f8ff;border-radius:100%;
    }
    .step.active .step-bg{
        background-color: #709bf0;
    }
    .step.active img{
        filter: brightness(10);
    }
    
    .radio-input, .radio-input-compact, .check-input{
        opacity: 0;
        position: absolute;
    }
    .radio-input + label{
        position: relative;
        display: flex;
        gap: 1rem;
        align-items: center;
        padding: 2rem 1rem;
        background-color: #f0f8ff;
        cursor: pointer;
    }
    .radio-input + label.col{
        gap: .5rem;
        flex-direction: column;
    }
    .radio-input + label:hover{
        background-color: #d6e0f5;
    }
    .radio-input:checked + label{
        background-color: #709bf0;
        color: white;
    }
    .radio-input:checked + label img{
        filter: brightness(6);
    }
    
    .radio-input-compact + label{
        position: relative;
        display: flex;
        gap: 1rem;
        align-items: center;
        padding: 1rem;
        background-color: #f0f8ff;
        cursor: pointer;
    }
    .radio-input-compact + label svg{
        color: #8080e0;
    }
    .radio-input-compact + label.col{
        gap: .5rem;
        flex-direction: column;
    }
    .radio-input-compact + label:hover{
        background-color: #d6e0f5;
    }
    .radio-input-compact:checked + label{
        background-color: #709bf0;
        color: white;
    }
    .radio-input-compact + label .check{
        fill: #8080e0;
        opacity: 0;
    }
    .radio-input-compact:checked + label .check{
        opacity: 1;
    }
    
    .check-input + label{
        position: relative;
        display: flex;
        gap: 1rem;
        align-items: center;
        padding: 1rem;
        background-color: #f0f8ff;
        cursor: pointer;
    }
    .check-input + label.col{
        gap: .5rem;
        flex-direction: column;
    }
    .check-input + label:hover{
        background-color: #d6e0f5;
    }
    .check-input:checked + label{
        background-color: #709bf0;
        color: white;
    }
    .check-input + label .check{
        fill: #8080e0;
        opacity: 0;
    }
    .check-input:checked + label .check{
        opacity: 1;
    }
    
</style>
@endpush

@extends('layouts.front_inner')

@section('content')
    <!-- Hero -->
    <section class="relative hero-alt">
        <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" style="max-height: 400px;">
        <div class="absolute overlay">
            <div class="container ">
                <h1>Plan My Trip</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Plan My Trip</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20" x-data="">
        <div class="max-w-6xl mx-auto px-4 grid gap-20">
        
            {{-- Progress --}}
            <div class="hidden lg:flex">
                {{-- Mark each step as active if it is complete or current --}}
                <button class="step active relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/who.png') }}" class="w-8 h-8 object-contain"></div>Who</button>
                <button class="step active relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/when.svg') }}" class="w-8 h-8 object-contain"></div>When</button>
                <button class="step relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/where.svg') }}" class="w-8 h-8 object-contain"></div>Where</button>
                <button class="step relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/accomodation.png') }}" class="w-8 h-8 object-contain"></div>Accomodation</button>
                <button class="step relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/budget.svg') }}" class="w-8 h-8 object-contain"></div>Budget</button>
                <button class="step relative flex-grow flex gap-2 flex-col items-center"><div class="step-bg"><img src="{{ asset('assets/front/img/tailor-made.svg') }}" class="w-8 h-8 object-contain"></div>Tailor-made tour</button>
            </div>
            
            {{-- Form --}}
            <form>
                
                {{-- Who --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg lg:text-3xl text-center">How are you travelling? <span class="text-red">*</span></legend>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                            <div>
                                <input type="radio" id="solo" name="who" value="solo" class="radio-input">
                                <label class="col" for="solo">
                                    <img src="{{ asset('assets/front/img/solo.svg') }}" class="h-12 lg:h-24">
                                    Solo
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="couple" name="who" value="couple" class="radio-input">
                                <label class="col" for="couple">
                                    <img src="{{ asset('assets/front/img/couple.svg') }}" class="h-12 lg:h-24">
                                    Couple
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="family" name="who" value="family" class="radio-input">
                                <label class="col" for="family">
                                    <img src="{{ asset('assets/front/img/family.svg') }}" class="h-12 lg:h-24">
                                    Family
                              </label>
                            </div>
                            
                            <div>
                                <input type="radio" id="group" name="who" value="group" class="radio-input">
                                <label class="col" for="group">
                                    <img src="{{ asset('assets/front/img/group.svg') }}" class="h-12 lg:h-24">
                                    Group
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="flex flex-wrap gap-8">
                        <div class="form-group">
                            <label for="adults">
                                No. of adults <span class="text-red">*</span>
                            </label>
                            <select id="adults" class="form-control">
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="children">
                                No. of children <span class="text-red">*</span>
                            </label>
                            <select id="children" class="form-control">
                                <option selected>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- When --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg lg:text-3xl text-center">Arrival date <span class="text-red">*</span></legend>
                        <div class="grid lg:grid-cols-3 gap-8">
                            <div>
                                <input type="radio" id="exact-date" name="when" value="solo" class="radio-input">
                                <label for="exact-date">
                                    <img src="{{ asset('assets/front/img/exact-date.svg') }}" class="h-12">
                                    I have exact travel dates.
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="approx-date" name="when" value="couple" class="radio-input">
                                <label for="approx-date">
                                    <img src="{{ asset('assets/front/img/approx-date.svg') }}" class="h-12">
                                    I have approximate travel dates.
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="decide-later" name="when" value="family" class="radio-input">
                                <label for="decide-later">
                                    <img src="{{ asset('assets/front/img/decide-later.svg') }}" class="h-12">
                                    I will decide later.
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="flex flex-wrap gap-8">
                        <div class="form-group">
                            <label for="arrival-date">
                                Arrival date <span class="text-red">*</span>
                            </label>
                            <input type="date" id="arrival-date">
                        </div>
                        <div class="form-group">
                            <label for="departure-date">
                                Departure date <span class="text-red">*</span>
                            </label>
                            <input type="date" id="departure-date">
                        </div>
                        <div class="form-group">
                            <label for="approx-month">
                                Select month <span class="text-red">*</span>
                            </label>
                            <input type="month" id="approx-month">
                        </div>
                    </div>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- Where --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg lg:text-3xl text-center">Choose your destination <span class="text-red">*</span></legend>
                        <div class="grid lg:grid-cols-4 gap-8 mb-8">
                            <div>
                                <input type="checkbox" id="nepal" class="check-input">
                                <label for="nepal">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Nepal
                              </label>
                            </div>
                        
                            <div>
                                <input type="checkbox" id="tibet" class="check-input">
                                <label for="tibet">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Tibet
                              </label>
                            </div>
                        
                            <div>
                                <input type="checkbox" id="bhutan" class="check-input">
                                <label for="bhutan">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Bhutan
                              </label>
                            </div>
                            
                            <div>
                                <input type="checkbox" id="india" class="check-input">
                                <label for="india">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    India
                              </label>
                            </div>
                        </div>
                        
                        <div>
                            <input type="checkbox" id="not-sure" class="check-input">
                            <label for="not-sure">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                    <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                    <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                </svg>
                                I am not sure!
                            </label>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <div class="flex flex-wrap justify-between mb-4">
                            <legend class="text-lg text-center">Choose the trip(s) you are interested in <span class="text-red">*</span></legend>
                        </div>
                        <div class="grid lg:grid-cols-4 gap-8 ">
                            <div>
                                <input type="checkbox" id="nepal" class="check-input">
                                <label for="nepal">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Everest Base Camp Trek
                              </label>
                            </div>
                        
                            <div>
                                <input type="checkbox" id="tibet" class="check-input">
                                <label for="tibet">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Annapurna Base Camp Trek
                              </label>
                            </div>
                        
                            <div>
                                <input type="checkbox" id="bhutan" class="check-input">
                                <label for="bhutan">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Mardi Himal Trek
                              </label>
                            </div>
                            
                            <div>
                                <input type="checkbox" id="india" class="check-input">
                                <label for="india">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <rect x="0" y="0" width="20" height="20" fill="white" stroke="currentColor"/>
                                        <path class="check" clip-rule="evenodd" fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"></path>
                                    </svg>
                                    Langtang Valley Trek
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- Accomodation --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-8 text-lg lg:text-3xl text-center">Preferred accomodation standard <span class="text-red">*</span></legend>
                        <div class="grid lg:grid-cols-5 gap-8">
                            <div>
                                <input type="radio" id="basic" name="accomodation" value="solo" class="radio-input">
                                <label class="col" for="basic">
                                    <img src="{{ asset('assets/front/img/basic.svg') }}" class="h-12 lg:h-24">
                                    Basic
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="comfortable" name="accomodation" value="couple" class="radio-input">
                                <label class="col" for="comfortable">
                                    <img src="{{ asset('assets/front/img/comfortable.svg') }}" class="h-12 lg:h-24">
                                    Comfortable
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="luxury" name="accomodation" value="family" class="radio-input">
                                <label class="col" for="luxury"><img src="{{ asset('assets/front/img/luxury.svg') }}" class="h-12 lg:h-24">
                                    Luxury
                              </label>
                            </div>
                              
                            <div>
                                <input type="radio" id="camping" name="accomodation" value="family" class="radio-input">
                                <label class="col" for="camping">
                                    <img src="{{ asset('assets/front/img/camping.svg') }}" class="h-12 lg:h-24">
                                    Camping
                              </label>
                            </div>
                            
                            <div>
                                <input type="radio" id="self-booking" name="accomodation" value="family" class="radio-input">
                                <label class="col" for="self-booking">
                                    <img src="{{ asset('assets/front/img/self-booking.svg') }}" class="h-12 lg:h-24">
                                    Self booking
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- Budget --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-4 text-lg lg:text-3xl text-center">Budget range (per person) <span class="text-red">*</span></legend>
                        Budget range slider
                    </fieldset>
                    
                    <fieldset>
                        <legend class="mb-4 text-lg lg:text-2xl text-center">Are you flexible with a change in budget? <span class="text-red">*</span></legend>
                        <div class="grid lg:grid-cols-2 gap-8">
                            <div>
                                <input type="radio" id="flexible" name="flexible" value="solo" class="radio-input">
                                <label for="flexible">
                                    <img src="{{ asset('assets/front/img/flexible-budget.svg') }}" class="h-12">
                                    Yes, I am flexible. Plan the best trip for me.
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="not-flexible" name="flexible" value="couple" class="radio-input">
                                <label for="not-flexible">
                                    <img src="{{ asset('assets/front/img/fixed-budget.svg') }}" class="h-12">
                                    No, that is my maximum and minimum budget.
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- Tailor-made tour --}}
                <div class="grid gap-8 py-10">
                    <fieldset>
                        <legend class="mb-4 lg:text-lg">Trip type you are looking for<span class="text-red">*</span></legend>
                        <div class="flex gap-1">
                            <div>
                                <input type="radio" id="tailor-made" name="trip-type" value="tailor-made" class="radio-input-compact">
                                <label for="tailor-made">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    Tailor-made
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="type-group" name="trip-type" value="group" class="radio-input-compact">
                                <label for="type-group">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check"/>
                                    </svg>
                                    Group
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend class="mb-4 lg:text-lg">Current phase of trip planning<span class="text-red">*</span></legend>
                        <div class="flex flex-wrap gap-1">
                            <div>
                                <input type="radio" id="planning" name="plan-phase" value="planning" class="radio-input-compact">
                                <label for="planning">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I am still planning on my trip.
                              </label>
                            </div>
                        
                            <div>
                                <input type="radio" id="ready" name="plan-phase" value="ready" class="radio-input-compact">
                                <label for="ready">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I am ready to start.
                              </label>
                            </div>
                            
                            <div>
                                <input type="radio" id="book" name="plan-phase" value="book" class="radio-input-compact">
                                <label for="book">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                    I want to book.
                              </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="grid lg:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="arrival-date">
                                Any additional queries?
                            </label>
                            <textarea name="additional_queries" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="departure-date">
                                How did you hear about us? <span class="text-red">*</span>
                            </label>
                            <select id="departure-date" class="form-control">
                                <option value="0">Select One</option>
                                <option value="Blog">Blog</option>
                                <option value="Club/Association">Club/Association</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Friend Recommendation">Friend Recommendation</option>
                                <option value="HGT Brochures/Flyers">HGT Brochures/Flyers</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Internet Search">Internet Search</option>
                                <option value="Lonely Planet Guides">Lonely Planet Guides</option>
                                <option value="New York Times">New York Times</option>
                                <option value="Newspaper Article">Newspaper Article</option>
                                <option value="Online Advertising">Online Advertising</option>
                                <option value="Past Client">Past Client</option>
                                <option value="Trade Partners">Trade Partners</option>
                                <option value="Trade Show">Trade Show</option>
                                <option value="Trek Leader/Staff Recommended">Trek Leader/Staff Recommended</option>
                                <option value="Trip Advisor">Trip Advisor</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Next</button>
                    </div>
                </div>
                
                {{-- Personal Information --}}
                <div class="grid gap-8 py-10">
                    <h2 class="text-lg lg:text-2xl">PERSONAL INFORMATION</h2>
                    <p>Please fill in the form below. Our customer support will get back to you as soon as possible.</p>
                    <div class="grid lg:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="first-name">First Name <span class="text-red">*</span></label>
                            <input type="text" id="first-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name <span class="text-red">*</span></label>
                            <input type="text" id="last-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contact-no">Contact number <span class="text-red">*</span></label>
                            <input type="tel" id="contact-no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-red">*</span></label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality <span class="text-red">*</span></label>
                            <select id="nationality" class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <fieldset>
                            <legend>Preferred method of contact<span class="text-red">*</span></legend>
                            <div class="flex flex-wrap gap-1">
                                <div>
                                    <input type="radio" id="method-email" name="contact_method" value="email" class="radio-input-compact">
                                    <label for="method-email">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                        Email
                                  </label>
                                </div>
                            
                                <div>
                                    <input type="radio" id="method-phone" name="contact_method" value="phone" class="radio-input-compact">
                                    <label for="method-phone">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                        Phone
                                  </label>
                                </div>
                                
                                <div>
                                    <input type="radio" id="method-both" name="contact_method" value="both" class="radio-input-compact">
                                    <label for="method-both">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6">
                                        <circle cx="10" cy="10" r="9" fill="white" stroke="currentColor"/>
                                        <circle cx="10" cy="10" r="6" class="check" />
                                    </svg>
                                        Both
                                  </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div>
                        <input type="checkbox" id="privacy-policy" name="privacy_policy">
                        <label for="privacy-policy">
                            I have read and accept the <a href="{{ url('/privacy-policy')}}">Privacy Policy</a>. <span class="text-red">*</span>
                      </label>
                    </div>
                    
                    <div class="flex justify-center gap-8">
                        <button type="button" class="btn btn-muted">Back</button>
                        <button type="button" class="btn btn-accent">Finish</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            $(document).on('click', '#make_a_payment_btn', function(ev) {
                ev.preventDefault();
                let btn = $(this);
                btn.prop('disabled', true);
                btn.html('submitting...');
                setTimeout(() => {
                    $("#captcha-form").submit();
                }, 1000);
            });
        });
    </script>
@endpush