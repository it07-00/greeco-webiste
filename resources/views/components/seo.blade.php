<title>{{ $title ?? config('app.name') }}</title>

@if(!empty($description))
    <meta name="description" content="{{ $description }}">
@endif

<link rel="canonical" href="{{ $canonical ?? url()->current() }}">

@if(isset($indexable) && $indexable === false)
    <meta name="robots" content="noindex, nofollow">
@else
    <meta name="robots" content="index, follow">
@endif

<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="vi_VN">
<meta property="og:title" content="{{ $title ?? config('app.name') }}">
<meta property="og:description" content="{{ $description ?? '' }}">
<meta property="og:type" content="{{ $type ?? 'website' }}">
<meta property="og:url" content="{{ $canonical ?? url()->current() }}">

@if(!empty($image))
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:secure_url" content="{{ $image }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $title ?? config('app.name') }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
<meta name="twitter:description" content="{{ $description ?? '' }}">

@if(!empty($image))
    <meta name="twitter:image" content="{{ $image }}">
@endif
