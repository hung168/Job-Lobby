<x-basic-layout>
    @include('partials._employernavbar')

    <x-card class="p-6 max-w mx-auto max-w-5xl mt-10 rounded-lg shadow-md mb-20">
    
        <header class="text-center">
            <h2 class="text-2xl font-semibold text-gray-900">Employer Profile</h2>
            <p class="mt-2 text-sm text-gray-600">Feel free to modify it to better suit your branding and messaging</p>
        </header>

        <form method="POST" action="/editProfile/{{$employer->name}}/submitEmployerDetails" class="mt-6">
            @csrf
            <div class="mx-auto max-w-2xl">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <!-- Name -->
                        <x-text-input label="Name" name="name" type="text" :value="$employer->name" />
                    </div>

                    <div class="sm:col-span-3">
                        <!-- Email -->
                        <x-text-input name="email" label="Email" type="email" :value="$employer->email" />
                    </div>

                    <div class="sm:col-span-3">
                        <!-- Department -->
                        <x-text-input name="department" label="Department" :value="$employer->department" />
                    </div>

                    <div class="sm:col-span-3">
                        <!-- Function Title -->
                        <x-text-input name="function_title" label="Function Title" :value="$employer->function_title" />
                    </div>
                
                    <hr class="sm:col-span-full border-t border-gray-500" />

                    <div class="sm:col-span-6 text-center">
                        <h2 class="text-2xl font-semibold text-gray-900">Company Details</h2>
                    </div>
                
                    <div class="sm:col-span-4">
                        <!-- Company Name -->
                        <x-text-input name="company_name" label="Company Name" :value="$employer->company_name" />
                    </div>
            
                    <div class="sm:col-span-2">
                        <!-- Company Industry -->
                        <x-text-input name="company_industry" label="Company Industry" :value="$employer->company_industry" />
                    </div>
                    
                    <div class="sm:col-span-6">
                        <!-- Company Overview -->                    
                        <div class="mb-6">
                            <label for="company_overview" class="inline-block text-lg mb-2">Company Overview</label>
                            <textarea class="border border-gray-200 rounded p-2 w-full" name="company_overview">{{ old('company_overview', $employer->company_overview) }}</textarea>
                            @error('company_overview')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="sm:col-span-3">
                        <!-- Company Registration Number -->
                        <x-text-input name="company_registration_number" label="Company Registration Number" :value="$employer->company_registration_number" />
                    </div>

                    <div class="sm:col-span-3">
                        <!-- Company Phone Number -->
                        <x-text-input name="company_contact_number" label="Company Contact Number" :value="old('company_contact_number', optional($employer)->company_contact_number)" />
                    </div>

                    <div class="sm:col-span-6">
                        <!-- Company Street Address -->
                        <x-text-input name="street_address" label="Street Address" :value="old('street_address', optional($address)->street_address)" />
                    </div>
                        
                    <div class="sm:col-span-2">
                        <!-- Company City-->
                        <x-text-input name="city" label="City" :value="old('city', optional($address)->city)" />
                    </div>
                        
                    <div class="sm:col-span-2">
                        <!-- Company State/Province-->
                        <x-dropdown name="state_province" label="State/Province" :options="$options['StateProvince']" :selected="old('state_province', optional($address)->state_province)" />
                    </div>

                    <div class="sm:col-span-2">
                        <!-- Company Address Postal Code-->
                        <x-text-input name="postal_code" label="Postal Code" :value="old('postal_code', optional($address)->postal_code)" />
                    </div>

                    <div class="sm:col-span-2 items-center">
                        <!-- Company Country/Region -->
                        <label for="country" class="inline-block text-lg mb-2">Country/Region: Malaysia</label>
                    </div>

                    <div class="sm:col-span-4">
                        <!-- Company Website -->
                        <x-text-input
                        name="company_website"
                        label="Website"
                        type="url"
                        placeholder="https://example.com"
                        :value="old('company_website', $employer->company_website)"
                        errorBag="company_website"
                        />
                    </div>

                    <div class="sm:col-span-6 grid grid-cols-12 gap-6">
                        <div class="col-span-4">
                            <!-- Company working hour -->
                            <x-radiobutton name="company_working_hour" label="Company Working Hours" :options="$options['CompanyWorkingHours']" :value="old('company_working_hour', $selectedOptions['SelectedCompanyWorkingHour'])" />
                        </div>
                    
                        <div class="col-span-4">
                            <!-- Company dress code -->
                            <x-radiobutton name="company_dress_code" label="Company Dress Code" :options="$options['CompanyDressCode']" :value="old('company_dress_code', $selectedOptions['SelectedCompanyDressCode'])" />
                        </div>
                    
                        <div class="col-span-4">
                            <!-- Employer Benefits -->
                            <x-checkbox name="employer_benefits" label="Employer Benefits" :options="$options['EmployerBenefits']" :selected="$selectedOptions['SelectedBenefits']" />
                        </div>
                    </div>

                    <hr class="sm:col-span-full border-t border-gray-500" />

                    <div class="sm:col-span-full">
                        <div class="mt-6 flex items-center justify-end gap-x-6 mb-10">
                            <a href="#" class="text-sm font-semibold text-gray-900">Cancel</a>
                            <button type="submit" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-card>
</x-basic-layout>
