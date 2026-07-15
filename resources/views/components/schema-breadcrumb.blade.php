@props(['items' => []])

@php
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [],
    ];

    foreach ($items as $i => $item) {
        $element = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $item['name'],
        ];

        $element['item'] = $item['url'] ?? null;

        $data['itemListElement'][] = $element;
    }
@endphp

<script type="application/ld+json">
{!! json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
