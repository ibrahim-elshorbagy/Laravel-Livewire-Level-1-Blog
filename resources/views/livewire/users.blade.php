<div>
    <form >
        <div class="space-y-6 w-2xl mx-auto">
            <flux:field>
                <flux:label>name</flux:label>
                <flux:input type="name" placeholder="name" wire:model='name' />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input type="email" placeholder="email" wire:model='email' />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>Password</flux:label>
                <flux:input type="password" placeholder="password" wire:model='password' />
                <flux:error name="password" />
            </flux:field>

            {{-- Save with wire:confirm.prompt --}}
            {{-- <flux:button wire:confirm='Are you Sure ?' wire:click='SaveUser' variant="primary">Save</flux:button> --}}

            {{-- Save with confirm with SweetAlert --}}
            <flux:button wire:click='SaveUserConfirm' variant="primary">Save</flux:button>
        </div>
    </form>

    @if(session('success'))
        <div class="w-2xl mx-auto p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-700 dark:text-green-400" >
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div
        class="mt-5 w-2xl overflow-hidden mx-auto overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
            <thead
                class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">Id</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @foreach ($users as $user)
                <tr class="even:bg-black/5 dark:even:bg-white/10" wire:key='{{ $user->id }}'>
                    <td class="p-4">{{ $user->id }}</td>
                    <td class="p-4">{{ $user->name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">
                        {{-- Delete with wire:confirm.prompt --}}
                        {{-- <flux:button wire:confirm.prompt="Are you sure?\n\nType Delete to confirm|Delete" variant="danger" wire:click='DeleteUser' x-on:click="$wire.deleteUserId={{ $user->id }}" size="sm">Delete</flux:button> --}}

                        {{-- Delete with mpodal Confirmation --}}
                        <flux:modal.trigger name="delete-user-modal">
                            <flux:button variant="danger" x-on:click="$wire.deleteUserId={{ $user->id }}" size="sm">Delete</flux:button>
                        </flux:modal.trigger>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Single Delete Confirmation Modal -->
    <flux:modal name="delete-user-modal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Confirm Deletion</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this user?</flux:text>
            </div>

            <!-- Confirmation Text Input -->
            <flux:field>
                <flux:label>Type 'Delete' to confirm</flux:label>
                <flux:input type="text" wire:model='confirmationText' />
                <flux:error name="confirmationText" />
            </flux:field>

            <div class="flex gap-2">

                <!-- Delete Button -->
                <flux:button wire:click="DeleteUser" variant="danger">Delete
                </flux:button>
                <!-- Cancel Button -->
                <flux:modal.close>
                    <flux:button variant="ghost" x-on:click="$wire.confirmationText = '' ">Cancel</flux:button>
                </flux:modal.close>
            </div>

        </div>
    </flux:modal>
</div>
