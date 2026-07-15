@extends('layouts.public')

@section('title', 'Contact Us — EduBase')
@section('meta_description', 'Get in touch with the EduBase team. Send us a message or reach out via email.')
@section('og_title', 'Contact EduBase')
@section('og_description', 'Get in touch with the EduBase team.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

    <p class="text-gray-700 mb-8">
        Have questions, suggestions, or feedback? We'd love to hear from you.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Send us a Message</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('contact') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Message</label>
                    <textarea name="message" rows="4" required class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Send Message</button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
            <div class="space-y-4 text-gray-700">
                <p>
                    <strong>Email:</strong><br>
                    <a href="mailto:hello@edubase.com" class="text-blue-600 hover:underline">hello@edubase.com</a>
                </p>
                <p>
                    <strong>Location:</strong><br>
                    Dhaka, Bangladesh
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
