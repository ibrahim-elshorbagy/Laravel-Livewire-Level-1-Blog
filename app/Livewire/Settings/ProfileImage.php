<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithFileUploads;


class ProfileImage extends Component
{
    use WithFileUploads;

    public $image;
    public $currentImage;

    public function mount()
    {
        $this->currentImage = Auth::user()->image_url ?? '';
    }



    public function updateProfileImage()
    {
        $this->validate([
            'image' => ['required', 'image', 'max:5120'], // 5MB max
        ]);

        $user = Auth::user();

        // Delete old image if exists and not default
        if ($user->image_url) {
            Storage::disk('public')->deleteDirectory('User/' . $user->id . '/profile_image');
        }

        // Store new image
        $path = $this->image->store('User/' . $user->id . '/profile_image', 'public');

        // Update user record
        $user->update([
            'image_url' => Storage::url($path)
        ]);

        $this->currentImage = $user->image_url;
        $this->reset('image');
        $this->modal('edit-profile')->close();

        LivewireAlert::title('Image Saved')
            ->text('Profile image updated successfully.')
            ->success()
            ->show();
    }

    public function render()
    {
        return view('livewire.settings.profile-image')->layout('components.layouts.app')->title('Profile Image');
    }
}
