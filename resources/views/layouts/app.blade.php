<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ (setting('favicon') ? asset('storage/' . setting('favicon')) : asset('assets/images/logo-icon.webp')) }}?v=2">

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

        <!-- Floating Contact Buttons -->
        @php
            $rawPhone = setting('phone', '09369 96390');
            $cleanPhone = preg_replace('/\D/', '', $rawPhone);
            
            $zaloUrl = setting('zalo_url');
            if (!$zaloUrl) {
                $zaloUrl = 'https://zalo.me/' . $cleanPhone;
            }
            
            $messengerUrl = setting('messenger_url');
            if (!$messengerUrl) {
                $fbUrl = setting('facebook_url');
                if ($fbUrl && preg_match('/facebook\.com\/([a-zA-Z0-9\.]+)/', $fbUrl, $matches)) {
                    $messengerUrl = 'https://m.me/' . $matches[1];
                } else {
                    $messengerUrl = 'https://m.me/greecoofficial';
                }
            }
        @endphp
        <div class="floating-contact-buttons">
            <a href="{{ $messengerUrl }}" target="_blank" rel="noopener noreferrer" class="contact-btn messenger-btn" data-tooltip="Chat Messenger" aria-label="Messenger">
                <i class="fa-brands fa-facebook-messenger"></i>
            </a>
            <a href="{{ $zaloUrl }}" target="_blank" rel="noopener noreferrer" class="contact-btn zalo-btn" data-tooltip="Chat Zalo" aria-label="Zalo">
                <svg viewBox="0 0 24 24" width="26" height="26">
                    <path d="M12 2C6.5 2 2 6 2 11c0 2.3 1.1 4.4 2.8 6L3.5 21c-.3.5.3 1 1 .8l4.2-2.1c1.2.4 2.2.8 3.3.8 5.5 0 10-4 10-9s-4.5-9-10-9z" fill="#ffffff"/>
                    <text x="12" y="15" font-family="'Inter', sans-serif" font-weight="900" font-size="12" fill="#0068ff" text-anchor="middle">Z</text>
                </svg>
            </a>
            <a href="tel:{{ $cleanPhone }}" class="contact-btn phone-btn" data-tooltip="Gọi điện thoại" aria-label="Gọi điện thoại">
                <span class="pulse-ring"></span>
                <i class="fa-solid fa-phone"></i>
            </a>
        </div>
        
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
