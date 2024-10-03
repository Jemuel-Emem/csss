<div class="max-w-8xl mx-auto p-8 bg-white rounded-lg shadow-md">

    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded">
        {{ session('message') }}
    </div>
@endif
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">HELP US SERVE YOU BETTER!</h2>
        <p class="text-gray-600 mt-2">
            This short Client Satisfaction Measurement (CSM) survey aims to track the customer experience of government offices.
            Your answers will enable this office to provide a better service.
        </p>
    </div>
    <form wire:submit.prevent="submit">


        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700">Age:</label>
                    <input type="text" placeholder="Enter age" wire:model="age" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700">Sex:</label>
                    <input type="text" wire:model="sex" placeholder="Enter sex" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700">Region:</label>
                    <input type="text" wire:model="region" placeholder="Enter region" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('region') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700">Agency visited:</label>
                    <input type="text" wire:model="agency_visited" placeholder="Enter the agency name" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('agency_visited') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700">Service availed:</label>
                    <input type="text" wire:model="service_availed" placeholder="Enter the service availed" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('service_availed') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Customer type:</label>
                <input type="text" wire:model="customer_type" placeholder="Enter customer type" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('customer_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-700">Citizen’s Charter (CC) Questions</h3>
                <div class="mt-4">
                    <label class="block text-gray-700 mb-2">CC1: Do you know about the Citizen’s Charter?</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc1" value="1" class="mr-2"> Yes, aware before my transaction
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc1" value="1" class="mr-2"> Yes, aware when I saw the CC
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc1" value="1" class="mr-2"> No, not aware
                        </label>
                    </div>
                    @error('cc1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="block text-gray-700 mb-2">CC2: Did you see the Citizen’s Charter of this office?</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc2" value="1" class="mr-2"> Yes, the CC was easy to find
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc2" value="1" class="mr-2"> Yes, but hard to find
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc2" value="1" class="mr-2"> No, I did not see the CC
                        </label>
                    </div>
                    @error('cc2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="block text-gray-700 mb-2">CC3: If yes to the previous question, did you use the CC as a guide for your services?</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc3" value="1" class="mr-2"> Yes, I was able to use CC
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc3" value="1" class="mr-2"> No, I was unable to use the CC
                        </label>
                    </div>
                    @error('cc3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-700">Satisfaction Rating</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Questions</th>
                        <th class="border px-4 py-2">1</th>
                        <th class="border px-4 py-2">2</th>
                        <th class="border px-4 py-2">3</th>
                        <th class="border px-4 py-2">4</th>
                        <th class="border px-4 py-2">5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="border px-4 py-2">SQD1: I spent an acceptable amount of time to complete my transaction (Responsiveness).</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd1" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd1" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd1" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd1" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd1" value="1"></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">SQD2: The staff was knowledgeable and could answer my questions.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd2" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd2" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd2" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd2" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd2" value="1"></td>
                    </tr>
                    <tr class="bg-white">
                        <td class="border px-4 py-2">SQD3: I was treated with respect and courtesy.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd3" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd3" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd3" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd3" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd3" value="1"></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">SQD4: The office was clean and well-maintained.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd4" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd4" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd4" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd4" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd4" value="1"></td>
                    </tr>
                    <tr class="bg-white">
                        <td class="border px-4 py-2">SQD5: I received adequate information regarding my transaction.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd5" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd5" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd5" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd5" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd5" value="1"></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">SQD6: I am satisfied with the overall service provided.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd6" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd6" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd6" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd6" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd6" value="1"></td>
                    </tr>
                    <tr class="bg-white">
                        <td class="border px-4 py-2">SQD7: I would recommend this office to others.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd7" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd7" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd7" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd7" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd7" value="1"></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">SQD8: Overall, I am satisfied with my experience with this agency.</td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd8" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd8" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd8" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd8" value="1"></td>
                        <td class="border px-4 py-2 text-center"><input type="radio" wire:model="sqd8" value="1"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


  <div class="mb-6">
    <label class="block text-gray-700">Remarks (optional):</label>
    <textarea class="w-full mt-2 p-3 border border-gray-300 rounded-md" rows="4" placeholder="Any suggestions or feedback..."></textarea>

</div>

    <div class="text-center mt-6">
        <button class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 transition">Submit</button>
    </div>

     </form>
</div>
