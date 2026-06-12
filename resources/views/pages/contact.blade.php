@php
    $seoTitle = 'Liên hệ - Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO';
    $seoDescription = 'Thông tin liên hệ chính thức của Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO. Địa chỉ, số điện thoại, email và bản đồ hướng dẫn.';
    $canonical = route('contact');

    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Liên hệ', 'url' => route('contact')]
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
                            <li class="active">Liên hệ</li>
                        </ul>
                        <h1 class="text-uppercase">Liên hệ</h1>
                        <p class="col-lg-10 lead">Kết nối với GREECO để cùng kiến tạo tương lai xanh bền vững.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <h3 class="wow fadeInUp">Gửi tin nhắn cho chúng tôi</h3>

                        <p>Nếu bạn có bất kỳ câu hỏi, đề xuất hợp tác hoặc yêu cầu tư vấn nào, xin vui lòng điền vào biểu
                            mẫu dưới đây. Đội ngũ chuyên gia của chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>

                        <div class="spacer-single"></div>

                        <div class="rounded-1 bg-light overflow-hidden">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <div class="auto-height relative"
                                        data-bgimage="url({{ setting('contact_image') ? asset('storage/' . setting('contact_image')) : asset('assets/images/blog/1.webp') }})">
                                    </div>
                                </div>
                                <div class="col-sm-6 relative">
                                    <div class="p-30">
                                        <div class="fw-bold text-dark"><i
                                                class="icofont-clock-time me-2 id-color-2"></i>Thời gian làm việc</div>
                                        {{ setting('work_hours', 'Thứ 2 - Thứ 7: 08:00 - 17:00') }}

                                        <div class="spacer-20"></div>

                                        <div class="fw-bold text-dark"><i
                                                class="icofont-location-pin me-2 id-color-2"></i>Địa chỉ văn phòng</div>
                                        {{ setting('address', '150 Đường 38-CL, Phường Cát Lái, TP. HCM') }}

                                        <div class="spacer-20"></div>

                                        <div class="fw-bold text-dark"><i class="icofont-phone me-2 id-color-2"></i>Điện
                                            thoại liên hệ</div>
                                        {{ setting('phone', '09369 96390') }}

                                        <div class="spacer-20"></div>

                                        <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color-2"></i>Email
                                            liên hệ</div>
                                        {{ setting('email', 'info@greeco.vn') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        @if(session('success'))
                            <div class="alert alert-success mb-4">
                                <i class="icofont-check-circled me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <i class="icofont-warning-alt me-2"></i><strong>Có lỗi xảy ra:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form name="contactForm" id="contact_form" class="position-relative z1000" method="post"
                            action="{{ route('contact.store') }}">
                            @csrf
                            <div class="field-set">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="field-set">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Địa chỉ Email"
                                    value="{{ old('email') }}">
                            </div>

                            <div class="field-set">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại"
                                    value="{{ old('phone') }}">
                            </div>

                            <div class="field-set mb20">
                                <textarea name="message" id="message" class="form-control"
                                    placeholder="Nội dung tin nhắn / Yêu cầu tư vấn"
                                    required>{{ old('message') }}</textarea>
                            </div>

                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='Gửi tin nhắn' class="btn-main">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="no-top pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-map-container">
                            <iframe 
                                src="https://maps.google.com/maps?q={{ urlencode(setting('address', '150 Đường 38-CL, Phường Cát Lái, TP. HCM')) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection