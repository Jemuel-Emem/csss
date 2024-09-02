<div>
    <div>
        <button wire:click="openAddModal" class="bg-sky-500 text-white hover:bg-sky-600 p-1 w-32 rounded mb-2">Add Director</button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                            <span class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</span>
                            <span class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Director Modal -->
    <x-dialog modal wire:model="add_modal">
        <x-slot name="title">Add Director</x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-input label="Name" wire:model.defer="name" />
            </div>
            <div class="mb-4">
                <x-input label="Username" wire:model.defer="username" />
            </div>
            <div class="mb-4">
                <x-input label="Password" type="password" wire:model.defer="password" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button flat label="Cancel" wire:click="$set('add_modal', false)" />
            <x-button primary label="Add" wire:click="submit" />
        </x-slot>
    </x-dialog>
</div>
