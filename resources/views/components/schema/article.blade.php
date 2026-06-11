@props(['headline', 'description', 'image', 'publishDate'])

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $headline }}",
    "description": "{{ $description }}",
    "image": "{{ $image ?? asset('assets/images/og-default.jpg') }}",
    "datePublished": "{{ $publishDate ?? now()->toIso8601String() }}",
    "author": {
        "@type": "Organization",
        "name": "Viện Nghiên cứu và Phát triển Kinh tế Xanh",
        "alternateName": "GREECO Institute",
        "url": "{{ url('/') }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Viện Nghiên cứu và Phát triển Kinh tế Xanh",
        "alternateName": "GREECO Institute",
        "url": "{{ url('/') }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/images/logo-v2.png') }}"
        }
    }
}
</script>
