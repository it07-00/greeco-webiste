@php
    $seoTitle = 'Thư viện & Tài liệu - Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO';
    $seoDescription = 'Thư viện tài liệu pháp luật về môi trường, giảm phát thải khí nhà kính và hồ sơ năng lực hoạt động của Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO.';
    $canonical = route('library');

    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Thư viện & Hồ sơ', 'url' => route('library')]
    ];
@endphp

@extends('layouts.app')

@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="active">Thư viện & Tài liệu</li>
                        </ul>
                        <h1 class="text-uppercase">Thư viện & Hồ sơ</h1>
                        <p class="col-lg-10 lead">Hệ thống cơ sở dữ liệu pháp luật môi trường và Hồ sơ năng lực hoạt động
                            toàn diện của Viện GREECO.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hồ sơ năng lực Section -->
        <section class="pb40 bg-navy-custom text-light position-relative overflow-hidden">
            <!-- Subtle background decorative elements -->
            <div class="decor-circle-1"></div>
            <div class="decor-circle-2"></div>
            
            <div class="container relative z-1">
                <div class="row g-4 gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="subtitle text-mint wow fadeInUp mb-3">Hồ sơ năng lực</div>
                        <h2 class="text-uppercase text-white wow fadeInUp" data-wow-delay=".2s">Giới thiệu Năng lực 
                            <img src="{{ asset('assets/images/logo-text-white-cropped.png') }}" 
                                 alt="GREECO" 
                                 class="inline-logo-profile"> 
                            <span class="text-mint">Profile</span></h2>
                        <p class="wow fadeInUp text-white-80">Hồ sơ năng lực (Capability Profile) của Viện Nghiên cứu và Phát triển Kinh
                            tế Xanh tổng hợp đầy đủ thông tin pháp lý, cơ sở vật chất, trang thiết bị kỹ thuật hiện đại cùng
                            danh sách các chuyên gia khoa học đầu ngành. Tài liệu này cung cấp cái nhìn toàn diện về năng
                            lực triển khai các đề tài nghiên cứu, tư vấn chuyên sâu về ESG, kiểm kê khí nhà kính, chuyển
                            giao công nghệ hóa học - môi trường xanh và phát triển dự án tín chỉ carbon.</p>
                        <p class="wow fadeInUp text-white-80">Chúng tôi cam kết đồng hành cùng cơ quan quản lý và các doanh nghiệp trong
                            lộ trình chuyển đổi xanh, thực thi trách nhiệm xã hội và hướng tới mục tiêu phát thải ròng bằng
                            không (Net Zero).</p>
                        <div class="spacer-20"></div>
                        @php
                            $profilePdf = setting('capability_profile') 
                                ? Storage::url(setting('capability_profile')) 
                                : asset('assets/docs/GREECO_Capability_Profile.pdf');
                        @endphp
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#" class="_df_button btn-main btn-flipbook-premium wow fadeInUp"
                                source="{{ $profilePdf }}"><i
                                    class="fa-solid fa-book-open me-2"></i>Xem trực tuyến</a>
                            <a class="btn-main btn-line-white wow fadeInUp"
                                href="{{ $profilePdf }}" download><i
                                    class="fa fa-download me-2"></i>Tải bản PDF</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="glass-card p-4 rounded-3 h-100 relative overflow-hidden wow fadeInUp" data-wow-delay=".1s">
                                    <div class="glass-card-icon-wrap mb-3"><i class="fa fa-award fs-32 text-mint"></i></div>
                                    <h4 class="text-white mb-2">Pháp lý vững chắc</h4>
                                    <p class="text-white-70 mb-0">Giấy đăng ký hoạt động KH&CN do Sở Khoa học và Công nghệ TP.HCM cấp phép.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="glass-card p-4 rounded-3 h-100 relative overflow-hidden wow fadeInUp" data-wow-delay=".2s">
                                    <div class="glass-card-icon-wrap mb-3"><i class="fa fa-users fs-32 text-mint"></i></div>
                                    <h4 class="text-white mb-2">Đội ngũ chuyên gia</h4>
                                    <p class="text-white-70 mb-0">Hội đồng khoa học gồm các Giáo sư, Tiến sĩ đầu ngành Hóa học, Sinh học và Kỹ thuật Môi trường.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="glass-card p-4 rounded-3 h-100 relative overflow-hidden wow fadeInUp" data-wow-delay=".3s">
                                    <div class="glass-card-icon-wrap mb-3"><i class="fa fa-flask fs-32 text-mint"></i></div>
                                    <h4 class="text-white mb-2">Phòng thí nghiệm</h4>
                                    <p class="text-white-70 mb-0">Hợp tác chặt chẽ với các phòng thí nghiệm trọng điểm, trang thiết bị phân tích hiện đại bậc nhất.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="glass-card p-4 rounded-3 h-100 relative overflow-hidden wow fadeInUp" data-wow-delay=".4s">
                                    <div class="glass-card-icon-wrap mb-3"><i class="fa fa-handshake fs-32 text-mint"></i></div>
                                    <h4 class="text-white mb-2">Đối tác toàn cầu</h4>
                                    <p class="text-white-70 mb-0">Hành trình hợp tác khoa học rộng khắp với các tổ chức quốc tế từ EU, Nhật Bản, Hàn Quốc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Văn bản pháp luật Section -->
        <section class="bg-light pb80">
            <div class="container">
                <div class="row g-4 mb-4 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="subtitle wow fadeInUp mb-3">Cơ sở pháp lý</div>
                        <h2 class="text-uppercase wow fadeInUp" data-wow-delay=".2s">Văn bản Pháp luật <span
                                class="id-color-2">Môi trường & Khí hậu</span></h2>
                        <p class="wow fadeInUp">Hệ thống hóa các văn bản quy phạm pháp luật, quyết định và thông tư quan
                            trọng của Nhà nước điều chỉnh các hoạt động bảo vệ môi trường, biến đổi khí hậu và kiểm kê khí
                            nhà kính tại Việt Nam.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive bg-white p-4 rounded-1 shadow-sm">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="table-col-20">Số hiệu / Ký hiệu</th>
                                        <th scope="col" class="table-col-60">Trích yếu nội dung</th>
                                        <th scope="col" class="table-col-20 text-center">Tải về / Tra cứu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $doc)
                                        @php
                                            $badgeClass = match($doc->type) {
                                                'Luật Quốc hội' => 'bg-success text-white',
                                                'Nghị định Chính phủ' => 'bg-primary text-white',
                                                'Quyết định Thủ tướng' => 'bg-warning text-dark',
                                                'Thông tư Bộ TN&MT' => 'bg-secondary text-white',
                                                'Khung Tiêu chuẩn Quốc tế' => 'bg-info text-dark',
                                                default => 'bg-dark text-white'
                                            };
                                            
                                            $linkUrl = str_starts_with($doc->link, 'http') || str_starts_with($doc->link, '/') 
                                                ? $doc->link 
                                                : url($doc->link);
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $doc->number }}</strong></td>
                                            <td>
                                                <span class="badge {{ $badgeClass }} mb-2">{{ $doc->type }}</span>
                                                <h5 class="mb-1 text-dark">{{ $doc->title }}</h5>
                                                @if($doc->description)
                                                    <p class="mb-0 text-muted fs-14">{{ $doc->description }}</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $linkUrl }}" target="_blank"
                                                    class="btn-main btn-line py-2 px-3 fs-13">
                                                    @if(str_contains($linkUrl, 'lien-he') || str_contains($linkUrl, 'dich-vu'))
                                                        <i class="fa-solid fa-circle-info me-1"></i>Liên hệ Tư vấn
                                                    @else
                                                        <i class="fa fa-external-link me-1"></i>Xem chi tiết
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('styles')
    <!-- DearFlip CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/css/dflip.min.css"
        rel="stylesheet" type="text/css">
    <!-- Themify Icons for DearFlip -->
    <link href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/css/themify-icons.min.css"
        rel="stylesheet" type="text/css">

    <style>
        /* Custom styles for the premium capability section */
        .bg-navy-custom {
            background: linear-gradient(135deg, #071524 0%, #0B1F33 100%) !important;
            padding: 80px 0 !important;
        }
        .text-mint {
            color: #A7C957 !important; /* soft lime/olive accent */
        }
        .text-white-80 {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 15px;
            line-height: 1.7;
        }
        .text-white-70 {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 14px;
            line-height: 1.6;
        }
        
        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(167, 201, 87, 0.4) !important; /* glow with accent color */
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
        }
        .glass-card-icon-wrap {
            width: 54px;
            height: 54px;
            background: rgba(167, 201, 87, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .glass-card:hover .glass-card-icon-wrap {
            background: #A7C957;
        }
        .glass-card:hover .glass-card-icon-wrap i {
            color: #071524 !important;
        }
        
        /* Floating background decoration */
        .decor-circle-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(167, 201, 87, 0.08) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            pointer-events: none;
        }
        .decor-circle-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(46, 139, 87, 0.06) 0%, transparent 70%);
            bottom: -50px;
            left: -100px;
            pointer-events: none;
        }
        
        /* Premium Buttons */
        .btn-flipbook-premium {
            background: #A7C957 !important; /* bright accent */
            color: #071524 !important;
            font-weight: 700 !important;
            border: 1px solid #A7C957 !important;
            box-shadow: 0 4px 15px rgba(167, 201, 87, 0.3) !important;
            border-radius: 30px !important;
            padding: 10px 24px !important;
            transition: all 0.3s ease !important;
        }
        .btn-flipbook-premium:hover {
            background: #ffffff !important;
            color: #071524 !important;
            border-color: #ffffff !important;
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4) !important;
            transform: translateY(-2px);
        }
        .btn-line-white {
            background: transparent !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 30px !important;
            padding: 10px 24px !important;
            transition: all 0.3s ease !important;
        }
        .btn-line-white:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Lightbox wrappers override */
        .df-lightbox-wrapper {
            background: rgba(7, 21, 36, 0.96) !important;
        }

        /* Fix and customize DearFlip Lightbox close button */
        .df-lightbox-close,
        .df-ui-btn.df-icon-close,
        .ti-close.df-lightbox-close {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 50% !important;
            width: 44px !important;
            height: 44px !important;
            font-size: 0 !important;         /* ẩn icon gốc của Themify/DearFlip */
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer !important;
            opacity: 0.85 !important;
            z-index: 1000000000 !important;
            color: #ffffff !important;
        }

        .df-lightbox-close:hover,
        .df-ui-btn.df-icon-close:hover,
        .ti-close.df-lightbox-close:hover {
            background: #A7C957 !important;
            color: #071524 !important;
            border-color: #A7C957 !important;
            transform: scale(1.1) rotate(90deg) !important;
            opacity: 1 !important;
            box-shadow: 0 0 15px rgba(167, 201, 87, 0.5) !important;
        }

        /* Dùng Unicode × không phụ thuộc font icon */
        .df-lightbox-close::before,
        .df-ui-btn.df-icon-close::before,
        .ti-close.df-lightbox-close::before {
            content: "\00D7" !important;     /* ký tự × Unicode chuẩn */
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 28px !important;
            font-weight: 400 !important;
            font-style: normal !important;
            line-height: 1 !important;
            color: #ffffff !important;
            display: block !important;
        }

        .df-lightbox-close:hover::before,
        .df-ui-btn.df-icon-close:hover::before,
        .ti-close.df-lightbox-close:hover::before {
            color: #071524 !important;
        }
    </style>
@endpush

@push('scripts')
    <!-- DearFlip JS -->
    <script src="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/js/dflip.min.js"></script>
@endpush