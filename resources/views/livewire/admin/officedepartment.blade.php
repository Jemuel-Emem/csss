<div>
    <div x-data="{ show: true }" x-show="show" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg" x-init="setTimeout(() => show = false, 3000)">
        <span>{{ session('message') }}</span>
        <button @click="show = false" class="ml-4">×</button>
    </div>
    <div class="flex justify-end">
       <button class="bg-emerald-500 hover:bg-emerald-600 text-white p-1 rounded w-32" wire:click="$set('add_modal', true)">Add Account</button>
    </div>
    <div class="relative overflow-x-auto mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="text-emerald-500 cursor-pointer" wire:click="openEditModal({{ $user->id }})">Edit</span>
                            <span class="text-red-600 cursor-pointer" wire:click="delete({{ $user->id }})">Delete</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Director Modal -->
    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Account">
            <div class="space-y-3">
                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Username" placeholder="" wire:model="username" />
                <x-input label="Password" type="password" wire:model="password" placeholder="" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('add_modal', false)" />
                    <x-button class="bg-emerald-500 text-white" label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Edit Director Modal -->
    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Account">
            <div class="space-y-3">
                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Username" placeholder="" wire:model="username" />
                <x-input label="Password" type="password" wire:model="password" placeholder="(Leave blank to keep current password)" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('edit_modal', false)" />
                    <x-button class="bg-emerald-500 text-white" label="Update" wire:click="update" spinner="update" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <script>
        document.addEventListener('notification', event => {
            alert(event.detail.message);
        });
    </script>
</div>
