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
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-6 d-flex flex-column">
                        <div class="mb-4">
                            <h2 class="wow fadeInUp text-success fw-bold" style="font-size: 32px; letter-spacing: -0.5px;">Gửi tin nhắn cho chúng tôi</h2>
                            <p class="text-muted" style="font-size: 15px; line-height: 1.6;">Nếu bạn có bất kỳ câu hỏi, đề xuất hợp tác hoặc yêu cầu tư vấn nào, xin vui lòng điền vào biểu mẫu dưới đây. Đội ngũ chuyên gia của chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>
                        </div>

                        <div class="contact-info-card overflow-hidden flex-grow-1">
                            <div class="row g-0 h-100">
                                <div class="col-sm-6">
                                    <div class="contact-image-col h-100" style="background-image: url('{{ setting('contact_image') ? asset('storage/' . setting('contact_image')) : asset('assets/images/blog/1.webp') }}');"></div>
                                </div>   
                                <div class="col-sm-6 relative d-flex align-items-center">
                                    <div class="p-30 w-100">
                                        <!-- Working hours -->
                                        <div class="contact-item">
                                            <div class="contact-icon-badge">
                                                <i class="fa-regular fa-clock"></i>
                                            </div>
                                            <div class="contact-text-group">
                                                <span class="contact-label">Thời gian làm việc</span>
                                                <span class="contact-value">{{ setting('work_hours', 'Thứ 2 - Thứ 7: 08:00 - 17:00') }}</span>
                                            </div>
                                        </div>

                                        <!-- Office Address -->
                                        <div class="contact-item">
                                            <div class="contact-icon-badge">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <div class="contact-text-group">
                                                <span class="contact-label">Địa chỉ văn phòng</span>
                                                <span class="contact-value">{{ setting('address', '150 Đường 38-CL, Phường Cát Lái, TP. HCM') }}</span>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="contact-item">
                                            <div class="contact-icon-badge">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="contact-text-group">
                                                <span class="contact-label">Điện thoại liên hệ</span>
                                                <a href="tel:{{ str_replace(' ', '', setting('phone', '0936996390')) }}" class="contact-value text-decoration-none hover-underline text-white">{{ setting('phone', '09369 96390') }}</a>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="contact-item">
                                            <div class="contact-icon-badge">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="contact-text-group">
                                                <span class="contact-label">Email liên hệ</span>
                                                <a href="mailto:{{ setting('email', 'info@greeco.vn') }}" class="contact-value text-decoration-none hover-underline text-white">{{ setting('email', 'info@greeco.vn') }}</a>
                                            </div>
                                        </div>                                            
                                    </div>
                                </div>                             
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center">
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

                        <div class="contact-form-wrapper">
                            <form name="contactForm" id="contact_form" class="position-relative z1000" method="post" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="field-set mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên" value="{{ old('name') }}" required>
                                </div>

                                <div class="field-set mb-3">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Địa chỉ Email" value="{{ old('email') }}">
                                </div>

                                <div class="field-set mb-3">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                </div>

                                <div class="field-set mb-4">
                                    <textarea name="message" id="message" class="form-control" placeholder="Nội dung tin nhắn / Yêu cầu tư vấn" required>{{ old('message') }}</textarea>
                                </div>
                                    
                                <div id="submit" class="text-end">
                                    <input type="submit" id="send_message" value="Gửi tin nhắn" class="btn-main w-100 w-sm-auto">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>            
    </div>
@endsection


