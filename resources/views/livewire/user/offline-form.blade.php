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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" placeholder="Enter name" wire:model="name" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700">Age:</label>
                    <input type="text" placeholder="Enter age" wire:model="age" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700">Gender:</label>
                    <select wire:model="sex" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Region:</label>
                    <input type="text" wire:model="region" placeholder="Enter region" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('region') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="mb-6">
                    <label class="block text-gray-700">Office Visited:</label>

                    <select  wire:model="office_id" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">Select Office</option>
                        @foreach ($offices as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('office_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700">Service Availed:</label>
                    <select wire:model="service_id" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">Select a Service</option>
                        @foreach ($services as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('service_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Client type:</label>
                <select wire:model="customer_type" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Select client type</option>
                    <option value="Citizen">Citizen</option>
                    <option value="Business">Business</option>
                    <option value="Government">Government</option>
                    <option value="Student">Student</option>
                    <option value="Visitor">Visitor</option>
                </select>
                @error('customer_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Select Offices</label>
                <select wire:model="department" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Select Offices</option>
                    @if (!empty($departments))
                    @foreach ($departments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                @else
                    <option value="">No departments available</option>
                @endif

                </select>
                @error('user_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
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
                            <input type="radio" wire:model="cc1" value="2" class="mr-2"> Yes, aware when I saw the CC
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc1" value="3" class="mr-2"> No, not aware
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
                            <input type="radio" wire:model="cc2" value="2" class="mr-2"> Yes, but hard to find
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model="cc2" value="3" class="mr-2"> No, I did not see the CC
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
                            <input type="radio" wire:model="cc3" value="2" class="mr-2"> No, I was unable to use the CC
                        </label>
                    </div>
                    @error('cc3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

    <div>
        <div class="mt-2">
            <x-card class="bg-white text-black rounded-lg">
                <div class="text-gray-500">
                    <h1 class="font-bold text-xl">Please read each statement and select a number, 1, 2, 3, 4, or 5 which indicates how the statement applies. There are no right or wrong answers. Do not spend too much time on any statement.</h1>

                    <div class="flex flex-col mt-4">
                        <span class="font-sans">The rating scale is as follows:</span>
                        <ul class="font-sans text-lg mt-2 space-y-2">
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">5</span> Strongly Agree
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">😍</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">4</span> Agree
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">😊</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">3</span> Neutral
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">😐</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">2</span> Disagree
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">😠</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">1</span> Strongly Disagree
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">😡</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-6 text-center">0</span> N/A
                                <span class="text-2xl bg-gray-100 p-1 rounded-lg">❓</span>
                            </li>
                        </ul>

                    </div>
                    <span class="text-red-500 font-bold mt-4">* Take note - All fields must be filled out before proceeding </span>
                    @error('answers')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="mt-4">

                <div>
                    {{-- @if($questions && count($questions) > 0)
                        @foreach($questions as $question)
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex items-center text-lg">
                                    <span class="mr-2">{{ $loop->iteration }}.</span>
                                    <span class="mr-2">{{ $question->question }}</span>
                                </div>
                                <div class="w-5/12">
                                    <x-native-select class="w-full"
                                        label="Select Scale"
                                        placeholder="Select"
                                        :options="['1', '2', '3', '4', '5']"
                                        wire:model.defer="answers.{{ $question->id }}"
                                        required
                                    />
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No questions available at the moment.</p>
                    @endif --}}

                    @if($questions && count($questions) > 0)
                    @foreach($questions as $question)
                        <div class="flex flex-col mt-4 p-4 border rounded-lg bg-gray-100">
                            <span class="text-lg font-semibold">{{ $loop->iteration }}. {{ $question->question }}</span>

                            <div class="flex justify-around mt-2">
                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="1" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">😡</span>
                                    <span class="text-sm">Strongly Disagree</span>
                                </label>

                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="2" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">😠</span>
                                    <span class="text-sm">Disagree</span>
                                </label>

                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="3" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">😐</span>
                                    <span class="text-sm">Neutral</span>
                                </label>

                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="4" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">😊</span>
                                    <span class="text-sm">Agree</span>
                                </label>

                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="5" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">😍</span>
                                    <span class="text-sm">Strongly Agree</span>
                                </label>

                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="6" class="hidden peer">
                                    <span class="text-3xl peer-checked:bg-gray-300 p-2 rounded-lg">❓</span>
                                    <span class="text-sm">Not Applicable</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No questions available at the moment.</p>
                @endif
                </div>



            </x-card>
        </div>
    </div>


  <div class="mb-6">
    Comments and Suggestions on how we can further improve our services (Optional)
    <textarea class="w-full mt-2 p-3 border border-gray-300 rounded-md" wire:model="remarks" rows="4" placeholder="Any suggestions or feedback..."></textarea>

</div>

    <div class="text-center mt-6">
        <button class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 transition">Submit</button>
    </div>

     </form>
</div>
