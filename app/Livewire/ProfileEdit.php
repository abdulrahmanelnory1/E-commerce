<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileEdit extends Component
{
    public string $name = '';
    public string $email = '';
    public bool $show_password_form = false;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $show_delete_modal = false;
    public string $delete_password = '';

    /**
     * Mount lifecycle hook - load user profile data
     */
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        
        if ($user->email !== $this->email) {
            $user->email_verified_at = null;
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->dispatch('notify', message: 'Profile updated successfully!');
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->show_password_form = false;
        $this->password = '';
        $this->password_confirmation = '';
        $this->current_password = '';

        $this->dispatch('notify', message: 'Password updated successfully!');
    }

    /**
     * Delete account
     */
    public function deleteAccount()
    {
        $this->validate([
            'delete_password' => 'required|current_password',
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.profile-edit');
    }
}
