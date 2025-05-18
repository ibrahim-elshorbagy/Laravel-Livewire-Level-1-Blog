<section class="w-full">

    @include('partials.settings-heading')
    
    <x-settings.layout :heading="__('Profile Image')" :subheading="__('Update your profile picture')">
        <div class="mt-6 space-y-6">
            <!-- Current Profile Image Display -->
            <div class="flex items-center gap-6">
                <div class="relative">
                    <div
                        class="h-24 w-24 overflow-hidden rounded-full bg-surface-alt ring-1 ring-zinc-300 dark:ring-black dark:bg-surface-dark-alt">
                        @if ($currentImage)
                        <img src="{{ $currentImage }}" class="h-full w-full object-cover" alt="Profile Image">
                        @else
                        <div
                            class="flex h-full w-full items-center justify-center bg-blue-100 dark:bg-blue-800 text-blue-500">
                            <span class="text-4xl">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Edit Button -->
                    <div
                        class="absolute bottom-0 right-0 p-1.5 rounded-full bg-white dark:bg-black ring-2 ring-white dark:ring-black text-primary dark:text-primary-dark hover:bg-gray-50 dark:hover:bg-gray-900">
                        <flux:modal.trigger name="edit-profile">
                            <flux:icon name="camera" class="h-5 w-5" />
                        </flux:modal.trigger>
                    </div>
                </div>

                <div>
                    <flux:heading size="sm">{{ __('Profile Picture') }}</flux:heading>
                    <flux:text class="mt-1">{{ __('Click the camera icon to update your profile picture') }}</flux:text>
                </div>
            </div>
        </div>
    </x-settings.layout>

    <!-- Profile Image Modal -->
    <flux:modal name="edit-profile" class="md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Update Profile Picture') }}</flux:heading>
                <flux:text class="mt-2">
                    {{ __('Upload a new profile picture. Recommended size is 300x300 pixels.') }}
                </flux:text>
            </div>

            <form wire:submit="updateProfileImage">
                <div class="mb-4">
                    @if ($image)
                    <div class="mb-4 flex justify-center">
                        <div class="h-64 w-64 overflow-hidden rounded-lg">
                            <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-contain"
                                alt="Profile Preview">
                        </div>
                    </div>
                    @endif

                    <flux:input type="file" wire:model="image" accept="image/*" />
                    <flux:error name="image" class="mt-2" />
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <flux:modal.close>
                        <flux:button variant="outline" type="button">
                            {{ __('Cancel') }}
                        </flux:button>
                    </flux:modal.close>
                    <flux:button variant="primary" type="submit" :disabled="!$image">
                        {{ __('Save') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</section>
