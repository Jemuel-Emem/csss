<div>
    <div class="mt-2">
        <x-card class="bg-white text-black rounded-lg">
            <div class="text-gray-500">
                <h1 class="font-bold text-xl">
                    Please read each statement and select a number, 0, 1, 2, 3, or 4 which indicates how the statement applies. There are no right or wrong answers. Do not spend too much time on any statement.
                </h1>

                <div class="flex flex-col mt-4">
                    <span class="font-sans">The rating scale is as follows:</span>
                    <ul class="font-sans text-xl mt-2">
                        <li class="flex gap-4">4 Very Satisfied <img src="{{ asset('images/approve.png') }}" alt="" class="h-8 w-8"></li>
                        <li class="flex gap-4">3 Satisfied <img src="{{ asset('images/happy.png') }}" alt="" class="h-8 w-8"></li>
                        <li class="flex gap-4">2 Neither Satisfied nor Dissatisfied <img src="{{ asset('images/wondering.png') }}" alt="" class="h-8 w-8"></li>
                        <li class="flex gap-4">1 Dissatisfied <img src="{{ asset('images/wow.png') }}" alt="" class="h-8 w-8"></li>
                        <li class="flex gap-4">0 Not Applicable <img src="{{ asset('images/sad.png') }}" alt="" class="h-8 w-8"></li>
                    </ul>
                </div>
                <span class="text-red-500 font-bold mt-4">* Take note - All fields must be filled out before proceeding</span>
                @error('answers')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <hr class="mt-4">

            <div class="mt-4">
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
                                :options="['0', '1', '2', '3', '4']"
                                wire:model.defer="answers.{{ $question->id }}"
                                required
                            />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-end">
                <x-button class="bg-emerald-500 text-white" label="Submit" wire:click="submitSurvey" />
            </div>
        </x-card>
    </div>
</div>
