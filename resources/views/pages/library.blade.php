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

        <section id="subheader" class="relative jarallax text-light">
            <img src="{{ asset('assets/images/background/8.webp') }}" class="jarallax-img" alt="Thư viện GREECO">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="active">Thư viện & Tài liệu</li>
                        </ul>
                        <h1 class="text-uppercase">Thư viện & Hồ sơ</h1>
                        <p class="col-lg-10 lead">Hệ thống cơ sở dữ liệu pháp luật môi trường và Hồ sơ năng lực hoạt động toàn diện của Viện GREECO.</p>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/images/logo-wm.webp') }}" class="abs end-0 bottom-0 z-2 w-20" alt="GREECO watermark">
            <div class="de-gradient-edge-top dark"></div>
            <div class="de-overlay"></div>
        </section>

        <!-- Hồ sơ năng lực Section -->
        <section class="pb40">
            <div class="container relative z-1">
                <div class="row g-4 gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="subtitle wow fadeInUp mb-3">Hồ sơ năng lực</div>
                        <h2 class="text-uppercase wow fadeInUp" data-wow-delay=".2s">Giới thiệu Năng lực <span class="id-color-2">GREECO Profile</span></h2>
                        <p class="wow fadeInUp">Hồ sơ năng lực (Capability Profile) của Viện Nghiên cứu và Phát triển Kinh tế Xanh tổng hợp đầy đủ thông tin pháp lý, cơ sở vật chất, trang thiết bị kỹ thuật hiện đại cùng danh sách các chuyên gia khoa học đầu ngành. Tài liệu này cung cấp cái nhìn toàn diện về năng lực triển khai các đề tài nghiên cứu, tư vấn chuyên sâu về ESG, kiểm kê khí nhà kính, chuyển giao công nghệ hóa học - môi trường xanh và phát triển dự án tín chỉ carbon.</p>
                        <p class="wow fadeInUp">Chúng tôi cam kết đồng hành cùng cơ quan quản lý và các doanh nghiệp trong lộ trình chuyển đổi xanh, thực thi trách nhiệm xã hội và hướng tới mục tiêu phát thải ròng bằng không (Net Zero).</p>
                        <div class="spacer-20"></div>
                        <a class="btn-main wow fadeInUp" href="{{ asset('assets/docs/GREECO_Capability_Profile.pdf') }}" download><i class="fa fa-download me-2"></i>Tải Hồ sơ năng lực (PDF)</a>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="bg-color-2 text-light p-4 rounded-1 h-100 relative">
                                    <i class="fa fa-award fs-36 mb-3 id-color-2"></i>
                                    <h4>Pháp lý vững chắc</h4>
                                    <p class="op-7">Giấy đăng ký hoạt động KH&CN do Sở Khoa học và Công nghệ TP.HCM cấp phép.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-color-2 text-light p-4 rounded-1 h-100 relative">
                                    <i class="fa fa-users fs-36 mb-3 id-color-2"></i>
                                    <h4>Đội ngũ chuyên gia</h4>
                                    <p class="op-7">Hội đồng khoa học gồm các Giáo sư, Tiến sĩ đầu ngành Hóa học, Sinh học và Kỹ thuật Môi trường.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-color-2 text-light p-4 rounded-1 h-100 relative">
                                    <i class="fa fa-flask fs-36 mb-3 id-color-2"></i>
                                    <h4>Phòng thí nghiệm</h4>
                                    <p class="op-7">Hợp tác chặt chẽ với các phòng thí nghiệm trọng điểm, trang thiết bị phân tích hiện đại bậc nhất.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-color-2 text-light p-4 rounded-1 h-100 relative">
                                    <i class="fa fa-handshake fs-36 mb-3 id-color-2"></i>
                                    <h4>Đối tác toàn cầu</h4>
                                    <p class="op-7">Hành trình hợp tác khoa học rộng khắp với các tổ chức quốc tế từ EU, Nhật Bản, Hàn Quốc.</p>
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
                        <h2 class="text-uppercase wow fadeInUp" data-wow-delay=".2s">Văn bản Pháp luật <span class="id-color-2">Môi trường & Khí hậu</span></h2>
                        <p class="wow fadeInUp">Hệ thống hóa các văn bản quy phạm pháp luật, quyết định và thông tư quan trọng của Nhà nước điều chỉnh các hoạt động bảo vệ môi trường, biến đổi khí hậu và kiểm kê khí nhà kính tại Việt Nam.</p>
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
                                    <!-- Doc 1 -->
                                    <tr>
                                        <td><strong>Luật số 72/2020/QH14</strong></td>
                                        <td>
                                            <span class="badge bg-success mb-2">Luật Quốc hội</span>
                                            <h5 class="mb-1 text-dark">Luật Bảo vệ Môi trường 2020</h5>
                                            <p class="mb-0 text-muted fs-14">Khung pháp lý cao nhất về bảo vệ môi trường, quản lý chất thải, đánh giá tác động môi trường, và các công cụ kinh tế môi trường.</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="https://vanban.chinhphu.vn/?pageid=27160&docid=202616" target="_blank" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa fa-external-link me-1"></i>Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    <!-- Doc 2 -->
                                    <tr>
                                        <td><strong>Nghị định 06/2022/NĐ-CP</strong></td>
                                        <td>
                                            <span class="badge bg-primary mb-2">Nghị định Chính phủ</span>
                                            <h5 class="mb-1 text-dark">Nghị định quy định giảm nhẹ phát thải khí nhà kính và bảo vệ tầng ô-dôn</h5>
                                            <p class="mb-0 text-muted fs-14">Quy định chi tiết về hạn ngạch phát thải, tổ chức thị trường carbon trong nước, kiểm kê khí nhà kính (GHG) và hoạt động giảm nhẹ phát thải.</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="https://vanban.chinhphu.vn/?pageid=27160&docid=205169" target="_blank" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa fa-external-link me-1"></i>Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    <!-- Doc 3 -->
                                    <tr>
                                        <td><strong>Quyết định 01/2022/QĐ-TTg</strong></td>
                                        <td>
                                            <span class="badge bg-warning text-dark mb-2">Quyết định Thủ tướng</span>
                                            <h5 class="mb-1 text-dark">Danh mục cơ sở phát thải khí nhà kính phải thực hiện kiểm kê khí nhà kính</h5>
                                            <p class="mb-0 text-muted fs-14">Danh sách chi tiết các nhà máy, cơ sở sản xuất thuộc ngành công thương, xây dựng, giao thông vận tải, tài nguyên môi trường bắt buộc thực hiện kiểm kê phát thải.</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="https://vanban.chinhphu.vn/?pageid=27160&docid=205187" target="_blank" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa fa-external-link me-1"></i>Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    <!-- Doc 4 -->
                                    <tr>
                                        <td><strong>Thông tư 01/2022/TT-BTNMT</strong></td>
                                        <td>
                                            <span class="badge bg-secondary mb-2">Thông tư Bộ TN&MT</span>
                                            <h5 class="mb-1 text-dark">Thông tư quy định chi tiết thi hành Luật BVMT về ứng phó với biến đổi khí hậu</h5>
                                            <p class="mb-0 text-muted fs-14">Hướng dẫn quy trình kỹ thuật kiểm kê khí nhà kính, xây dựng báo cáo giảm phát thải cấp cơ sở và thẩm định kết quả kiểm kê.</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="https://vanban.chinhphu.vn/?pageid=27160&docid=205216" target="_blank" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa fa-external-link me-1"></i>Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    <!-- Doc 5 -->
                                    <tr>
                                        <td><strong>Nghị định 08/2022/NĐ-CP</strong></td>
                                        <td>
                                            <span class="badge bg-primary mb-2">Nghị định Chính phủ</span>
                                            <h5 class="mb-1 text-dark">Nghị định quy định chi tiết một số điều của Luật Bảo vệ Môi trường</h5>
                                            <p class="mb-0 text-muted fs-14">Quy định chi tiết về đánh giá tác động môi trường (ĐTM), giấy phép môi trường (GPMT), đăng ký môi trường, và trách nhiệm tái chế sản phẩm của nhà sản xuất (EPR).</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="https://vanban.chinhphu.vn/?pageid=27160&docid=205168" target="_blank" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa fa-external-link me-1"></i>Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    <!-- Doc 6 -->
                                    <tr>
                                        <td><strong>Khung báo cáo ESG & GRI</strong></td>
                                        <td>
                                            <span class="badge bg-info text-dark mb-2">Khung Tiêu chuẩn Quốc tế</span>
                                            <h5 class="mb-1 text-dark">GRI Standards & Khung hướng dẫn báo cáo CBAM, EUDR</h5>
                                            <p class="mb-0 text-muted fs-14">Tài liệu hướng dẫn xây dựng báo cáo phát triển bền vững ESG của doanh nghiệp; quy chế điều chỉnh biên giới carbon (CBAM) phục vụ xuất khẩu sang EU và tiêu chuẩn chống phá rừng EUDR.</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('services.index') }}" class="btn-main btn-line py-2 px-3 fs-13"><i class="fa-solid fa-circle-info me-1"></i>Liên hệ Tư văn</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
@endsection
