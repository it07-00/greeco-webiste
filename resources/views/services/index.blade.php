@php
    $seoTitle = 'Lĩnh vực hoạt động - Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO';
    $seoDescription = 'Chi tiết các lĩnh vực hoạt động của Viện GREECO bao gồm nghiên cứu khoa học, chuyển giao công nghệ xanh, tư vấn ESG và tín chỉ carbon.';
    $canonical = route('services.index');
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Lĩnh vực hoạt động', 'url' => route('services.index')]
    ];
@endphp

@extends('layouts.app')


@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative jarallax text-light">
            <img src="{{ asset('assets/images/background/7.webp') }}" class="jarallax-img" alt="Lĩnh vực hoạt động GREECO">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="active">Lĩnh vực hoạt động</li>
                        </ul>
                        <h1 class="text-uppercase">Lĩnh vực hoạt động</h1>
                        <p class="col-lg-10 lead">Tiên phong trong nghiên cứu, tư vấn và chuyển giao công nghệ vì một tương lai phát triển bền vững.</p>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/images/logo-wm.webp') }}" class="abs end-0 bottom-0 z-2 w-20" alt="GREECO watermark">
            <div class="de-gradient-edge-top dark"></div>
            <div class="de-overlay"></div>
        </section>

        <section class="p-4">
            <div class="container-fluid service-categories-grid">
                <div class="row g-4">
                    @foreach($serviceCategories as $category)
                        <div class="col-lg-4 col-sm-6 wow fadeInRight" data-wow-delay="{{ ($loop->index % 3) * 0.3 }}s">
                            <a class="service-category-link" href="{{ $category['url'] }}" aria-label="Xem chi tiết {{ $category['name'] }}">
                                <div class="bg-color text-light rounded-1 overflow-hidden h-100 d-flex flex-column">
                                    <div class="hover relative overflow-hidden text-light text-center">
                                        <img src="{{ $category['image'] }}" class="hover-scale-1-1 w-100" alt="{{ $category['name'] }}">
                                        <div class="abs w-100 px-4 hover-op-1 z-4 hover-mt-40 abs-centered">
                                            <span class="btn-line">Xem chi tiết</span>
                                        </div>
                                        <img src="{{ asset('assets/images/logo-icon.webp') }}" class="abs abs-centered w-20" alt="GREECO Icon">
                                        <div class="abs bg-color z-2 top-0 w-100 h-100 hover-op-1"></div>
                                        <div class="abs z-2 bottom-0 mb-3 w-100 text-center hover-op-0">
                                            <h4 class="mb-3">{{ $category['name'] }}</h4>
                                        </div>
                                        <div class="gradient-trans-color-bottom abs w-100 h-40 bottom-0 Z-1"></div>
                                    </div>
                                    <div class="p-4 py-3 flex-grow-1">
                                        <p class="mb-0">{{ $category['description'] }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="jarallax pt80 pb80 relative text-light">
            <img src="{{ asset('assets/images/background/3.webp') }}" class="jarallax-img" alt="Tư vấn chuyên sâu GREECO">
            <div class="container relative z-2">
                <div class="row">
                    <div class="col-lg-8">
                        <img src="{{ asset('assets/images/logo-icon.webp') }}" class="w-60px mb-4" alt="GREECO logo icon">
                        <h2 class="text-uppercase mb-4">Hành động ngay vì tương lai bền vững – Liên hệ với GREECO để được tư vấn chuyên sâu</h2>
                        <a class="btn-main" href="{{ route('contact') }}">Liên hệ ngay</a>
                    </div>
                </div>
            </div>
            <div class="de-gradient-edge-bottom dark"></div>
            <div class="de-overlay"></div>
        </section>
        
    </div>
@endsection
