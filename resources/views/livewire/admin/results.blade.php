<div>
    <div class="relative overflow-x-auto mt-4">
        {{-- <input type="text" wire:model.debounce.500ms="search" class="border p-2 mb-4 w-full" placeholder="Search results..."> --}}

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Very Satisfied</th>
                    <th scope="col" class="px-6 py-3">Satisfied</th>
                    <th scope="col" class="px-6 py-3">Neither Satisfied nor Dissatisfied</th>
                    <th scope="col" class="px-6 py-3">Dissatisfied</th>
                    <th scope="col" class="px-6 py-3">Not Applicable</th>
                    {{-- <th scope="col" class="px-6 py-3 text-center">Action</th> --}}
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse($results as $result)
                    <tr class="border">
                        <td class="px-6 py-4">{{ $result->id }}</td>
                        <td class="px-6 py-4">{{ $result->name }}</td>
                        <td class="px-6 py-4">{{ $result->verysatisfied }}</td>
                        <td class="px-6 py-4">{{ $result->satisfied }}</td>
                        <td class="px-6 py-4">{{ $result->neithersatisfied }}</td>
                        <td class="px-6 py-4">{{ $result->dissatisfied }}</td>
                        <td class="px-6 py-4">{{ $result->notapplicable }}</td>
                        {{-- <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $result->id }})" positive />
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $results->links() }}
        </div>
    </div>

    <x-modal wire:model.defer="edit_modal">
        <x-card title="Update Survey Result">
            <div class="space-y-3">
                <x-input label="Name" wire:model="name" />
                <x-input label="Very Satisfied" wire:model="verysatisfied" />
                <x-input label="Satisfied" wire:model="satisfied" />
                <x-input label="Neither Satisfied nor Dissatisfied" wire:model="neithersatisfied" />
                <x-input label="Dissatisfied" wire:model="dissatisfied" />
                <x-input label="Not Applicable" wire:model="notapplicable" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" negative />
                    <x-button positive label="Update" wire:click="submitedit" spinner="submitedit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
