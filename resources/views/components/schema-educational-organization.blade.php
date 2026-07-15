@props(['institute' => null])

@if($institute)
@php
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => $institute->name,
    ];

    if ($institute->short_name) {
        $data['alternateName'] = $institute->short_name;
    }

    if ($institute->description) {
        $data['description'] = \Illuminate\Support\Str::limit(strip_tags($institute->description), 300);
    }

    $data['url'] = route('institutes.show', $institute);

    if ($institute->logo_url) {
        $data['logo'] = $institute->logo_url;
    }

    if ($institute->full_address || $institute->district) {
        $address = ['@type' => 'PostalAddress'];

        if ($institute->full_address) {
            $address['streetAddress'] = $institute->full_address;
        }
        if ($institute->district) {
            $address['addressLocality'] = $institute->district->name;
        }
        if ($institute->division) {
            $address['addressRegion'] = $institute->division->name;
        }

        $address['addressCountry'] = 'BD';

        $data['address'] = $address;
    }

    if ($institute->latitude && $institute->longitude) {
        $data['geo'] = [
            '@type' => 'GeoCoordinates',
            'latitude' => $institute->latitude,
            'longitude' => $institute->longitude,
        ];
    }

    if ($institute->contacts->isNotEmpty()) {
        $data['telephone'] = $institute->contacts->first()->phone;
    }

    if ($institute->contacts->isNotEmpty() && $institute->contacts->first()->email) {
        $data['email'] = $institute->contacts->first()->email;
    }

    if ($institute->socialLinks->isNotEmpty()) {
        $data['sameAs'] = $institute->socialLinks->pluck('url')->all();
    }
@endphp

<script type="application/ld+json">
{!! json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif
