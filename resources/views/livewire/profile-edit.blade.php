<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Profile Information') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Update your account's profile information and email address.") }}
                        </p>
                    </header>

                    <form wire:submit="updateProfile" class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" 
                                         wire:model="name" 
                                         type="text" 
                                         class="mt-1 block w-full" 
                                         required />
                            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" 
                                         wire:model="email" 
                                         type="email" 
                                         class="mt-1 block w-full" 
                                         required />
                            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Update Password') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                    </header>

                    @if($show_password_form)
                        <form wire:submit="changePassword" class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" 
                                             wire:model="current_password" 
                                             type="password" 
                                             class="mt-1 block w-full" />
                                @error('current_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" 
                                             wire:model="password" 
                                             type="password" 
                                             class="mt-1 block w-full" />
                                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" 
                                             wire:model="password_confirmation" 
                                             type="password" 
                                             class="mt-1 block w-full" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <button type="button" 
                                        wire:click="$set('show_password_form', false)"
                                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </form>
                    @else
                        <button wire:click="$set('show_password_form', true)" 
                                class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            {{ __('Change Password') }}
                        </button>
                    @endif
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Delete Account') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                        </p>
                    </header>

                    <button wire:click="$set('show_delete_modal', true)" 
                            class="mt-6 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        {{ __('Delete Account') }}
                    </button>

                    @if($show_delete_modal)
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
                             wire:click="$set('show_delete_modal', false)">
                            <div class="bg-white rounded-lg p-6 max-w-md w-full" @click.stop>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ __('Once deleted, all data will be permanently lost. Please enter your password to confirm.') }}
                                </p>

                                <form wire:submit="deleteAccount" class="mt-6 space-y-4">
                                    <div>
                                        <x-input-label for="delete_password" :value="__('Password')" />
                                        <x-text-input id="delete_password" 
                                                     wire:model="delete_password" 
                                                     type="password" 
                                                     class="mt-1 block w-full" />
                                        @error('delete_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="flex justify-end gap-4">
                                        <button type="button" 
                                                wire:click="$set('show_delete_modal', false)"
                                                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                            {{ __('Delete Account') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
