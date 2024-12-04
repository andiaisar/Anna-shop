<x-guest-layout>
    <div class="space-y-4">
        <h2 class="text-3xl font-extrabold text-center text-indigo-700">Create Account</h2>
        <p class="text-center text-gray-600">Join us for exclusive benefits</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="text-indigo-800 font-bold text-lg" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-indigo-800 font-bold text-lg" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" :value="__('Register as')" class="text-indigo-800 font-bold text-lg" />
                <select id="role" name="role" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition bg-white">
                    <option value="buyer">User</option>
                    <option value="seller">Seller</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-indigo-800 font-bold text-lg" />
                <x-text-input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-800 font-bold text-lg" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-lg">
                {{ __('Register') }}
            </button>

            <p class="text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>