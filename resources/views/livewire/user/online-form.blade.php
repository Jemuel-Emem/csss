<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Form Header -->
    <div class="text-center mb-6">
        {{-- <img src="{{ asset('images/agency-logo.png') }}" alt="Agency Logo" class="mx-auto mb-4 h-16 w-16"> --}}
        <h1 class="text-2xl font-bold uppercase text-gray-900">Help Us Serve You Better</h1>
        <p class="text-gray-700 mt-2">
            This Client Satisfaction Measurement (CSM) tracks the customer experience of government offices. Your feedback will help this office provide a better service.
            Personal information shared will be kept confidential and you always have the option to not answer this form.
        </p>
    </div>

    <!-- Form Fields -->
    <form>
        <!-- Other Fields (Client Type, Age, Region, etc.) -->
        <!-- Instructions Section -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-4">INSTRUCTIONS</h3>
            <p class="text-gray-700 mb-4">
                Check mark (✔ ) your answer to the Citizen’s Charter (CC) questions. The Citizen’s Charter is an official document that reflects the services of a government agency/office including its requirements, fees, and processing times among others.
            </p>
        </div>

        <!-- Citizen's Charter Questions -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-4">Citizen's Charter Questions</h3>

            <!-- CC1 Question -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">CC1: Which of the following best describes your awareness of a CC?</label>
                <div class="flex flex-col gap-2 mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc1" value="1" class="form-checkbox">
                        <span class="ml-2">1. I know what a CC is and I saw this office’s CC.</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc1" value="2" class="form-checkbox">
                        <span class="ml-2">2. I know what a CC is but I did NOT see this office’s CC.</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc1" value="3" class="form-checkbox">
                        <span class="ml-2">3. I learned of the CC only when I saw this office’s CC.</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc1" value="4" class="form-checkbox">
                        <span class="ml-2">4. I do not know what a CC is and I did not see one in this office. (Answer ‘N/A’ on CC2 and CC3)</span>
                    </label>
                </div>
            </div>

            <!-- CC2 Question -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">CC2: If aware of CC (answered 1-3 in CC1), would you say that the CC of this office was…?</label>
                <div class="flex flex-col gap-2 mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc2" value="1" class="form-checkbox">
                        <span class="ml-2">1. Easy to see</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc2" value="2" class="form-checkbox">
                        <span class="ml-2">2. Somewhat easy to see</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc2" value="3" class="form-checkbox">
                        <span class="ml-2">3. Difficult to see</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc2" value="4" class="form-checkbox">
                        <span class="ml-2">4. Not visible at all</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc2" value="5" class="form-checkbox">
                        <span class="ml-2">5. N/A</span>
                    </label>
                </div>
            </div>

            <!-- CC3 Question -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">CC3: If aware of CC (answered codes 1-3 in CC1), how much did the CC help you in your transaction?</label>
                <div class="flex flex-col gap-2 mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc3" value="1" class="form-checkbox">
                        <span class="ml-2">1. Helped very much</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc3" value="2" class="form-checkbox">
                        <span class="ml-2">2. Somewhat helped</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc3" value="3" class="form-checkbox">
                        <span class="ml-2">3. Did not help</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="cc3" value="4" class="form-checkbox">
                        <span class="ml-2">4. N/A</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Other Form Fields like SQD Questions, Suggestions, etc. -->
    </form>
</div>
