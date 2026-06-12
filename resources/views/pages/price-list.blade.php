@php
    $seoTitle = 'Bảng giá Dịch vụ Tham khảo - Viện GREECO';
    $seoDescription = 'Bảng giá tham khảo cho các dịch vụ đào tạo chuyên môn và tư vấn môi trường của Viện GREECO.';
    $canonical = route('price-list');
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Bảng giá tham khảo', 'url' => route('price-list')]
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
                            <li class="active">Bảng giá tham khảo</li>
                        </ul>
                        <h1 class="text-uppercase">Bảng giá tham khảo</h1>
                        <p class="col-lg-10 lead">Bảng giá tham khảo các hạng mục đào tạo chuyên môn và tư vấn môi trường tại Viện GREECO.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row g-lg-4 gx-lg-5">
                    <div class="col-xl-6">
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Khảo sát phát thải ban đầu</h5>
                                Khảo sát thực địa và thu thập số liệu phát thải tại nhà máy/văn phòng.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Đào tạo nhận thức ESG</h5>
                                Tổ chức khóa học tập huấn cơ bản về phát triển bền vững cho nhân viên.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Tư vấn lộ trình Net Zero</h5>
                                Tư vấn chuyên sâu về giảm phát thải khí nhà kính và chuyển dịch xanh.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Tính toán carbon Scope 1 & 2</h5>
                                Xác định phát thải trực tiếp và gián tiếp từ điện năng tiêu thụ.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Tính toán carbon Scope 3</h5>
                                Đo lường phát thải gián tiếp từ chuỗi cung ứng và logistics.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Báo cáo ESG Thường niên</h5>
                                Hỗ trợ tổng hợp dữ liệu và lập báo cáo phát triển bền vững đạt chuẩn GRI.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Đánh giá Tiêu chuẩn ISO 14064</h5>
                                Thẩm định hệ thống quản trị và kiểm kê khí nhà kính.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Tư vấn Tiết kiệm Năng lượng</h5>
                                Đánh giá các giải pháp kỹ thuật và tích hợp năng lượng tái tạo.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Đánh giá Kinh tế Tuần hoàn</h5>
                                Đo lường mức độ tối ưu hóa tài nguyên và quản lý chất thải.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Hồ sơ Môi trường Định kỳ</h5>
                                Hỗ trợ thủ tục xin giấy phép môi trường và lập báo cáo giám sát định kỳ.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Chứng nhận Công trình Xanh</h5>
                                Tư vấn hồ sơ đạt chứng nhận LEED, EDGE hoặc LOTUS cho nhà máy.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Đào tạo Báo cáo viên ESG</h5>
                                Huấn luyện kỹ năng viết báo cáo tích hợp cho đội ngũ quản lý doanh nghiệp.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Xây dựng Dự án Tín chỉ Rừng</h5>
                                Thiết lập và đăng ký dự án hấp thụ carbon từ bảo tồn rừng tự nhiên.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Giám sát Dự án Tín chỉ Carbon</h5>
                                Đo đạc và lập báo cáo theo dõi lượng carbon hấp thụ định kỳ hàng năm.
                            </div>
                            <div class="text-end">
                                <h5 class="fw-500 mb-1">Liên hệ</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h4>Lưu ý quan trọng</h4>
                        <ul class="px-3">
                            <li>Mức chi phí mang tính chất tham khảo và có thể thay đổi tùy theo quy mô, mức độ phức tạp của dự án, địa điểm triển khai và hồ sơ đi kèm.</li>
                            <li>Một số dịch vụ phức tạp yêu cầu chuyên gia của Viện khảo sát thực địa trực tiếp trước khi đưa ra báo giá chính thức.</li>
                            <li>Viện GREECO có chính sách hỗ trợ chi phí cho các chương trình hợp tác nghiên cứu dài hạn hoặc gói dịch vụ tích hợp.</li>
                        </ul>
                        Bảng chi phí trên mang tính tham khảo và sẽ được tùy chỉnh theo nhu cầu và đặc thù thực tế của từng đối tác.
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
