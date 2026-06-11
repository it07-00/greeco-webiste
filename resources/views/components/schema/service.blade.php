@props(['name', 'description', 'url'])

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "name": "{{ $name }}",
    "description": "{{ $description }}",
    "provider": {
        "@type": "Organization",
        "name": "Viện Nghiên cứu và Phát triển Kinh tế Xanh",
        "alternateName": "GREECO Institute",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/logo-v2.png') }}"
    },
    "areaServed": {
        "@type": "Country",
        "name": "Vietnam"
    }
}
</script>
