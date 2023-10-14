<x-basic-layout>
    @include('partials._employernavbar')

    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24 rounded-xl shadow-md mb-20">

        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Make Employer Profile
            </h2>
            <p class="mb-4">Make the best profile</p>
        </header>

        <form method="POST" action="/editProfile/{{$employer->name}}/submitEmployerDetails">
            @csrf

            <!-- Name -->
            <x-text-input label="Name" name="name" type="text" :value="$employer->name" />

            <!-- Email -->
            <x-text-input name="email" label="Email" type="email" :value="$employer->email" />

            <!-- Department -->
            <x-text-input name="department" label="Department" :value="$employer->department" />

            <!-- Function Title -->
            <x-text-input name="function_title" label="Function Title" :value="$employer->function_title" />
        
            <!-- Company Name -->
            <x-text-input name="company_name" label="Company Name" :value="$employer->company_name" />
           
            <!-- Company Industry -->
            <x-text-input name="company_industry" label="Company Industry" :value="$employer->company_industry" />
            
            <!-- Company Overview -->                    
            <div class="mb-6">
                <label for="company_overview" class="inline-block text-lg mb-2">Company Overview</label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="company_overview">{{ old('company_overview', $employer->company_overview) }}</textarea>
                @error('company_overview')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Company Registration Number -->
            <x-text-input name="company_registration_number" label="Company Registration Number" :value="$employer->company_registration_number" />

            <!-- Company Street Address -->
            <x-text-input name="street_address" label="Street Address" :value="old('street_address', optional($address)->street_address)" />
                
            <!-- Company City-->
            <x-text-input name="city" label="City" :value="old('city', optional($address)->city)" />
                
            <!-- Company State/Province-->
            <x-dropdown name="state_province" label="State/Province" :options="$options['StateProvince']" :selected="old('state_province', optional($address)->state_province)" />

            <!-- Company Address Postal Code-->
            <x-text-input name="postal_code" label="Postal Code" :value="old('postal_code', optional($address)->postal_code)" />

            <!-- Company Country/Region -->
            <div class="mb-6">
                <label for="country" class="inline-block text-lg mb-2">Country/Region: Malaysia</label>
            </div>         

            <!-- Company Phone Number -->
            <x-text-input name="company_contact_number" label="Company Contact Number" :value="old('company_contact_number', optional($employer)->company_contact_number)" />

            <!-- Company Size -->
            <x-dropdown name="company_size" label="Company Size" :options="$options['CompanySize']" :selected="old('company_size', $selectedOptions['SelectedCompanySize'])" />

            <!-- Company Website -->
            <x-text-input
                name="company_website"
                label="Website"
                type="url"
                placeholder="https://example.com"
                :value="old('company_website', $employer->company_website)"
                errorBag="company_website"
            />
        
            <!-- Company working hour -->
            <x-radiobutton name="company_working_hour" label="Company Working Hours" :options="$options['CompanyWorkingHours']" :value="old('company_working_hour', $selectedOptions['SelectedCompanyWorkingHour'])" />

            <!-- Company dress code -->
            <x-radiobutton name="company_dress_code" label="Company Dress Code" :options="$options['CompanyDressCode']" :value="old('company_dress_code', $selectedOptions['SelectedCompanyDressCode'])" />

            <x-checkbox name="employer_benefits" label="Employer Benefits" :options="$options['EmployerBenefits']" :selected="$selectedOptions['SelectedBenefits']" />

            <div class="mb-6">
                <button
                    type="submit"
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Done
                </button>
            </div>

        </form>
    </x-card>
</x-basic-layout>


