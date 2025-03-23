<div>
    <!-- Add Service Button -->
    <div class="flex justify-end mb-4">
        <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-md"
            wire:click="openAddModal">Add Service</button>
    </div>

    <!-- Services Table -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Service Name</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $service->name }}</td>
                    <td class="px-6 py-4">
                        <button class="text-blue-500" wire:click="openEditModal({{ $service->id }})">Edit</button>
                        <button class="text-red-500 ml-4" wire:click="delete({{ $service->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Service Modal -->
    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Service">
            <x-input label="Service Name" wire:model="service_name" />
            <x-slot name="footer">
                <button class="bg-gray-400 px-4 py-2 rounded-md" wire:click="$set('add_modal', false)">Cancel</button>
                <button class="bg-emerald-500 text-white px-4 py-2 rounded-md" wire:click="submit">Submit</button>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Edit Service Modal -->
    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Service">
            <x-input label="Service Name" wire:model="service_name" />
            <x-slot name="footer">
                <button class="bg-gray-400 px-4 py-2 rounded-md" wire:click="$set('edit_modal', false)">Cancel</button>
                <button class="bg-emerald-500 text-white px-4 py-2 rounded-md" wire:click="update">Update</button>
            </x-slot>
        </x-card>
    </x-modal>
</div>
