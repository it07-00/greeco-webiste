<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.webp') }}" type="image/webp" sizes="16x16">

    <x-seo
        :title="$seoTitle ?? 'Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO'"
        :description="$seoDescription ?? 'Viện Nghiên cứu và Phát triển Kinh tế Xanh (GREECO) - Đơn vị hàng đầu về chuyển giao công nghệ xanh, kinh tế tuần hoàn và ứng phó biến đổi khí hậu.'"
        :canonical="$canonical ?? url()->current()"
        :image="$ogImage ?? asset('assets/images/logo-greeco.png')"
        :indexable="$indexable ?? true"
    />

    <!-- CSS Files ================================================== -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css">
    @stack('vendor-styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/coloring.css') }}" rel="stylesheet" type="text/css">
    <link id="colors" href="{{ asset('assets/css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <a href="#" id="back-to-top"></a>
        
        <!-- preloader begin -->
        <div id="de-loader"></div>
        <!-- preloader end -->

        <x-header />

        <!-- content begin -->
        @yield('content')
        <!-- content end -->

        <x-footer />
    </div>

    <x-extra-wrap />

    <!-- Javascript Files ================================================== -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/designesia.js') }}"></script>

    @stack('scripts')
</body>
</html>
