<div>
    <!-- Success Notification -->
    <div x-data="{ show: @entangle('session').defer }" x-show="show"
        class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg"
        x-init="setTimeout(() => show = false, 3000)">
        <span>{{ session('message') }}</span>
        <button @click="show = false" class="ml-4">×</button>
    </div>

    <!-- Add Office Button -->
    <div class="flex justify-end mb-4">
        <button class="bg-emerald-500 hover:bg-emerald-600 text-white p-2 rounded"
                wire:click="$set('add_modal', true)">
            Add Office
        </button>
    </div>

    <!-- Offices Table -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Office Name</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offices as $office)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            {{ $office->name }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-emerald-500 cursor-pointer"
                                  wire:click="openEditModal({{ $office->id }})">
                                Edit
                            </span>
                            <span class="text-red-600 cursor-pointer ml-4"
                                  wire:click="delete({{ $office->id }})">
                                Delete
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Office Modal -->
    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Office">
            <div class="space-y-3">
                <x-input label="Office Name" placeholder="Enter office name" wire:model="name" />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('add_modal', false)" />
                    <x-button class="bg-emerald-500 text-white" label="Submit"
                              wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Edit Office Modal -->
    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Office">
            <div class="space-y-3">
                <x-input label="Office Name" placeholder="Enter office name" wire:model="name" />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('edit_modal', false)" />
                    <x-button class="bg-emerald-500 text-white" label="Update"
                              wire:click="update" spinner="update" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        @this.on('showNotification', message => {
            showNotification(message);
        });
    });
</script>
@endpush
