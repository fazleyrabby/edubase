@extends('layouts.public')

@section('title', 'Privacy Policy — EduBase')
@section('meta_description', 'EduBase privacy policy — how we collect, use, and protect your personal information.')
@section('og_title', 'Privacy Policy — EduBase')
@section('robots', 'index, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>

    <p class="text-gray-700 mb-4">Last updated: {{ date('F j, Y') }}</p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">1. Information We Collect</h2>
    <p class="text-gray-700 mb-4">
        We collect information you provide directly, such as your name and email when you contact us. We also collect anonymized usage data to improve our platform.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">2. How We Use Your Information</h2>
    <p class="text-gray-700 mb-4">
        We use the information to respond to your inquiries, improve our services, and send occasional updates if you have opted in.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">3. Data Protection</h2>
    <p class="text-gray-700 mb-4">
        We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">4. Third-Party Services</h2>
    <p class="text-gray-700 mb-4">
        We may use third-party services for analytics and hosting. These services have their own privacy policies.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">5. Contact</h2>
    <p class="text-gray-700 mb-4">
        For privacy-related inquiries, contact us at <a href="mailto:hello@edubase.com" class="text-blue-600 hover:underline">hello@edubase.com</a>.
    </p>
</div>
@endsection
