@extends('layouts.public')

@section('title', 'Register — EduBase')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Create an Account</h1>
        <p class="text-sm text-gray-500 mb-6">Join EduBase to save comparisons, bookmark favorite schools, and set alerts.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <x-input type="text" id="name" name="name" :value="old('name')" required autofocus />
                @error('name')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <x-input type="email" id="email" name="email" :value="old('email')" required />
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <x-input type="password" id="password" name="password" required />
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <x-input type="password" id="password_confirmation" name="password_confirmation" required />
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 text-white font-medium text-sm rounded-lg hover:bg-indigo-700 transition">
                Create Account
            </button>
        </form>

        <p class="text-sm text-gray-500 mt-6 text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Log in</a>
        </p>
    </div>
</div>
@endsection
