@props([
    'title' => 'Discover Education in Bangladesh',
    'subtitle' => 'Comprehensive database of schools, madrasas, and colleges — compare fees, facilities, and admission information.',
    'searchAction' => '',
])

<div class="bg-indigo-600 text-white">
    <div class="max-w-4xl mx-auto px-4 py-24 text-center">
        <h1 class="text-5xl font-bold mb-4">{{ $title }}</h1>
        <p class="text-xl text-indigo-100 mb-8">{{ $subtitle }}</p>
        <div class="max-w-xl mx-auto">
            <form method="GET" action="{{ $searchAction }}" class="flex gap-3">
                <input type="text" name="q" placeholder="Search by name, location..." class="flex-1 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" autofocus>
                <button type="submit" class="px-6 py-3 bg-white text-indigo-700 rounded-lg font-semibold hover:bg-indigo-50 transition duration-150">Search</button>
            </form>
        </div>
    </div>
</div>
