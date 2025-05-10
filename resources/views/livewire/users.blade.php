<div>
    <form>
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

            <flux:button wire:click='SaveUser' variant="primary">Save</flux:button>
        </div>
    </form>

    <div
        class="mt-5 overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
            <thead
                class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">Id</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Email</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @foreach ($users as $user)
                <tr class="even:bg-black/5 dark:even:bg-white/10">
                    <td class="p-4">{{ $user->id }}</td>
                    <td class="p-4">{{ $user->name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
