@php
    $seoTitle = 'Nghiên cứu Khoa học & Chuyển giao Công nghệ - Viện GREECO';
    $seoDescription = 'Nghiên cứu khoa học và chuyển giao công nghệ xanh, giải pháp thích ứng biến đổi khí hậu và tối ưu hóa tài nguyên cho doanh nghiệp.';
    $canonical = route('services.nghien-cuu');
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Lĩnh vực', 'url' => route('services.index')],
        ['name' => 'Nghiên cứu & Chuyển giao', 'url' => route('services.nghien-cuu')]
    ];
@endphp

@extends('layouts.app')


@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />
    <x-schema.service 
        name="Nghiên cứu & Chuyển giao" 
        description="Kết nối nghiên cứu khoa học thực nghiệm với nhu cầu thực tế của doanh nghiệp nhằm thúc đẩy phát triển công nghệ xanh bền vững." 
        :url="$canonical" 
    />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative jarallax text-light">
            <img src="{{ asset('assets/images/background/8.webp') }}" class="jarallax-img" alt="Subheader research background">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="{{ route('services.index') }}">Lĩnh vực</a></li>
                            <li class="active">Nghiên cứu & Chuyển giao</li>
                        </ul>
                        <h1 class="text-uppercase">Nghiên cứu & Chuyển giao</h1>
                        <p class="col-lg-10">Kết nối nghiên cứu khoa học thực nghiệm với nhu cầu thực tế của doanh nghiệp nhằm thúc đẩy phát triển công nghệ xanh bền vững.</p>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/images/logo-wm.webp') }}" class="abs end-0 bottom-0 z-2 w-20" alt="GREECO logo watermark">
            <div class="de-overlay"></div>
        </section>

        <section>
            <div class="container">
                <div class="row g-4 gx-5">
                    <div class="col-lg-3">
                        <div class="me-lg-3">
                            <a href="{{ route('services.dao-tao') }}" class="bg-light d-block p-3 px-4 rounded-10px mb-3"><h4 class="mb-0">Đào tạo & Bồi dưỡng</h4></a>
                            <a href="{{ route('services.tu-van') }}" class="bg-light d-block p-3 px-4 rounded-10px mb-3"><h4 class="mb-0">Dịch vụ Tư vấn</h4></a>
                            <a href="{{ route('services.du-an') }}" class="bg-light d-block p-3 px-4 rounded-10px mb-3"><h4 class="mb-0">Phát triển Dự án</h4></a>
                            <a href="{{ route('services.nghien-cuu') }}" class="bg-color text-light d-block p-3 px-4 rounded-10px mb-3 relative"><h4 class="mb-0">Nghiên cứu & Chuyển giao</h4><i class="icofont-long-arrow-right absolute abs-middle fs-24 end-20px"></i></a>
                            <a href="{{ route('services.hoi-thao') }}" class="bg-light d-block p-3 px-4 rounded-10px mb-3"><h4 class="mb-0">Hội thảo & Truyền thông</h4></a>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <h2><span class="id-color-2">Nghiên cứu Ứng dụng</span> & Chuyển giao Công nghệ Xanh</h2>
                                <p class="lead">Viện GREECO hoạt động như một cầu nối giữa các viện trường và thực tế sản xuất. Chúng tôi thực hiện các đề tài nghiên cứu khoa học chuyên sâu, phân tích tác động môi trường và biến đổi khí hậu, đồng thời chuyển giao các giải pháp công nghệ xanh hiệu quả cho cộng đồng doanh nghiệp.</p>
                            </div>
                        </div>

                        <div class="spacer-double"></div>

                        <div class="row g-4">
                            <!-- Research Area 1 -->
                            <div class="col-lg-12">
                                <div class="p-4 rounded-10px research-card mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="service-feature-icon service-feature-icon-lg bg-color text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fa-solid fa-flask"></i>
                                        </div>
                                        <h4 class="mb-0">Nghiên cứu khoa học và phát triển công nghệ</h4>
                                    </div>
                                    <p class="mb-3 text-justify">Thực hiện các đề tài, dự án nghiên cứu khoa học cấp Nhà nước, cấp Bộ và cấp Tỉnh trong lĩnh vực kỹ thuật môi trường, tái sử dụng chất thải và tối ưu hóa hiệu quả sử dụng tài nguyên. Nghiên cứu phát triển các sản phẩm sinh học thân thiện với môi trường, các mô hình kinh tế xanh thực tiễn phục vụ định hướng phát triển của địa phương và quốc gia.</p>
                                </div>
                            </div>

                            <!-- Research Area 2 -->
                            <div class="col-lg-12">
                                <div class="p-4 rounded-10px research-card mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="service-feature-icon service-feature-icon-lg bg-color text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fa-solid fa-temperature-arrow-up"></i>
                                        </div>
                                        <h4 class="mb-0">Nghiên cứu biến đổi khí hậu và giải pháp thích ứng</h4>
                                    </div>
                                    <p class="mb-3 text-justify">Nghiên cứu, đánh giá tác động của biến đổi khí hậu lên hệ sinh thái, sản xuất nông nghiệp và đời sống cộng đồng. Ứng dụng công nghệ GIS và viễn thám để xây dựng bản đồ cảnh báo thiên tai, đề xuất các mô hình thích ứng thông minh với khí hậu, giảm thiểu tổn thất và xây dựng cộng đồng/doanh nghiệp có khả năng tự phục hồi cao.</p>
                                </div>
                            </div>

                            <!-- Research Area 3 -->
                            <div class="col-lg-12">
                                <div class="p-4 rounded-10px research-card mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="service-feature-icon service-feature-icon-lg bg-color text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </div>
                                        <h4 class="mb-0">Chuyển giao công nghệ và giải pháp xanh</h4>
                                    </div>
                                    <p class="mb-3 text-justify">Nhận chuyển giao và thương mại hóa các công nghệ môi trường tiên tiến từ các đối tác quốc tế. Tư vấn thiết kế, chuyển giao các dây chuyền công nghệ xử lý nước thải sinh hoạt/công nghiệp, quy trình sản xuất sạch hơn, giải pháp tiết kiệm năng lượng và các mô hình tuần hoàn chất thải nông nghiệp quy mô trang trại, nhà máy.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
    </div>
@endsection
