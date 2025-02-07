<div>
    @if (session()->has('message'))
        <div class="mt-4 bg-green-100 text-green-700 p-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif


  <div class="flex justify-end">
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        Add Account
    </button>
  </div>


    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Create Account</h2>

                <div class="mb-4">
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" wire:model="name" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email:</label>
                    <input type="email" wire:model="email" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Password:</label>
                    <input type="password" wire:model="password" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500">
                        Cancel
                    </button>
                    <button wire:click="createAccount" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Create
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Account Modal -->
    @if ($showEditModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Edit Account</h2>

                <div class="mb-4">
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" wire:model="name" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email:</label>
                    <input type="email" wire:model="email" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500">
                        Cancel
                    </button>
                    <button wire:click="updateAccount" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </div>
        </div>
    @endif


    <div class="mt-6">

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $user->name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $user->email }}</td>
                        <td class="border px-4 py-2 text-center space-x-2">
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                            <button wire:click="deleteAccount({{ $user->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
