@extends('layouts.admin')

@section('title', 'Dashboard — EduBase Admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Welcome back, {{ Auth::user()->name }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total Institutes</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Published Institutes</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Pending Review</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>
    </div>
@endsection
