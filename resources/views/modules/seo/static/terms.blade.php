@extends('layouts.public')

@section('title', 'Terms of Service — EduBase')
@section('meta_description', 'EduBase terms of service — rules and guidelines for using our education discovery platform.')
@section('og_title', 'Terms of Service — EduBase')
@section('robots', 'index, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>

    <p class="text-gray-700 mb-4">Last updated: {{ date('F j, Y') }}</p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">1. Acceptance of Terms</h2>
    <p class="text-gray-700 mb-4">
        By using EduBase, you agree to these terms of service. If you do not agree, please do not use our platform.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">2. Use of Service</h2>
    <p class="text-gray-700 mb-4">
        You may use EduBase for lawful purposes only. You agree not to scrape, reproduce, or redistribute our data without permission.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">3. Accuracy of Information</h2>
    <p class="text-gray-700 mb-4">
        While we strive for accuracy, we make no guarantees about the completeness or reliability of institution data. Verify important information directly with institutions.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">4. Limitation of Liability</h2>
    <p class="text-gray-700 mb-4">
        EduBase is not liable for any damages arising from the use or inability to use our platform.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3">5. Changes</h2>
    <p class="text-gray-700 mb-4">
        We reserve the right to update these terms at any time. Continued use after changes constitutes acceptance.
    </p>
</div>
@endsection
