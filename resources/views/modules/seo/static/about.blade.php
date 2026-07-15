@extends('layouts.public')

@section('title', 'About Us — EduBase')
@section('meta_description', 'EduBase is Bangladesh\'s education discovery platform helping students and parents find, compare, and analyze educational institutions.')
@section('og_title', 'About EduBase')
@section('og_description', 'Learn about EduBase — Bangladesh\'s education discovery platform.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">About EduBase</h1>

    <p class="text-lg text-gray-700 mb-4">
        EduBase is Bangladesh's premier education discovery platform. We help students, parents, and educators find, compare, and analyze educational institutions across the country.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-4">Our Mission</h2>
    <p class="text-gray-700 mb-4">
        To make education information accessible, transparent, and comparable for every student and parent in Bangladesh, enabling informed decisions about educational futures.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-4">What We Offer</h2>
    <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-4">
        <li><strong>Comprehensive Database</strong> — Thousands of schools, madrasas, colleges, and universities across Bangladesh</li>
        <li><strong>Fee Comparison</strong> — Transparent fee structures across institutions</li>
        <li><strong>Facility Insights</strong> — Detailed information about campus facilities</li>
        <li><strong>Admission Info</strong> — Up-to-date admission deadlines and requirements</li>
        <li><strong>Side-by-Side Comparison</strong> — Compare up to 5 institutions at once</li>
    </ul>

    <h2 class="text-2xl font-semibold mt-8 mb-4">Our Values</h2>
    <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-4">
        <li><strong>Accuracy</strong> — We strive to keep all information current and correct</li>
        <li><strong>Transparency</strong> — Clear, unbiased presentation of data</li>
        <li><strong>Accessibility</strong> — Free access to education information for all</li>
    </ul>
</div>
@endsection
